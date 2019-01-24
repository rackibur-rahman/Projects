<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-home-testimonial-enable'] = 0;
$clean_biz_customizer_defaults['clean-biz-home-testimonial-image-enable'] = 1;
$clean_biz_customizer_defaults['clean-biz-home-testimonial-main-title'] =  __('Testimonials','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-testimonial-sub-title'] =  __('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-testimonial-number'] = 4;
$clean_biz_customizer_defaults['clean-biz-home-testimonial-single-words'] = 30;
$clean_biz_customizer_defaults['clean-biz-home-testimonial-selection'] = 'from-page';
$clean_biz_customizer_defaults['clean-biz-home-testimonial-slider-mode'] = 'fade';
$clean_biz_customizer_defaults['clean-biz-home-testimonial-slider-time'] = 2;
$clean_biz_customizer_defaults['clean-biz-home-testimonial-slider-pause-time'] = 7;
$clean_biz_customizer_defaults['clean-biz-home-testimonial-enable-control'] = 1;
$clean_biz_customizer_defaults['clean-biz-home-testimonial-enable-autoplay'] = 1;


/*testimonial options*/
$clean_biz_sections['clean-biz-home-testimonial-options'] =
    array(
        'priority'       => 30,
        'title'          => __( 'Section Settings', 'clean-biz' ),
        'panel'          => 'clean-biz-home-testimonial',
    );

$clean_biz_settings_controls['clean-biz-home-testimonial-enable'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-testimonial-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Testimonial', 'clean-biz' ),
            'description'           => __( 'Enable "Testimonial selection" on checked', 'clean-biz' ),
            'section'               => 'clean-biz-home-testimonial-options',
            'type'                  => 'checkbox',
            'priority'              => 5,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-testimonial-image-enable'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-testimonial-image-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Image On Testimonial', 'clean-biz' ),
            'description'           => __( 'Enable image on testimonial selection on checked', 'clean-biz' ),
            'section'               => 'clean-biz-home-testimonial-options',
            'type'                  => 'checkbox',
            'priority'              => 5,
            'active_callback'       => ''
        )
    );

/*Testimonial Title control*/
$clean_biz_settings_controls['clean-biz-home-testimonial-main-title'] =
array(
    'setting' =>     array(
        'default'              => $clean_biz_customizer_defaults['clean-biz-home-testimonial-main-title']
    ),
    'control' => array(
        'label'                 =>  __( 'Main Title', 'clean-biz' ),
        'section'               => 'clean-biz-home-testimonial-options',
        'type'                  => 'text',
        'priority'              => 5,
        'active_callback'       => ''
    )
);

/*Testimonial Title control*/
$clean_biz_settings_controls['clean-biz-home-testimonial-sub-title'] =
array(
    'setting' =>     array(
        'default'              => $clean_biz_customizer_defaults['clean-biz-home-testimonial-sub-title']
    ),
    'control' => array(
        'label'                 =>  __( 'Sub Title', 'clean-biz' ),
        'section'               => 'clean-biz-home-testimonial-options',
        'type'                  => 'text',
        'priority'              => 5,
        'active_callback'       => ''
    )
);

/*No of Testimonial needed*/
$clean_biz_settings_controls['clean-biz-home-testimonial-number'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-testimonial-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Testimonial/s', 'clean-biz' ),
            'description'           => __( 'Choose number of Testimonial to be displayed', 'clean-biz' ),
            'section'               => 'clean-biz-home-testimonial-options',
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

/*String in max to be appear as description on testimonial*/
$clean_biz_settings_controls['clean-biz-home-testimonial-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-testimonial-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Single Testimonial- Number Of Words', 'clean-biz' ),
            'description'           =>  __( 'If you do not have selected from - Custom', 'clean-biz' ),
            'section'               => 'clean-biz-home-testimonial-options',
            'type'                  => 'number',
            'input_attrs' => array( 'min' => 1, 'max' => 200),
            'priority'              => 20,
            'active_callback'       => ''
        )
    );
