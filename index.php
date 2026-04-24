<?php
/**
 * The main template file
 */

get_header();
?>

<div class="site-container site-content">
    <main id="primary" class="main-column">

        <?php if (have_posts()): ?>

            <div class="posts-grid">
                <?php
                while (have_posts()):
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <?php 
                        $comment_count = get_comments_number();
                        if ( $comment_count > 0 ) : 
                        ?>
                            <div class="post-comment-badge" title="<?php echo esc_attr( sprintf( _n( '%s comment', '%s comments', $comment_count, 'profduweb' ), number_format_i18n( $comment_count ) ) ); ?>">
                                <?php echo esc_html( $comment_count ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (has_post_thumbnail()): ?>
                            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                <?php
                                the_post_thumbnail(
                                    'medium_large',
                                    array(
                                        'alt' => the_title_attribute(
                                            array(
                                                'echo' => false,
                                            )
                                        ),
                                    )
                                );
                                ?>
                            </a>
                        <?php else: ?>
                            <!-- Fallback empty space if no thumbnail to maintain visual grid consistency -->
                            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"
                                style="display: flex; align-items: center; justify-content: center; background-color: #fafafa;">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/image-PWD-invert.svg'); ?>"
                                    alt="Default Thumbnail" style="width: 50%; height: auto; object-fit: contain;">
                            </a>
                        <?php endif; ?>

                        <div class="post-content">
                            <header class="entry-header">
                                <?php the_title('<h2 class="post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                            </header><!-- .entry-header -->
                        </div>
                    </article><!-- #post-<?php the_ID(); ?> -->
                    <?php
                endwhile;
                ?>
            </div>

            <div class="nav-links">
                <?php
                the_posts_navigation(
                    array(
                        'prev_text' => '&larr; Articles précédents',
                        'next_text' => 'Articles plus récents &rarr;',
                    )
                );
                ?>
            </div>

            <?php
        else:
            ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title">
                        <?php esc_html_e('Nothing Found', 'profduweb'); ?>
                    </h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <?php
                    if (is_search()):
                        ?>
                        <p>
                            <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'profduweb'); ?>
                        </p>
                        <?php
                        get_search_form();

                    else:
                        ?>
                        <p>
                            <?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'profduweb'); ?>
                        </p>
                        <?php
                        get_search_form();
                    endif;
                    ?>
                </div><!-- .page-content -->
            </section><!-- .no-results -->
            <?php
        endif;
        ?>

    </main><!-- #primary -->

    <?php get_sidebar(); ?>
</div>

<?php
get_footer();
