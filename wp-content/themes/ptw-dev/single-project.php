
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

    $demo_url = get_post_meta(get_the_ID(), '_cpm_demo_url', true);
    $github_url = get_post_meta(get_the_ID(), '_cpm_github_url', true);
    $date = get_post_meta(get_the_ID(), '_cpm_year_made', true);

            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-container'); ?>>
                <div class="post-hero">
                    <h1 class="title display"><?php the_title(); ?></h1>
                    <div class="post-meta">
                        <?php if(!empty($demo_url)): ?>
                            <a class="ghost-btn" href="<?php echo esc_url($demo_url); ?>" target="_blank" rel="noopener"><?php esc_html_e('LIVE DEMO', 'ptw-dev') ?></a>
                        <?php endif; ?>
                        <?php if(!empty($github_url)): ?>
                            <a class="ghost-btn" href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noopener"><?php esc_html_e('GITHUB', 'ptw-dev') ?></a>
                        <?php endif; ?>
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
