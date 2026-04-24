<?php
/**
 * ProfduWeb Minimalist functions and definitions
 */

function profduweb_setup()
{
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Register navigation menus.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'profduweb'),
            'menu-social' => esc_html__('Social Links', 'profduweb'),
            'footer-1' => esc_html__('Footer Column 1', 'profduweb'),
            'footer-2' => esc_html__('Footer Column 2', 'profduweb'),
        )
    );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );
}
add_action('after_setup_theme', 'profduweb_setup');

/**
 * Enqueue scripts and styles.
 */
function profduweb_scripts()
{
    wp_enqueue_style('profduweb-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    wp_enqueue_script('profduweb-navigation', get_template_directory_uri() . '/js/navigation.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'profduweb_scripts');

/**
 * Register widget area.
 */
function profduweb_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'profduweb'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'profduweb'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action('widgets_init', 'profduweb_widgets_init');

/**
 * Remove default excerpt trailing [...] and replace it with a cleaner look.
 */
function profduweb_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'profduweb_excerpt_more');

/**
 * Set custom excerpt length.
 */
function profduweb_excerpt_length($length)
{
    return 20; // Words
}
add_filter('excerpt_length', 'profduweb_excerpt_length', 999);

/**
 * Replace social menu link text with SVG icons based on URL
 */
function profduweb_social_icons($item_output, $item, $depth, $args)
{
    // First priority: user-provided custom SVG via WordPress Admin
    $custom_svg = get_post_meta($item->ID, '_profduweb_custom_svg', true);

    // We will conditionally process if it's a social menu or has a custom SVG
    if (!empty($custom_svg) || 'menu-social' === $args->theme_location) {
        $icon = '';
        $url = strtolower($item->url);

        if (!empty($custom_svg)) {
            $icon = wp_kses($custom_svg, profduweb_allowed_svg_tags());
        } elseif (strpos($url, 'instagram.com') !== false) {
            $icon = '<svg viewBox="0 0 448 512" width="24" height="24" fill="currentColor"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>';
        } elseif (strpos($url, 'threads.net') !== false) {
            $icon = '<svg viewBox="0 0 448 512" width="24" height="24" fill="currentColor"><path d="M331.5 235.7c2.2 .9 4.2 1.9 6.3 2.8 29.2 14.1 50.6 35.2 61.8 61.4 15.7 36.5 17.2 95.8-30.3 143.2-36.2 36.2-86.6 52.3-148.2 46.2-70.3-6.9-123.6-45.7-149.8-107.5-31.5-74.3-32.3-205.1-5-281.4 20.8-58.7 74.6-100.1 142.4-100.1 51.1 0 96.6 23.4 125.4 68.3 19.1 29.7 27.6 62 25.1 95.9-4.7 63.1-41.1 106.3-99.4 120-23.5 5.5-47.5 1.5-64.6-10.7-12.6-9-20.9-22-24.9-39 2.2-1.6 4.3-3.2 6.4-4.8 19-14.6 25.5-32 23.8-49.2-2.1-22.1-17.7-36.6-37.4-38.3-25.7-2.2-46.3 14.6-54.8 44.9-6.5 22.7-3.8 54.6 26.6 83.1 36.6 34.5 97.4 38.3 140.2 11.9 28.5-17.6 39.8-44.5 35.4-85.3-3.8-35.3-21.4-61.9-50.6-76.3-25-12.4-53.7-13.8-82.7-5.5-22.9 6.5-62.8 24.2-96.8 77.2-29.4 46.1-39.7 101.4-33.1 146 13.1 88.5 76.5 130.6 142.1 130.6 57 0 112.6-26.6 136.2-83.3 21.2-51.2 16.7-101.4-12.8-139zM192.4 220.8c-1.3-15.6-3-31.1-5-46.5 1.8 .8 3.5 1.5 5 2.1 14.3 6.1 27.4 17.5 31.8 34.4 2.1 8 2.6 19.7 .1 31.7-8.1 4.7-17 7.7-25.9 8.6-6-2.5-12.1-5-18.4-7.4-4.3-12.8-5.3-24.2-5.4-30.9-.3-11.8 .4-23.8 1.4-35.3 12.1-6 25.7-8.6 39.6-7.4 22.6 2 41 15 48.7 34.2 6.7 17 5.8 38.1-1.3 57.6-3.8-2-7.5-4-11.4-5.9-10.4-5.1-23.5-9.1-39-11.8z"/></svg>';
        } elseif (strpos($url, 'bsky.app') !== false) {
            $icon = '<svg viewBox="0 0 512 512" width="24" height="24" fill="currentColor"><path d="M111.8 62.2C170.2 105.9 233 194.7 256 241.1v-115.3c0-31.2 56-118.8 144.2-74.9 31.5 15.6 58.1 52.8 58.1 94.4 0 71.9-38.3 151.7-109 176.6-47.8 16.8-125.7 31.4-180.2-12.1-6.1-4.8-14.7 2.1-10.2 8.7 38.1 54.4 133.5 119.7 190.2 136.6 51 15.2 58.6 53.6 58.6 86.8 0 35.8-29.2 65.4-65.7 65.4-86.8 0-142.1-80.1-182-167.3-39.9 87.2-95.2 167.3-182 167.3-36.5 0-65.7-29.6-65.7-65.4 0-33.2 7.6-71.6 58.6-86.8 56.7-16.9 152.1-82.2 190.2-136.6 4.5-6.6-4.1-13.5-10.2-8.7-54.5 43.5-132.4 28.9-180.2 12.1C4 282.8-34.3 203-34.3 131.1c0-41.6 26.6-78.8 58.1-94.4C112-7 168 80.6 168 111.3V241.1C191 194.7 253.8 105.9 312.2 62.2c16.1-12 36.4-14.2 53.7-6 16.7 8 28.7 23.3 32.8 41.3z"/></svg>';
        } elseif (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            $icon = '<svg viewBox="0 0 576 512" width="24" height="24" fill="currentColor"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>';
        } elseif (strpos($url, 'signal.me') !== false) {
            $icon = '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 0C5.372 0 0 5.373 0 12c0 6.628 5.372 12 12 12 6.627 0 12-5.372 12-12C24 5.373 18.627 0 12 0zm5.66 17.514A8.72 8.72 0 1 1 20.72 12a8.73 8.73 0 0 1-3.06 5.514zm-5.66-1.393A6.12 6.12 0 1 1 18.12 12a6.127 6.127 0 0 1-6.12 6.121zm0-9.654A3.535 3.535 0 1 0 15.535 12 3.54 3.54 0 0 0 12 6.467z"/></svg>';
        }

        if (!empty($icon)) {
            $item_output = str_replace($args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after, '<span class="screen-reader-text">' . esc_html($item->title) . '</span>' . $icon, $item_output);
        }
    }

    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'profduweb_social_icons', 10, 4);

/**
 * Limit posts on the home page to 12.
 */
function profduweb_homepage_posts($query)
{
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('posts_per_page', 12);
    }
}
add_action('pre_get_posts', 'profduweb_homepage_posts');

/**
 * Remove default widgets (Archives, Categories) to keep the sidebar clean.
 */
function profduweb_remove_default_widgets()
{
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Categories');
}
add_action('widgets_init', 'profduweb_remove_default_widgets', 11);

/**
 * Add custom SVG field to menu items in WordPress Admin.
 */
function profduweb_nav_menu_item_custom_fields($item_id, $item, $depth, $args, $id)
{
    $custom_svg = get_post_meta($item_id, '_profduweb_custom_svg', true);
    ?>
    <p class="field-custom-svg description description-wide">
        <label for="edit-menu-item-custom-svg-<?php echo esc_attr($item_id); ?>">
            Code SVG de l'icône personnalisée (optionnel)<br />
            <textarea id="edit-menu-item-custom-svg-<?php echo esc_attr($item_id); ?>"
                class="widefat edit-menu-item-custom-svg" rows="3" cols="20"
                name="menu-item-custom-svg[<?php echo esc_attr($item_id); ?>]"><?php echo esc_textarea($custom_svg); ?></textarea>
            <span class="description">Collez ici le code &lt;svg&gt; pour remplacer le texte du lien. L'icône prendra
                automatiquement la bonne taille.</span>
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'profduweb_nav_menu_item_custom_fields', 10, 5);

/**
 * Allowed SVG markup for custom menu icons.
 */
function profduweb_allowed_svg_tags()
{
    return array(
        'svg' => array(
            'xmlns' => true,
            'viewbox' => true,
            'width' => true,
            'height' => true,
            'fill' => true,
            'class' => true,
            'focusable' => true,
            'role' => true,
            'aria-hidden' => true,
        ),
        'path' => array(
            'd' => true,
            'fill' => true,
        ),
        'g' => array(
            'fill' => true,
        ),
        'title' => array(),
        'desc' => array(),
    );
}

/**
 * Save custom SVG field for menu items.
 */
function profduweb_update_nav_menu_item($menu_id, $menu_item_db_id, $args)
{
    if (isset($_POST['menu-item-custom-svg'][$menu_item_db_id])) {
        // Sanitize SVG input using wp_kses to allow ONLY specific safe SVG tags and attributes
        $svg_content = wp_unslash($_POST['menu-item-custom-svg'][$menu_item_db_id]);

        $sanitized_svg = wp_kses($svg_content, profduweb_allowed_svg_tags());
        update_post_meta($menu_item_db_id, '_profduweb_custom_svg', $sanitized_svg);
    } else {
        delete_post_meta($menu_item_db_id, '_profduweb_custom_svg');
    }
}
add_action('wp_update_nav_menu_item', 'profduweb_update_nav_menu_item', 10, 3);

/**
 * Use one canonical URL source for every public view.
 */
remove_action('wp_head', 'rel_canonical');

function profduweb_get_canonical_url()
{
    if (is_singular()) {
        return get_permalink();
    }

    if (is_home() || is_front_page()) {
        $paged = max(1, (int) get_query_var('paged'));
        return 1 < $paged ? get_pagenum_link($paged) : home_url('/');
    }

    if (is_archive() || is_search()) {
        $paged = max(1, (int) get_query_var('paged'));
        return get_pagenum_link($paged);
    }

    return home_url(add_query_arg(array(), $GLOBALS['wp']->request ?? ''));
}

function profduweb_get_meta_description()
{
    if (is_singular()) {
        $post_id = get_queried_object_id();

        if (has_excerpt($post_id)) {
            $description = get_the_excerpt($post_id);
        } else {
            $post = get_post($post_id);
            $description = $post ? $post->post_content : '';
        }
    } elseif (is_category() || is_tag() || is_tax()) {
        $description = term_description();
    } elseif (is_author()) {
        $description = get_the_author_meta('description');
    } elseif (is_search()) {
        $description = sprintf(
            /* translators: %s: search query. */
            __('Search results for %s', 'profduweb'),
            get_search_query()
        );
    } else {
        $description = get_bloginfo('description');
    }

    $description = wp_strip_all_tags(strip_shortcodes((string) $description));
    $description = preg_replace('/\s+/', ' ', $description);
    $description = trim($description);

    return wp_trim_words($description, 28, '');
}

function profduweb_get_social_image()
{
    if (is_singular() && has_post_thumbnail()) {
        return get_the_post_thumbnail_url(get_queried_object_id(), 'large');
    }

    return get_template_directory_uri() . '/screenshot.png';
}

function profduweb_get_social_title()
{
    if (is_singular()) {
        return sprintf('%s | %s', single_post_title('', false), get_bloginfo('name'));
    }

    return wp_get_document_title();
}

/**
 * Output JSON-LD for search engines without depending on an SEO plugin.
 */
function profduweb_output_structured_data()
{
    $site_url = home_url('/');
    $site_name = get_bloginfo('name');

    $graph = array(
        array(
            '@type' => 'WebSite',
            '@id' => trailingslashit($site_url) . '#website',
            'url' => $site_url,
            'name' => $site_name,
            'description' => get_bloginfo('description'),
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => home_url('/?s={search_term_string}'),
                'query-input' => 'required name=search_term_string',
            ),
        ),
        array(
            '@type' => 'Person',
            '@id' => trailingslashit($site_url) . '#person',
            'name' => 'Mat',
            'url' => $site_url,
            'sameAs' => array(
                'https://instagram.com/profduweb',
                'https://bsky.app/profile/profduweb.com',
                'https://www.youtube.com/@appetco/community',
            ),
        ),
    );

    if (is_singular()) {
        $post_id = get_queried_object_id();
        $image = profduweb_get_social_image();

        $graph[] = array_filter(
            array(
                '@type' => is_page($post_id) ? 'WebPage' : 'BlogPosting',
                '@id' => get_permalink($post_id) . '#article',
                'url' => get_permalink($post_id),
                'mainEntityOfPage' => get_permalink($post_id),
                'headline' => get_the_title($post_id),
                'description' => profduweb_get_meta_description(),
                'image' => $image ? array($image) : null,
                'datePublished' => get_the_date(DATE_W3C, $post_id),
                'dateModified' => get_the_modified_date(DATE_W3C, $post_id),
                'author' => array(
                    '@id' => trailingslashit($site_url) . '#person',
                ),
                'publisher' => array(
                    '@id' => trailingslashit($site_url) . '#person',
                ),
            )
        );
    }

    $data = array(
        '@context' => 'https://schema.org',
        '@graph' => $graph,
    );

    echo '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'profduweb_output_structured_data', 20);

/**
 * Custom Comment Callback
 */
function profduweb_comment_callback($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    
        <div class="comment-meta commentmetadata">
            <div class="comment-author vcard">
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                <?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
                <span class="says"></span> <!-- Ensure it's empty -->
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
                <br />
            <?php endif; ?>
        </div>

        <div class="comment-content">
            <?php comment_text(); ?>
        </div>

        <div class="comment-metadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php
                /* translators: 1: date, 2: time */
                printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
            ?>
        </div>

        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
        
    <?php if ( 'div' != $args['style'] ) : ?>
        </div>
    <?php endif; ?>
    <?php
}
