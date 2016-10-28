<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php bloginfo('name'); ?></title>
      <link rel="profile" href="http://gmpg.org/xfn/11" />
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
      <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
      <?php wp_head(); ?>
      <script src="https://use.typekit.net/ayi0twc.js"></script>
      <script>
      var templateDir = "<?php bloginfo('template_directory') ?>";
      </script>
  </head>
  <body <?php body_class(); ?>>
  <div id="fb-root"></div>
<script>// <![CDATA[
(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));
// ]]></script>
  
      <nav class="main">
        <a href=""><img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/sundsvall_el_logo.png"></a>
    </nav>
  
 <header>
    
    <div class="logotype center">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/el_logo.png" alt="">
        <p>#LYSUPPSUNDSVALL</p>
    </div>
    
 </header>
 
