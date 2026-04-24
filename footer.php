<?php
/**
 * The template for displaying the footer
 */
?>

</div><!-- .site-content -->

<footer id="colophon" class="site-footer custom-footer">
    <div class="site-container footer-inner">

        <div class="footer-col-1">
            <div class="footer-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.jpeg'); ?>"
                        alt="Logo <?php bloginfo('name'); ?>">
                </a>
                <h2 class="footer-title"><a href="<?php echo esc_url(home_url('/')); ?>">Mat</a></h2>
            </div>
            <p class="footer-tagline">Mat, connu sous le nom de @profduweb. J'adore tout ce qui rend la vie plus facile
                !</p>
            <div class="footer-buttons">
                <a class="footer-btn btn-outline" href="https://buymeacoffee.com/profduweb" target="_blank"
                    rel="noopener noreferrer">
                    <strong>M'offrir un café</strong> ☕
                </a>
                <a class="footer-btn btn-filled" href="https://www.youtube.com/channel/UCNzUonmxxvG-HIqOC3S7Thw/join"
                    target="_blank" rel="noopener noreferrer">
                    <strong>Abonnement sur Youtube</strong> 🤍
                </a>
            </div>
        </div>

        <div class="footer-nav-container">
            <div class="footer-col-2">
                <?php
                if (has_nav_menu('footer-1')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer-1',
                        'menu_class' => 'footer-menu',
                        'container' => false,
                        'depth' => 1,
                    ));
                } else {
                    // Fallback
                    echo '<ul class="footer-menu">';
                    echo '<li><a href="/qui-suis-je/">Qui suis-je ?</a></li>';
                    echo '<li><a href="/mes-liens/">Mes liens</a></li>';
                    echo '<li><a href="https://music.apple.com/profile/profduweb" target="_blank" rel="noopener noreferrer">Ma musique</a></li>';
                    echo '<li><a href="https://letterboxd.com/profduweb/films/" target="_blank" rel="noopener noreferrer">Mes films chouchous</a></li>';
                    echo '</ul>';
                }
                ?>
            </div>

            <div class="footer-col-3">
                <?php
                if (has_nav_menu('footer-2')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer-2',
                        'menu_class' => 'footer-menu',
                        'container' => false,
                        'depth' => 1,
                    ));
                } else {
                    // Fallback
                    echo '<ul class="footer-menu">';
                    echo '<li><a href="https://www.happycow.net/members/profile/Profduweb" target="_blank" rel="noopener noreferrer">Mes recos de restos</a></li>';
                    echo '<li><a href="https://buymeacoffee.com/profduweb" target="_blank" rel="noopener noreferrer">M' . "'" . 'offrir un café</a></li>';
                    echo '<li><a href="mailto:casbah.miroir07@icloud.com">Me joindre</a></li>';
                    echo '<li><a href="https://mailchi.mp/8a09d8a10389/newsletter-de-mat-alias-profduweb" target="_blank" rel="noopener noreferrer">Ma newsletter</a></li>';
                    echo '</ul>';
                }
                ?>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>Site hébergé au Canada 🇨🇦</p>
    </div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>