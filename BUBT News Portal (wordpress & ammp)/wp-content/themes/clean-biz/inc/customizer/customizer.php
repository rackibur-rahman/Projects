<?php
/**
 * evision themes Theme Customizer
 *
 * @package eVision themes
 * @subpackage clean-biz
 * @since clean-biz 1.0.0
 */
/*Define Url for including css and js*/
if ( !defined( 'EVISION_CUSTOMIZER_URL' ) ) {
    define( 'EVISION_CUSTOMIZER_URL', trailingslashit( get_template_directory_uri() ) . 'inc/frameworks/evision-customizer/' );
}
/*Define path for including php files*/
if ( !defined( 'EVISION_CUSTOMIZER_PATH' ) ) {
    define( 'EVISION_CUSTOMIZER_PATH', trailingslashit( get_template_directory() ) . 'inc/frameworks/evision-customizer/' );
}

/*define constant for evision customizer name*/
if(!defined('EVISION_CUSTOMIZER_NAME')){
    define( 'EVISION_CUSTOMIZER_NAME', 'clean_biz_options' );
}

/**
 * reset options
 * @param  array $reset_options
 * @return void
 *
 * @since clean-biz 1.0.0
 */
if ( ! function_exists( 'clean_biz_reset_options' ) ) :
    function clean_biz_reset_options( $reset_options ) {
        set_theme_mod( EVISION_CUSTOMIZER_NAME, $reset_options );
    }
endif;

/**
 * Customizer framework added.
 */
require get_template_directory() . '/inc/frameworks/evision-customizer/evision-customizer.php';
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/******************************************
Modify Site Color Options
 *******************************************/
require get_template_directory().'/inc/customizer/color/color-section.php';

/******************************************
Modify Site Font Options
 *******************************************/
require get_template_directory().'/inc/customizer/font/font-section.php';

/******************************************
Modify Slider Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/slider-section/slider-panel.php';

/******************************************
Modify service Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/service-section/service-panel.php';

/******************************************
Modify about Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/about-section/about-panel.php';

/******************************************
Modify testimonial Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/testimonial-section/testimonial-panel.php';

/******************************************
Modify portfolio Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/portfolio-section/portfolio-panel.php';

/******************************************
Modify team Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/team-section/team-panel.php';

/******************************************
Modify callback Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/callback-section/callback-panel.php';

/******************************************
Modify Blog Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/blog-section/blog-panel.php';

/******************************************
Modify Theme Option Section Options
 *******************************************/
require get_template_directory().'/inc/customizer/theme-option/option-panel.php';



/*Resetting all Values*/
/**
 * Reset color settings to default
 *
 * @since clean-biz 1.0.0
 */
global $clean_biz_customizer_defaults;
$clean_biz_customizer_defaults['clean-biz-customizer-reset-settings'] = '';
if ( ! function_exists( 'clean_biz_customizer_reset' ) ) :
    function clean_biz_customizer_reset( ) {
        global $clean_biz_customizer_saved_values;
        $clean_biz_customizer_saved_values = clean_biz_get_all_options();
        if ( $clean_biz_customizer_saved_values['clean-biz-customizer-reset-settings'] == 1 ) {
            global $clean_biz_customizer_defaults;
            /*getting fields*/
            $clean_biz_customizer_defaults['clean-biz-customizer-reset-settings'] = '';
            /*resetting fields*/
            clean_biz_reset_options( $clean_biz_customizer_defaults );
        }
        else {
            return '';
        }
    }
endif;
add_action( 'customize_save_after','clean_biz_customizer_reset' );

$clean_biz_sections['clean-biz-customizer-reset'] =
    array(
        'priority'       => 999,
        'title'          => __( 'Reset All Options', 'clean-biz' )
    );
$clean_biz_settings_controls['clean-biz-customizer-reset-settings'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-customizer-reset-settings'],
            'sanitize_callback'    => 'evision_customizer_sanitize_checkbox',
            'transport'            => 'postmessage',
        ),
        'control' => array(
            'label'                 =>  __( 'Reset All Options', 'clean-biz' ),
            'description'           =>  __( 'Caution: Reset all options settings to default. Refresh the page after save to view the effects. ', 'clean-biz' ),
            'section'               => 'clean-biz-customizer-reset',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/******************************************
Aranging header image
 *******************************************/
$clean_biz_sections['custom_css'] =
    array(
        'title'          => __( 'Additional CSS', 'clean-biz' ),
        'priority'       => 400,
    );
    
$clean_biz_sections['header_image'] =
    array(
        'priority'       => 1999,
        'title'          => __( 'Header Image', 'clean-biz' )
    );

$clean_biz_customizer_args = array(
    'panels'            => $clean_biz_panels, /*always use key panels */
    'sections'          => $clean_biz_sections,/*always use key sections*/
    'settings_controls' => $clean_biz_settings_controls,/*always use key settings_controls*/
    'repeated_settings_controls' => $clean_biz_repeated_settings_controls,/*always use key sections*/
);

/*registering panel section setting and control start*/
function clean_biz_add_panels_sections_settings() {
    global $clean_biz_customizer_args;
    return $clean_biz_customizer_args;
}
add_filter( 'evision_customizer_panels_sections_settings', 'clean_biz_add_panels_sections_settings' );
/*registering panel section setting and control end*/

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_biz_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'clean_biz_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function clean_biz_customize_preview_js() {
    wp_enqueue_script( 'clean-biz-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'clean_biz_customize_preview_js' );


/**
 * get all saved options
 * @param  null
 * @return array saved options
 *
 * @since clean-biz 1.0.0
 */
if ( ! function_exists( 'clean_biz_get_all_options' ) ) :
    function clean_biz_get_all_options( $merge_default = 0 ) {
        $clean_biz_customizer_saved_values = evision_customizer_get_all_values( EVISION_CUSTOMIZER_NAME );
        if( 1 == $merge_default ){
            global $clean_biz_customizer_defaults;
            if(is_array( $clean_biz_customizer_saved_values )){
                $clean_biz_customizer_saved_values = array_merge($clean_biz_customizer_defaults, $clean_biz_customizer_saved_values );
            }
            else{
                $clean_biz_customizer_saved_values = $clean_biz_customizer_defaults;
            }
        }
        return $clean_biz_customizer_saved_values;
    }
endif;
