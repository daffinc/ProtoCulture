 <?php

//Get Slug

if(! function_exists('the_slug')) :
function the_slug(){
  global $post;
  $post_slug=$post->post_name;

  echo "$post_slug";
}
endif;


//Category Arguments

if(! function_exists('category_name')) :
function category_name(){
  $category = get_the_category();
  echo $category[0]->cat_name;
}
endif;

if(! function_exists('category_link')) :
function category_link(){
  $category = get_the_category();
  if($category[0]->cat_name){
    echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
  }
}
endif;


if(! function_exists('published_time')) :
function published_time(){
  $pub = the_date('F jS, Y', '', '', FALSE);
  echo $pub;
}
endif;

//Published Time Link
if(! function_exists('published_time_links')) :
function published_time_links(){
  $archive_year  = get_the_time('Y');
  $archive_month = get_the_time('m');
  $archive_day   = get_the_time('d');

  echo get_day_link( $archive_year, $archive_month, $archive_day);
}
endif;

if(!function_exists('term_slug')) :
function term_slug(){
  global $post;
  $name = single_term_title();
  $terms = get_the_terms( $post->ID, $name);

  if($terms && !wp_error($terms)){
    foreach($terms as $term){
      echo $term->slug;
    }
  }
}
endif;

//Post Thumbnail Captions

if(! function_exists('the_post_thumbnail_caption')) :
function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<figcaption><span>'.$thumbnail_image[0]->post_title.'</span></figcaption>';
  }
}
endif;

if(! function_exists('modify_read_more_link')) :
function modify_read_more_link() {
  return ' <a class="btn-more" href="' . get_permalink() . '"> Leer art&iacute;culo completo...</a>';
}
endif;

if(! function_exists('new_excerpt_more')) :
function new_excerpt_more($more) {
 global $post;
 return ' <a class="btn-more" href="'. get_permalink($post->ID) . '"> Leer art&iacute;culo completo...</a>';
}
endif;

//Time Filter

if(! function_exists('time_ago')) :
function time_ago() {
  global $post;
  $now = time();
  $date = strtotime($post->post_date);
  $sixMonthsAgo = 180*24*60*60;
  $human_time = 'hace '. human_time_diff( get_the_time('U'), current_time('timestamp') );
  $mobile = wp_is_mobile();


  if (( $now - $date ) > $sixMonthsAgo && $mobile) {
   the_time('j. M .Y');


 } elseif(( $now - $date ) > $sixMonthsAgo && !$mobile) {
   the_time('j. F .Y');


 } else {
   echo $human_time;

 }

}
endif;


//Figure Source

if(! function_exists('extract_url')) :
function extract_url($size){
  global $post;
  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size);
  $url = $thumb['0'];
  echo $url;
}
endif;


//PictureFil
if(! function_exists('picturefill')) :
function picturefill($pw,$pm,$ps){
  global $post;
  $thumb0 = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $pw);
  $thumb1 = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $pm);
  $thumb2 = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $ps);

  $title= get_the_title();
  $url0 = $thumb0['0'];
  $url1 = $thumb1['0'];
  $url2 = $thumb2['0'];

  $picture = '';

  $picture .="<picture>";
  $picture .="<!--[if IE 9]><video style=\"display: none;\"><![endif]-->";
  $picture .="<source srcset=\"$url0\" media=\"(min-width: 1140px)\">";
  $picture .="<source srcset=\"$url1\" media=\"(min-width: 960px)\">";
  $picture .="<source srcset=\"$url2\" media=\"(min-width: 645px)\">";
  $picture .="<!--[if IE 9]></video><![endif]-->";
  $picture .="<img srcset=\"$url2\" alt=\"$title\" />";
  $picture .="</picture>";

  if ($picture <> '') {
    $picture ="<!-- <picture> -->\n $picture";
    echo $picture;
  }

}
endif;

//Comment Count
if(! function_exists('disqus_count')) :
function disqus_count($disqus_shortname) {
  $disqusID =
  wp_enqueue_script('disqus_count','http://'.$disqusID.'.disqus.com/count.js');

  echo '<a href="'. get_permalink() .'#disqus_thread"></a>';
}
endif;

// Numeric Page Navi (built into the theme by default)
if(!function_exists('dreams_page_navi')) :
function dreams_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
    ) );
  echo '</nav>';
} /* end page navi */
endif;

//PostViewsCOunt

if(! function_exists('getPostViews')) :
function getPostViews($postID){
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count==''){
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
    return "0";
  }
  return $count.'';
}
endif;

if(! function_exists('setPostViews')) :
function setPostViews($postID) {
 $count_key = 'post_views_count';
 $count = get_post_meta($postID, $count_key, true);
 if($count==''){
  $count = 0;
  delete_post_meta($postID, $count_key);
  add_post_meta($postID, $count_key, '0');
}else{
  $count++;
  update_post_meta($postID, $count_key, $count);
}
}
endif;

//Excerpt Expert

if(!function_exists('excerpt')) :
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }

  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;

}
endif;

//Fotogalería

if(! function_exists('gallery')) :
function gallery(){
  global $prefix;
  $template_url = get_template_directory_uri();
  $idpost = get_the_id();
  $images = rwmb_meta("{$prefix}photo", "type=image_advanced&size=full");
  $i = "";

  foreach ($images as $image) {
   $i .="<a href=\"{$image['url']}\"></a>";
 }

 if ($i <> '') {
  $i = "$i\n";


  echo "<div id=\"gallery\" class='gallery'>";

  echo $i;
  echo "</div>";
}

}
endif;


//Author Info

if(! function_exists('author_social_info')) :
function author_social_info(){
  global $post, $prefix, $author_id;
  $www = get_the_author_meta( 'user_url', $author_id );
  $tw =  get_the_author_meta( 'twitter', $author_id );
  $fb =  get_the_author_meta( 'facebook', $author_id );
  $in =  get_the_author_meta( 'yabber', $author_id );
  $gp =  get_the_author_meta( 'google_plus', $author_id );

  $info = '';

  $info .= "<ul class=\"author-social\">";
  if($www){
    $info .= "<li class=\"web\"><a href=\"$www\" target=\"_blank\"><i class=\"fa fa-globe\"></i>
  </a></li>";
}
if($tw){
  $info .= "<li class=\"twitter\"><a href=\"https://twitter.com/$tw\" target=\"_blank\"><i class=\"fa fa-twitter\"></i></a></li>";
}

if($fb){
  $info .= "<li class=\"facebook\"><a href=\"https://www.facebook.com/$fb\" target=\"_blank\"><i class=\"fa fa-facebook\"></i></a></li>";
}
if($gp){
  $info .= "<li class=\"google-plus\"><a href=\"https://plus.google.com/user/$gp\" rel=\"publisher\" target=\"_blank\"><i class=\"fa fa-google-plus\"></i></a></li>";
}

if($in){
  $info .= "<li class=\"linkedin\"><a href=\"https://www.linkedin.com/in/$in\" target=\"_blank\"><i class=\"fa fa-linkedin\"></i></a></li>";
}

$info .= "</ul>";

if( !empty( $info ) ) {
  $info = "\n<!-- Author Info Social -->\n" . $info . "\n";
  echo $info;
}
}
endif;

//Social Forbes Mexico Info

if(! function_exists('social_info')) :
function social_info(){
  global $post, $prefix;
  $tw =  ot_get_option($prefix.'twitter');
  $fb =  ot_get_option($prefix.'facebook');
  $yt =  ot_get_option($prefix.'youtube');
  $in =  ot_get_option($prefix.'linkedin');
  $pt =  ot_get_option($prefix.'pinterest');
  $rss = ot_get_option($prefix.'rss');

  $info = '';

  $info .= "<div class=\"social cf\">";
  $info .= "<h4>S&iacute;guenos</h4>";
  $info .= "<ul class=\"info\">";

  if($tw){
    $info .= "<li class=\"twitter\"><a href=\"https://twitter.com/$tw\" target=\"_blank\"><i class=\"fa fa-twitter\"></i></a></li>";
  }
  if($fb){
    $info .= "<li class=\"facebook\"><a href=\"https://www.facebook.com/$fb\" target=\"_blank\"><i class=\"fa fa-facebook\"></i></a></li>";
  }

  if($yt){
    $info .= "<li class=\"youtube\"><a href=\"https://www.youtube.com/user/$yt\" rel=\"publisher\" target=\"_blank\"><i class=\"fa fa-youtube-play\"></i></a></li>";
  }
  if($in){
    $info .= "<li class=\"linkedin\"><a href=\"https://www.linkedin.com/in/$in\" target=\"_blank\"><i class=\"fa fa-linkedin\"></i></a></li>";
  }

  if($pt){
    $info .= "<li class=\"pinterest\"><a href=\"http://pinterest.com/$pt/\" target=\"_blank\"><i class=\"fa fa-pinterest\"></i></a></li>";
  }

  if($rss){
    $info .= "<li class=\"rss\"><a href=\"http://feeds.feedburner.com/$rss\" target=\"_blank\"><i class=\"fa fa-rss\"></i></a></li>";
  }

  $info .= "</ul>
</div>";

if( !empty( $info ) ) {
  $info = "\n<!-- Social Forbes Mexico Info -->\n" . $info . "\n";
  echo $info;
}
}

endif;



//Litracy Banner (Insert ads after second paragraph of single post content.)
if(! function_exists('prefix_insert_post_ads')) :
function prefix_insert_post_ads( $content ) {

  $ad_code = '<!--- <div class="helper-content-ad"><small>PUBLICICDAD</small><figure></figure></div> -->';

  if ( is_single() && is_wp_mobile() && ! is_admin() ) {
    return prefix_insert_after_paragraph( $ad_code, 2, $content );
  }

  return $content;
}
endif;

// Parent Function that makes the magic happen
if(! function_exists('prefix_insert_after_paragraph')) :
function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
  $closing_p = '</p>';
  $paragraphs = explode( $closing_p, $content );
  foreach ($paragraphs as $index => $paragraph) {

    if ( trim( $paragraph ) ) {
      $paragraphs[$index] .= $closing_p;
    }

    if ( $paragraph_id == $index + 1 ) {
      $paragraphs[$index] .= $insertion;
    }
  }

  return implode( '', $paragraphs );
}
endif;

?>

<?php
//RELATED POSTS FUNCTION

// Related Posts Function (call using dreams_related_posts(); )
function dreams_related_posts() {
  echo '<ul id="dreams-related-posts">';
  echo '<h2>Notas Relacionadas</h2>';

  global $post;
  $tags = wp_get_post_tags( $post->ID );
  $tag_arr = '';

  if($tags) {

    foreach( $tags as $tag ) {
      $tag_arr .= $tag->slug . ',';
    }
    $args = array(
      'tag' => $tag_arr,
      'numberposts' => 4, /* you can change this to show more */
      'post__not_in' => array($post->ID)
      );
    $related_posts = get_posts( $args );
    if($related_posts) {
      foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
      <li class="related_post">

        <figure class="helper-image">
          <a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
            <?php picturefill('dreams-480x300','dreams-480x300','dreams-320x200'); ?>
          </a>
        </figure>

        <a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>

      </li>
    <?php endforeach; }
    else { ?>
    <?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'dreamstheme' ) . '</li>'; ?>
    <?php }
  }
  wp_reset_postdata();
  echo '</ul>';
} /* end dreams related posts function */

?>