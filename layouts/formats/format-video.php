
<div class="container black-space" role="region">

  <div class="wrap">
    <article id="post-<?php the_ID(); ?>" class="cf" role="article" itemscope itemtype="http://schema.org/BlogPosting">

      <header class="article-header">
        <figure class="icon-play helper-image">
          <a href="<?php the_permalink(); ?>">
            <?php picturefill('dreams-640x400','dreams-640x400'); ?>
          </a>

          <a href="<?php video_url(); ?>" id="openVidOne" data-source="<?php extract_url('full');?>" class="autoplay"></a>
        </figure>

      </header> <?php // end article header ?>


      <aside class="excerpts">
        <h2><?php the_title(); ?></h2>
        <small><?php the_author_posts_link(); ?> |
          <?php
          $archive_year  = get_the_time('Y');
          $archive_month = get_the_time('m');
          $archive_day   = get_the_time('d');
          ?>
          <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>">
            <?php time_ago(); ?>
          </a>
        </small>
      </aside>

    </article> <?php // end article ?>




    <div class="more-videos grid grid-inline" style="clear:both;">

      <div class="more-videos--one">
        <header class="head-line cf"><h3>Más recientes</h3></header>

        <?php

        $args = array(
         'post_type' => 'media_videos',
         'order' => 'DESC',
         'posts_per_page' => 10

         );
        $ultimas = new WP_Query($args);

        ?>

        <nav class="more-videos--arrows" id="moreVideoArrowsOne"></nav>
        <div class="article-grid cf"  id="vidNews">

          <?php if ( $ultimas->have_posts() ) : while ( $ultimas->have_posts() ) : $ultimas->the_post(); ?>
            <div class="item">
              <figure class="helper-image">
                <a href="<?php the_permalink(); ?>">
                  <?php picturefill('dreams-240x150','dreams-240x150'); ?>
                </a>
              </figure>
              <small><a href="<?php the_permalink();?>"><?php the_title();?></a></small>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
      </div>


    </div>

  </div>

</div>

</div> <!-- Single Black Sapce -->
</div> <!-- Single Region -->
</div> <!-- Single Wrap -->


<?php locate_template( array('/layouts/loops/loop-media.php' ), true ); ?>