<?php
	//
	//Template Name: Vote
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
    	<h2>VILKEN LJUSFORMATION TYCKER DU ÄR MEST LYSANDE?</h2>
    	<p>Nu hänger det på dig. Vilken ljusformation tycker du är mest lysande? Rösta på ditt favoritbidrag och ta hjälp av dina vänner genom att dela bidraget på Facebook.</p>

    <?php
    	global $wpdb;
		$votes_table = $wpdb->prefix.'lysupp_votes';
    ?>
	<div class="voting-content">
		<!-- Voting content -->
		<div class="lysupp-voting">
			<a target="_blank" href="https://www.facebook.com/JudoSundsvall/posts/906463856136350">
				<div class="img-wrap">
				</div>
			</a>
			<div class="voting-info">
				<h2>Judo Sundsvall</h2>
				<p>En lysande kampsport</p>
				
				<div class="voting-rotation">
					<div class="vote-1 slide">
						<div class="vote popup-trigger" data-id="2141515" data-text='+ Röstat'><span>Rösta!</span></div>
						<?php $votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $votes_table WHERE contribution_id = %d", '2141515')) ?>
						<div class="voteing-results"><?php if($votes !== false){ echo $votes; } if(($votes > 1) || ($votes == 0)){ echo ' Röster'; } else { echo ' Röst'; } ?></div>
					</div>
					<div class="vote-2 slide">
						<div class="vote" data-id="2141515">Tack!</div>
						<div class="voteing-results">Tack för din röst.</div>
					</div>
					<div class="vote-3 slide">
						<div class="vote" data-id="2141515">Fel!</div>
						<div class="voteing-results">Tyvärr gick något fel..</div>
					</div>
				</div>

				<a href="" class="share" data-title="En lysande kampsport" data-desc="Judo Sundsvall" data-image="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12376735_906463856136350_2846029237074411243_n.jpg"><span class="facebook-icon"></span><span>Dela på Facebook</span></a>
			</div>
		</div>

		<!-- Voting content -->
		<div class="lysupp-voting">
			<a target="_blank" href="https://www.facebook.com/photo.php?fbid=1038995466151456">
				<div class="img-wrap">
					<img src="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12391195_1038995466151456_651326068915010000_n.jpg" alt="Bergsåkers Badminton" />
				</div>
			</a>
			<div class="voting-info">
				<h2>Bergsåkers Badminton</h2>
				<p>En lysande fjäderboll</p>
				
				<div class="voting-rotation">
					<div class="vote-1 slide">
						<div class="vote popup-trigger" data-id="2141516" data-text='+ Röstat'><span>Rösta!</span></div>
						<?php $votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $votes_table WHERE contribution_id = %d", '2141516')) ?>
						<div class="voteing-results"><?php if($votes !== false){ echo $votes; } if(($votes > 1) || ($votes == 0)){ echo ' Röster'; } else { echo ' Röst'; } ?></div>
					</div>
					<div class="vote-2 slide">
						<div class="vote" data-id="2141516">Tack!</div>
						<div class="voteing-results">Tack för din röst.</div>
					</div>
					<div class="vote-3 slide">
						<div class="vote" data-id="2141516">Fel!</div>
						<div class="voteing-results">Tyvärr gick något fel..</div>
					</div>
				</div>

				<a href="" class="share" data-title="En lysande fjäderboll" data-desc="Bergsåkers Badminton" data-image="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12391195_1038995466151456_651326068915010000_n.jpg"><span class="facebook-icon"></span><span>Dela på Facebook</span></a>
			</div>
		</div>

		<!-- Voting content -->
		<div class="lysupp-voting">
			<a target="_blank" href="https://www.instagram.com/p/_JbTYYQkJz/">
				<div class="img-wrap">
					<img src="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12328355_491354877713284_612207785_n.jpg" alt="Hagaskolans klass 8c:2" />
				</div>
			</a>
			<div class="voting-info">
				<h2>Hagaskolans klass 8c:2</h2>
				<p>En lysande hälsning till flyktingarna</p>
				
				<div class="voting-rotation">
					<div class="vote-1 slide">
						<div class="vote popup-trigger" data-id="2141517" data-text='+ Röstat'><span>Rösta!</span></div>
						<?php $votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $votes_table WHERE contribution_id = %d", '2141517')) ?>
						<div class="voteing-results"><?php if($votes !== false){ echo $votes; } if(($votes > 1) || ($votes == 0)){ echo ' Röster'; } else { echo ' Röst'; } ?></div>
					</div>
					<div class="vote-2 slide">
						<div class="vote" data-id="2141517">Tack!</div>
						<div class="voteing-results">Tack för din röst.</div>
					</div>
					<div class="vote-3 slide">
						<div class="vote" data-id="2141517">Fel!</div>
						<div class="voteing-results">Tyvärr gick något fel..</div>
					</div>
				</div>

				<a href="" class="share" data-title="En lysande hälsning till flyktingarn" data-desc="Hagaskolans klass 8c:2a" data-image="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12328355_491354877713284_612207785_n.jpg"><span class="facebook-icon"></span><span>Dela på Facebook</span></a>
			</div>
		</div>

		<!-- Voting content -->
		<div class="lysupp-voting">
			<a target="_blank" href="https://www.instagram.com/p/_jzjnCupnH/">
				<div class="img-wrap">
					<img src="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12362487_434371013422882_1591949740_n.jpg" alt="Internationella Engelska skolans klass 9b" />
				</div>
			</a>
			<div class="voting-info">
				<h2>Internationella Engelska skolans klass 9b</h2>
				<p>En lysande prideflagga</p>
				
				<div class="voting-rotation">
					<div class="vote-1 slide">
						<div class="vote popup-trigger" data-id="2141518" data-text='+ Röstat'><span>Rösta!</span></div>
						<?php $votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $votes_table WHERE contribution_id = %d", '2141518')) ?>
						<div class="voteing-results"><?php if($votes !== false){ echo $votes; } if(($votes > 1) || ($votes == 0)){ echo ' Röster'; } else { echo ' Röst'; } ?></div>
					</div>
					<div class="vote-2 slide">
						<div class="vote" data-id="2141518">Tack!</div>
						<div class="voteing-results">Tack för din röst.</div>
					</div>
					<div class="vote-3 slide">
						<div class="vote" data-id="2141518">Fel!</div>
						<div class="voteing-results">Tyvärr gick något fel..</div>
					</div>
				</div>

				<a href="" class="share" data-title="En lysande prideflagga" data-desc="Internationella Engelska skolans klass 9b" data-image="http://www.lysuppsundsvall.nu/wp-content/uploads/2016/01/12362487_434371013422882_1591949740_n.jpg"><span class="facebook-icon"></span><span>Dela på Facebook</span></a>
			</div>
		</div>
		<p class="contrib-byline">Tävlingen avslutas 22 januari klockan 12.00 och vinnaren presenteras på Elens dag den 23 januari vid Stora Torget i Sundsvall.</p>
	</div>

        <?php the_content(); ?>
    </div>
</div>
<?php endwhile; ?>
<?php endif; ?>

<div class="popup" role="alert">
	<div class="popup-container">
		<h2>RÖSTA!</h2>
		<p>Välj vilken typ av röstningsmetod du vill rösta genom</p>
		<div class="social-share share-facebook">Facebook</div>
		<div class="social-share share-twitter">Twitter</div>
		<a href="#0" class="popup-close img-replace"></a>
	</div>
</div> 

<?php get_footer(); ?>