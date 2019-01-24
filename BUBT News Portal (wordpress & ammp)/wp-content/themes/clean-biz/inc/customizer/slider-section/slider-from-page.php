<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-featured-slider-pages'] = 0;

/*page selection*/
$clean_biz_sections['clean-biz-feature-slider-pages'] =
    array(
        'priority'       => 40,
        'title'          => __( 'Select From Page', 'clean-biz' ),
        'description'    => __( 'This option only work when you have selected "Page" in "Settings Options".', 'clean-biz' ),
        'panel'          => 'clean-biz-featured-slider',
    );

/*creating setting control for clean-biz-fs-page start*/
$clean_biz_repeated_settings_controls['clean-biz-featured-slider-pages'] =
    array(
        'repeated' => 3,
        'clean-biz-fs-pages-ids' => array(
            'setting' =>     array(
                'default'              => $clean_biz_customizer_defaults['clean-biz-featured-slider-pages'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For Slide %s', 'clean-biz' ),
                'section'               => 'clean-biz-feature-slider-pages',
                'type'                  => 'dropdown-pages',
                'priority'              => 60,
                'description'           => ''
            )
        ),
        'clean-biz-fs-pages-divider' => array(
            'control' => array(
                'section'               => 'clean-biz-fs-selection-setting',
                'type'                  => 'message',
                'priority'              => 60,
                'description'           => '<br /><hr />'
            )
        )
    );

