<?php
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-footer-sidebar-number'] = 3;
$clean_biz_customizer_defaults['clean-biz-copyright-text'] = __('Copyright &copy; All right reserved.','clean-biz');
$clean_biz_customizer_defaults['clean-biz-enable-theme-name'] = 1;

$clean_biz_sections['clean-biz-footer-options'] =
    array(
        'priority'       => 15,
        'title'          => __( 'Footer Options', 'clean-biz' ),
        'panel'          => 'clean-biz-theme-options'
    );

$clean_biz_settings_controls['clean-biz-footer-sidebar-number'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-footer-sidebar-number'],
        ),
        'control' => array(
            'label'                 =>  __( 'Number of Sidebars In Footer Area', 'clean-biz' ),
            'section'               => 'clean-biz-footer-options',
            'type'                  => 'select',
            'choices'               => array(
                0 => __( 'Disable footer sidebar area', 'clean-biz' ),
                1 => __( '1', 'clean-biz' ),
                2 => __( '2', 'clean-biz' ),
                3 => __( '3', 'clean-biz' )
            ),
            'priority'              => 15,
            'description'           => '',
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-copyright-text'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-copyright-text'],
        ),
        'control' => array(
            'label'                 =>  __( 'Copyright Text', 'clean-biz' ),
            'section'               => 'clean-biz-footer-options',
            'type'                  => 'text_html',
            'priority'              => 20,
        )
    );
