<?php
  $layout = get_field('layout');
  $vimeoID = get_field('vimeoId');
?>

<section class="vimeo text vimeo--<?= $layout ?>">
  <div class="vimeo__wrapper text__wrapper">
    <canvas width="640" height="360"></canvas>
    <iframe src="https://player.vimeo.com/video/<?= $vimeoID ?>?h=c285d7a5fe" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
  </div>
</section>
