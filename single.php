<?php get_header(); ?>
<div class="wrap">

    <div id="content" <?php post_class(); ?>>
        <div class="flex-row sep cf" role="region">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php setPostViews(get_the_ID()); ?>

                <?php user_utilities(); ?>

                <?php get_template_part( '/layouts/formats/format', get_post_format() ); ?>

            <?php endwhile; ?>

        <?php else : ?>

            <article id="post-not-found" class="hentry cf">
                <header class="article-header">
                    <div class="wrap">
                        <h1><?php _e( 'Oops, Post Not Found!', 'dreamstheme' ); ?></h1>
                    </div>
                </header>
                <section class="entry-content">
                    <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'dreamstheme' ); ?></p>
                </section>
                <footer class="article-footer">
                    <p><?php _e( 'This is the error message in the single.php template.', 'dreamstheme' ); ?></p>
                </footer>
            </article>

        <?php endif; ?>


    </div>
</div>
</div>


<?php get_footer(); ?>