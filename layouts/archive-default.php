<?php get_header(); ?>


<div id="content" class="inner-content-category sep">
  <div class="wrap">

    <header class="head-line">
      <h1>
        <?php

        if (function_exists('is_tag') && is_tag()) :
          echo ''.single_tag_title().'';
        elseif (is_search()) :
          echo 'Estas Buscando &quot;'.wp_specialchars($s).'&quot; - ';
        elseif (!(is_404()) && (is_single()) || (is_page())) :
          wp_title('');
        elseif (is_404()) :
          echo 'No disponible por el momento.';
        elseif ( is_day() ) :
          printf( __( 'Archivo del D&iacute;a: <span>%s</span>', 'dreamstheme' ), get_the_date() );
        elseif ( is_month() ) :
         printf( __( 'Archivo del M&eacute;s: <span>%s</span>', 'dreamstheme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'dreamstheme' ) ) );
       elseif ( is_year() ) :
         printf( __( 'Archivo del Año: <span>%s</span>', 'dreamstheme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'dreamstheme' ) ) );
       else :
        wp_title('');
      endif;
      ?>
    </h1>

  </header>

  <section class="article-list sep" role="region">

    <header class="head-line"></header>
    <!-- Start Articles Loop -->


    <?php if(is_author()){ ?>


    <?php
    $author = get_the_author_meta('ID');
    $args = array(
      'author' => $author,
      'posts_per_page' => 8
      );

    $archive = new WP_Query($args);
    if (  $archive->have_posts() ) :
      while (  $archive->have_posts() ) :  $archive->the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
      <header class="article-header">
        <figure class="helper-image">
          <?php picturefill('dreams-480x300','dreams-480x300','dreams-480x300'); ?>
        </figure>
      </header>
      <section class="entry-content cf">
        <small>
          <?php
          $categories = get_the_category();
          $category_id = $categories[0]->cat_ID;
          echo get_cat_name($category_id);?>
          <i><?php time_ago(); ?></i>
        </small>
        <h2 class="h2 entry-title">
          <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </h2>
        <footer class="byline vcard">
          <small><?php the_author();?></small>
          <!-- <small><?php //disqus_count();?></small> -->
        </footer>
      </section>
    </article>
    <?php
    endwhile;
    endif;
    ?>


    <!-- End Articles Loop -->
    <?php wp_reset_postdata(); ?>

    <?php  } elseif(is_category()){ ?>


    <?php
    $cur_cat_id = get_cat_id( single_cat_title("",false) );
    $category = get_cat_slug($cur_cat_id);
    $args = array(
      'cat' => $category,
      'posts_per_page' => 8
      );

    $archive = new WP_Query($args);
    if (  $archive->have_posts() ) :
      while (  $archive->have_posts() ) :  $archive->the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
      <header class="article-header">
        <figure class="helper-image">
          <?php picturefill('dreams-480x300','dreams-480x300','dreams-480x300'); ?>      </figure>
        </header>
        <section class="entry-content cf">
          <small>
            <?php
            $categories = get_the_category();
            $category_id = $categories[0]->cat_ID;
            echo get_cat_name($category_id);?>
            <i><?php time_ago(); ?></i>
          </small>
          <h2 class="h2 entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
          </h2>
          <footer class="byline vcard">
            <small><?php the_author();?></small>
            <!-- <small><?php //disqus_count();?></small> -->
          </footer>
        </section>
      </article>
      <?php
      endwhile;
      endif;
      ?>


      <?php wp_reset_postdata(); ?>

      <?php } elseif(is_tag()){ ?>


      <?php
      $tag = get_query_var('tag');
      $args = array(
        'tag' => $tag,
        'posts_per_page' => 8
        );

      $archive = new WP_Query($args);
      if (  $archive->have_posts() ) :
        while (  $archive->have_posts() ) :  $archive->the_post();
      ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
        <header class="article-header">
          <figure class="helper-image">
            <?php picturefill('dreams-480x300','dreams-480x300','dreams-480x300'); ?>
          </figure>
        </header>
        <section class="entry-content cf">
          <small>
            <?php
            $categories = get_the_category();
            $category_id = $categories[0]->cat_ID;
            echo get_cat_name($category_id);?>
            <i><?php time_ago(); ?></i>
          </small>
          <h2 class="h2 entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
          </h2>
          <footer class="byline vcard">
            <small><?php the_author();?></small>
            <!-- <small><?php //disqus_count();?></small> -->
          </footer>
        </section>
      </article>
      <?php
      endwhile;
      endif;
      ?>


      <?php wp_reset_postdata(); ?>

      <?php } elseif(is_day() || is_month() || is_year()) { ?>


      <?php
      $year = get_the_date('Y');
      $month = get_the_date('m');
      $day = get_the_date('d');

      $args = array(
        'posts_per_page' => 8,
        'post_type' => 'any',
        'post_status' => 'publish',
        'date_query' => array(
          array(
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
            ),
          ),
        );

      $archive_day = new WP_Query($args);
      if (  $archive_day->have_posts() ) :
        while (  $archive_day->have_posts() ) :
          $archive_day->the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
          <header class="article-header">
            <figure class="helper-image">
              <?php picturefill('dreams-480x300','dreams-480x300','dreams-480x300'); ?>
            </figure>
          </header>
          <section class="entry-content cf">
            <small>
              <?php
              $categories = get_the_category();
              $category_id = $categories[0]->cat_ID;
              echo get_cat_name($category_id);
              ?>
              <i><?php time_ago(); ?></i>
            </small>
            <h2 class="h2 entry-title">
              <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </h2>
            <footer class="byline vcard">
              <small><?php the_author();?></small>
              <!-- <small><?php //disqus_count();?></small> -->
            </footer>
          </section>
        </article>
        <?php
        endwhile;
        endif;
        wp_reset_postdata();
        ?>



        <?php } else { ?>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
            <header class="article-header">
              <figure class="helper-image">
                <?php picturefill('dreams-480x300','dreams-480x300','dreams-480x300'); ?>
              </figure>
            </header>
            <section class="entry-content cf">
              <small>
                <?php
                $categories = get_the_category();
                $category_id = $categories[0]->cat_ID;
                echo get_cat_name($category_id);?>
                <i><?php time_ago(); ?></i>
              </small>

              <h2 class="h2 entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
              </h2>

              <footer class="byline vcard">
                <small><?php the_author();?></small>
                <!-- <small><?php //disqus_count();?></small> -->
              </footer>
            </section>
          </article>
          <?php
          endwhile;
          endif;
          wp_reset_postdata();
          ?>


          <?php } ?>

        </section>

      </div>

      <?php locate_template( array('/layouts/sidebars/sidebar_type-a.php' ), true ); ?>

    </div>
    <?php get_footer(); ?>