<div id="content" <?php post_class('white-space'); ?>>
  <div class="container">

    <div class="wrap">
      <article role="article">
        <h1><?php the_title();?></h1>
        <?php the_excerpt();?>
        <footer class="article-footer helper-next cf">
          <!-- <div class="post-tags">
            Etiquetas: <?php // the_tags('','','');?>
          </div> -->
          <hr>
          <?php comments_template(); ?>
        </footer>
      </article>

      <?php locate_template( array('/layouts/sidebars/sidebar_type-d.php' ), true ); ?>
    </div>
  </div>
</div>