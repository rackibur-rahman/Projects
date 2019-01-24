<?php
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-header-enable-search'] = 1;

$clean_biz_sections['clean-biz-header-enable-search-options'] =
    array(
        'priority'       => 80,
        'title'          => __( 'Search Options', 'clean-biz' ),
        'panel'          => 'clean-biz-theme-options'
    );

$clean_biz_settings_controls['clean-biz-header-enable-search'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-header-enable-search'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Search', 'clean-biz' ),
            'section'               => 'clean-biz-header-enable-search-options',
            'type'                  => 'checkbox',
            'priority'              => 50,
        )
    );