<?php
/**
 * The sidebar containing the main widget area
 */

if (!is_active_sidebar('sidebar-1')) {
    // If no widgets are active, output a default block for demo purposes.
    ?>
    <aside id="secondary" class="sidebar-column widget-area">
        <section class="widget">
            <h2 class="widget-title">About Mat</h2>
            <p>Découvrez les meilleures astuces, tests et tutoriels Apple, iPhone, Mac et iOS avec Mat, alias Prof du Web
                (@profduweb).</p>
        </section>
    </aside><!-- #secondary -->
    <?php
    return;
}
?>

<aside id="secondary" class="sidebar-column widget-area">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside><!-- #secondary -->