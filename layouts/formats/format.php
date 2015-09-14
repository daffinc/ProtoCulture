<article id="post-<?php the_ID(); ?>" class="cf" role="article" itemscope itemtype="http://schema.org/BlogPosting">

  <header class="article-header">
<div class="wrap">
    <h1 class="entry-title single-title" itemprop="headline">
      <?php the_title(); ?>
      </h1>

    <ul class="meta">
      <li>
        <figure class="helper-image" id="<?php echo get_the_author_meta('ID'); ?>" >
          <a href="" id="<?php echo get_the_author_meta('ID'); ?>" class="colaborator">
            <img src="http://cdn.forbes.com.mx/userphoto/<?php echo get_the_author_meta('ID'); ?>.thumbnail.jpg" alt="<?php echo get_the_author_meta('display_name');?>" width="80" height="80" class="photo" />
          </a>
        </figure>
        <small><?php the_author_posts_link(); ?></small>
      </li>

      <li>
        <small><?php category_link(); ?></small>
      </li>

      <li>
        <small>
          <?php
          $archive_year  = get_the_time('Y');
          $archive_month = get_the_time('m');
          $archive_day   = get_the_time('d');
          ?>
          <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>">
          <?php time_ago(); ?>
          </a>
        </small>
      </li>
    </ul>
    </div>


    <figure class="small">
      <?php picturefill('dreams-640x400','dreams-640x400','dreams-480x300'); ?>
      <?php the_post_thumbnail_caption(); ?>
    </figure>

  </header> <?php // end article header ?>

  <section class="entry-content cf" itemprop="articleBody">
<div class="wrap">
    <?php
    the_content();

    wp_link_pages( array(
      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'dreamstheme' ) . '</span>',
      'after'       => '</div>',
      'link_before' => '<span>',
      'link_after'  => '</span>',
      ) );
      ?>
      </div>
    </section> <?php // end article section ?>

    <?php //photoGallery(); ?>

    <footer class="article-footer helper-next cf">
<div class="wrap">
      <div class="post-tags">
        Etiquetas: <?php the_tags('','','');?>
      </div>

      <div id="singles<?php the_id(); ?>" class="authorF cf">
        <figure class="helper-image" id="<?php echo get_the_author_meta('ID'); ?>" >
          <a href="" id="<?php echo get_the_author_meta('ID'); ?>" class="colaborator">
            <img src="http://cdn.forbes.com.mx/userphoto/<?php echo get_the_author_meta('ID'); ?>.thumbnail.jpg" alt="<?php echo get_the_author_meta('display_name');?>" width="80" height="80" class="photo" />
          </a>
        </figure>

        <div id="autor_<?php the_ID(); ?>">
          <h2><?php the_author_posts_link(); ?></h2>
          <?php //  author_info(); ?>
          <p><?php the_author_meta('description');?></p>
        </div>
      </div>

      <?php dreams_related_posts(); ?>
      </div>
    </footer> <?php // end article footer ?>


    <?php comments_template(); ?>

  </article> <?php // end article ?>

  <?php
    locate_template( array('/layouts/sidebars/sidebar_type-a.php' ), true );
  ?>
