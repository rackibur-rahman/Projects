<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-home-service-pages'] = 0;

/*page selection*/
$clean_biz_sections['clean-biz-home-service-pages'] =
    array(
        'priority'       => 40,
        'title'          => __( 'Select Service From Page', 'clean-biz' ),
        'description'    => __( 'This option only work when you have selected "Page" in "Service selection Options".', 'clean-biz' ),
        'panel'          => 'clean-biz-home-service',
    );

/*creating setting control for clean-biz-home-service-page start*/
$clean_biz_repeated_settings_controls['clean-biz-home-service-pages'] =
    array(
        'repeated' => 4,
        'clean-biz-home-service-pages-ids' => array(
            'setting' =>     array(
                'default'              => $clean_biz_customizer_defaults['clean-biz-home-service-pages'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For Service %s', 'clean-biz' ),
                'section'               => 'clean-biz-home-service-pages',
                'type'                  => 'dropdown-pages',
                'priority'              => 10,
                'description'           => ''
            )
        ),
        'clean-biz-home-service-pages-divider' => array(
            'control' => array(
                'section'               => 'clean-biz-home-service-pages',
                'type'                  => 'message',
                'priority'              => 20,
                'description'           => '<br /><hr />'
            )
        )
    );