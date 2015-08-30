<?php
get_header();
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>

<div class="wrap">
<div id="content" class="inner-content-author sep">

  <header class="head-line">
    <h1><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></h1>

    <div id="author" class="authorF">
      <figure class="helper-image" id="<?php echo get_the_author_meta('ID'); ?>" >
        <a href="" id="<?php echo get_the_author_meta('ID'); ?>" class="colaborator">
          <img src="http://cdn.forbes.com.mx/userphoto/<?php echo get_the_author_meta('ID'); ?>.thumbnail.jpg" alt="<?php echo get_the_author_meta('display_name');?>" width="80" height="80" class="photo" />
        </a>
      </figure>
      <div id="autor_<?php the_ID(); ?>">
        <?php echo $curauth->user_description; ?>
      </div>
    </div>


  </header>


  <section class="article-list sep" role="region">

    <header class="head-line">
      <h2>M&aacute;s Notas de <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></h2>
    </header>

    <!-- Start Articles Loop -->
    <?php

    $args = array(
      'author_name' => $curauth->user_login,
      'post_type' => 'any',
      'posts_per_page' => 15,
      );
    $auth = new WP_Query($args);
    ?>
    <?php
    if (  $auth->have_posts() ) :
      while (  $auth->have_posts() ) :  $auth->the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
      <header class="article-header">
        <figure class="helper-image">
          <?php picturefill('dreams-640x400','dreams-640x400','dreams-640x400'); ?>
        </figure>
      </header>
      <section class="entry-content cf">
        <small>
          <?php
          $categories = get_the_category();
          $category_id = $categories[0]->cat_ID;
          echo get_cat_name($category_id);?> <i><?php the_modified_time('F j, Y');?></i>
        </small>
        <h2 class="h2 entry-title">
          <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <?php the_title(); ?>
          </a>
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
wp_reset_postdata(); ?>
<!-- End Articles Loop -->

</section>

</div>

<?php locate_template( array('/layouts/sidebars/sidebar_type-a.php' ), true ); ?>

</div>
<?php get_footer(); ?>