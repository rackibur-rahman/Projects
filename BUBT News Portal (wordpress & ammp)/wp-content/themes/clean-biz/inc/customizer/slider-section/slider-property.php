<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-slider-single-words'] = 30;
$clean_biz_customizer_defaults['clean-biz-slider-slider-mode'] = 'fadeout';
$clean_biz_customizer_defaults['clean-biz-slider-slider-time'] = 2;
$clean_biz_customizer_defaults['clean-biz-slider-slider-pause-time'] = 7;
$clean_biz_customizer_defaults['clean-biz-slider-enable-arrow'] = 0;
$clean_biz_customizer_defaults['clean-biz-slider-enable-pager'] = 1;
$clean_biz_customizer_defaults['clean-biz-slider-enable-autoplay'] = 1;
$clean_biz_customizer_defaults['clean-biz-slider-enable-title'] = 1;
$clean_biz_customizer_defaults['clean-biz-slider-enable-caption'] = 1;
$clean_biz_customizer_defaults['clean-biz-slider-button-text'] = __('View More','clean-biz');

/*slider options*/
$clean_biz_sections['clean-biz-slider-slider-options'] =
    array(
        'priority'       => 80,
        'title'          => __( 'Slider Property', 'clean-biz' ),
        'panel'          => 'clean-biz-featured-slider',
    );

$clean_biz_settings_controls['clean-biz-slider-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-slider-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Single Slider- Number Of Words', 'clean-biz' ),
            'description'           =>  __( 'If you do not have selected from - Custom', 'clean-biz' ),
            'section'               => 'clean-biz-slider-slider-options',
            'type'                  => 'number',
            'priority'              => 5,
            'active_callback'       => '',
            'input_attrs' => array( 'min' => 1, 'max' => 200),
        )
    );

$clean_biz_settings_controls['clean-biz-slider-slider-mode'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-slider-slider-mode']
        ),
        'control' => array(
            'label'                 =>  __( 'Slider Mode', 'clean-biz' ),
            'section'               => 'clean-biz-slider-slider-options',
            'type'                  => 'select',
            'choices'               => array(
                'scrollHorz' => __( 'Default', 'clean-biz' ),
                'fade' => __( 'Fade', 'clean-biz' ),
                'fadeout' => __( 'Fade-Out', 'clean-biz' )
            ),
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-slider-enable-arrow'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-slider-enable-arrow']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Arrow', 'clean-biz' ),
            'section'               => 'clean-biz-slider-slider-options',
            'type'                  => 'checkbox',
            'priority'              => 50,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-slider-enable-pager'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-slider-enable-pager']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Pager', 'clean-biz' ),
            'section'               => 'clean-biz-slider-slider-options',
            'type'                  => 'checkbox',
            'priority'              => 55,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-slider-enable-title'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-slider-enable-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Title', 'clean-biz' ),
            'section'               => 'clean-biz-slider-slider-options',
            'type'                  => 'checkbox',
            'priority'              => 70,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-slider-enable-caption'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-slider-enable-caption']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Caption', 'clean-biz' ),
            'section'               => 'clean-biz-slider-slider-options',
            'type'                  => 'checkbox',
            'priority'              => 80,
            'active_callback'       => ''
        )
    );


$clean_biz_settings_controls['clean-biz-slider-button-text'] =
array(
    'setting' =>     array(
        'default'              => $clean_biz_customizer_defaults['clean-biz-slider-button-text']
    ),
    'control' => array(
        'label'                 =>  __( 'Slider Section Button Text', 'clean-biz' ),
        'section'               => 'clean-biz-slider-slider-options',
        'type'                  => 'text',
        'priority'              => 90,
        'active_callback'       => ''
    )
);