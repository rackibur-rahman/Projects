<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-feature-slider-enable'] = 0;
$clean_biz_customizer_defaults['clean-biz-featured-slider-number'] = 3;
$clean_biz_customizer_defaults['clean-biz-featured-slider-selection'] = 'from-page';


/*feature slider setting*/
$clean_biz_sections['clean-biz-featured-slider-selection-setting'] =
    array(
        'priority'       => 20,
        'title'          => __( 'Section Settings', 'clean-biz' ),
        'panel'          => 'clean-biz-featured-slider',
    );

/*Feature section enable control*/
$clean_biz_settings_controls['clean-biz-feature-slider-enable'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-feature-slider-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Feature Slider', 'clean-biz' ),
            'section'               => 'clean-biz-featured-slider-selection-setting',
            'description'           => __( 'Enable "Feature slider" on checked' , 'clean-biz' ),
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/*No of feature slider selection*/
$clean_biz_settings_controls['clean-biz-featured-slider-number'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-featured-slider-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Slider', 'clean-biz' ),
            'section'               => 'clean-biz-featured-slider-selection-setting',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'clean-biz' ),
                2 => __( '2', 'clean-biz' ),
                3 => __( '3', 'clean-biz' )
            ),
            'priority'              => 10,
            'active_callback'       => ''
        )
    );