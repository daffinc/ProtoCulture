      <article id="post-<?php the_ID(); ?>" class="note helper-activate cf" data-animate-down="ha-header-down" data-animate-up="ha-header-up" role="article" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="wrap">

         <section class="entry-content cf" itemprop="articleBody">

           <div class="article-header">
            <div id="sharemeMobile" class="shareme-mobile" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Compartir"></div>
          </div>

          <?php
                    // the content (pretty self explanatory huh)
          the_content();

          wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'dreamstheme' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            ) );
            ?>



          </section> <?php // end article section ?>

          <?php
          locate_template( array('/layouts/sidebars/sidebar-type-e.php' ), true );
          ?>
        </div>
        <footer class="article-footer helper-next cf">

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
              <?php author_info(); ?>
              <p><?php the_author_meta('description');?></p>
            </div>
          </div>


          <?php dreams_related_posts(); ?>

        </footer> <?php // end article footer ?>


        <?php comments_template(); ?>

      </article> <?php // end article ?>