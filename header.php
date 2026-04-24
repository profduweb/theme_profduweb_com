<?php
/**
 * The header for our theme
 */
?><!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Open Graph Tags -->
    <?php
    $og_url = home_url('/');
    $og_type = 'website';
    $og_title = get_bloginfo('name');
    $og_image = get_template_directory_uri() . '/screenshot.png';
    $og_desc = get_bloginfo('description');

    if (is_single() || is_page()) {
        $current_id = get_queried_object_id();
        $og_url = get_permalink($current_id);
        $og_type = 'article';
        $og_title = get_the_title($current_id);

        if (has_post_thumbnail($current_id)) {
            $og_image = get_the_post_thumbnail_url($current_id, 'large');
        }

        if (has_excerpt($current_id)) {
            $og_desc = wp_strip_all_tags(get_the_excerpt($current_id));
        } else {
            $post_obj = get_post($current_id);
            $content = $post_obj ? $post_obj->post_content : '';
            $og_desc = wp_trim_words(wp_strip_all_tags($content), 30);
        }
    }
    ?>
    <meta property="og:title" content="<?php echo esc_attr($og_title); ?>" />
    <meta property="og:type" content="<?php echo esc_attr($og_type); ?>" />
    <meta property="og:url" content="<?php echo esc_url($og_url); ?>" />
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($og_desc); ?>" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- SVG filter definition for dark duotone imaging (#3F3F46) -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <filter id="duotone-dark">
            <feColorMatrix type="matrix" result="gray" values="0.2126 0.7152 0.0722 0 0
                        0.2126 0.7152 0.0722 0 0
                        0.2126 0.7152 0.0722 0 0
                        0 0 0 1 0" />
            <feComponentTransfer color-interpolation-filters="sRGB">
                <feFuncR type="table" tableValues="0.247 1.0" /> <!-- R: 63 to 255 -->
                <feFuncG type="table" tableValues="0.247 1.0" /> <!-- G: 63 to 255 -->
                <feFuncB type="table" tableValues="0.275 1.0" /> <!-- B: 70 to 255 -->
            </feComponentTransfer>
        </filter>
    </svg>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary">
            <?php esc_html_e('Skip to content', 'profduweb'); ?>
        </a>

        <header id="masthead" class="site-header">
            <div class="site-container header-inner">
                <div class="site-branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-logo-link">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.jpeg'); ?>"
                            alt="Logo <?php bloginfo('name'); ?>" class="site-logo">
                    </a>
                    <div class="site-title-wrapper">
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a></h1>
                        <?php
                        $profduweb_description = get_bloginfo('description', 'display');
                        if ($profduweb_description || is_customize_preview()):
                            ?>
                            <p class="site-description">
                                <?php echo esc_html($profduweb_description); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div><!-- .site-branding -->

                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="screen-reader-text">
                        <?php esc_html_e('Menu', 'profduweb'); ?>
                    </span>
                    <span class="hamburger"></span>
                </button>

                <nav id="site-navigation" class="site-nav">
                    <div class="primary-nav">
                        <?php
                        if (has_nav_menu('menu-1')) {
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'menu_id' => 'primary-menu',
                                    'container' => false,
                                    'fallback_cb' => false,
                                )
                            );
                        } else {
                            // Fallback basic menu
                            echo '<ul id="primary-menu">';
                            echo '</ul>';
                        }
                        ?>
                    </div>

                    <div class="social-nav">
                        <?php
                        if (has_nav_menu('menu-social')) {
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-social',
                                    'menu_id' => 'social-menu',
                                    'container' => false,
                                    'depth' => 1,
                                )
                            );
                        } else {
                            echo '<ul id="social-menu">';
                            echo '<li><a href="https://instagram.com/profduweb" target="_blank" rel="noopener noreferrer"><span class="screen-reader-text">Instagram</span><svg viewBox="0 0 448 512" width="24" height="24" fill="currentColor"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></a></li>';
                            echo '<li><a href="https://www.threads.net/" target="_blank" rel="noopener noreferrer"><span class="screen-reader-text">Threads</span><svg viewBox="0 0 448 512" width="24" height="24" fill="currentColor"><path d="M331.5 235.7c2.2 .9 4.2 1.9 6.3 2.8 29.2 14.1 50.6 35.2 61.8 61.4 15.7 36.5 17.2 95.8-30.3 143.2-36.2 36.2-86.6 52.3-148.2 46.2-70.3-6.9-123.6-45.7-149.8-107.5-31.5-74.3-32.3-205.1-5-281.4 20.8-58.7 74.6-100.1 142.4-100.1 51.1 0 96.6 23.4 125.4 68.3 19.1 29.7 27.6 62 25.1 95.9-4.7 63.1-41.1 106.3-99.4 120-23.5 5.5-47.5 1.5-64.6-10.7-12.6-9-20.9-22-24.9-39 2.2-1.6 4.3-3.2 6.4-4.8 19-14.6 25.5-32 23.8-49.2-2.1-22.1-17.7-36.6-37.4-38.3-25.7-2.2-46.3 14.6-54.8 44.9-6.5 22.7-3.8 54.6 26.6 83.1 36.6 34.5 97.4 38.3 140.2 11.9 28.5-17.6 39.8-44.5 35.4-85.3-3.8-35.3-21.4-61.9-50.6-76.3-25-12.4-53.7-13.8-82.7-5.5-22.9 6.5-62.8 24.2-96.8 77.2-29.4 46.1-39.7 101.4-33.1 146 13.1 88.5 76.5 130.6 142.1 130.6 57 0 112.6-26.6 136.2-83.3 21.2-51.2 16.7-101.4-12.8-139zM192.4 220.8c-1.3-15.6-3-31.1-5-46.5 1.8 .8 3.5 1.5 5 2.1 14.3 6.1 27.4 17.5 31.8 34.4 2.1 8 2.6 19.7 .1 31.7-8.1 4.7-17 7.7-25.9 8.6-6-2.5-12.1-5-18.4-7.4-4.3-12.8-5.3-24.2-5.4-30.9-.3-11.8 .4-23.8 1.4-35.3 12.1-6 25.7-8.6 39.6-7.4 22.6 2 41 15 48.7 34.2 6.7 17 5.8 38.1-1.3 57.6-3.8-2-7.5-4-11.4-5.9-10.4-5.1-23.5-9.1-39-11.8z"/></svg></a></li>';
                            echo '<li><a href="https://bsky.app/profile/profduweb.com" target="_blank" rel="noopener noreferrer"><span class="screen-reader-text">Bluesky</span><svg viewBox="0 0 512 512" width="24" height="24" fill="currentColor"><path d="M111.8 62.2C170.2 105.9 233 194.7 256 241.1v-115.3c0-31.2 56-118.8 144.2-74.9 31.5 15.6 58.1 52.8 58.1 94.4 0 71.9-38.3 151.7-109 176.6-47.8 16.8-125.7 31.4-180.2-12.1-6.1-4.8-14.7 2.1-10.2 8.7 38.1 54.4 133.5 119.7 190.2 136.6 51 15.2 58.6 53.6 58.6 86.8 0 35.8-29.2 65.4-65.7 65.4-86.8 0-142.1-80.1-182-167.3-39.9 87.2-95.2 167.3-182 167.3-36.5 0-65.7-29.6-65.7-65.4 0-33.2 7.6-71.6 58.6-86.8 56.7-16.9 152.1-82.2 190.2-136.6 4.5-6.6-4.1-13.5-10.2-8.7-54.5 43.5-132.4 28.9-180.2 12.1C4 282.8-34.3 203-34.3 131.1c0-41.6 26.6-78.8 58.1-94.4C112-7 168 80.6 168 111.3V241.1C191 194.7 253.8 105.9 312.2 62.2c16.1-12 36.4-14.2 53.7-6 16.7 8 28.7 23.3 32.8 41.3z"/></svg></a></li>';
                            echo '<li><a href="https://www.youtube.com/@appetco/community" target="_blank" rel="noopener noreferrer"><span class="screen-reader-text">YouTube</span><svg viewBox="0 0 576 512" width="24" height="24" fill="currentColor"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg></a></li>';
                            echo '<li><a href="https://signal.me/#eu/mpMRkqFVK6_xBKPzJqERMbMI5SDOIsmeoLVw5yDRPBWL-vnGf3FKM5eouoQ8qyzQ" target="_blank" rel="noopener noreferrer"><span class="screen-reader-text">Signal</span><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 0C5.372 0 0 5.373 0 12c0 6.628 5.372 12 12 12 6.627 0 12-5.372 12-12C24 5.373 18.627 0 12 0zm5.66 17.514A8.72 8.72 0 1 1 20.72 12a8.73 8.73 0 0 1-3.06 5.514zm-5.66-1.393A6.12 6.12 0 1 1 18.12 12a6.127 6.127 0 0 1-6.12 6.121zm0-9.654A3.535 3.535 0 1 0 15.535 12 3.54 3.54 0 0 0 12 6.467z"/></svg></a></li>';
                            echo '</ul>';
                        }
                        ?>
                    </div>
                </nav><!-- #site-navigation -->
            </div>
        </header><!-- #masthead -->