<?php
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-site-identity-color'] = '#fff';
$clean_biz_customizer_defaults['clean-biz-primary-color'] = '#6F26AC';
$clean_biz_customizer_defaults['clean-biz-secondary-color'] = '#ffa800';
$clean_biz_customizer_defaults['clean-biz-color-reset'] = '';

/**
 * Reset color settings to default
 *
 * @since clean-biz 1.0.0
 */
if ( ! function_exists( 'clean_biz_color_reset' ) ) :
    function clean_biz_color_reset( ) {
        
            global $clean_biz_customizer_saved_values;
           $clean_biz_customizer_saved_values = clean_biz_get_all_options();
        if ( $clean_biz_customizer_saved_values['clean-biz-color-reset'] == 1 ) {
            global $clean_biz_customizer_defaults;
            global $clean_biz_customizer_saved_values;
            /*getting fields*/

            /*setting fields */
            $clean_biz_customizer_saved_values['clean-biz-site-identity-color'] = $clean_biz_customizer_defaults['clean-biz-site-identity-color'] ;
            $clean_biz_customizer_saved_values['clean-biz-primary-color'] = $clean_biz_customizer_defaults['clean-biz-primary-color'] ;
            $clean_biz_customizer_saved_values['clean-biz-secondary-color'] = $clean_biz_customizer_defaults['clean-biz-secondary-color'] ;
            remove_theme_mod( 'background_color' );
            $clean_biz_customizer_saved_values['clean-biz-color-reset'] = '';
            /*resetting fields*/
            clean_biz_reset_options( $clean_biz_customizer_saved_values );
        }
        else {
            return '';
        }
    }
endif;
add_action( 'customize_save_after','clean_biz_color_reset' );

$clean_biz_settings_controls['clean-biz-site-identity-color'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-site-identity-color'],
        ),
        'control' => array(
            'label'                 =>  __( 'Site Identity Color', 'clean-biz' ),
            'description'           =>  __( 'Site title and tagline color', 'clean-biz' ),
            'section'               => 'colors',
            'type'                  => 'color',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-primary-color'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-primary-color'],
        ),
        'control' => array(
            'label'                 =>  __( 'Primary Color', 'clean-biz' ),
            'description'           =>  __( 'Change your primary color on default it is purple', 'clean-biz' ),
            'section'               => 'colors',
            'type'                  => 'color',
            'priority'              => 30,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-secondary-color'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-secondary-color'],
        ),
        'control' => array(
            'label'                 =>  __( 'Secondary Color', 'clean-biz' ),
            'description'           =>  __( 'Change your secondary color on default it is orange', 'clean-biz' ),
            'section'               => 'colors',
            'type'                  => 'color',
            'priority'              => 30,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-color-reset'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-color-reset'],
            'transport'            => 'postmessage',
        ),
        'control' => array(
            'label'                 =>  __( 'Reset', 'clean-biz' ),
            'description'           =>  __( 'Caution: Reset all color settings above to default. Refresh the page after saving to view the effects', 'clean-biz' ),
            'section'               => 'colors',
            'type'                  => 'checkbox',
            'priority'              => 220,
            'active_callback'       => ''
        )
    );