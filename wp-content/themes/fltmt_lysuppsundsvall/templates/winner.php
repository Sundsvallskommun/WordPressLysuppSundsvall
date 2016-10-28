<?php
	//
	//Template Name: Winner
	//
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
if ( ! $image ) {
	$image = array( 'http://www.lysuppsundsvall.nu/wp-content/uploads/2015/11/lysuppsundsvallbg.jpg' );
}
?>
<script> var bgUrl = '<?php echo $image[0]; ?>'; </script>

<div class="container center">
    <div class="main-content">

    	<h2>STORT TACK!</h2>
    	<p>Stort tack till dig som har röstat i årets tävling och till alla er som har hjälpt oss att lysa upp Sundsvall med era ljusformationer. Nu är omröstningen klar och vi gratulerar vinnaren i samband ett evenemang på Elens dag 23 januari. Upplev när vinnaren tar 
emot sitt pris, provkör elbilar och delta i aktiviteter för hela familjen i Stadshuset och på Stora torget i Sundsvall. <a href="https://www.facebook.com/events/494203120761942/" target="_blank">Läs mer om vad som händer på Elens dag.</a></p>


    <?php
    	global $wpdb;
		$votes_table = $wpdb->prefix.'lysupp_votes';
    ?>
	<div class="voting-content">
		<!-- Voting winner-->
		<div class="lysupp-winner">
		<img src="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12391195_1038995466151456_651326068915010000_n.jpg" alt="Judo Sundsvall" />
		
		<div class="voting-info">
			
			<div class="vote"><span>vinnare!</span></div>
			<h2>500 RÖSTER</h2>
			
			<h2>Judo Sundsvall</h2>
			<p>Med den här lysnade bilden från Judo Sundsvall vill vi passa på att önska dig en god jul och ett gott nytt år!</p>
		</div>

		</div>

<div class="row">
		<!-- Voting content -->
		<div class="lysupp-voting">
		<div class="img-wrap">
		<img src="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12376735_906463856136350_2846029237074411243_n.jpg" alt="Judo Sundsvall" />
		</div>
		<div class="voting-info">
			<h2>Judo Sundsvall</h2>
            <p>395 RÖSTER</p>
          </div>
		</div>

		<!-- Voting content -->
		<div class="lysupp-voting">
		<div class="img-wrap">
		<img src="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12362487_434371013422882_1591949740_n.jpg" alt="Judo Sundsvall" />
          </div>
		<div class="voting-info">
			<h2>INTERNATIONELLA ENGELSKA SKOLANS KLASS 9B</h2>
			<p>254 RÖSTER</p>
		</div>

		</div>

		<!-- Voting content -->
		<div class="lysupp-voting">
		<div class="img-wrap">
		<img src="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12328355_491354877713284_612207785_n.jpg" alt="Judo Sundsvall" />
          </div>
		<div class="voting-info">
			<h2>HAGASKOLANS KLASS 8C:2</h2>
			<p>212 RÖSTER</p>
		</div>
		</div>
		</div>
		
	</div>

        <?php the_content(); ?>
    </div>
</div>
<?php endwhile; ?>
<?php endif; ?>
<!--
<div class="popup" role="alert">
	<div class="popup-container">
		<h2>RÖSTA!</h2>
		<p>Välj vilken typ av röstningsmetod du vill rösta genom</p>
		<div class="social-share share-facebook">Facebook</div>
		<div class="social-share share-twitter">Twitter</div>
		<a href="#0" class="popup-close img-replace"></a>
	</div>
</div> 
-->
<?php get_footer(); ?>