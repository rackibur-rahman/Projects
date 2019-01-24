<?php

if ( ! function_exists( 'clean_biz_home_about' ) ) :
    /**
     * About Section
     *
     * @since clean biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_home_about() {
        global $clean_biz_customizer_all_values;
        $clean_biz_home_about_button_text = $clean_biz_customizer_all_values['clean-biz-home-about-button-text'];
        $repeated_page = array('clean-biz-about-pages-ids');
        $clean_biz_home_about_single_words = absint( $clean_biz_customizer_all_values['clean-biz-home-about-single-words'] );
        $clean_biz_home_about_posts = evision_customizer_get_repeated_all_value(1 , $repeated_page);
        $clean_biz_home_about_posts_ids = array();
        foreach ($clean_biz_home_about_posts as $clean_biz_home_about_post) {
            if (0 != $clean_biz_home_about_post['clean-biz-about-pages-ids']) {
                $clean_biz_home_about_posts_ids[] = $clean_biz_home_about_post['clean-biz-about-pages-ids'];
            }
            else {
                $clean_biz_home_about_posts_ids[] = 2;
            }
        }
        if( !empty( $clean_biz_home_about_posts_ids )){
            $clean_biz_home_about_args = array(
                'post_type' => 'page',
                'post__in' => $clean_biz_home_about_posts_ids,
                'orderby' => 'post__in'
            );
        }
        if( (1 != $clean_biz_customizer_all_values['clean-biz-home-about-enable'])){
            return;
        }
            if( !empty( $clean_biz_home_about_args )){
                $home_about_query = new WP_Query($clean_biz_home_about_args);
                while ($home_about_query->have_posts()): $home_about_query->the_post();
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'clean-biz-about-image' );
                        $url = $thumb['0'];
                    }
                    else{
                        $url = get_template_directory_uri().'/assets/images/about-fallback-720-510.png';
                    } ?>
                    <!-- About section -->
                    <section class="wrapper wrapper-about" style="background-image: url(<?php echo esc_url( $url ); ?>)">
                        <div class="about-inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="section-title">
                                            <h2><?php the_title(); ?></h2>
                                            <div class="block-title-par">
                                                <?php
                                                if (has_excerpt()) {
                                                    $clean_biz_home_about_content_word_count = get_the_excerpt();
                                                }
                                                else {
                                                    $clean_biz_home_about_content_word_count = clean_biz_words_count( $clean_biz_home_about_single_words ,get_the_content());
                                                } ?>
                                                <?php echo wp_kses_post( $clean_biz_home_about_content_word_count );?>
                                            </div>
                                            <?php if (!empty($clean_biz_home_about_button_text)) { ?>
                                            <div class="btn-holder">
                                                <a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html( $clean_biz_home_about_button_text ); ?></a>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </section>
                <?php endwhile;
            }
            ?>
            <?php wp_reset_postdata(); ?>
        <?php
    }
endif;
add_action( 'clean_biz_action_front_page', 'clean_biz_home_about', 30 );

