<?php
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-enable-back-to-top'] = 1;

$clean_biz_sections['clean-biz-back-to-top-options'] =
    array(
        'priority'       => 80,
        'title'          => __( 'Back To Top Options', 'clean-biz' ),
        'panel'          => 'clean-biz-theme-options'
    );

$clean_biz_settings_controls['clean-biz-enable-back-to-top'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-enable-back-to-top'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Back To Top', 'clean-biz' ),
            'section'               => 'clean-biz-back-to-top-options',
            'type'                  => 'checkbox',
            'priority'              => 50,
        )
    );