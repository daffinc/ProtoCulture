<?php get_header(); ?>


<div id="content" class="inner-content-category sep">

  <header class="head-line">
    <h1><?php single_tag_title(); ?></h1>
  </header>

  <?php locate_template( array('/layouts/formats/action-featured.php' ), true ); ?>
  <?php banner('type-f'); ?>


  <!-- Start Articles Loop -->
  <?php
  $tag = get_query_var('tag');

  $args = array(
    'tag' => $tag,
    'posts_per_page' => 8,
    'offset' => 1,
    'post_type' => 'any',
    'order' => 'DESC'
    );

  $tag_posts = new WP_Query($args);
  ?>


  <section class="article-list sep" role="region">

    <header class="head-line">
      <h2>M&aacute;s Noticias</h2>
    </header>

    <?php

    if ($tag_posts->have_posts() ) :
      while (  $tag_posts  ->have_posts() ) :  $tag_posts->the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
      <header class="article-header">
        <figure class="helper-image">
          <?php picturefill('dreams-640x400','dreams-560x350','dreams-480x300'); ?>
        </figure>
      </header>
      <section class="entry-content cf">
        <small>
          <?php single_tag_title();?> <i><?php time_ago(); ?></i>
        </small>
        <h2 class="h2 entry-title">
          <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </h2>
        <footer class="byline vcard">
          <small><?php the_author();?></small>
        <!-- <small>
        <?php //disqus_count();?>
      </small> -->
    </footer>
  </section>

</article>
<?php
endwhile;
endif;
wp_reset_postdata();
?>
<!-- End Articles Loop -->

<?php
$tag = get_query_var('tag');
echo do_shortcode('[ajax_load_more seo="true" repeater="template_2" offset="9" posts_per_page="5" scroll="false" pause="true" button_label="Leer más notas" tag="'.$tag.'"]');
?>

</section>

</div>

<?php locate_template( array('/layouts/sidebars/sidebar_type-a.php' ), true ); ?>


<?php get_footer(); ?>