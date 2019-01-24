<?php
if ( ! function_exists( 'clean_biz_home_portfolio' ) ) :
    /**
     * Blog Section
     *
     * @since clean-biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_home_portfolio() {
        global $clean_biz_customizer_all_values;
        
        $clean_biz_home_portfolio_category = absint($clean_biz_customizer_all_values['clean-biz-home-portfolio-category']);
        $clean_biz_home_portfolio_title = esc_html($clean_biz_customizer_all_values['clean-biz-home-portfolio-title']);
        $clean_biz_home_portfolio_sub_title = esc_html($clean_biz_customizer_all_values['clean-biz-home-portfolio-sub-title']);
        $clean_biz_home_portfolio_no = absint($clean_biz_customizer_all_values['clean-biz-home-portfolio-number']);
        if( 1 != $clean_biz_customizer_all_values['clean-biz-home-portfolio-enable'] ){
            return null;
        }
        ?>

        <!-- Portfolio section -->
        <section class="wrapper wrapper-portfolio wrapper-port">
            <div class="container">
                <div class="section-title">
                    <h2><?php echo esc_html($clean_biz_home_portfolio_title); ?></h2>
                    <div class="block-title-par">
                        <?php echo esc_html($clean_biz_home_portfolio_sub_title);?>
                    </div>
                </div>
            </div>
            <div class="container-full bannerbg">
                <div class="row">
                    <?php $clean_biz_portfolio_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $clean_biz_home_portfolio_no,
                        'cat'           => $clean_biz_home_portfolio_category,
                        'ignore_sticky_posts' => 1,
                    );
                    $i = 1 ;
                    $clean_biz_home_portfolio_post_query = new WP_Query($clean_biz_portfolio_args);
                    if ($clean_biz_home_portfolio_post_query->have_posts()) :
                        while ($clean_biz_home_portfolio_post_query->have_posts()) : $clean_biz_home_portfolio_post_query->the_post();
                            if(has_post_thumbnail()){
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'clean-biz-portfolio-image' );
                                $url = $thumb['0'];
                            }
                            else{
                                $url = get_template_directory_uri().'/assets/images/portfolio-fallback-340-340.png';
                            }
                            ?>
                            <div class="col-xs-12 col-sm-6 col-md-3 pad0lr">
                                <div class="single-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($url); ?>">
                                        <div class="content-area">
                                            <h2><?php the_title(); ?></h2>
                                            <?php $archive_year = get_the_time('M j, Y'); ?>
                                            <a href="<?php echo esc_url(get_year_link($archive_year)); ?>" class="icon"><div class="date"><?php echo esc_html($archive_year);?></div></a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php if ($i % 4 == 0 ) { ?>
                                <div class="clear"> </div>
                            <?php } ?>
                        <?php 
                        $i++;
                        endwhile; 
                        wp_reset_postdata();
                    endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
endif;
add_action( 'clean_biz_action_front_page', 'clean_biz_home_portfolio', 50 );