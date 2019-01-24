<?php
if ( ! function_exists( 'clean_biz_home_team_array' ) ) :
    /**
     * Team section array creation
     *
     * @since clean biz 1.0.0
     *
     * @param string $from_team
     * @return array
     */
    function clean_biz_home_team_array( $from_team ){
        global $clean_biz_customizer_all_values;
        $clean_biz_home_team_number = absint($clean_biz_customizer_all_values['clean-biz-home-team-number']);
        $clean_biz_home_team_contents_array = array();
        $repeated_page = array('clean-biz-home-team-pages-ids');
        $clean_biz_home_team_args = array();
        if ( 'from-category' ==  $from_team ){
            $clean_biz_home_team_category = $clean_biz_customizer_all_values['clean-biz-home-team-category'];
            if( $clean_biz_home_team_category  > 0 ){
                $clean_biz_home_team_args =    array(
                    'post_type' => 'post',
                    'posts_per_page' => $clean_biz_home_team_number,
                    'cat' => absint($clean_biz_home_team_category),
                );
            }
        }else {
                $clean_biz_home_team_posts = evision_customizer_get_repeated_all_value(4 , $repeated_page);
                $clean_biz_home_team_posts_ids = array();
                if( null != $clean_biz_home_team_posts ) {
                    foreach( $clean_biz_home_team_posts as $clean_biz_home_team_post ) {
                        if( $clean_biz_home_team_post['clean-biz-home-team-pages-ids']  > 0 ){
                            $clean_biz_home_team_posts_ids[] = $clean_biz_home_team_post['clean-biz-home-team-pages-ids'];
                        }
                    }
                    if( !empty( $clean_biz_home_team_posts_ids )){
                        $clean_biz_home_team_args =    array(
                            'post_type' => 'page',
                            'post__in' => $clean_biz_home_team_posts_ids,
                            'posts_per_page' => $clean_biz_home_team_number,
                            'orderby' => 'post__in'
                        );
                    }
                }
            }
        // the query
        if( !empty( $clean_biz_home_team_args )){

            $clean_biz_home_team_contents_array = array(); /*again empty array*/
            $clean_biz_home_team_post_query = new WP_Query( $clean_biz_home_team_args );
            if ( $clean_biz_home_team_post_query->have_posts() ) :
                $i = 1;
                while ( $clean_biz_home_team_post_query->have_posts() ) : $clean_biz_home_team_post_query->the_post();
                    $clean_biz_home_team_contents_array[$i]['clean-biz-home-team-title'] = get_the_title();
                    $clean_biz_home_team_contents_array[$i]['clean-biz-home-team-link'] = get_permalink();

                    $url ='';
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'clean-biz-team-image' );
                        $url = $thumb['0'];
                    }
                    else{
                      $url = NULL;
                    }
                    $clean_biz_home_team_contents_array[$i]['clean-biz-home-team-page-image'] = $url;

                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $clean_biz_home_team_contents_array;
    }
endif;

if ( ! function_exists( 'clean_biz_home_team' ) ) :
    /**
     * Team section
     *
     * @since clean-biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_home_team() {
        global $clean_biz_customizer_all_values;
        if( 1 != $clean_biz_customizer_all_values['clean-biz-home-team-enable'] ){
            return null;
        }
        $clean_biz_home_team_selection_options = $clean_biz_customizer_all_values['clean-biz-home-team-selection'];
        $clean_biz_team_arrays = clean_biz_home_team_array( $clean_biz_home_team_selection_options );

        if( is_array( $clean_biz_team_arrays )){
            $clean_biz_home_team_number = absint($clean_biz_customizer_all_values['clean-biz-home-team-number']);
            $clean_biz_home_team_title = $clean_biz_customizer_all_values['clean-biz-home-team-title'];
            $clean_biz_home_team_sub_title = $clean_biz_customizer_all_values['clean-biz-home-team-sub-title'];
            $clean_biz_home_team_button_text = $clean_biz_customizer_all_values['clean-biz-home-team-button-text'];
            $clean_biz_home_team_button_link = $clean_biz_customizer_all_values['clean-biz-home-team-button-link'];
            $clean_biz_home_team_enable_single_link = $clean_biz_customizer_all_values['clean-biz-home-team-enable-single-link'];
            ?>
            <!-- Team section -->
            <section class="wrapper wrapper-team">
                <div class="container">
                    <div class="section-title">
                        <?php if(!empty( $clean_biz_home_team_title ) ){ ?>
                            <h2><?php echo esc_html($clean_biz_home_team_title); ?></h2>
                        <?php } ?>
                        <?php if(!empty( $clean_biz_home_team_sub_title ) ){ ?>
                            <div class="block-title-par">
                            <?php echo esc_html($clean_biz_home_team_sub_title); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                    <?php
                    $i = 1;
                    $data_delay = 0;
                    foreach( $clean_biz_team_arrays as $clean_biz_team_array ){
                        if( $clean_biz_home_team_number < $i){
                            break;
                        }
                        $data_wow_delay = 'data-wow-delay='.$data_delay.'s';
                        ?>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="team-item">
                                <div class="team-thumb">
                                    <a  <?php if( 1 == $clean_biz_home_team_enable_single_link ){ ?> href="<?php echo esc_url($clean_biz_team_array['clean-biz-home-team-link']) ?>" <?php } ?>>
                                    <?php if(empty($clean_biz_team_array['clean-biz-home-team-page-image'])){
                                        $clean_biz_team_image = get_template_directory_uri().'/assets/images/team-fallback-260-290.png';
                                    }
                                    else{
                                        $clean_biz_team_image =$clean_biz_team_array['clean-biz-home-team-page-image'];
                                    }
                                    ?>
                                    <img src="<?php echo esc_url($clean_biz_team_image); ?>">
                                </a>
                                </div>
                                <div class="content">
                                    <h3><a href="<?php echo esc_url($clean_biz_team_array['clean-biz-home-team-link']) ?>"><?php echo wp_kses_post( $clean_biz_team_array['clean-biz-home-team-title'] );?></a></h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        if( $i % 4 == 0 ){
                            echo "<div class='clear'></div>";
                        }
                        $i++;
                    }
                    ?>
                    </div>
                    <?php
                    if( !empty( $clean_biz_home_team_button_link ) && !empty( $clean_biz_home_team_button_text ) ){
                        ?>
                        <div class="btn-holder">
                            <a class="button" href="<?php echo esc_url( $clean_biz_home_team_button_link );?>">
                                <?php echo esc_html( $clean_biz_home_team_button_text );?>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </section>
            <!-- team section -->
       <?php
        }
    }
endif;
add_action( 'clean_biz_action_front_page', 'clean_biz_home_team', 80 );