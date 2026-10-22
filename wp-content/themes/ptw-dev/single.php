<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package PTW_Dev
 */

get_header();
?>

<aside class="sidebar">
</aside>
<div>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-container'); ?>>
                <div class="post-hero">
                    <h1 class="title display"><?php the_title(); ?></h1>
                    <p class="subtitle display"><?php esc_html_e('Blog post', 'ptw-dev'); ?></p>
                    <div class="post-meta">
                        <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
                    </div>
                </div>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
        the_posts_navigation();
    else :
        echo '<p>No content found.</p>';
    endif; ?>
</div>
<?php get_footer();
