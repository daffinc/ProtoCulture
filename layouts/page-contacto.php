<?php
/*
Template Name: Contacto
*/
?>

<?php get_header(); ?>

<?php query_posts( "pagename= contacto");?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>

<header class="head-line">
<h1><?php the_title(); ?></h1>
</header>
<div>
<?php the_content(); ?>
</div>
<?php endwhile; endif;?>
<?php wp_reset_query();?>

<?php get_footer(); ?>