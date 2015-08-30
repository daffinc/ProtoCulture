<!-- Start Articles Loop -->
<?php

$argsbreak = array(
  'posts_per_page' => 4
  );
$breaking = new WP_Query($argsbreak);
?>
<?php
if (  $breaking->have_posts() ) :
  while (  $breaking->have_posts() ) :  $breaking->the_post();
?>
<li>
    <a href="<?php the_permalink();?>">
     <?php the_title( ); ?>
     <small><?php time_ago(); ?></small>
 </a>
</li>
<?php
endwhile;
endif;
wp_reset_postdata();
?>

<?php echo do_shortcode('[ajax_load_more repeater="template_1" post_type="post, brand_voice, media_videos, forbes_life, forbes_latam, specials" posts_per_page="4" scroll="false" button_label="Leer más notas"]'); ?>


