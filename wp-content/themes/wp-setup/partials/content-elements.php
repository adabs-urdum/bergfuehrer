<?php // FLEXIBLE LAYOUT
  $contentElements = get_field('contentelements');
  if( is_array($contentElements) ):
?>

  <?php foreach ($contentElements as $element): ?>

    <?php
      $layout = $element['acf_fc_layout'];
      $hide = $element['hide'];
      if(!$hide):
    ?>

      <?php if( $layout == 'text' ): ?>
        <?php
          $text = $element['text'];
        ?>

        <section class="text">
          <?= $text ?>
        </section>

      <?php else: ?>
        <?= $layout ?>
      <?php endif; ?>

    <?php endif; ?>

  <?php endforeach; ?>

<?php endif; ?>
