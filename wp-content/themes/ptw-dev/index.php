<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            the_title( '<h1 class="entry-title">', '</h1>' );
            the_content();
        endwhile;
    else :
        echo '<p>Geen inhoud gevonden.</p>';
    endif;
    ?>
</main>

<?php
get_footer();
