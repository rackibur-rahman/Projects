<?php
if ( ! function_exists( 'clean_biz_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since clean-biz 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function clean_biz_before_footer() {
    ?>
        </div><!-- #content -->
    </section>
    <?php
    }
endif;
add_action( 'clean_biz_action_before_footer', 'clean_biz_before_footer', 10 );

if ( ! function_exists( 'clean_biz_widget_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since clean-biz 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function clean_biz_widget_before_footer() {
        global $clean_biz_customizer_all_values;
        $clean_biz_footer_widgets_number = $clean_biz_customizer_all_values['clean-biz-footer-sidebar-number'];
        if( !is_active_sidebar( 'footer-col-one' ) && !is_active_sidebar( 'footer-col-two' ) && !is_active_sidebar( 'footer-col-three' ) && !is_active_sidebar( 'footer-col-four' )){
            return false;
        }
        if( 1 == $clean_biz_footer_widgets_number ){
                $col = 'col-xs-12 col-sm-12 col-md-12';
            }
        elseif( 2 == $clean_biz_footer_widgets_number ){
            $col = 'col-xs-12 col-sm-6 col-md-6';
        }
        elseif( 3 == $clean_biz_footer_widgets_number ){
            $col = 'col-xs-12 col-sm-4 col-md-4';
        }
        else{
            $col = 'col-xs-12 col-sm-6 col-md-3';
        }
        ?>
        <!-- footer widget -->
        <section class="wrapper footer-widgetsection">
            <div class="container">
                <div class="row">
                    <?php if( is_active_sidebar( 'footer-col-one' ) && $clean_biz_footer_widgets_number > 0 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-one' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-two' ) && $clean_biz_footer_widgets_number > 1 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-two' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-three' ) && $clean_biz_footer_widgets_number > 2 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-three' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( is_active_sidebar( 'footer-col-four' ) && $clean_biz_footer_widgets_number > 3 ) : ?>
                        <div class="contact-list <?php echo esc_attr( $col );?>">
                            <?php dynamic_sidebar( 'footer-col-four' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <div class="clear"></div>
    <?php
    }
endif;
add_action( 'clean_biz_action_widget_before_footer', 'clean_biz_widget_before_footer', 10 );

if ( ! function_exists( 'clean_biz_footer' ) ) :
    /**
     * Footer content
     *
     * @since clean-biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_footer() {
        global $clean_biz_customizer_all_values;
        ?> 
        <!-- footer site info -->
        <footer id="colophon" class="wrapper site-footer" role="contentinfo">
            <div class="site-info">
                <div class="container">
                    <div class="row">
                        <div class="xs-12 col-sm-6 col-md-6">
                            <div class="copyright">
                                <?php
                                if(isset($clean_biz_customizer_all_values['clean-biz-copyright-text'])){
                                    echo wp_kses_post( $clean_biz_customizer_all_values['clean-biz-copyright-text'] );
                                }
                                ?>
                                <?php
                                 if( 1 == $clean_biz_customizer_all_values['clean-biz-enable-theme-name']){
                                    ?>
                                    <span class="sep"> | </span>
                                    <?php printf( esc_html__( 'Theme: %1$s by %2$s', 'clean-biz' ), 'Clean Biz', '<a href="http://evisionthemes.com/" target = "_blank" rel="designer">eVisionThemes </a>' ); ?>
                                    <?php
                                }
                                ?>
                            </div><!-- .site-info -->
                        </div>
                        <?php if (has_nav_menu('social')) { ?>
                            <div class="xs-12 col-sm-6 col-md-6">
                                <div class="evision-social-section">
                                    <?php
                                        wp_nav_menu( array(
                                            'theme_location' => 'social',
                                            'menu_id'        => 'social-menu',
                                            'menu_class'     => 'social-menu',
                                        ) );
                                    ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div> <!-- .site-info -->
        </footer><!-- #colophon -->     
    </div><!-- #page -->
    <?php
    }
endif;
add_action( 'clean_biz_action_footer', 'clean_biz_footer', 10 );

if ( ! function_exists( 'clean_biz_page_end' ) ) :
    /**
     * Page end
     *
     * @since clean-biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_page_end() {
    global $clean_biz_customizer_all_values;
        ?>
    <?php
     if( 1 == $clean_biz_customizer_all_values['clean-biz-enable-back-to-top']) {
        ?>
            <span id="gotop" class="evision-back-to-top"><i class="fa fa-arrow-up"></i></span>
        <?php
        } ?>
    </div><!-- #page -->
    <?php }
endif;
add_action( 'clean_biz_action_after', 'clean_biz_page_end', 10 );