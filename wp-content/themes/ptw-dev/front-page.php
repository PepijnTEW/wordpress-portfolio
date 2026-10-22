<?php
/**
 * Template Name: Portfolio Front Page
 *
 * @package PTW_Dev
 */

get_header();

$page_id = get_the_ID();

$location   = get_post_meta( $page_id, '_cpm_location', true );
$identity   = get_post_meta( $page_id, '_cpm_identity_bio', true );
$hardware   = get_post_meta( $page_id, '_cpm_hardware_lens', true );
$philosophy = get_post_meta( $page_id, '_cpm_philosophy', true );

$skills_raw = get_post_meta( $page_id, '_cpm_skills_list', true );
$env_raw    = get_post_meta( $page_id, '_cpm_env_list', true );
$specs_raw  = get_post_meta( $page_id, '_cpm_specs_list', true );

?>

<aside class="sidebar">
    <div class="indicator" aria-hidden="true">
      <span></span><span></span><span></span>
    </div>
</aside>

<div class ="scroll-container">
    <section class="hero-container section">
        <div>
            <h1 class="title display">Pepijn te Winkel</h1>
            <p class="subtitle display"><?php esc_html_e('Fullstack Developer','ptw-dev'); ?></p>
            <div class="cta-buttons">
                <a href="#projects-container" class="action-btn primary"><?php esc_html_e('Go to projects', 'ptw-dev'); ?></a>
                <a href="#about-container" class="action-btn secondary"><?php esc_html_e('About me', 'ptw-dev'); ?></a>
            </div>
        </div>
        <div class="card metadata-card">
            <div class="chapter">
                <h2 class="label"><?php esc_html_e('// SKILLS', 'ptw-dev'); ?></h2>
                <ul class="list">
                    <?php
                    foreach( explode("\n", $skills_raw) as $skill) {
                        $skill = trim( $skill );
                        if ( ! empty( $skill ) ) {
                            echo '<li>' . esc_html( $skill ) . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="chapter">
                <span class="label"><?php esc_html_e('// METADATA', 'ptw-dev'); ?></span>
                <ul class="list">
                    <li>[LO] <?php echo esc_html($location);?></li>
                    <li>[DA] <?php echo esc_html(date_i18n(get_option('date_format'))); ?></li>
                    <li>[TI] <?php echo esc_html(date_i18n(get_option('time_format'))); ?></li>
                </ul>
            </div>
        </div>
    </section>

    <section id="projects-container" class="projects-container section">
        <div class="grid-row project-row">
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
        ?>
        </div>
        <a href="<?php echo esc_url(get_post_type_archive_link('project'))?>" class="link-more"><?php esc_html_e('MORE PROJECTS ->', 'ptw-dev'); ?></a>
    </section>
    <section id="about-container" class="about-container section">
        <div class="grid-row about-row">
        <div class="card about-card">

            <div class="chapter">
                <h3 class="label"><?php esc_html_e('// IDENTITY', 'ptw-dev'); ?></h3>
                <p class="about-content">
                    <?php echo esc_html($identity);?>
                </p>
            </div>

            <div class="chapter">
                <h3 class="label"><?php esc_html_e('// HARDWARE & LENS', 'ptw-dev'); ?></h3>
                <p class="about-content">
                    <?php echo esc_html($hardware);?>
                </p>
            </div>

            <div class="chapter">
                <h3 class="label"><?php esc_html_e('// PHILOSOPHY', 'ptw-dev'); ?></h3>
                <p class="about-content">
                    <?php echo esc_html($philosophy);?>
                </p>
            </div>

        </div>

        <div class="card specs-card">
            <div class="specs-wrapper">
                <div class="chapter">
                    <h3 class="label"><?php esc_html_e('// ENVIRONMENT', 'ptw-dev'); ?></h3>
                    <ul class="list">
                        <?php
                        foreach( explode("\n", $env_raw) as $env) {
                            $env = trim( $env );
                            if ( ! empty( $env ) ) {
                                echo '<li>' . esc_html( $env ) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="chapter">
                    <h3 class="label"><?php esc_html_e('// SPECS', 'ptw-dev'); ?></h3>
                    <ul class="list">
                        <?php
                        foreach( explode("\n", $specs_raw) as $spec) {
                            $spec = trim( $spec );
                            if ( ! empty( $spec ) ) {
                                echo '<li>' . esc_html( $spec ) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <pre class="ascii">
              __
   .,-;-;-,. /'_\
 _/_/_/_|_\_\) /
'-<_><_><_><_>=/\
 `/_/====/_/-'\_\
  ""     ""    ""
            </pre>
        </div>
        </div>

        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="link-more"><?php esc_html_e('MY BLOG ->', 'ptw-dev'); ?></a>

    </section>
    <section id="contact-container" class="contact-container section">
        <div class="grid-row contact-row">
            <div class="card about-card">
                <div class="chapter">
                    <h2 class="label"><?php esc_html_e('// CONTACT', 'ptw-dev'); ?></h2>
                    <p class="about-content">
                        <?php esc_html_e('Open to internships, projects and a good chat about hardware.', 'ptw-dev'); ?>
                    </p>
                </div>
                <div class="chapter">
                    <h3 class="label"><?php esc_html_e('// CHANNELS', 'ptw-dev'); ?></h3>
                    <ul class="list">
                        <li>[01] EMAIL : <a href="mailto:pepijntewinkel@gmail.com">pepijntewinkel@gmail.com</a></li>
                        <li>[02] GITHUB : <a href="https://github.com/PepijnTEW" target="_blank" rel="noopener">PepijnTEW</a></li>
                        <li>[03] LINKEDIN : <a href="https://www.linkedin.com/in/pepijn-te-winkel-91855724b/" target="_blank" rel="noopener">pepijn-te-winkel</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.scroll-container');
    if (!container) return;

    let isScrolling = false;

    container.addEventListener('wheel', (e) => {
      if (window.matchMedia('(max-width: 900px)').matches) return;
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
