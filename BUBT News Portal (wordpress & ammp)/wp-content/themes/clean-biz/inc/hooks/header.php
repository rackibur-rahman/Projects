<?php
if ( ! function_exists( 'clean_biz_set_global' ) ) :
/**
 * Setting global values for all saved customizer values
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
function clean_biz_set_global() {
    /*Getting saved values start*/
    $GLOBALS['clean_biz_customizer_all_values'] = clean_biz_get_all_options(1);
}
endif;
add_action( 'clean_biz_action_before_head', 'clean_biz_set_global', 0 );

if ( ! function_exists( 'clean_biz_doctype' ) ) :
/**
 * Doctype Declaration
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
function clean_biz_doctype() {
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
<?php
}
endif;
add_action( 'clean_biz_action_before_head', 'clean_biz_doctype', 10 );

if ( ! function_exists( 'clean_biz_before_wp_head' ) ) :
/**
 * Before wp head codes
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
function clean_biz_before_wp_head() {
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
}
endif;
add_action( 'clean_biz_action_before_wp_head', 'clean_biz_before_wp_head', 10 );

if( ! function_exists( 'clean_biz_default_layout' ) ) :
    /**
     * clean-biz default layout function
     *
     * @since  clean-biz 1.0.0
     *
     * @param int
     * @return string
     */
    function clean_biz_default_layout( $post_id = null ){

        global $clean_biz_customizer_all_values,$post;
        $clean_biz_default_layout = $clean_biz_customizer_all_values['clean-biz-default-layout'];
        if( is_home()){
            $post_id = get_option( 'page_for_posts' );
        }
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $clean_biz_default_layout_meta = get_post_meta( $post_id, 'clean-biz-default-layout', true );

        if( false != $clean_biz_default_layout_meta ) {
            $clean_biz_default_layout = $clean_biz_default_layout_meta;
        }
        return $clean_biz_default_layout;
    }
endif;

if ( ! function_exists( 'clean_biz_body_class' ) ) :
/**
 * add body class
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
function clean_biz_body_class( $clean_biz_body_classes ) {
    if(!is_front_page() || ( is_front_page())){
        $clean_biz_default_layout = clean_biz_default_layout();
        if( !empty( $clean_biz_default_layout ) ){
            if( 'left-sidebar' == $clean_biz_default_layout ){
                $clean_biz_body_classes[] = 'evision-left-sidebar nav-close';
            }
            elseif( 'right-sidebar' == $clean_biz_default_layout ){
                $clean_biz_body_classes[] = 'evision-right-sidebar nav-close';
            }
            elseif( 'both-sidebar' == $clean_biz_default_layout ){
                $clean_biz_body_classes[] = 'evision-both-sidebar nav-close';
            }
            elseif( 'no-sidebar' == $clean_biz_default_layout ){
                $clean_biz_body_classes[] = 'evision-no-sidebar nav-close';
            }
            else{
                $clean_biz_body_classes[] = 'evision-right-sidebar nav-close';
            }
        }
        else{
            $clean_biz_body_classes[] = 'evision-right-sidebar nav-close';
        }
    }
    return $clean_biz_body_classes;

}
endif;
add_action( 'body_class', 'clean_biz_body_class', 10, 1);

if ( ! function_exists( 'clean_biz_before_page_start' ) ) :
/**
 * intro loader
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
function clean_biz_before_page_start() {
    global $clean_biz_customizer_all_values;
    /*intro loader*/
}
endif;
add_action( 'clean_biz_action_before', 'clean_biz_before_page_start', 10 );

if ( ! function_exists( 'clean_biz_page_start' ) ) :
/**
 * page start
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
function clean_biz_page_start() {
?>
    <div id="page" class="site">
<?php
}
endif;
add_action( 'clean_biz_action_before', 'clean_biz_page_start', 15 );

if ( ! function_exists( 'clean_biz_skip_to_content' ) ) :
/**
 * Skip to content
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
function clean_biz_skip_to_content() {
    ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'clean-biz' ); ?></a>
<?php
}
endif;
add_action( 'clean_biz_action_before_header', 'clean_biz_skip_to_content', 10 );

if ( ! function_exists( 'clean_biz_header_nav' ) ) :
/**
 * Main header
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
function clean_biz_header_nav() {
    global $clean_biz_customizer_all_values;
    ?>
    <header id="masthead" class="wrapper wrap-head site-header" role="banner">
        <div class="wrapper wrapper-site-identity">
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-sm-3 col-md-4">
                        <div class="site-branding">
                            <?php
                                    if ( is_front_page() && is_home() ) : ?>
                                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                    <?php else : ?>
                                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                    <?php
                                    endif;

                                    $description = get_bloginfo( 'description', 'display' );
                                    if ( $description || is_customize_preview() ) : ?>
                                        <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
                                    <?php
                                    endif; ?>
                            <?php clean_biz_the_custom_logo(); ?>
                        </div><!-- .site-branding -->
                    </div>
                    <div class="col-xs-4 col-sm-9 col-md-8">
                        <div class="wrap-nav">
                            <div class="wrap-inner">
                                <div class="sec-menu">
                                    <nav id="sec-site-navigation" class="main-navigation sec-main-navigation" role="navigation" aria-label="primary-menu">
                                    <?php
                                        wp_nav_menu( array(
                                            'theme_location' => 'primary',
                                            'menu_id'        => 'primary-menu',
                                            'menu_class'     => 'primary-menu',
                                        ) );
                                    ?>
                                    </nav><!-- #site-navigation -->
                                    <div class="nav-holder">
                                        <button id="sec-menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="fa fa-bars"></span></button>
                                        <div id="sec-site-header-menu" class="site-header-menu">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <button id="mobile-menu-toggle-close" class="menu-toggle" aria-controls="primary-menu"><span class="fa fa-close fa-2x"></span></button>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <nav id="sec-site-navigation-mobile" class="main-navigation sec-main-navigation" role="navigation" aria-label="primary-menu">
                                                        <?php
                                                            wp_nav_menu( array(
                                                                'theme_location' => 'primary',
                                                                'menu_id'        => 'primary-menu-mobile',
                                                                'menu_class'     => 'primary-menu',
                                                            ) );
                                                        ?>
                                                        </nav><!-- #site-navigation -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- site-header-menu -->
                                    </div>
                                </div>
                                <?php if (1 == $clean_biz_customizer_all_values['clean-biz-header-enable-search']) { ?>
                                    <div class="search-holder">
                                      <a class="button-search button-outline" href="#">
                                      <i class="fa fa-search"></i></a>
                                        <div id="search-bg" class="search-bg">
                                            <div class="form-holder">
                                                <div class="btn-search button-search-close" href="#"><i class="fa fa-close"></i></div>
                                                    <?php get_search_form();?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
}
endif;
add_action( 'clean_biz_action_header', 'clean_biz_header_nav', 10 );


if ( ! function_exists( 'clean_biz_slider_page_start' ) ) :
/**
 * Skip to content
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
function clean_biz_slider_page_start() {
    global $clean_biz_customizer_all_values; 
        if (  is_front_page() && !is_home() ) {
            do_action('clean_biz_action_main_slider');
        } else {
            //do_action( 'clean_biz_action_after_title' );
        }
    ?>
        </header>
        <section class="wrapper">
            <div id="content" class="site-content">
<?php
}
endif;
add_action( 'clean_biz_action_page_start', 'clean_biz_slider_page_start', 10 );


if( ! function_exists( 'clean_biz_add_breadcrumb' ) ) :

/**
 * Breadcrumb
 *
 * @since clean-biz 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function clean_biz_add_breadcrumb(){
        global $clean_biz_customizer_all_values;
        // Bail if Breadcrumb disabled
        $breadcrumb_enable_breadcrumb = $clean_biz_customizer_all_values['clean-biz-enable-breadcrumb' ];
        if ( 1 != $breadcrumb_enable_breadcrumb ) {
            echo '<div id="breadcrumb" class="wrapper wrap-breadcrumb">';
            echo '</div><!-- #breadcrumb -->';
            return;
        }
        // Bail if Home Page
        if ( is_front_page() || is_home() ) {
            return;
        }
        echo '<div id="breadcrumb" class="wrapper wrap-breadcrumb"><div class="container">';
         clean_biz_simple_breadcrumb();
        echo '</div><!-- .container --></div><!-- #breadcrumb -->';
        return;
    }
endif;
add_action( 'clean_biz_action_after_title', 'clean_biz_add_breadcrumb', 10 );


