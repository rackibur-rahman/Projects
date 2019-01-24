<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-home-team-enable'] = 0;
$clean_biz_customizer_defaults['clean-biz-home-team-title'] = __('Our Teams','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-team-sub-title'] = __('Meet Our Awesome Creators','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-team-button-text'] = __('Browse more teams','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-team-button-link'] = '';
$clean_biz_customizer_defaults['clean-biz-home-team-enable-single-link'] = 1;
$clean_biz_customizer_defaults['clean-biz-home-team-selection'] = 'from-page';
$clean_biz_customizer_defaults['clean-biz-home-team-number'] = 4;

/*teamoptions*/
$clean_biz_sections['clean-biz-home-team-options'] =
    array(
        'priority'       => 35,
        'title'          => __( 'Section Settings', 'clean-biz' ),
        'panel'          => 'clean-biz-home-team',
    );

$clean_biz_settings_controls['clean-biz-home-team-enable'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-team-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Team', 'clean-biz' ),
            'section'               => 'clean-biz-home-team-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-team-title'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-team-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Main Title', 'clean-biz' ),
            'section'               => 'clean-biz-home-team-options',
            'type'                  => 'text',
            'priority'              => 15,
            'active_callback'       => ''
        )
    );


$clean_biz_settings_controls['clean-biz-home-team-sub-title'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-team-sub-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Sub Title', 'clean-biz' ),
            'section'               => 'clean-biz-home-team-options',
            'type'                  => 'text',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-team-number'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-team-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Team/s', 'clean-biz' ),
            'section'               => 'clean-biz-home-team-options',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'clean-biz' ),
                2 => __( '2', 'clean-biz' ),
                3 => __( '3', 'clean-biz' ),
                4 => __( '4', 'clean-biz' )
            ),
            'priority'              => 23,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-team-button-text'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-team-button-text']
        ),
        'control' => array(
            'label'                 =>  __( 'Browse All Button Text', 'clean-biz' ),
            'section'               => 'clean-biz-home-team-options',
            'type'                  => 'text',
            'priority'              => 40,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-team-button-link'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-team-button-link']
        ),
        'control' => array(
            'label'                 =>  __( 'Browse All Button Link', 'clean-biz' ),
            'section'               => 'clean-biz-home-team-options',
            'type'                  => 'url',
            'priority'              => 50,
            'active_callback'       => ''
        )
    );