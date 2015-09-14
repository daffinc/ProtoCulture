<?php
get_header();
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>

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


<?php get_footer(); ?>