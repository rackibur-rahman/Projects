<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values callback options*/
$clean_biz_customizer_defaults['clean-biz-callback-enable'] = 0;
$clean_biz_customizer_defaults['clean-biz-callback-page'] = 7;
$clean_biz_customizer_defaults['clean-biz-home-callback-single-words'] = 40;
$clean_biz_customizer_defaults['clean-biz-home-callback-remove-button'] = 1;
$clean_biz_customizer_defaults['clean-biz-home-callback-button-text'] = __('View More','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-callback-button-link'] = '';

/* Feature section Enable settings*/
$clean_biz_sections['clean-biz-callback-section-settings'] =
    array(
        'priority'       => 30,
        'title'          => __( 'Section Settings', 'clean-biz' ),
        'panel'          => 'clean-biz-callback-panel',
    );

/*callback section enable control*/
$clean_biz_settings_controls['clean-biz-callback-enable'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-callback-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable callback Section', 'clean-biz' ),
            'description'           =>  __( 'Enable "callback Section" on checked', 'clean-biz' ),
            'section'               => 'clean-biz-callback-section-settings',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


    /*creating setting control for clean-biz-callback-page start*/
    $clean_biz_settings_controls['clean-biz-callback-page'] =
        array(
                'setting' =>     array(
                    'default'              => $clean_biz_customizer_defaults['clean-biz-callback-page'],
                    ),
                'control' => array(
                    'label'                 =>  __( 'Select Page For callback Section', 'clean-biz' ),
                    'description'           => '',
                    'section'               => 'clean-biz-callback-section-settings',
                    'type'                  => 'dropdown-pages',
                    'priority'              => 20
                )
        );

/*String in max to be appear as description on callback*/
$clean_biz_settings_controls['clean-biz-home-callback-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-callback-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Words', 'clean-biz' ),
            'description'           =>  __( 'Give number of words you wish to be appear on home page callback section', 'clean-biz' ),
            'section'               => 'clean-biz-callback-section-settings',
            'type'                  => 'number',
            'input_attrs' => array( 'min' => 1, 'max' => 200),
            'priority'              => 30,
            'active_callback'       => ''
        )
    );

    $clean_biz_settings_controls['clean-biz-home-callback-remove-button'] =
        array(
            'setting' =>     array(
                'default'              => $clean_biz_customizer_defaults['clean-biz-home-callback-remove-button']
            ),
            'control' => array(
                'label'                 =>  __( 'Enable Button', 'clean-biz' ),
                'section'               => 'clean-biz-callback-section-settings',
                'type'                  => 'checkbox',
                'priority'              => 30,
                'active_callback'       => ''
            )
        );

/*callback Button Text control*/
$clean_biz_settings_controls['clean-biz-home-callback-button-text'] =
array(
    'setting' =>     array(
        'default'              => $clean_biz_customizer_defaults['clean-biz-home-callback-button-text']
    ),
    'control' => array(
        'label'                 =>  __( 'callback Section Button Text', 'clean-biz' ),
        'section'               => 'clean-biz-callback-section-settings',
        'type'                  => 'text',
        'priority'              => 60,
        'active_callback'       => ''
    )
);

/*callback button url*/
$clean_biz_settings_controls['clean-biz-home-callback-button-link'] =
array(
    'setting' =>     array(
        'default'              => $clean_biz_customizer_defaults['clean-biz-home-callback-button-link']
    ),
    'control' => array(
        'label'                 =>  __( 'callback Section Button URL', 'clean-biz' ),
        'description'           =>  __( 'Will redirect to the costume URL ', 'clean-biz' ),
        'section'               => 'clean-biz-callback-section-settings',
        'type'                  => 'url',
        'priority'              => 70,
        'active_callback'       => ''
    )
);
