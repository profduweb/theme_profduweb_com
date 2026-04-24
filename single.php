<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<div class="site-container site-content single-centered-content">
    <main id="primary" class="main-column content-centered">

        <?php
        while (have_posts()):
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
                <header class="entry-header">
                    <div class="article-navigation-bar">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="button-back">
                            &larr; <?php esc_html_e('Retour à l\'accueil', 'profduweb'); ?>
                        </a>
                        <div class="social-share-minimal">
                            <span class="share-label">Partager :</span>
                            <a href="<?php echo esc_url('https://threads.net/intent/post?text=' . rawurlencode(get_the_title() . ' ' . get_permalink())); ?>"
                                target="_blank" rel="noopener noreferrer" aria-label="Partager sur Threads">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20"
                                    fill="currentColor"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                    <path
                                        d="M331.5 235.7c2.2 .9 4.2 1.9 6.3 2.8 29.2 14.1 50.6 35.2 61.8 61.4 15.7 36.5 17.2 95.8-30.3 143.2-36.2 36.2-80.3 52.5-142.6 53l-.3 0c-70.2-.5-124.1-24.1-160.4-70.2-32.3-41-48.9-98.1-49.5-169.6l0-.5C17 184.3 33.6 127.2 65.9 86.2 102.2 40.1 156.2 16.5 226.4 16l.3 0c70.3 .5 124.9 24 162.3 69.9 18.4 22.7 32 50 40.6 81.7l-40.4 10.8c-7.1-25.8-17.8-47.8-32.2-65.4-29.2-35.8-73-54.2-130.5-54.6-57 .5-100.1 18.8-128.2 54.4-26.2 33.3-39.8 81.5-40.3 143.2 .5 61.7 14.1 109.9 40.3 143.3 28 35.6 71.2 53.9 128.2 54.4 51.4-.4 85.4-12.6 113.7-40.9 32.3-32.2 31.7-71.8 21.4-95.9-6.1-14.2-17.1-26-31.9-34.9-3.7 26.9-11.8 48.3-24.7 64.8-17.1 21.8-41.4 33.6-72.7 35.3-23.6 1.3-46.3-4.4-63.9-16-20.8-13.8-33-34.8-34.3-59.3-2.5-48.3 35.7-83 95.2-86.4 21.1-1.2 40.9-.3 59.2 2.8-2.4-14.8-7.3-26.6-14.6-35.2-10-11.7-25.6-17.7-46.2-17.8l-.7 0c-16.6 0-39 4.6-53.3 26.3l-34.4-23.6c19.2-29.1 50.3-45.1 87.8-45.1l.8 0c62.6 .4 99.9 39.5 103.7 107.7l-.2 .2 .1 0zm-156 68.8c1.3 25.1 28.4 36.8 54.6 35.3 25.6-1.4 54.6-11.4 59.5-73.2-13.2-2.9-27.8-4.4-43.4-4.4-4.8 0-9.6 .1-14.4 .4-42.9 2.4-57.2 23.2-56.2 41.8l-.1 .1z" />
                                </svg>
                            </a>
                            <a href="<?php echo esc_url('https://bsky.app/intent/compose?text=' . rawurlencode(get_the_title() . ' ' . get_permalink())); ?>"
                                target="_blank" rel="noopener noreferrer" aria-label="Partager sur Bluesky">
                                <svg viewBox="0 0 576 512" width="20" height="20" fill="currentColor">
                                    <path
                                        d="M407.8 294.7c-3.3-.4-6.7-.8-10-1.3 3.4 .4 6.7 .9 10 1.3zM288 227.1C261.9 176.4 190.9 81.9 124.9 35.3 61.6-9.4 37.5-1.7 21.6 5.5 3.3 13.8 0 41.9 0 58.4S9.1 194 15 213.9c19.5 65.7 89.1 87.9 153.2 80.7 3.3-.5 6.6-.9 10-1.4-3.3 .5-6.6 1-10 1.4-93.9 14-177.3 48.2-67.9 169.9 120.3 124.6 164.8-26.7 187.7-103.4 22.9 76.7 49.2 222.5 185.6 103.4 102.4-103.4 28.1-156-65.8-169.9-3.3-.4-6.7-.8-10-1.3 3.4 .4 6.7 .9 10 1.3 64.1 7.1 133.6-15.1 153.2-80.7 5.9-19.9 15-138.9 15-155.5s-3.3-44.7-21.6-52.9c-15.8-7.1-40-14.9-103.2 29.8-66.1 46.6-137.1 141.1-163.2 191.8z" />
                                </svg>
                            </a>
                            <a href="#"
                                onclick="if(navigator.share){navigator.share({title:'<?php echo esc_js(get_the_title()); ?>',url:'<?php echo esc_js(get_permalink()); ?>'})}else{alert('Copiez l\'URL de la page pour la partager sur Threads ou d\'autres apps !');}return false;"
                                aria-label="Autres options de partage">
                                <svg viewBox="0 0 448 512" width="20" height="20" fill="currentColor">
                                    <path
                                        d="M352 320c-22.6 0-43.4 7.2-60.5 19.4L157.9 261c3.9-10.7 6.1-22.2 6.1-34.1s-2.2-23.4-6.1-34.1l133.6-78.4C308.6 126.8 329.4 134 352 134c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80c0 11.9 2.2 23.4 6.1 34.1L144.5 166.4C127.4 154.2 106.6 147 84 147c-44.2 0-80 35.8-80 80s35.8 80 80 80c22.6 0 43.4-7.2 60.5-19.4L278.1 366c-3.9 10.7-6.1 22.2-6.1 34.1 0 44.2 35.8 80 80 80s80-35.8 80-80-35.8-80-80-80z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                    <div class="entry-meta">
                        <?php
                        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
                        $time_string = sprintf(
                            $time_string,
                            esc_attr(get_the_date(DATE_W3C)),
                            esc_html(get_the_date())
                        );
                        printf(esc_html__('Publié le %s', 'profduweb'), $time_string);
                        ?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->

                <div class="entry-content">

                        <?php
                        the_content(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'profduweb'),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                wp_kses_post(get_the_title())
                            )
                        );

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

    <!-- Sidebar Removed for single posts -->
</div><!-- .site-content -->

<?php
get_footer();
