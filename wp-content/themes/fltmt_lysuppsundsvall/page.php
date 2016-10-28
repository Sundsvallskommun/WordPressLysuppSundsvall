<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>
<script> var bgUrl = '<?php echo $image[0]; ?>'; </script>

<div class="container center">
    <div class="main-content">
        <?php the_content(); ?>
    </div>
</div>
<?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>