<?php get_header(); ?>

<main>

  <?php
    $pageID = get_the_ID();
  ?>

  <?php if (have_posts()) : while (have_posts()) :?>
    <?php
      the_post();
      get_template_part('partials/content-elements');
    ?>
  <?php endwhile; endif; ?>

  <?php
    if ( has_blocks( $post->post_content ) ) {
      $blocks = parse_blocks( $post->post_content );
      foreach($blocks as $block){
        $blockHtml = render_block($block);
        echo $blockHtml;
      }
    }
  ?>
</main>

<?php get_footer(); ?>
