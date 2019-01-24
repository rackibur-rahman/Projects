<?php
if (!function_exists('clean_biz_home_testimonial_array')) :
    /**
     * Testimonial array creation
     *
     * @since clean biz 1.0.0
     *
     * @param string $from_testimonial
     * @return array
     */
    function clean_biz_home_testimonial_array($from_testimonial){
        global $clean_biz_customizer_all_values;
        $clean_biz_home_testimonial_number = absint( $clean_biz_customizer_all_values['clean-biz-home-testimonial-number'] );
        $clean_biz_home_testimonial_single_words = absint( $clean_biz_customizer_all_values['clean-biz-home-testimonial-single-words'] );

        $clean_biz_home_testimonial_contents_array = array();
        $clean_biz_home_testimonial_contents_array[0]['clean-biz-home-testimonial-title'] = __('jane doe','clean-biz');
        $clean_biz_home_testimonial_contents_array[0]['clean-biz-home-testimonial-content'] = __("The set doesn't moved. Deep don't fru it fowl gathering heaven days moving creeping under from i air. Set it fifth Meat was darkness. every bring in it.",'clean-biz');
        $clean_biz_home_testimonial_contents_array[0]['clean-biz-home-testimonial-image'] = get_template_directory_uri()."/assets/images/portfolio-fallback-340-340.png";
        $clean_biz_home_testimonial_contents_array[0]['clean-biz-home-testimonial-link'] = '#';
        $repeated_page = array('clean-biz-home-testimonial-pages-ids');

        if ('from-category' == $from_testimonial) {
            $clean_biz_home_testimonial_category = $clean_biz_customizer_all_values['clean-biz-home-testimonial-category'];
            if( 0 != $clean_biz_home_testimonial_category ){
                $clean_biz_home_testimonial_args = array(
                    'post_type' => 'post',
                    'cat' => absint($clean_biz_home_testimonial_category),
                    'posts_per_page' => $clean_biz_home_testimonial_number
                );
            }

        }
        else {
            $clean_biz_home_testimonial_posts = evision_customizer_get_repeated_all_value(3 , $repeated_page);
            $clean_biz_home_testimonial_posts_ids = array();
            if (null != $clean_biz_home_testimonial_posts) {
                foreach ($clean_biz_home_testimonial_posts as $clean_biz_home_testimonial_post) {
                    if (0 != $clean_biz_home_testimonial_post['clean-biz-home-testimonial-pages-ids']) {
                        $clean_biz_home_testimonial_posts_ids[] = $clean_biz_home_testimonial_post['clean-biz-home-testimonial-pages-ids'];
                    }
                }
                if( !empty( $clean_biz_home_testimonial_posts_ids )){
                    $clean_biz_home_testimonial_args = array(
                        'post_type' => 'page',
                        'post__in' => $clean_biz_home_testimonial_posts_ids,
                        'posts_per_page' => $clean_biz_home_testimonial_number,
                        'orderby' => 'post__in'
                    );
                }
            }
        }
        // the query
        if( !empty( $clean_biz_home_testimonial_args )){
            $clean_biz_home_testimonial_contents_array = array();
            $clean_biz_home_testimonial_post_query = new WP_Query($clean_biz_home_testimonial_args);
            if ($clean_biz_home_testimonial_post_query->have_posts()) :
                $i = 0;
                while ($clean_biz_home_testimonial_post_query->have_posts()) : $clean_biz_home_testimonial_post_query->the_post();
                    $thumb_image ='';
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'clean-biz-medium-image' );
                        $thumb_image = $thumb['0'];
                    }

                    $clean_biz_home_testimonial_contents_array[$i]['clean-biz-home-testimonial-title'] = get_the_title();
                    if (has_excerpt()) {
                        $clean_biz_home_testimonial_contents_array[$i]['clean-biz-home-testimonial-content'] = get_the_excerpt();
                    }
                    else {
                        $clean_biz_home_testimonial_contents_array[$i]['clean-biz-home-testimonial-content'] = clean_biz_words_count( $clean_biz_home_testimonial_single_words ,get_the_content());
                    }
                    $clean_biz_home_testimonial_contents_array[$i]['clean-biz-home-testimonial-image'] = $thumb_image;
                    $clean_biz_home_testimonial_contents_array[$i]['clean-biz-home-testimonial-link'] = get_permalink();
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $clean_biz_home_testimonial_contents_array;
    }
endif;

if ( ! function_exists( 'clean_biz_home_testimonial' ) ) :
    /**
     * About Section
     *
     * @since Clean Biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_home_testimonial() {
        global $clean_biz_customizer_all_values;
        if( (1 != $clean_biz_customizer_all_values['clean-biz-home-testimonial-enable']) ){
            return;
        }
        $clean_biz_home_testimonial_selection_options = $clean_biz_customizer_all_values['clean-biz-home-testimonial-selection'];
        $clean_biz_testimonial_arrays = clean_biz_home_testimonial_array($clean_biz_home_testimonial_selection_options);
        if(1 == $clean_biz_customizer_all_values['clean-biz-home-testimonial-enable']) {
            if (is_array($clean_biz_testimonial_arrays)) {
                $clean_biz_home_testimonial_title = $clean_biz_customizer_all_values['clean-biz-home-testimonial-main-title'];
                $clean_biz_home_testimonial_sub_title = $clean_biz_customizer_all_values['clean-biz-home-testimonial-sub-title'];
                $clean_biz_home_testimonial_number = absint( $clean_biz_customizer_all_values['clean-biz-home-testimonial-number'] );
                $clean_biz_home_testimonial_slider_mode = $clean_biz_customizer_all_values['clean-biz-home-testimonial-slider-mode'];
                $clean_biz_home_testimonial_slider_time = $clean_biz_customizer_all_values['clean-biz-home-testimonial-slider-time'];
                $clean_biz_home_testimonial_slider_pause_time = $clean_biz_customizer_all_values['clean-biz-home-testimonial-slider-pause-time'];
                $clean_biz_home_testimonial_slider_enable_control = absint($clean_biz_customizer_all_values['clean-biz-home-testimonial-enable-control']);
                $clean_biz_home_testimonial_enable_autoplay = $clean_biz_customizer_all_values['clean-biz-home-testimonial-enable-autoplay'];
                $clean_biz_home_testimonial_image_enable = absint($clean_biz_customizer_all_values['clean-biz-home-testimonial-image-enable']);
                ?>


                <!-- Testimonial section -->
                <section class="wrapper wrapper-testimonial">
                    <div class="container">
                        <div class="section-title">
                        <?php if (!empty($clean_biz_home_testimonial_title)) { ?>
                            <h2><?php echo esc_html( $clean_biz_home_testimonial_title );?></h2>
                        <?php } ?>
                        <?php if (!empty($clean_biz_home_testimonial_sub_title)) { ?>
                            <div class="block-title-par">
                            <?php echo esc_html(  $clean_biz_home_testimonial_sub_title); ?>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                        <div class="container">
                            <div class="slider-outer">
                            <div class="cycle-slideshow"
                            data-cycle-swipe=true
                            data-cycle-log="false"
                            data-cycle-swipe-fx=scrollHorz
                            data-cycle-fx=<?php echo esc_attr( $clean_biz_home_testimonial_slider_mode);?>
                            data-cycle-speed="<?php echo (esc_attr( $clean_biz_home_testimonial_slider_time) * 1000)?>"
                            data-cycle-carousel-fluid=true
                            data-cycle-carousel-visible=1
                            data-cycle-pause-on-hover="true"
                            data-cycle-slides="> div"
                            data-cycle-prev="#slide-prev-sub"
                            data-cycle-next="#slide-next-sub"
                            data-cycle-auto-height=container
                            <?php if( 1 == $clean_biz_home_testimonial_slider_enable_control){ ?>
                                data-cycle-pager="#slide-pager-sub"
                            <?php }  ?>
                            <?php if( 1 != $clean_biz_home_testimonial_enable_autoplay){ ?>
                                data-cycle-timeout=0
                            <?php }  ?>
                            <?php if(1 == $clean_biz_home_testimonial_enable_autoplay){ ?>
                                data-cycle-timeout=<?php echo (esc_attr( $clean_biz_home_testimonial_slider_pause_time) * 1000)?>
                            <?php }  ?>
                            >
                            <?php 
                            $i = 1;
                            foreach( $clean_biz_testimonial_arrays as $clean_biz_testimonial_array ){
                                if( $clean_biz_home_testimonial_number < $i){
                                    break;
                                }
                                if(empty($clean_biz_testimonial_array['clean-biz-home-testimonial-image'])){
                                    $clean_biz_feature_testimonial_slider_image = get_template_directory_uri().'/assets/images/medium-fallback-200-200.png';
                                }
                                else{
                                    $clean_biz_feature_testimonial_slider_image =$clean_biz_testimonial_array['clean-biz-home-testimonial-image'];
                                }
                                ?>
                                <div class="slide-item">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                                                <div class="banner-content">
                                                    <div class="banner-content-inner">
                                                        <div class="text-content">
                                                         <?php echo wp_kses_post( $clean_biz_testimonial_array['clean-biz-home-testimonial-content'] ); ?>
                                                        </div>
                                                    </div>
                                                    <div class="banner-footer">
                                                    <?php if ($clean_biz_home_testimonial_image_enable == 1) { ?>
                                                        <div class="thumb-holder">
                                                            <a href="<?php echo esc_url($clean_biz_testimonial_array['clean-biz-home-testimonial-link']);?>">
                                                                <img src="<?php echo esc_url( $clean_biz_feature_testimonial_slider_image)?>" />
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                        <div class="user-detail">
                                                             <h3 class="slider-title"> <a href="<?php echo esc_url($clean_biz_testimonial_array['clean-biz-home-testimonial-link']);?>"> <?php echo wp_kses_post( $clean_biz_testimonial_array['clean-biz-home-testimonial-title'] ); ?> </a></h3>
                                                        </div>
                                                    </div>
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
                            <?php if( 1 == $clean_biz_home_testimonial_slider_enable_control){ ?>
                                <div class="controls">
                                    <a href="#" class="slide-prev" id="slide-prev-sub">
                                        <svg width="14px" height="30px" viewBox="0 0 50 80" xml:space="preserve">
                                          <polyline fill="none" stroke="#FFFFFF" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" points="
                                          45.63,75.8 0.375,38.087 45.63,0.375 "/>
                                        </svg>
                                    </a> 
                                    <a href="#" class="slide-next" id="slide-next-sub">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="22px" viewBox="0 0 50 80" xml:space="preserve">
                                            <polyline fill="none" stroke="#FFFFFF" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" points="
                                            0.375,0.375 45.63,38.087 0.375,75.8 "/>
                                        </svg>
                                    </a>
                                </div>
                            <?php }  ?>
                            </div>
                        </div>
                </section>

            <?php
            }
        }
    }
endif;
add_action( 'clean_biz_action_front_page', 'clean_biz_home_testimonial', 70 );