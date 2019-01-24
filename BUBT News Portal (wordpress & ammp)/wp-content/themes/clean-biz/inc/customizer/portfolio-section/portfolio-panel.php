<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-home-portfolio-enable'] = 0;
$clean_biz_customizer_defaults['clean-biz-home-portfolio-title'] = __('Our Portfolio','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-portfolio-sub-title'] = __('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-portfolio-number'] = 4;
$clean_biz_customizer_defaults['clean-biz-home-portfolio-category'] = 0;

/*aboutoptions*/
$clean_biz_sections['clean-biz-home-portfolio-options'] =
    array(
        'priority'       => 170,
        'title'          => __( 'Portfolio Section', 'clean-biz' ),
    );


$clean_biz_settings_controls['clean-biz-home-portfolio-enable'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-portfolio-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Portfolio Section', 'clean-biz' ),
            'description'           => __( 'Enable Portfolio Section" on checked' , 'clean-biz' ),
            'section'               => 'clean-biz-home-portfolio-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-portfolio-title'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-portfolio-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Main Title', 'clean-biz' ),
            'description'           =>  __( 'Enable "portfolio Section" on checked', 'clean-biz' ),
            'section'               => 'clean-biz-home-portfolio-options',
            'type'                  => 'text',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-portfolio-sub-title'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-portfolio-sub-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Sub Title', 'clean-biz' ),
            'section'               => 'clean-biz-home-portfolio-options',
            'type'                  => 'text',
            'priority'              => 30,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-portfolio-number'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-portfolio-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Portfolio/s', 'clean-biz' ),
            'section'               => 'clean-biz-home-portfolio-options',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'clean-biz' ),
                2 => __( '2', 'clean-biz' ),
                3 => __( '3', 'clean-biz' ),
                4 => __( '4', 'clean-biz' ),
                5 => __( '5', 'clean-biz' ),
                6 => __( '6', 'clean-biz' ),
                7 => __( '7', 'clean-biz' ),
                8 => __( '8', 'clean-biz' )
            ),
            'priority'              => 40,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-portfolio-category'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-portfolio-category']
        ),
        'control' => array(
            'label'                 =>  __( 'Select Category For Portfolio', 'clean-biz' ),
            'description'           =>  __( 'Portfolio will only displayed from this category', 'clean-biz' ),
            'section'               => 'clean-biz-home-portfolio-options',
            'type'                  => 'category_dropdown',
            'priority'              => 60,
            'active_callback'       => ''
        )
    );
