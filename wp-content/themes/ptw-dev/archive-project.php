<?php
/**
 * Template Name: Protfolio Projects Page
 *
 * @package PTW_Dev
 */

get_header(); ?>

<aside class="sidebar">
</aside>

<main class="post-container">
    <div class="post-grid project-row">
        <?php
        $args = array(
            'post_type' => 'project',
        );

        $showcase_query = new WP_Query($args);

        if($showcase_query->have_posts()) :
            while($showcase_query->have_posts()):
                $showcase_query->the_post();

                $demo_url   = get_post_meta( get_the_ID(), '_cpm_demo_url', true );
                $github_url = get_post_meta( get_the_ID(), '_cpm_github_url', true );
                $date = get_post_meta( get_the_ID(), '_cpm_year_made', true );

                ?>

            <div class="project-card card">
                <?php if ( has_post_thumbnail() ) :
                    the_post_thumbnail( 'medium', array(
                        'class' => 'project-image',
                    )); endif
                ?>
                <div class="project-info">
                    <div class ="project-top-wrapper">
                        <h3 class="label">// <?php the_title(); ?></h3>
                        <?php if ( ! empty( $date) ) : ?>
                            <span class="label"><?php echo $date; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="project-bottom-wrapper">
                        <?php the_excerpt(); ?>
                        <div class="project-links">
                            <div>
                                <?php if ( ! empty( $demo_url ) ) : ?>
                                    <a class="ghost-btn" href="<?php echo esc_url( $demo_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e('LIVE DEMO', 'ptw-dev'); ?></a>
                                <?php endif; ?>

                                <?php if ( ! empty( $github_url ) ) : ?>
                                    <a class="ghost-btn" href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e('GITHUB', 'ptw-dev'); ?></a>
                                <?php endif; ?>
                            </div>
                            <a class="ghost-btn" href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE', 'ptw-dev'); ?></a>
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
