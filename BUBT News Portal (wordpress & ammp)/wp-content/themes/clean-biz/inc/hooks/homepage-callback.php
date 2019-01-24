<?php

if ( ! function_exists( 'clean_biz_home_callback_section' ) ) :
    /**
     * Callback
     *
     * @since clean biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_home_callback_section() {
        global $clean_biz_customizer_all_values;
        if( 1 != $clean_biz_customizer_all_values['clean-biz-callback-enable'] ){
            return null;
        }
        $clean_biz_home_callback_single_words = absint( $clean_biz_customizer_all_values['clean-biz-home-callback-single-words'] );
        $clean_biz_home_callback_posts = absint($clean_biz_customizer_all_values['clean-biz-callback-page']);
        $clean_biz_home_callback_button = esc_html($clean_biz_customizer_all_values['clean-biz-home-callback-button-text'] );
        $clean_biz_home_callback_button_link = esc_url($clean_biz_customizer_all_values['clean-biz-home-callback-button-link'] );

    ?>
    <?php
    if( !empty( $clean_biz_home_callback_posts )){
        $clean_biz_feature_callback_args =    array(
            'post_type' => 'page',
            'p' => $clean_biz_home_callback_posts,
            'posts_per_page' => 1

        );
        $clean_biz_fature_section_post_query = new WP_Query( $clean_biz_feature_callback_args );
        if ( $clean_biz_fature_section_post_query->have_posts() ) :
        while ( $clean_biz_fature_section_post_query->have_posts() ) : $clean_biz_fature_section_post_query->the_post();
        if(has_post_thumbnail()){
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        }
        else{
            $thumb[0] = get_template_directory_uri() .'/assets/imges/banner-fallback-1340-560.png';
        }
        ?>               

        <section class="wrapper wrapper-callback bannerbg" style="background-image: url('<?php echo esc_url($thumb[0]); ?>')";>
            <div class="thumb-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                            <h2><?php the_title(); ?></h2>
                            <div class="text-content">
                                <?php
                                if (has_excerpt()) {
                                    $clean_biz_home_callback_content = get_the_excerpt();
                                }
                                else {
                                    $clean_biz_home_callback_content = clean_biz_words_count( $clean_biz_home_callback_single_words ,get_the_content());
                                } ?>
                                <?php echo wp_kses_post($clean_biz_home_callback_content); ?>
                            </div>
                            <?php if( 1 == $clean_biz_customizer_all_values['clean-biz-home-callback-remove-button'] ){ ?>
                                <div class="btn-holder"><a href="<?php 
                                    if (empty($clean_biz_home_callback_button_link)) {
                                        the_permalink();
                                    }
                                    else{
                                        echo esc_url($clean_biz_home_callback_button_link);
                                    }
                                    ?>" class="button"> <?php echo esc_html($clean_biz_home_callback_button);?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
    }
}
endif;
add_action( 'clean_biz_action_front_page', 'clean_biz_home_callback_section', 85);