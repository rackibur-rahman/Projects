<?php
if ( ! function_exists( 'clean_biz_slider_array' ) ) :
    /**
     * Featured Slider array creation
     *
     * @since clean-biz 1.0.0
     *
     * @param string $from_slider
     * @return array
     */
    function clean_biz_slider_array( $from_slider ){
        global $clean_biz_customizer_all_values;
        $clean_biz_feature_slider_number = absint( $clean_biz_customizer_all_values['clean-biz-featured-slider-number'] );
        $clean_biz_feature_slider_single_words = absint( $clean_biz_customizer_all_values['clean-biz-slider-single-words'] );
        $repeated_page = array('clean-biz-fs-pages-ids');
        $clean_biz_feature_slider_args = array();
        $clean_biz_feature_slider_contents_array = array();

        if ( 'from-category' ==  $from_slider ){
            $clean_biz_feature_slider_category = $clean_biz_customizer_all_values['clean-biz-featured-slider-category'];
            if( 0 != $clean_biz_feature_slider_category ){
                $clean_biz_feature_slider_args =    array(
                    'post_type' => 'post',
                    'cat' => absint($clean_biz_feature_slider_category),
                    'ignore_sticky_posts' => true
                );
            }
        }
        else{
            $clean_biz_feature_slider_posts = evision_customizer_get_repeated_all_value(3 , $repeated_page);
            $clean_biz_feature_slider_posts_ids = array();
            if( null != $clean_biz_feature_slider_posts ) {
                foreach( $clean_biz_feature_slider_posts as $clean_biz_feature_slider_post ) {
                    if( 0 != $clean_biz_feature_slider_post['clean-biz-fs-pages-ids'] ){
                        $clean_biz_feature_section_posts_ids[] = $clean_biz_feature_slider_post['clean-biz-fs-pages-ids'];
                    }
                }

                if( !empty( $clean_biz_feature_section_posts_ids )){
                    $clean_biz_feature_slider_args =    array(
                        'post_type' => 'page',
                        'post__in' => $clean_biz_feature_section_posts_ids,
                        'posts_per_page' => $clean_biz_feature_slider_number,
                        'orderby' => 'post__in'
                    );
                }

            }
        }
        if( !empty( $clean_biz_feature_slider_args )){
            // the query
            $clean_biz_fature_section_post_query = new WP_Query( $clean_biz_feature_slider_args );

            if ( $clean_biz_fature_section_post_query->have_posts() ) :
                $i = 0;
                while ( $clean_biz_fature_section_post_query->have_posts() ) : $clean_biz_fature_section_post_query->the_post();
                    $url ='';
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        $url = $thumb['0'];
                    }
                    $clean_biz_feature_slider_contents_array[$i]['clean-biz-feature-slider-title'] = get_the_title();
                    if (has_excerpt()) {
                        $clean_biz_feature_slider_contents_array[$i]['clean-biz-feature-slider-content'] = get_the_excerpt();
                    }
                    else {
                        $clean_biz_feature_slider_contents_array[$i]['clean-biz-feature-slider-content'] = clean_biz_words_count( $clean_biz_feature_slider_single_words ,get_the_content());
                    }
                    $clean_biz_feature_slider_contents_array[$i]['clean-biz-feature-slider-link'] = get_permalink();
                    $clean_biz_feature_slider_contents_array[$i]['clean-biz-feature-slider-image'] = $url;
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $clean_biz_feature_slider_contents_array;
    }
endif;

if ( ! function_exists( 'clean_biz_featured_home_slider' ) ) :
    /**
     * Featured Slider
     *
     * @since Clean Biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_featured_home_slider() {
        global $clean_biz_customizer_all_values;

        if( 1 != $clean_biz_customizer_all_values['clean-biz-feature-slider-enable'] ){
            return null;
        }
        $clean_biz_feature_slider_selection_options = $clean_biz_customizer_all_values['clean-biz-featured-slider-selection'];
        $clean_biz_slider_arrays = clean_biz_slider_array( $clean_biz_feature_slider_selection_options );


        if( is_array( $clean_biz_slider_arrays )){
        $clean_biz_feature_slider_number = absint( $clean_biz_customizer_all_values['clean-biz-featured-slider-number'] );
        $clean_biz_feature_slider_mode = $clean_biz_customizer_all_values['clean-biz-slider-slider-mode'];
        $clean_biz_feature_slider_time = $clean_biz_customizer_all_values['clean-biz-slider-slider-time'];
        $clean_biz_feature_slider_pause_time = $clean_biz_customizer_all_values['clean-biz-slider-slider-pause-time'];
        $clean_biz_feature_enable_arrow = $clean_biz_customizer_all_values['clean-biz-slider-enable-arrow'];
        $clean_biz_feature_enable_pager = $clean_biz_customizer_all_values['clean-biz-slider-enable-pager'];
        $clean_biz_feature_enable_autoplay = $clean_biz_customizer_all_values['clean-biz-slider-enable-autoplay'];
        $clean_biz_feature_enable_title = $clean_biz_customizer_all_values['clean-biz-slider-enable-title'];
        $clean_biz_feature_enable_caption = $clean_biz_customizer_all_values['clean-biz-slider-enable-caption'];
        $clean_biz_feature_button_text = $clean_biz_customizer_all_values['clean-biz-slider-button-text'];

    ?>
    <!-- slider area -->
    <section class="wrapper-slider-section">
        <div class="wrapper wrapper-slider">
            <?php if( 1 == $clean_biz_feature_enable_arrow){ ?>
                <div class="controls">
                    <a href="#" id="slide-prev">
                      <svg width="60px" height="80px" viewBox="0 0 50 80" xml:space="preserve">
                        <polyline fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" points="
                        45.63,75.8 0.375,38.087 45.63,0.375 "/>
                      </svg>
                    </a> 
                    <a href="#" id="slide-next">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60px" height="80px" viewBox="0 0 50 80" xml:space="preserve">
                            <polyline fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" points="
                            0.375,0.375 45.63,38.087 0.375,75.8 "/>
                          </svg>
                    </a>
                </div>
            <?php }  ?>

            <div id="cycle-slideshow" class="cycle-slideshow" data-cycle-auto-height="container"
                data-cycle-log="false"
                data-cycle-fx=<?php echo esc_attr( $clean_biz_feature_slider_mode);?>
                data-cycle-speed="<?php echo (absint( $clean_biz_feature_slider_time) * 1000)?>"
                data-cycle-carousel-fluid=true
                data-cycle-carousel-visible=1
                data-cycle-pause-on-hover="true"
                data-cycle-slides="> div"
                data-cycle-prev="#slide-prev"
                data-cycle-next="#slide-next"
                data-cycle-auto-height=container
                data-cycle-swipe=true
                data-cycle-swipe-fx=scrollHorz
                <?php if( 1 == $clean_biz_feature_enable_pager){ ?>
                    data-cycle-pager="#slide-pager"
                <?php }  ?>
                <?php if( 1 != $clean_biz_feature_enable_autoplay){ ?>
                    data-cycle-timeout=0
                <?php }  ?>
                <?php if(1 == $clean_biz_feature_enable_autoplay){ ?>
                    data-cycle-timeout=<?php echo (absint( $clean_biz_feature_slider_pause_time) * 1000)?>
                <?php }  ?>
                >
                <?php
                $i = 1;
                foreach( $clean_biz_slider_arrays as $clean_biz_slider_array ){
                    if( $clean_biz_feature_slider_number < $i){
                        break;
                    }
                    if(empty($clean_biz_slider_array['clean-biz-feature-slider-image'])){
                        $clean_biz_feature_slider_image = get_template_directory_uri().'/assets/images/banner-fallback-1340-560.png';
                    }
                    else{
                        $clean_biz_feature_slider_image =$clean_biz_slider_array['clean-biz-feature-slider-image'];
                    }
                    ?>
                    <div class="slide-item" style="background-image: url('<?php echo esc_url( $clean_biz_feature_slider_image )?>');">
                        <div class="thumb-overlay main-slider-overlay"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-10 col-sm-10 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-2 banner-content">
                                    <div class="banner-content-inner">
                                    <?php if ((1 == $clean_biz_feature_enable_title) || (1 == $clean_biz_feature_enable_caption)){?>
                                        <div class="banner-content-inner">
                                            <?php if( 1 == $clean_biz_feature_enable_title) {
                                                ?>
                                                    <h2 class="banner-title alt-title"><a href="<?php echo esc_url( $clean_biz_slider_array['clean-biz-feature-slider-link'] );?>"><?php echo esc_html( $clean_biz_slider_array['clean-biz-feature-slider-title'] );?></a></h2>
                                                <?php
                                            }
                                            if( 1 == $clean_biz_feature_enable_caption){
                                                ?>
                                                <div class="text-content">
                                                    <?php echo wp_kses_post( $clean_biz_slider_array['clean-biz-feature-slider-content'] );?>
                                                </div>
                                                <?php if (!empty($clean_biz_feature_button_text)) { ?>
                                                    <div class="btn-holder">
                                                        <a href="<?php echo esc_url( $clean_biz_slider_array['clean-biz-feature-slider-link'] );?>" class="button"><?php echo esc_html($clean_biz_feature_button_text); ?></a>
                                                    </div>
                                                <?php } ?>
                                                <?php
                                            }?>      
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                $i++;
                }
                ?>
            </div>
            <div class="cycle-pager" id="slide-pager"></div>
            <?php if( 1 == $clean_biz_customizer_all_values['clean-biz-home-service-enable'] ){ ?>
                <div id="go-bottom">
                    <a href="#features">
                        <svg width="60px" height="80px" viewBox="0 0 50 80" xml:space="preserve">
                        <polyline fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" points="
                        45.63,75.8 0.375,38.087 45.63,0.375 "/>
                      </svg>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>
    <?php
    }
    }
endif;
add_action( 'clean_biz_action_main_slider', 'clean_biz_featured_home_slider', 10 );