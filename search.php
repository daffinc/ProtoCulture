<?php get_header(); ?>


<div id="content" class="inner-content-category sep">


  <section class="article-list sep" role="region">
    <?php //locate_template( array('/searchform-archive.php' ), true ); ?>


    <header class="head-line">
      <h2>Est&aacute;s buscando: <?php echo get_search_query(); ?></h2>
    </header>

    <!-- Start Articles Loop -->
    <?php
    global $query_string;

    $query_args = explode("&", $query_string);
    $search_query = array();

    foreach($query_args as $key => $string) {
      $query_split = explode("=", $string);
      $search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

$search = new WP_Query($search_query);
if (  $search->have_posts() ) :
  while (  $search->have_posts() ) :  $search->the_post();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
  <header class="article-header">
    <figure class="helper-image">
      <?php picturefill('dreams-640x400','dreams-640x400','dreams-480x300'); ?>
    </figure>
  </header>
  <section class="entry-content cf">
    <small>
      <?php $categories = get_the_category();
      $category_id = $categories[0]->cat_ID;
      echo get_cat_name($category_id);?><i><?php the_modified_time('F j, Y');?></i>
    </small>
    <h2 class="h2 entry-title">
      <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h2>
    <footer class="byline vcard">
      <small><?php the_author();?></small>
    </footer>
  </section>

</article>
<?php
endwhile;
endif;
?>

<?php wp_reset_postdata(); ?>
<!-- End Articles Loop -->


</section>

</div>

<?php locate_template( array('/layouts/sidebars/sidebar_type-a.php' ), true ); ?>


<?php get_footer(); ?>