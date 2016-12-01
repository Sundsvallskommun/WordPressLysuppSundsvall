# lysuppsundsvall.se - Dokumentation

Sidan är byggd i WordPress och temat är byggt för version 4.3.1. Det bör inte finnas någon större anledning att uppdatera så det görs på egen risk.

## 1. Installation
1. Ladda ner allt från GitHub.
2. Sätt upp en webbserver. Vi kör med PHP (v5.5.38) och MySQL.
3. Installera WordPress enligt instruktioner.
4. Sätt upp de extra tabellerna som behövs enligt instruktioner nedan.
5. Byt tema (via wp-admin) till `Lysuppsundsvall`.
5. Sätt upp en sida, namn spelar ingen roll och välj denna som startsida i WordPress-inställningarna.
6. Genom att välja sidmall (Page Template) för den uppsatta sidan så är sajten antingen i röstnings eller vinnarstadiet.

## 1.2 Installationsnotering

__OBS:__ Detta gäller om man önskar återställa förra årets sida.

Template-filerna är "hårdkodade" för förra årets bidrag så för att återskapa sidan helt behövs dessa rader i `lysupp_contributions`-tabellen:

![Databasrader](http://image.prntscr.com/image/283c1f6285064e8084181e568dfa29b4.png "Förra årets bidrag")

SQL för att lägga in dessa:
```
INSERT INTO `wp_lysupp_contributions` (`id`, `contribution_id`, `contribution_name`) VALUES
(1, 2141515, 'Judo Sundsvall'),
(2, 2141518, 'Internationella Engelska skolans klass 9b'),
(3, 2141517, 'Hagaskolans klass 8c:2'),
(4, 2141516, 'Bergsåkers Badminton');
```

## 1.3 Databastabeller

Båda tabeller har prefixet som ställs in vid installation av WordPress. Standard är `wp_`.

### 1.3.1 lysupp_contributions

Kolumner:
1. `id`, `int(6)` (primärnyckel, auto_increment), `NOT NULL`.
2. `contribution_id`, `int(6)`, `NOT NULL`
3. `contribution_name`, `varchar(50)`, `NOT NULL`

Bild för exempel:

![Exempel](http://image.prntscr.com/image/f134d521b4784f6683991ec78c6b8b5e.png "lysupp_contributions")

### 1.3.2 lysupp_votes

Kolumner:

1. `id`, `int(6)` (primärnyckel, auto_increment), `NOT NULL`
2. `contribution_id`, `int(50)`, `NOT NULL`
3. `voter`, `bigint(100)`

Bild för exempel:

![Exempel](http://image.prntscr.com/image/8765afd3755b4ac49f88f5cf252a0a66.png "lysupp_votes")

## 2. Funktionsspecifikation

Båda sidmallarna är statiska och inställda efter förra årets bidrag så för att lägga in nya bidrag så kommer det krävas modifikation av dessa filer.

Observera: röstningsfunktionen är satt så varje användare (från Twitter eller Facebook) bara kan lägga en röst så i testningssyfte så måste man gå in i databasen och ändra ``voter` fältet i ``lysupp_votes` eller helt enkelt ta bort raden helt om man vill kunna rösta mer än en gång.

Nedan följer ett exempel på ett bidrag i `vote.php` angående hur det ser ut och hur ska det ska lägas in.

(Pastebin: [länk](http://pastebin.com/bKumUCr8))

```html
<div class="lysupp-voting">
    <a target="_blank" href="https://www.facebook.com/JudoSundsvall/posts/906463856136350">
        <div class="img-wrap"></div>
    </a>
    <div class="voting-info">
        <h2>
            Judo Sundsvall
        </h2>
        <p>
            En lysande kampsport
        </p>
        <div class="voting-rotation">
            <div class="vote-1 slide">
                <div class="vote popup-trigger" data-id="2141515" data-text='+ Röstat'>
                    <span>Rösta!</span>
                </div>
                <?php $votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $votes_table WHERE contribution_id = %d", '2141515')) ?>
                <div class="voteing-results">
                    <?php if($votes !== false){ echo $votes; } if(($votes > 1) || ($votes == 0)){ echo ' Röster'; } else { echo ' Röst'; } ?>
                </div>
            </div>
            <div class="vote-2 slide">
                <div class="vote" data-id="2141515">
                    Tack!
                </div>
                <div class="voteing-results">
                    Tack för din röst.
                </div>
            </div>
            <div class="vote-3 slide">
                <div class="vote" data-id="2141515">
                    Fel!
                </div>
                <div class="voteing-results">
                    Tyvärr gick något fel..
                </div>
            </div>
        </div><a href="" class="share" data-title="En lysande kampsport" data-desc="Judo Sundsvall" data-image="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12376735_906463856136350_2846029237074411243_n.jpg"><span>Dela p&aring; Facebook</span></a>
    </div>
</div>
```

Det är alltså ett sånt här block för varje bidrag. Varje block ska ligga inom `<div class="voting-content"></div>`.

För att ändra/lägga till nytt bidrag:

1. ` <a target="_blank" href="https://www.facebook.com/JudoSundsvall/posts/906463856136350">` attributet `href`bör peka till bidragets facebook inlägg.
2. `<h2>` pekar till bidragets namn.
3. `<p>` pekear till bidragets beskrivning.
3. `<div class="vote popup-trigger" data-id="2141515" data-text='+ Röstat'>` attributet `data-id` representerar `contribution_id` från databasen.
4. `<?php $votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $votes_table WHERE contribution_id = %d", '2141515')) ?>` strängen: '2141515', representerar `contribution_id` från databasen.
5. `<div class="vote" data-id="2141515">` (två tillfällen) representerar `contribution_id` från databasen.

## 2.1 Användning

Enklaste sättet att verifiera att allt fungerar är att följa instruktionerna ovan för att installera och återställa.

### 2.1.1 Ändra bidragen

För att ändra bidragen: lägg till en ny rad i databastabellen `lysupp_contribution`. Fältet `contribution_id` är en godtycklig siffra men det är viktigt att denna sedan noteras. Fältet `contribution_name` är bidragets namn.

Ändra sedan i sidmallen `vote.php` enligt instruktioner ovan.

### 2.1.2 Vinnarsidan

Vinnarsidan är helt statiskt gjord. Vinnartexten, bidragen och antalet röster är saker man måste ändra direkt i sidmallen (`winner.php`).

## 3. Eventuella problem

### 3.1 URL:er

Det är viktigt att alla URL:er stämmer i källkoden. Dessa är nämligen hårdkodade just nu till `http://www.lysuppsundsvall.se/` så om det ska testas någon annstans så måste dessa ändras.

Här är en lista på alla URL referenser i källkoden:

1. Variabel `redir` i fil `main.js:50`
2. Sträng i fil `main.js:122`
3. Sträng i fil `lysupp_vote.php:38`
4. Sträng i fil `lysupp_vote.php:84`

### 3.2 Twitter API

Det kan hända att man kommer behöva ställa om `consumer_key` och `consumer_secret` för Twitter beroende på vad man får för fel.

Dessa är definerade i `lysupp_vote.php` på rad 11, 12 samt 79 och 80.

Det kan också vara så att sidans URL inte är definerad som en callback-URL i Twitter appen.

### Facebook API

Det är viktigt att sidans URL finns definerad i Facebook Appens lista av URL:er annars kommer det inte gå att autensiera användaren för att kunna rösta.

Precis som för Twitter så behövs det även här autensiering för sin facebook app. Det enda som behövs här är dock `applikation_id`. Detta är definerat i `main.js` på rad 52 och 79.

### 3.3 Databasrelaterade problem

Se till att våra databaser är uppsatta och att alla bidrag som finns i templates också finns i databasen. Detta gäller om felmeddelandet "Bidraget hittades inte" uppstår när man försöker rösta.
