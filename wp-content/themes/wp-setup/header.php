<!DOCTYPE html>
<html <?php language_attributes(); ?> class="">
<head>

<!-- adabs.ch -->

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="csrf-token" content="<?= wp_create_nonce( 'ajaxNonce' ); ?>">


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7WL5C65K8C"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7WL5C65K8C', { 'anonymize_ip': true });
</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'G-7WL5C65K8C', 'auto');
</script>


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

  $galleryImages = $img = get_field('images', 'option');
  $isHome = is_front_page();
?>

<header class="header" id="header">

  <?php if(!$isHome): ?>
    <div class="header__imageWrapper">
      <img class="header__image" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
    </div>
  <?php else: ?>
    <div class="swiper-container header__imageWrapper">
      <div class="swiper-wrapper">
        <?php foreach($galleryImages as $img): ?>
          <?php
            $caption = $img['caption'];
            $src = $img['sizes']['L'];
            $srcset = wp_get_attachment_image_srcset($img['ID']);
            $alt = $img['alt'] ? $img['alt'] : $img['name'];
            $imgTitle = $img['title'] ? $img['title'] : $img['name'];
            $srcset = wp_get_attachment_image_srcset($img['ID']);
          ?>
          <div class="swiper-slide">
            <img class="header__image" loading="lazy" src="<?= $src ?>" title="<?= $imgTitle ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>">
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

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
        <?php if(!$isHome): ?>
          <a href="<?= wc_get_cart_url() ?>" class="header__cartWrapper">
            <canvas width="476" height="403"></canvas>
            <svg width="476" height="403" viewBox="0 0 476 403" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M365.446 365.998C365.446 376.09 369.025 384.7 376.157 391.832C383.289 398.971 391.906 402.543 402.002 402.543C412.083 402.543 420.7 398.971 427.832 391.832C434.971 384.7 438.543 376.09 438.543 365.998C438.543 355.906 434.975 347.296 427.832 340.157C420.7 333.025 412.083 329.453 402.002 329.453C391.906 329.453 383.289 333.025 376.157 340.157C369.025 347.296 365.446 355.906 365.446 365.998Z" fill="black"/>
              <path d="M469.658 42.51C466.04 38.893 461.76 37.084 456.81 37.084H113.918C113.725 35.753 113.297 33.328 112.631 29.807C111.965 26.284 111.443 23.478 111.062 21.382C110.679 19.295 109.969 16.771 108.92 13.821C107.873 10.869 106.636 8.53497 105.209 6.82597C103.784 5.10797 101.881 3.63697 99.501 2.39597C97.123 1.16297 94.409 0.542969 91.365 0.542969H18.276C13.324 0.542969 9.042 2.35497 5.426 5.96697C1.809 9.58297 0 13.868 0 18.816C0 23.764 1.809 28.047 5.426 31.663C9.045 35.28 13.328 37.087 18.276 37.087H76.513L127.045 272.063C126.667 272.823 124.716 276.436 121.193 282.911C117.672 289.386 114.865 295.046 112.773 299.899C110.68 304.758 109.633 308.515 109.633 311.178C109.633 316.126 111.442 320.41 115.057 324.032C118.678 327.638 122.959 329.453 127.908 329.453H146.18H420.256C425.204 329.453 429.488 327.639 433.103 324.032C436.723 320.411 438.53 316.127 438.53 311.178C438.53 306.229 436.723 301.945 433.103 298.331C429.489 294.717 425.205 292.903 420.256 292.903H157.596C162.166 283.765 164.45 277.681 164.45 274.635C164.45 272.726 164.212 270.631 163.735 268.352C163.258 266.073 162.688 263.547 162.022 260.783C161.355 258.031 160.929 255.984 160.739 254.65L458.816 219.819C463.569 219.244 467.474 217.205 470.519 213.679C473.565 210.161 475.084 206.117 475.084 201.546V55.363C475.082 50.415 473.278 46.132 469.658 42.51Z" fill="black"/>
              <path d="M109.632 365.998C109.632 376.09 113.199 384.7 120.338 391.832C127.479 398.971 136.088 402.543 146.179 402.543C156.264 402.543 164.878 398.971 172.014 391.832C179.153 384.7 182.724 376.09 182.724 365.998C182.724 355.906 179.156 347.296 172.014 340.157C164.877 333.025 156.265 329.453 146.18 329.453C136.09 329.453 127.475 333.025 120.338 340.157C113.203 347.296 109.632 355.906 109.632 365.998Z" fill="black"/>
            </svg>
            <span class="header__cartAmount"><?= WC()->cart->get_cart_contents_count() ?></span>
          </a>
        <?php endif; ?>
        <div class="header__mobileNavWrapper">
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
