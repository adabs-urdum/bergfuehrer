<!DOCTYPE html>
<html <?php language_attributes(); ?> class="">
<head>

<!-- adabs.ch -->

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="csrf-token" content="<?= wp_create_nonce( 'ajaxNonce' ); ?>">


<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76879621-3"></script> -->
<!-- <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-76879621-3', { 'anonymize_ip': true });
</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-2092620-46', 'auto');
</script> -->


<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
  $img = get_field('headerImage', 'option');
  $caption = $img['caption'];
  $src = $img['sizes']['L'];
  $alt = $img['alt'] ? $img['alt'] : $img['name'];
  $imgTitle = $img['title'] ? $img['title'] : $img['name'];
  $srcset = wp_get_attachment_image_srcset($img['ID']);
?>

<header class="header" id="header">

  <div class="header__imageWrapper">
    <img class="header__image" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
  </div>
  <div class="header__wrapper">
    <div class="header__logoWrapper">
      <a class="header__logoLink" href="/" target="_self">
        <div>
          <canvas width="623" height="485"></canvas>
          <?php include(get_template_directory() . '/includes/logo.svg') ?>
        </div>
      </a>
    </div>
    <div class="header__navWrapper">
      <input class="header__mobileNavCheckbox" type="checkbox" id="mobileNavCheckbox">
      <label class="header__mobileNavLabel" for="mobileNavCheckbox">
        <canvas class="header__mobileNavCanvas" width="20" height="14"></canvas>
        <svg class="header__mobileNavSVG" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 2.25H17" stroke="#575756"/>
          <path d="M0 8.25H17" stroke="#575756"/>
          <path d="M0 14.25H17" stroke="#575756"/>
        </svg>
      </label>
      <nav class="header__nav">
        <?=
          wp_nav_menu([
            'menu'              => "Hauptmenü", // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
            'menu_class'        => "header__menu", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
            'container'         => "", // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
            'container_class'   => "", // (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
            'echo'              => true, // (bool) Whether to echo the menu or return it. Default true.
          ]);
        ?>
        <div>
          <label class="header__mobileNavLabel" for="mobileNavCheckbox">
            <canvas class="header__mobileNavCanvas" width="20" height="14"></canvas>
            <svg class="header__mobileNavSVG" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0.928955 1L18 18.071" stroke="#575756"/>
              <path d="M0.928955 18.0711L18 1.00003" stroke="#575756"/>
            </svg>
          </label>
        </div>
      </nav>
    </div>
  </div>

</header>
