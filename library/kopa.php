<?php

add_action('after_setup_theme', 'kopa_after_setup_theme');

function kopa_after_setup_theme() {
    
    load_theme_textdomain(kopa_get_domain(), get_template_directory() . '/languages');
    add_action('admin_menu', 'kopa_admin_menu');
    add_action('init', 'kopa_add_exceprt_page');
    require trailingslashit(get_template_directory()) . '/library/includes/widgets.php';
    
    add_filter('get_avatar', 'kopa_get_avatar');
}
function kopa_add_exceprt_page() {
	add_post_type_support( 'page', 'excerpt' );
}
function kopa_admin_menu() {
    
    //General Setting Page
    $page_kopa_cpanel_theme_options = add_theme_page(
            __('Theme Options', kopa_get_domain()), __('Theme Options', kopa_get_domain()), 'edit_theme_options', 'kopa_cpanel_theme_options', 'kopa_cpanel_theme_options'
    );

    //call register settings function
    add_action( 'admin_init', 'kopa_register_settings' );

    add_action('admin_print_scripts-' . $page_kopa_cpanel_theme_options, 'kopa_admin_print_scripts');
    add_action('admin_print_styles-' . $page_kopa_cpanel_theme_options, 'kopa_admin_print_styles');

}

/**
 * Get theme options arguments ( option ids, option types and option standard values )
 */
function kopa_get_options_args() {
    return array(
        /* General */
        array(
            'id'   => 'kopa_theme_options_logo_margin_top',
            'type' => 'number',
        ),
        array(
            'id'   => 'kopa_theme_options_logo_margin_left',
            'type' => 'number'
        ),
        array(
            'id'   => 'kopa_theme_options_logo_margin_right',
            'type' => 'number'
        ),
        array(
            'id'   => 'kopa_theme_options_logo_margin_bottom',
            'type' => 'number'
        ),
        array(
            'id'   => 'kopa_theme_options_top_banner_url',
            'type' => 'textarea'
        ),
        array(
            'id'   => 'kopa_theme_options_favicon_url',
            'type' => 'upload'
        ),
        array(
            'id'   => 'kopa_theme_options_apple_iphone_icon_url',
            'type' => 'upload'
        ),
        array(
            'id'   => 'kopa_theme_options_apple_iphone_retina_icon_url',
            'type' => 'upload'
        ),
        array(
            'id'   => 'kopa_theme_options_apple_ipad_icon_url',
            'type' => 'upload'
        ),
        array(
            'id'   => 'kopa_theme_options_apple_ipad_retina_icon_url',
            'type' => 'upload'
        ),
        array(
            'id'   => 'kopa_theme_options_phone_number',
            'type' => 'text'
        ),
        array(
            'id'   => 'kopa_theme_options_address',
            'type' => 'text'
        ),
        array(
            'id'   => 'kopa_theme_options_email',
            'type' => 'email'
        ),
        array(
            'id'   => 'kopa_theme_options_copyright',
            'type' => 'textarea',
            'std'  => sprintf( __( 'Copyrights. &copy; %s by KOPATHEME', kopa_get_domain() ), date( 'Y' ) )
        ),

        /* Post */
        array(
            'id'   => 'kopa_theme_options_thumbnail_image',
            'type' => 'radio',
            'std'  => 'show'
        ),
        array(
            'id'   => 'kopa_theme_options_post_link',
            'type' => 'radio',
            'std'  => 'show'
        ),
        array(
            'id'   => 'kopa_theme_options_post_about_author',
            'type' => 'radio',
            'std'  => 'show'
        ),
        array(
            'id'   => 'kopa_theme_options_post_related_get_by',
            'type' => 'select',
            'std'  => 'hide'
        ),
        array(
            'id'   => 'kopa_theme_options_post_related_limit',
            'type' => 'abs_number',
            'std'  => 3
        ),

        /* Social Link */
        array(
            'id'   => 'kopa_theme_options_social_links_rss_url',
            'type' => 'url'
        ),
        array(
            'id'   => 'kopa_theme_options_social_links_facebook_url',
            'type' => 'url'
        ),
        array(
            'id'   => 'kopa_theme_options_social_links_twitter_url',
            'type' => 'url'
        ),
        array(
            'id'   => 'kopa_theme_options_social_links_gplus_url',
            'type' => 'url'
        ),
        array(
            'id'   => 'kopa_theme_options_social_links_instagram_url',
            'type' => 'url'
        ),
        array(
            'id'   => 'kopa_theme_options_social_links_Line_url',
            'type' => 'url'
        ),

        /* Custom CSS */
        array(
            'id'   => 'kopa_theme_options_custom_css',
            'type' => 'textarea'
        ),
    );
}

/**
 * Register settings 
 */
function kopa_register_settings() {
    //register our settings
    register_setting( 'kopa_theme_options_group', 'kopa_theme_options', 'kopa_validate_options' );
}

/**
 * Validate/Sanitize options
 */
function kopa_validate_options( $input ) {
    $args = kopa_get_options_args();

    foreach ( $args as $index => $option ) {
        $id = $option['id'];

        if ( isset( $input[ $id ] ) ) {
            switch ( $option['type'] ) {
                case 'text':
                    $input[ $id ] = sanitize_text_field( $input[ $id ] );
                    break;
                case 'url':
                    $input[ $id ] = esc_url( $input[ $id ] );
                    break;
                case 'email':
                    $input[ $id ] = sanitize_email( $input[ $id ] );
                    break;
                case 'number':
                    $input[ $id ] = kopa_sanitize_number( $input[ $id ] );
                    break;
                case 'abs_number':
                    $input[ $id ] = absint( $input[ $id ] );
                    break;
                case 'textarea':
                    $input[ $id ] = kopa_sanitize_textarea( $input[ $id ] );
                    break;
                case 'upload':
                    $input[ $id ] = kopa_sanitize_upload( $input[ $id ] );
                default:
                    break;
            }
        }
    }

    return $input;
}

/**
 * Get singular option in setting array
 * @param $key, option name (index)
 * @param $default, default value
 * @return option value, if option is available
 * @return $default value, if option is not available and user puts second parameter value
 * @return standard value in kopa_get_option_args(), when user does not put second parameter $default 
 * @return null, if the option index is not available, $default is empty and standard value is not available 
 * @package: Resolution
 * @since: 1.0.4
 */
function kopa_get_option( $key = null, $default = null ) {
    $args = kopa_get_options_args();
    $kopa_options = get_option( 'kopa_theme_options' );

    if ( isset( $kopa_options[ $key ] ) ) {
        return $kopa_options[ $key ];
    } elseif ( $default ) {
        return $default;
    } else {
        foreach ( $args as $index => $option ) {
            if ( $key === $option['id'] && isset( $option['std'] ) ) {
                return $option['std'];
            }
        }
    }

    return null;
}

/**
 * Sanitize number in theme options
 */
function kopa_sanitize_number( $value ) {
    if ( $value == '' ) {
        return null;
    } 

    return intval( $value );
}

/**
 * Sanitize textarea in theme options
 */
function kopa_sanitize_textarea( $value ) {
    global $allowedposttags;
    $output = wp_kses( $value, $allowedposttags);
    return $output;
}

/**
 * Sanitize textarea in theme options
 */
function kopa_sanitize_upload( $input ) {
    $output = '';
    $filetype = wp_check_filetype($input);
    if ( $filetype["ext"] ) {
        $output = $input;
    }
    return $output;
}

function kopa_cpanel_theme_options() {
    include trailingslashit(get_template_directory()) . '/library/includes/cpanel/theme-options.php';
}

function kopa_admin_print_scripts() {
    $dir = get_template_directory_uri() . '/library/js';

    

    wp_localize_script('jquery', 'kopa_variable', kopa_localize_script());

    if (!wp_script_is('wp-color-picker'))
        wp_enqueue_script('wp-color-picker');
    if (!wp_script_is('kopa-colorpicker'))
        wp_enqueue_script('kopa-colorpicker', "{$dir}/colorpicker.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-admin-utils'))
        wp_enqueue_script('kopa-admin-utils', "{$dir}/utils.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-admin-jquery-form'))
        wp_enqueue_script('kopa-admin-jquery-form', "{$dir}/jquery.form.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-admin-script'))
        wp_enqueue_script('kopa-admin-script', "{$dir}/script.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-admin-bootstrap'))
        wp_enqueue_script('kopa-admin-bootstrap', "{$dir}/bootstrap.min.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('thickbox'))
        wp_enqueue_script('thickbox', null, array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-uploader'))
        wp_enqueue_script('kopa-uploader', "{$dir}/uploader.js", array('jquery'), NULL, TRUE);
}

function kopa_localize_script() {
    return array(
        'AjaxUrl' => admin_url('admin-ajax.php'),
        'google_fonts' => kopa_get_google_font_array(),
    );
}

function kopa_admin_print_styles() {
    $dir = get_template_directory_uri() . '/library/css';
    wp_enqueue_style('kopa-admin-style', "{$dir}/style.css", array(), NULL);
    wp_enqueue_style('thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', array(), NULL);
    wp_enqueue_style('open-sans-font', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,600', array(), NULL);
    if (!wp_style_is('wp-color-picker'))
        wp_enqueue_style('wp-color-picker');


    $google_fonts = kopa_get_google_font_array();
    $current_heading_font = get_option('kopa_theme_options_heading_font_family', array(), NULL);
    $current_content_font = get_option('kopa_theme_options_content_font_family');
    $current_main_nav_font = get_option('kopa_theme_options_main_nav_font_family');
    $current_wdg_sidebar_font = get_option('kopa_theme_options_wdg_sidebar_font_family');
    $current_wdg_main_font = get_option('kopa_theme_options_wdg_main_font_family');
    $current_wdg_footer_font = get_option('kopa_theme_options_wdg_footer_font_family');
    $current_slider_font = get_option('kopa_theme_options_slider_font_family');

    $load_font_array = array();
    if ($current_heading_font) {
        array_push($load_font_array, $current_heading_font);
    }
    if ($current_content_font && !in_array($current_content_font, $load_font_array)) {
        array_push($load_font_array, $current_content_font);
    }
    if ($current_main_nav_font && !in_array($current_main_nav_font, $load_font_array)) {
        array_push($load_font_array, $current_main_nav_font);
    }
    if ($current_wdg_sidebar_font && !in_array($current_wdg_sidebar_font, $load_font_array)) {
        array_push($load_font_array, $current_wdg_sidebar_font);
    }


    if ($current_wdg_main_font && !in_array($current_wdg_main_font, $load_font_array)) {
        array_push($load_font_array, $current_wdg_main_font);
    }

    if ($current_wdg_footer_font && !in_array($current_wdg_footer_font, $load_font_array)) {
        array_push($load_font_array, $current_wdg_footer_font);
    }
    if ($current_slider_font && !in_array($current_slider_font, $load_font_array)) {
        array_push($load_font_array, $current_slider_font);
    }

    foreach ($load_font_array as $current_font) {

        if ($current_font != '') {
            $google_font_family = $google_fonts[$current_font]['family'];
            $temp_font_name = str_replace(' ', '+', $google_font_family);
            $font_url = 'http://fonts.googleapis.com/css?family=' . $temp_font_name . ':300,300italic,400,400italic,700,700italic&subset=latin';
            wp_enqueue_style('Google-Font-' . $temp_font_name, $font_url, array(), NULL);
        }
    }
}



function kopa_get_domain() {
    return constant('KOPA_DOMAIN');
}



/* =====================================================================================
 * Add Style and script for categories and post edit page
  ==================================================================================== */
add_action('admin_enqueue_scripts', 'kopa_category_scripts', 10, 1);

function kopa_category_scripts($hook) {
    if ($hook == 'edit-tags.php' or $hook == 'post-new.php' or $hook == 'post.php' or $hook == 'widgets.php') {
        
        wp_localize_script('jquery', 'kopa_variable', kopa_localize_script());
        wp_enqueue_script('kopa-admin-script', get_template_directory_uri() . '/library/js/script.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-admin-bootstrap', get_template_directory_uri() . '/library/js/bootstrap.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_style('kopa-admin-style', get_template_directory_uri() . '/library/css/style.css', array(), NULL);
         wp_enqueue_style('kopa-icon-style', get_template_directory_uri() . '/css/font-awesome.css', array(), NULL);
          wp_enqueue_style('kopa-widget-style', get_template_directory_uri() . '/library/css/widget.css', array(), NULL);
    }
}

/* =====================================================================================
 * Add Style and script for Widget page
  ==================================================================================== */
add_action('admin_enqueue_scripts', 'kopa_widget_page_scripts', 10, 1);

function kopa_widget_page_scripts($hook) {
    if ($hook == 'widgets.php') {
        
        if (!wp_script_is('thickbox'))
            wp_enqueue_script('thickbox', null, array('jquery'), NULL, TRUE);

        if (!wp_script_is('kopa-uploader'))
            wp_enqueue_script('kopa-uploader', get_template_directory_uri() ."/library/js/uploader.js", array('jquery'), NULL, TRUE);
        wp_enqueue_style('thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', array(), NULL);
        wp_enqueue_style('kopa-admin-widget-style', get_template_directory_uri() . '/library/css/widget.css', array(), NULL);
        wp_enqueue_style('kopa-icon-style', get_template_directory_uri() . '/css/icoMoon.css', array(), NULL);
        wp_enqueue_script('kopa-widget-js', get_template_directory_uri() ."/library/js/widget.js", array('jquery'), NULL, TRUE);
    }
}


function kopa_get_avatar($avatar) {
    $avatar = str_replace('"', "'", $avatar);
    return str_replace("class='", "class='author-avatar ", $avatar);
}
