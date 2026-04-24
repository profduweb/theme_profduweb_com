<?php
/**
 * The template for displaying all pages
 */

get_header();
?>

<div class="site-container site-content">
    <main id="primary" class="main-column">

        <?php
        while (have_posts()):
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'profduweb'),
                            'after' => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

                <?php if (has_post_thumbnail()): ?>
                    <div class="post-thumbnail-single">
                        <?php the_post_thumbnail('large'); ?>
                    </div><!-- .post-thumbnail-single -->
                <?php endif; ?>

            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()):
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #primary -->

    <?php get_sidebar(); ?>
</div><!-- .site-content -->

<?php
get_footer();
