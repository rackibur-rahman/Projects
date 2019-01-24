<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-home-blog-enable'] = 0;
$clean_biz_customizer_defaults['clean-biz-home-blog-title'] = __('FROM OUR BLOG','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-blog-sub-title'] = __('Stay update with us','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-blog-single-words'] = 30;
$clean_biz_customizer_defaults['clean-biz-home-blog-blog-no'] = 3;
$clean_biz_customizer_defaults['clean-biz-home-blog-category'] = 0;
$clean_biz_customizer_defaults['clean-biz-home-blog-button-text'] = __('Browse more','clean-biz');
$clean_biz_customizer_defaults['clean-biz-home-blog-button-link'] = '';
/*blogoptions*/
$clean_biz_sections['clean-biz-home-blog-options'] =
    array(
        'priority'       => 180,
        'title'          => __( 'Blog Section', 'clean-biz' ),
    );

$clean_biz_settings_controls['clean-biz-home-blog-enable'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-blog-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Blog', 'clean-biz' ),
            'description'           => __( 'Enable "Blog Section" on checked' , 'clean-biz' ),
            'section'               => 'clean-biz-home-blog-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-blog-title'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-blog-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Main Title', 'clean-biz' ),
            'section'               => 'clean-biz-home-blog-options',
            'type'                  => 'text',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-blog-sub-title'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-blog-sub-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Sub Title', 'clean-biz' ),
            'section'               => 'clean-biz-home-blog-options',
            'type'                  => 'text',
            'priority'              => 30,
            'active_callback'       => ''
        )
    );

/*creating setting control for clean-biz-fs-Category start*/
$clean_biz_settings_controls['clean-biz-home-blog-category'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-blog-category']
        ),
        'control' => array(
            'label'                 =>  __( 'Select Category For Blog', 'clean-biz' ),
            'description'           =>  __( 'Blog will only displayed from this category', 'clean-biz' ),
            'section'               => 'clean-biz-home-blog-options',
            'type'                  => 'category_dropdown',
            'priority'              => 60,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-blog-button-text'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-blog-button-text']
        ),
        'control' => array(
            'label'                 =>  __( 'Browse All Button Text', 'clean-biz' ),
            'section'               => 'clean-biz-home-blog-options',
            'type'                  => 'text',
            'priority'              => 70,
            'active_callback'       => ''
        )
    );

$clean_biz_settings_controls['clean-biz-home-blog-button-link'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-home-blog-button-link']
        ),
        'control' => array(
            'label'                 =>  __( 'Browse All Button Link', 'clean-biz' ),
            'section'               => 'clean-biz-home-blog-options',
            'type'                  => 'url',
            'priority'              => 80,
            'active_callback'       => ''
        )
    );
