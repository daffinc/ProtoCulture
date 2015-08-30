<?php get_header(); ?>
<section id='mainGal' class='cf'>
      <?php
        $args = array(
          'post_type' => 'galerias',
          'order' => 'ASC',
          );
        $queryover = new WP_Query($args);
        ?>
        <?php if ( $queryover->have_posts() ) : while ( $queryover->have_posts() ) : $queryover->the_post();?>
  <article class=\"galLeft\"> <!-- video principal-->;

  <div><p><?php the_content(); ?></p></div>
  </article>
  <article class='galRight'>
    <?php get_gallery(); ?>
  </article>
     <?php endwhile;endif; ?>
    <?php  wp_reset_postdata(); ?>
</section>

<!--DISQUS-->
<?php comments_template(); ?>
<!--DISQUS-->

<section id='masVid cf'>
  <div>
    <h2>Más Galerías</h2>
  </div>
  <div class="listaGal">
      <?php
        $args = array(
          'post_type' => 'galerias',
          'order' => 'DESC',
          'orderby' => 'rand',
          'posts_per_page' => 6,
          'offset'=>1
          );
        $queryover = new WP_Query($args);
        ?>
        <?php if ( $queryover->have_posts() ) : while ( $queryover->have_posts() ) : $queryover->the_post();?>
          <div class='galExtra'>
            <?php  the_content(); ?>
            <?php the_title(); ?>
          </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
</section>
<?php get_footer(); ?>