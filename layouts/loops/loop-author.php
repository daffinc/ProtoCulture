<!-- Start Articles Loop -->
<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../../../wp-load.php');

// Our variables
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;

$args = array(
  'posts_per_page' => $numPosts,
  'paged' => $page
  );

$author = new WP_Query($args);
?>

<?php
if (  $author->have_posts() ) :
  while (  $author->have_posts() ) :  $author->the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
  <header class="article-header">
    <figure class="helper-image">
      <?php the_post_thumbnail('lo-ultimo');  ?>
    </figure>
  </header>

  <section class="entry-content cf">
    <small><?php single_cat_title();?></small>
    <h2 class="h2 entry-title">
      <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
      </a>
    </h2>
  </section>
</article>
<?php  endwhile; endif;
wp_reset_postdata(); ?>
<!-- End Articles Loop -->