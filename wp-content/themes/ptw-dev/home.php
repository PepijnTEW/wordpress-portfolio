<?php
/**
 * Template Name: Protfolio Projects Page
 *
 * @package PTW_Dev
 */

get_header(); ?>

<aside class="sidebar">
    <div class="indicator" aria-hidden="true">
      <span></span><span></span><span></span>
    </div>
</aside>

<main class="post-container">
    <div class="post-grid project-row">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
        ?>

            <div class="project-card card">
                <?php if ( has_post_thumbnail() ) :
                    the_post_thumbnail( 'medium'); endif
                ?>
                <div class="project-info">
                    <div class ="project-top-wrapper">
                        <h3 class="label">// <?php the_title(); ?></h3>
                    </div>
                    <div class="project-bottom-wrapper">
                        <?php the_excerpt(); ?>
                        <div class="project-links">
                            <a class="ghost-btn" href="#"><?php esc_html_e('READ MORE', 'ptw-dev'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
            else :
                echo '<p>No projects found for the showcase yet.</p>';
            endif;
        ?>    </div>
</main>

<?php get_footer(); ?>
