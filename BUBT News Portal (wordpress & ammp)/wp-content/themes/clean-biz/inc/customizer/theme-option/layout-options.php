<?php
global $clean_biz_sections;
global $clean_biz_settings_controls;
global $clean_biz_repeated_settings_controls;
global $clean_biz_customizer_defaults;

/*defaults values*/
$clean_biz_customizer_defaults['clean-biz-enable-selected-page'] = 1;
$clean_biz_customizer_defaults['clean-biz-default-layout'] = 'right-sidebar';
$clean_biz_customizer_defaults['clean-biz-single-post-image-align'] = 'full';
$clean_biz_customizer_defaults['clean-biz-excerpt-length'] = '50';
$clean_biz_customizer_defaults['clean-biz-archive-layout'] = 'thumbnail-and-excerpt';
$clean_biz_customizer_defaults['clean-biz-archive-image-align'] = 'full';

$clean_biz_sections['clean-biz-layout-options'] =
    array(
        'priority'       => 10,
        'title'          => __( 'Layout Options', 'clean-biz' ),
        'panel'          => 'clean-biz-theme-options',
    );

/*layout-options option responsive lodader start*/
$clean_biz_settings_controls['clean-biz-enable-selected-page'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-enable-selected-page'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Selected Front Page', 'clean-biz' ),
            'description'           =>  __( 'If you disable this the selected page will be disappera form the home page and other section from customizer will reamin as it is', 'clean-biz' ),
            'section'               => 'clean-biz-layout-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );

$clean_biz_settings_controls['clean-biz-default-layout'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-default-layout'],
        ),
        'control' => array(
            'label'                 =>  __( 'Default Layout', 'clean-biz' ),
            'description'           =>  __( 'Please note that this section can be overridden for individual page/posts', 'clean-biz' ),
            'section'               => 'clean-biz-layout-options',
            'type'                  => 'select',
            'choices'               => array(
                'right-sidebar' => __( 'Content - Primary Sidebar', 'clean-biz' ),
                'left-sidebar' => __( 'Primary Sidebar - Content', 'clean-biz' ),
                'no-sidebar' => __( 'No Sidebar', 'clean-biz' )
            ),
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


$clean_biz_settings_controls['clean-biz-single-post-image-align'] =
    array(
        'setting' =>     array(
            'default'              => $clean_biz_customizer_defaults['clean-biz-single-post-image-align'],
        ),
        'control' => array(
            'label'                 =>  __( 'Alignment Of Image In Single Post/Page', 'clean-biz' ),
            'description'           =>  __( 'Please note that this section can be overridden for individual page/posts', 'clean-biz' ),
            'section'               => 'clean-biz-layout-options',
            'type'                  => 'select',
            'choices'               => array(
                'full' => __( 'Full', 'clean-biz' ),
                'right' => __( 'Right', 'clean-biz' ),
                'left' => __( 'Left', 'clean-biz' ),
                'no-image' => __( 'No image', 'clean-biz' )
            ),
            'priority'              => 40,
        )
    );

    $clean_biz_settings_controls['clean-biz-excerpt-length'] =
        array(
            'setting' =>     array(
                'default'              => $clean_biz_customizer_defaults['clean-biz-excerpt-length'],
            ),
            'control' => array(
                'label'                 =>  __( 'Excerpt Length (in words)', 'clean-biz' ),
                'section'               => 'clean-biz-layout-options',
                'type'                  => 'number',
                'priority'              => 40,
            )
        );

        $clean_biz_settings_controls['clean-biz-archive-layout'] =
            array(
                'setting' =>     array(
                    'default'              => $clean_biz_customizer_defaults['clean-biz-archive-layout'],
                ),
                'control' => array(
                    'label'                 =>  __( 'Archive Layout', 'clean-biz' ),
                    'section'               => 'clean-biz-layout-options',
                    'type'                  => 'select',
                    'choices'               => array(
                        'excerpt-only' => __( 'Excerpt Only', 'clean-biz' ),
                        'thumbnail-and-excerpt' => __( 'Thumbnail and Excerpt', 'clean-biz' ),
                        'full-post' => __( 'Full Post', 'clean-biz' ),
                        'thumbnail-and-full-post' => __( 'Thumbnail and Full Post', 'clean-biz' ),
                    ),
                    'priority'              => 55,
                )
            );