<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-home-testimonial-pages'] = 0;

/*page selection*/
$clean_biz_sections['clean-biz-home-testimonial-pages'] =
    array(
        'priority'       => 40,
        'title'          => __( 'Select From Page', 'clean-biz' ),
        'description'    => __( 'This option only work when you have selected "Page" in "Settings Options".', 'clean-biz' ),
        'panel'          => 'clean-biz-home-testimonial',
    );

/*creating setting control for clean-biz-home-testimonial-page start*/
$clean_biz_repeated_settings_controls['clean-biz-home-testimonial-pages'] =
    array(
        'repeated' => 3,
        'clean-biz-home-testimonial-pages-ids' => array(
            'setting' =>     array(
                'default'              => $clean_biz_customizer_defaults['clean-biz-home-testimonial-pages'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For Testimonial %s', 'clean-biz' ),
                'section'               => 'clean-biz-home-testimonial-pages',
                'type'                  => 'dropdown-pages',
                'priority'              => 10,
                'description'           => ''
            )
        ),
        'clean-biz-home-testimonial-pages-divider' => array(
            'control' => array(
                'section'               => 'clean-biz-home-testimonial-pages',
                'type'                  => 'message',
                'priority'              => 20,
                'description'           => '<hr />'
            )
        )
    );