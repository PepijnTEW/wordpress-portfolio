<?php
/**
 * Plugin Name: Portfolio Manager
 * Description: For my portfolio
 * Version: 2.0
 * Author: Pepijn te Winkel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function cpm_register_project_post_type() {
    $args =array(
        'labels' => array(
            'name'               => 'Projects',
            'singular_name'      => 'Project',
            'menu_name'          => 'Projects',
            'add_new'            => 'Add New Project',
            'add_new_item'       => 'Add New Project',
            'new_item'           => 'New Project',
            'edit_item'          => 'Edit Project',
            'view_item'          => 'View Project',
            'all_items'          => 'All Projects',
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon'     => 'dashicons-portfolio',
        'supports'      => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
    );
    register_post_type( 'project', $args );
}
add_action( 'init', 'cpm_register_project_post_type' );

function cpm_add_project_meta_boxes() {
    add_meta_box(
        'cpm_project_details',
        'Project Details & Showcase Settings',
        'cpm_project_meta_box_html',
        'project',
        'normal',
        'high'
    );

    add_meta_box(
        'cpm_portfolio_about',
        'Portfolio Homepage & About Content',
        'cpm_portfolio_about_html',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'cpm_add_project_meta_boxes' );

function cpm_project_meta_box_html( $post ) {
    wp_nonce_field( 'cpm_save_project_meta', 'cpm_project_nonce' );

    $demo_url   = get_post_meta( $post->ID, '_cpm_demo_url', true );
    $github_url = get_post_meta( $post->ID, '_cpm_github_url', true );
    $year_made  = get_post_meta( $post->ID, '_cpm_year_made', true );
    $is_showed  = get_post_meta( $post->ID, '_cpm_is_showcased', true );

    ?>
    <p>
        <label for="cpm_demo_url"><strong>Live Demo URL:</strong></label><br>
        <input type="url" id="cpm_demo_url" name="cpm_demo_url" value="<?php echo esc_url( $demo_url ); ?>" style="width:100%;" placeholder="https://example.com">
    </p>
    <p>
        <label for="cpm_github_url"><strong>GitHub Repository URL:</strong></label><br>
        <input type="url" id="cpm_github_url" name="cpm_github_url" value="<?php echo esc_url( $github_url ); ?>" style="width:100%;" placeholder="https://github.com/yourusername/repo">
    </p>
    <p>
        <label for="cpm_year_made"><strong>Year Made:</strong></label><br>
        <input type="number" id="cpm_year_made" name="cpm_year_made" value="<?php echo esc_attr( $year_made ); ?>" style="width:100%;" placeholder="2026" min="2000" max="2099">
    </p>
    <p>
        <label>
            <input type="checkbox" name="cpm_is_showcased" value="1" <?php checked( $is_showed, '1' ); ?>>
            <strong>Feature on Homepage Showcase</strong>
        </label>
    </p>
    <?php
}

function cpm_portfolio_about_html($post) {
    wp_nonce_field('cpm_save_portfolio_meta', 'cpm_portfolio_nonce');

    $location   = get_post_meta( $post->ID, '_cpm_location', true );
    $skills     = get_post_meta( $post->ID, '_cpm_skills_list', true );
    $identity   = get_post_meta( $post->ID, '_cpm_identity_bio', true );
    $hardware   = get_post_meta( $post->ID, '_cpm_hardware_lens', true );
    $philosophy = get_post_meta( $post->ID, '_cpm_philosophy', true );
    $env_items  = get_post_meta( $post->ID, '_cpm_env_list', true );
    $specs      = get_post_meta( $post->ID, '_cpm_specs_list', true );
    ?>

    <p>
        <label><strong>Location (e.g. Hilversum, NL):</strong></label><br>
        <input type="text" name="cpm_location" value="<?php echo esc_attr( $location ); ?>" style="width:100%;">
    </p>
    <p>
        <label><strong>Skills:</strong></label><br>
        <textarea name="cpm_skills_list" rows="5" style="width:100%;"><?php echo esc_textarea( $skills ); ?></textarea>
    </p>
    <p>
        <label><strong>// IDENTITY Bio:</strong></label><br>
        <textarea name="cpm_identity_bio" rows="3" style="width:100%;"><?php echo esc_textarea( $identity ); ?></textarea>
    </p>
    <p>
        <label><strong>// HARDWARE & LENS:</strong></label><br>
        <textarea name="cpm_hardware_lens" rows="3" style="width:100%;"><?php echo esc_textarea( $hardware ); ?></textarea>
    </p>
    <p>
        <label><strong>// PHILOSOPHY:</strong></label><br>
        <textarea name="cpm_philosophy" rows="3" style="width:100%;"><?php echo esc_textarea( $philosophy ); ?></textarea>
    </p>
    <p>
        <label><strong>// ENVIRONMENT:</strong></label><br>
        <textarea name="cpm_env_list" rows="3" style="width:100%;"><?php echo esc_textarea( $env_items ); ?></textarea>
    </p>
    <p>
        <label><strong>// SPECS:</strong></label><br>
        <textarea name="cpm_specs_list" rows="3" style="width:100%;"><?php echo esc_textarea( $specs ); ?></textarea>
    </p>
    <?php
}


function cpm_save_project_meta( $post_id ) {

    if ( isset( $_POST['cpm_project_nonce'] ) && wp_verify_nonce( $_POST['cpm_project_nonce'], 'cpm_save_project_meta' ) ) {
            if ( !( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) && current_user_can( 'edit_post', $post_id ) ) {
                if ( isset( $_POST['cpm_demo_url'] ) ) {
                    update_post_meta( $post_id, '_cpm_demo_url', esc_url_raw( $_POST['cpm_demo_url'] ) );
                }
                if ( isset( $_POST['cpm_github_url'] ) ) {
                    update_post_meta( $post_id, '_cpm_github_url', esc_url_raw( $_POST['cpm_github_url'] ) );
                }
                if ( isset( $_POST['cpm_year_made'] ) ) {
                    update_post_meta( $post_id, '_cpm_year_made', sanitize_text_field( $_POST['cpm_year_made'] ) );
                }
                $is_showcased = isset( $_POST['cpm_is_showcased'] ) ? '1' : '0';
                update_post_meta( $post_id, '_cpm_is_showcased', $is_showcased );
            }
        }

    if ( isset( $_POST['cpm_portfolio_nonce'] ) && wp_verify_nonce( $_POST['cpm_portfolio_nonce'], 'cpm_save_portfolio_meta' ) ) {
        if ( !( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) && current_user_can( 'edit_post', $post_id ) ) {
            $fields = array(
                '_cpm_identity_bio'   => 'sanitize_textarea_field',
                '_cpm_hardware_lens'  => 'sanitize_textarea_field',
                '_cpm_philosophy'     => 'sanitize_textarea_field',
                '_cpm_location'       => 'sanitize_text_field',
                '_cpm_skills_list'    => 'sanitize_textarea_field',
                '_cpm_env_list'       => 'sanitize_textarea_field',
                '_cpm_specs_list'     => 'sanitize_textarea_field',
            );
            foreach ( $fields as $key => $sanitizer ) {
                $field_name = ltrim( $key, '_' );
                if( isset($_POST[$field_name] ) ) {
                    update_post_meta( $post_id, $key, call_user_func( $sanitizer, $_POST[$field_name] ) );
                }
            }
        }
    }

}
add_action( 'save_post', 'cpm_save_project_meta' );
