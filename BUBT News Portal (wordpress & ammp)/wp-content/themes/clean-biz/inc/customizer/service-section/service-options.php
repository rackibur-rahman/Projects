<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-home-service-enable'] = 0;
$clean_biz_customizer_defaults['clean-biz-home-service-title'] = __('amazing features','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-service-sub-title'] = __('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-service-single-words'] = 10;
$clean_biz_customizer_defaults['clean-biz-home-service-button-text'] = __('Browse more','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-service-button-link'] = '';
$clean_biz_customizer_defaults['clean-biz-home-service-enable-single-link'] = 1;
$clean_biz_customizer_defaults['clean-biz-home-service-selection'] = 'from-page';
$clean_biz_customizer_defaults['clean-biz-home-service-number'] = 4;

/*serviceoptions*/
$clean_biz_sections['clean-biz-home-service-options'] =
    array(
        'priority'       => 20,
        'title'          => __( 'Section Settings', 'clean-biz' ),
        'panel'          => 'clean-biz-home-service',
    );

$clean_biz_settings_controls['clean-biz-home-service-enable'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-service-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Service', 'clean-biz' ),
            'section'               => 'clean-biz-home-service-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


$clean_biz_settings_controls['clean-biz-home-service-title'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-service-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Main Title', 'clean-biz' ),
            'section'               => 'clean-biz-home-service-options',
            'type'                  => 'text',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );



$clean_biz_settings_controls['clean-biz-home-service-sub-title'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-service-sub-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Sub Title', 'clean-biz' ),
            'section'               => 'clean-biz-home-service-options',
            'type'                  => 'text',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-service-button-text'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-service-button-text']
        ),
        'control' => array(
            'label'                 =>  __( 'Browse All Button Text', 'clean-biz' ),
            'section'               => 'clean-biz-home-service-options',
            'type'                  => 'text',
            'priority'              => 40,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-service-button-link'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-service-button-link']
        ),
        'control' => array(
            'label'                 =>  __( 'Browse All Button Link', 'clean-biz' ),
            'section'               => 'clean-biz-home-service-options',
            'type'                  => 'url',
            'priority'              => 50,
            'active_callback'       => ''
        )
    );