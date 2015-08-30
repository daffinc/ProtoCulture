<aside id="sidebar" role="sidebar" class="sidebar-type--a">


  <div class="sidebar-type--block sidebar--type-a-first">
    <figure class="ad-sidebar ad-auto-height">
    <?php banner('type-i');  ?>
    </figure>

    <header class="head-line cf">
      <h1>Destacado </h1>

      <ul id="selectiveD" class="tabs">
        <li class="active"><a href="#destDay">dia</a></li>
        <li><a href="#destWeek">semana</a></li>
        <li><a href="#destMonth">mes</a></li>
      </ul>

    </header>

    <?php locate_template( array('/layouts/loops/loop-destacadoD.php' ), true ); ?>
    <?php locate_template( array('/layouts/loops/loop-destacadoW.php' ), true ); ?>
    <?php locate_template( array('/layouts/loops/loop-destacadoM.php' ), true ); ?>

  </div>

  <figure class="ad-sidebar">
    <?php banner('type-b');  ?>
  </figure>

  <div class="sidebar-type--block sidebar-type--a---second">
    <header class="head-line cf">
      <h1>Multimedia </h1>
    </header>

    <?php
    $argsFeat = array(
      'post_type' => 'media_videos',
      'order' => 'DESC',
      'posts_per_page' => 5,
      );
    $videosFeatured = new WP_Query($argsFeat);
    ?>
    <div class="popType">

      <ul >
       <?php if ( $videosFeatured->have_posts() ) : while ( $videosFeatured->have_posts() ) : $videosFeatured->the_post(); ?>
        <li id="post-<?php the_ID(); ?>" class="cf">
          <figure class="helper-image">
            <?php picturefill('dreams-160x100','dreams-160x100','dreams-160x100'); ?>

          </figure>
          <h5><a href="<?php the_permalink();?>"><strong><?php the_title(); ?></strong></a></h5>
        </li>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </ul>
  </div>
</div>

<div class="sidebar-type--block sidebar-type--a---third">
  <header class="head-line cf">
    <h1>Lo Último </h1>
  </header>
  <div id="destDay" class="popType">

    <ul>

      <?php
      $argsLa = array(
        'cat' => '-154',
        'order' => 'DESC',
        'posts_per_page' => 5,
        );
        $latestSidebar = new WP_Query($argsLa); ?>
        <?php if ( $latestSidebar->have_posts() ) : while ( $latestSidebar->have_posts() ):$latestSidebar->the_post(); ?>
          <li id="post-<?php the_ID(); ?>"  class="cf">
            <figure class="helper-image">
              <?php picturefill('dreams-160x100','dreams-160x100','dreams-160x100'); ?>

            </figure>
            <h5><a href="<?php the_permalink();?>"><strong><?php the_title(); ?></strong></a></h5>
          </li>
        <?php endwhile; endif; wp_reset_postdata(); ?>

      </ul>
    </div>
  </div>

  <div class="helper-follow" data-follow-up="follow-up" data-follow-down="follow-down"></div>

  <figure id="bottomSide" class="sidebar-type--ad ad-sidebar">
    <?php banner('type-c');  ?>
  </figure>



</aside>