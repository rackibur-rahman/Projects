<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values about options*/
$clean_biz_customizer_defaults['clean-biz-home-about-enable'] = 0;
$clean_biz_customizer_defaults['clean-biz-home-about-page'] = 0;
$clean_biz_customizer_defaults['clean-biz-home-about-single-words'] = 30;
$clean_biz_customizer_defaults['clean-biz-home-about-button-text'] = __('Know More','clean-biz');

/* Feature section Enable settings*/
$clean_biz_sections['clean-biz-home-about-section-settings'] =
    array(
        'priority'       => 150,
        'title'          => __( 'About Section', 'clean-biz' ),
    );

/*About section enable control*/
$clean_biz_settings_controls['clean-biz-home-about-enable'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-about-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable About Section', 'clean-biz' ),
            'description'           =>  __( 'Enable "About Section" on checked', 'clean-biz' ),
            'section'               => 'clean-biz-home-about-section-settings',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/*creating setting control for clean-biz-home-about-page start*/
$clean_biz_repeated_settings_controls['clean-biz-home-about-page'] =
    array(
        'repeated' => 1,
        'clean-biz-about-pages-ids' => array(
            'setting' =>     array(
                'default'              => $clean_biz_customizer_defaults['clean-biz-home-about-page'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For About Section', 'clean-biz' ),
                'description'           => '',
                'section'               => 'clean-biz-home-about-section-settings',
                'type'                  => 'dropdown-pages',
                'priority'              => 40
            )
        ),
        'clean-biz-about-pages-divider' => array(
            'control' => array(
                'section'               => 'clean-biz-about-selection-setting',
                'type'                  => 'message',
                'priority'              => 60,
                'description'           => '<br /><hr />'
            )
        )
    );

/*About Button Text control*/
$clean_biz_settings_controls['clean-biz-home-about-button-text'] =
array(
    'setting' =>     array(
        'default'              => $clean_biz_customizer_defaults['clean-biz-home-about-button-text']
    ),
    'control' => array(
        'label'                 =>  __( 'About Section Button Text', 'clean-biz' ),
        'section'               => 'clean-biz-home-about-section-settings',
        'type'                  => 'text',
        'priority'              => 60,
        'active_callback'       => ''
    )
);

