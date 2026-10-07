<?php get_header(); ?>

<div class="hero-container content">
    <div class="hero-content">
        <h1 class="title">Pepijn te Winkel</h1>
        <p class="subtitle"><?php esc_html_e('Fullstack Developer','ptw-dev'); ?></p>
        <div class="cta-buttons">
            <a href="#projects" class="btn primary"><?php esc_html_e('Go to projects', 'ptw-dev'); ?></a>
            <a href="#about" class="btn secondary"><?php esc_html_e('About me', 'ptw-dev'); ?></a>
        </div>
    </div>

    <aside class="metadata-card">
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
    </aside>
</div>
<div class="projects-container content">
    <div class="projects-wrapper">
        <div class="project-card card">
            <div class="project-image card-image"></div>
            <h3>title</h3>
            <p>description</p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
