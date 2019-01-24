<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function clean_biz_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'clean-biz' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    $clean_biz_get_all_options = clean_biz_get_all_options(1);
    $clean_biz_footer_widgets_number = $clean_biz_get_all_options['clean-biz-footer-sidebar-number'];

    if( $clean_biz_footer_widgets_number > 0 ){
        register_sidebar(array(
            'name' => __('Footer Column One', 'clean-biz'),
            'id' => 'footer-col-one',
            'description' => __('Displays items on footer section.','clean-biz'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));
        if( $clean_biz_footer_widgets_number > 1 ){
            register_sidebar(array(
                'name' => __('Footer Column Two', 'clean-biz'),
                'id' => 'footer-col-two',
                'description' => __('Displays items on footer section.','clean-biz'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
        if( $clean_biz_footer_widgets_number > 2 ){
            register_sidebar(array(
                'name' => __('Footer Column Three', 'clean-biz'),
                'id' => 'footer-col-three',
                'description' => __('Displays items on footer section.','clean-biz'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
        if( $clean_biz_footer_widgets_number > 3 ){
            register_sidebar(array(
                'name' => __('Footer Column Four', 'clean-biz'),
                'id' => 'footer-col-four',
                'description' => __('Displays items on footer section.','clean-biz'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
    }
}
add_action( 'widgets_init', 'clean_biz_widgets_init' );
