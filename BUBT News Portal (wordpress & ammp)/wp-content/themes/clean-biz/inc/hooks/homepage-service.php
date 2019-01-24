<?php
if ( ! function_exists( 'clean_biz_home_service_array' ) ) :
    /**
     * Service Section array creation
     *
     * @since clean biz 1.0.0
     *
     * @param string $from_service
     * @return array
     */
    function clean_biz_home_service_array( $from_service ){
        global $clean_biz_customizer_all_values;
        $clean_biz_home_service_number = absint($clean_biz_customizer_all_values['clean-biz-home-service-number']);
        $clean_biz_home_service_single_words = absint($clean_biz_customizer_all_values['clean-biz-home-service-single-words']);
        $clean_biz_icons_array = array('clean-biz-home-service-page-icon');
        $clean_biz_home_service_page = array('clean-biz-home-service-pages-ids');
        $clean_biz_home_service_contents_array = array();
        $clean_biz_icons_arrays = evision_customizer_get_repeated_all_value(6 , $clean_biz_icons_array);

        if ( 'from-category' ==  $from_service ){
            $clean_biz_home_service_category = $clean_biz_customizer_all_values['clean-biz-home-service-category'];
            if( 0 != $clean_biz_home_service_category ){
                $clean_biz_home_service_args =    array(
                    'post_type' => 'post',
                    'cat' => absint($clean_biz_home_service_category),
                    'posts_per_page' => $clean_biz_home_service_number
                );
            }
        }else {
                $clean_biz_home_service_posts = evision_customizer_get_repeated_all_value(6 , $clean_biz_home_service_page);
                $clean_biz_home_service_posts_ids = array();
                if( null != $clean_biz_home_service_posts ) {
                    foreach( $clean_biz_home_service_posts as $clean_biz_home_service_post ) {
                        if( 0 != $clean_biz_home_service_post['clean-biz-home-service-pages-ids'] ){
                            $clean_biz_home_service_posts_ids[] = $clean_biz_home_service_post['clean-biz-home-service-pages-ids'];
                        }
                    }
                    if( !empty( $clean_biz_home_service_posts_ids )){
                        $clean_biz_home_service_args =    array(
                            'post_type' => 'page',
                            'post__in' => $clean_biz_home_service_posts_ids,
                            'posts_per_page' => $clean_biz_home_service_number,
                            'orderby' => 'post__in'
                        );
                    }
                }
            }
        // the query
        if( !empty( $clean_biz_home_service_args )){

            $clean_biz_home_service_contents_array = array(); /*again empty array*/
            $clean_biz_home_service_post_query = new WP_Query( $clean_biz_home_service_args );
            if ( $clean_biz_home_service_post_query->have_posts() ) :
                $i = 1;
                while ( $clean_biz_home_service_post_query->have_posts() ) : $clean_biz_home_service_post_query->the_post();
                    $clean_biz_home_service_contents_array[$i]['clean-biz-home-service-title'] = get_the_title();
                    if (has_excerpt()) {
                        $clean_biz_home_service_contents_array[$i]['clean-biz-home-service-content'] = get_the_excerpt();
                    }
                    else {
                        $clean_biz_home_service_contents_array[$i]['clean-biz-home-service-content'] = clean_biz_words_count( $clean_biz_home_service_single_words ,get_the_content());
                    }
                    $clean_biz_home_service_contents_array[$i]['clean-biz-home-service-link'] = get_permalink();
                    if(isset( $clean_biz_icons_arrays[$i] )){
                        $clean_biz_home_service_contents_array[$i]['clean-biz-home-service-page-icon'] = $clean_biz_icons_arrays[$i]['clean-biz-home-service-page-icon'];
                    }
                    else{
                        $clean_biz_home_service_contents_array[$i]['clean-biz-home-service-page-icon'] = 'fa-magic';
                    }

                    $url ='';
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'clean-biz-costume-medium' );
                        $url = $thumb['0'];
                    }
                    else{
                      $url = NULL;
                    }
                    $clean_biz_home_service_contents_array[$i]['clean-biz-home-service-page-image'] = $url;

                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $clean_biz_home_service_contents_array;
    }
endif;

if ( ! function_exists( 'clean_biz_home_service' ) ) :
    /**
     * Service Section
     *
     * @since clean-biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_home_service() {
        global $clean_biz_customizer_all_values;
        if( 1 != $clean_biz_customizer_all_values['clean-biz-home-service-enable'] ){
            return null;
        }
        $clean_biz_home_service_selection_options = $clean_biz_customizer_all_values['clean-biz-home-service-selection'];
        $clean_biz_service_arrays = clean_biz_home_service_array( $clean_biz_home_service_selection_options );
        if( is_array( $clean_biz_service_arrays )){
            $clean_biz_home_service_number = absint($clean_biz_customizer_all_values['clean-biz-home-service-number']);
            $clean_biz_home_service_title = $clean_biz_customizer_all_values['clean-biz-home-service-title'];
            $clean_biz_home_service_sub_title = $clean_biz_customizer_all_values['clean-biz-home-service-sub-title'];
            $clean_biz_home_service_button_text = $clean_biz_customizer_all_values['clean-biz-home-service-button-text'];
            $clean_biz_home_service_button_link = $clean_biz_customizer_all_values['clean-biz-home-service-button-link'];
            $clean_biz_home_service_enable_single_link = $clean_biz_customizer_all_values['clean-biz-home-service-enable-single-link'];
            ?>

            <!-- Features section -->
            <section id="features" class="wrapper wrapper-features">
                <div class="container">
                    <div class="section-title">
                       <?php if(!empty( $clean_biz_home_service_title ) ){ ?>
                           <h2><?php echo esc_html(  $clean_biz_home_service_title); ?></h2>
                       <?php } ?>
                       <?php if(!empty( $clean_biz_home_service_sub_title ) ){ ?>
                        <div class="block-title-par">
                            <?php echo esc_html( $clean_biz_home_service_sub_title );?>
                        </div>
                       <?php } ?>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                    <?php 
                    $i = 1;
                    $data_delay = 0;
                    foreach( $clean_biz_service_arrays as $clean_biz_service_array ){
                        if( $clean_biz_home_service_number < $i){
                            break;
                        }
                        ?>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <div class="single-icon">
                                    
                                    <a <?php if( 1 == $clean_biz_home_service_enable_single_link ){ ?> href="<?php echo esc_url( $clean_biz_service_array['clean-biz-home-service-link'] );?>" <?php } ?>>
                                        
                                        <div class="icon-holder">
                                            <i class="fa <?php echo esc_attr( $clean_biz_service_array['clean-biz-home-service-page-icon'] ); ?>"></i>
                                        </div>
                                        <div class="content-area">
                                            <h2><?php echo esc_html( $clean_biz_service_array['clean-biz-home-service-title'] );?></h2>
                                        </div>
                                        <div class="hover-content">
                                            <div class="icon-holder">
                                                <i class="fa <?php echo esc_attr( $clean_biz_service_array['clean-biz-home-service-page-icon'] ); ?>"></i>
                                            </div>
                                            <div class="content-area">
                                                <h2><?php echo esc_html( $clean_biz_service_array['clean-biz-home-service-title'] );?></h2>
                                            </div>
                                            <div class="content-text"> <?php echo wp_kses_post( $clean_biz_service_array['clean-biz-home-service-content'] );?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php 
                            if( $i % 4 == 0 ){
                                echo "<div class='clear'></div>";
                            }
                        $i++;
                    }
                    ?>
                    <?php
                    if( !empty( $clean_biz_home_service_button_link ) && !empty( $clean_biz_home_service_button_text ) ){
                        ?>
                        <div class="btn-holder">
                            <a class="button" href="<?php echo esc_url( $clean_biz_home_service_button_link );?>">
                                <?php echo esc_html( $clean_biz_home_service_button_text );?>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </section>
            <!-- service section -->
            <?php
        }
    }
endif;
add_action( 'clean_biz_action_front_page', 'clean_biz_home_service', 20);