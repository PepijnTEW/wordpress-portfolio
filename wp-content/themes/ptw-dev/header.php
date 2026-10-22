<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <script>
      (function() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
          document.documentElement.setAttribute('data-theme', savedTheme);
        } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
          document.documentElement.setAttribute('data-theme', 'dark');
        } else {
          document.documentElement.setAttribute('data-theme', 'light');
        }
      })();
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <a class="logo" href="<?php echo home_url(); ?>"><?php bloginfo('name')?></a>
        <div class="header-controls">
            <div class="dropdown">
                <?php
                    if (function_exists('pll_the_languages')) {
                        $translations = pll_the_languages(array('raw' => 1));
                        $current_lang_code = 'EN';

                        if (!empty($translations) && is_array($translations)) {
                            foreach($translations as $lang) {
                                if (!empty($lang['current']) || (function_exists('pll_current_language') && $lang['slug'] === pll_current_language())) {
                                    $current_lang_code = strtoupper($lang['slug']);
                                    break;
                                }
                            }
                        }
                ?>
                <button class="ghost-btn"><?php esc_html_e('LANG', 'ptw-dev'); ?>: [<?php echo esc_html($current_lang_code); ?>] ▾</button>
                <div class="dropdown-content">
                    <?php foreach($translations as $lang) : ?>
                        <a class="dropdown-content-btn" href="<?php echo esc_url($lang['url']); ?>">
                            [<?php echo esc_html(strtoupper($lang['slug'])); ?>] <?php echo esc_html(strtoupper($lang['name'])); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php } else { ?>
                    <button class="dropdown-btn">LANG: EN ▾</button>
                <?php } ?>
            </div>
            <div class="dropdown">
                <button id="theme-btn" class="ghost-btn"><?php esc_html_e('THEME', 'ptw-dev'); ?>: <?php esc_html_e('AUTO', 'ptw-dev'); ?> ▾</button>
                <div class="dropdown-content">
                    <a class="dropdown-content-btn" href="#" onclick="setTheme('light'); return false;"><?php esc_html_e('LIGHT', 'ptw-dev'); ?></a>
                    <a class="dropdown-content-btn" href="#" onclick="setTheme('dark'); return false;"><?php esc_html_e('DARK', 'ptw-dev'); ?></a>
                    <a class="dropdown-content-btn" href="#" onclick="setTheme('system'); return false;"><?php esc_html_e('AUTO', 'ptw-dev'); ?></a>
                </div>
            </div>
        </div>
    </header>
