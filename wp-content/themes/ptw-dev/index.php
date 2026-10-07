<?php get_header(); ?>
<aside class="sidebar">
    sidebar
</aside>

<div class ="scroll-container">
    <div class="hero-container content">
        <div class="hero-content">
            <h1 class="title">Pepijn te Winkel</h1>
            <p class="subtitle"><?php esc_html_e('Fullstack Developer','ptw-dev'); ?></p>
            <div class="cta-buttons">
                <a href="#projects-container" class="btn primary"><?php esc_html_e('Go to projects', 'ptw-dev'); ?></a>
                <a href="#about" class="btn secondary"><?php esc_html_e('About me', 'ptw-dev'); ?></a>
            </div>
        </div>
        <div class="metadata-card">
            <div class="skills-section">
                <span class="comment"><?php esc_html_e('// SKILLS', 'ptw-dev'); ?></span>
                <ul>
                    <li>[01] REACT</li>
                    <li>[02] LARAVEL</li>
                    <li>[03] TYPESCRIPT</li>
                    <li>[04] TAILWINDCSS</li>
                    <li>[05] LINUX</li>
                </ul>
            </div>
            <div class="metadata-section">
                <span class="comment"><?php esc_html_e('// METADATA', 'ptw-dev'); ?></span>
                <ul>
                    <li>[LO] HILVERSUM, NL</li>
                    <li>[DA] <?php echo esc_html(date_i18n(get_option('date_format'))); ?></li>
                    <li>[TI] <?php echo esc_html(date_i18n(get_option('time_format'))); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="projects-container" class="projects-container content">
        <div class="projects-grid">
        <?php
        $args = array(
            'post_type' => 'project',
            'posts_per_type' => 3,
            'meta_query' => array(
                array(
                    'key' => '_cpm_is_showcased',
                    'value' => 1,
                ),
            ),
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
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'medium', array(
                        'class' => 'project-image',
                    )); ?>
                <?php endif; ?>
                <div class="project-info">
                    <div class ="project-top-wrapper">
                        <p class="project-title">// <?php the_title(); ?></p>
                        <?php if ( ! empty( $date) ) : ?>
                            <p class="project-date"><?php echo $date; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="project-bottom-wrapper">
                        <div class="project-description">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="project-links">
                            <div>
                                <?php if ( ! empty( $demo_url ) ) : ?>
                                    <a class="project-button" href="<?php echo esc_url( $demo_url ); ?>" target="_blank" rel="noopener">LIVE DEMO</a>
                                <?php endif; ?>

                                <?php if ( ! empty( $github_url ) ) : ?>
                                    <a class="project-button" href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener">GITHUB</a>
                                <?php endif; ?>
                            </div>
                            <a class="project-button read-more-button" href="#"><?php esc_html_e('READ MORE', 'ptw-dev'); ?></a>
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
        ?>
        </div>
        <a href="#moreprojects" class="more-projects-button"><?php esc_html_e('MORE PROJECTS ->', 'ptw-detov'); ?></a>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.scroll-container');
    if (!container) return;

    let isScrolling = false;

    container.addEventListener('wheel', (e) => {
      if (isScrolling) {
        e.preventDefault();
        return;
      }

      if (Math.abs(e.deltaY) >= 50) {
        e.preventDefault();

        const direction = e.deltaY > 0 ? 1 : -1;
        const targetScroll = container.scrollTop + (window.innerHeight * direction);

        isScrolling = true;

        container.scrollTo({
          top: targetScroll,
            behavior: 'smooth'
          });

        setTimeout(() => {
            isScrolling = false;
        }, 600);
      }
    }, { passive: false });
  });
</script>

<?php get_footer(); ?>
