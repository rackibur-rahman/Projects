<?php
global $clean_biz_panels;
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-home-service-page-icon'] = 'fa-magic';


/*font selection*/
$clean_biz_sections['clean-biz-home-service-font-icon'] =
    array(
        'priority'       => 35,
        'title'          => __( 'Service Icons', 'clean-biz' ),
        'description'    => __( 'This will let you choose font icon for service page".', 'clean-biz' ),
        'panel'          => 'clean-biz-home-service',
    );

$clean_biz_repeated_settings_controls['clean-biz-home-service-font-icon'] =
    array(
        'repeated' => 4,
        'clean-biz-home-service-page-icon' => array(
            'setting' =>     array(
                'default'              => $clean_biz_customizer_defaults['clean-biz-home-service-page-icon'],
            ),
            'control' => array(
                'label'                 =>  __( 'Icon for service section %s', 'clean-biz' ),
                'section'               => 'clean-biz-home-service-font-icon',
                'type'                  => 'text',
                'priority'              => 5,
                'description'           => sprintf( __( 'Use font awesome icon: Eg: %1$s. %2$sSee more here%3$s', 'clean-biz' ), 'fa-magic','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
            )
        ),
            'clean-biz-home-service-font-icon-divider' => array(
                'control' => array(
                    'section'               => 'clean-biz-home-service-font-icon',
                    'type'                  => 'message',
                    'priority'              => 20,
                    'description'           => '<br /><hr />'
                )
            )
        );