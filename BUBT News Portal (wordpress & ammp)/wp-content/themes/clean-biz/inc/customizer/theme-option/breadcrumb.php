<?php
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-enable-breadcrumb'] = 1;

$clean_biz_sections['clean-biz-breadcrumb-options'] =
    array(
        'priority'       => 50,
        'title'          => __( 'Breadcrumb Options', 'clean-biz' ),
        'panel'          => 'clean-biz-theme-options',
    );

$clean_biz_settings_controls['clean-biz-enable-breadcrumb'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-enable-breadcrumb'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Breadcrumb', 'clean-biz' ),
            'section'               => 'clean-biz-breadcrumb-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );