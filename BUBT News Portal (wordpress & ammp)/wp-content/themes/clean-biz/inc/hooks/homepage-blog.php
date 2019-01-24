<?php
if ( ! function_exists( 'clean_biz_home_blog' ) ) :
    /**
     * Blog Section
     *
     * @since clean-biz 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function clean_biz_home_blog() {
        global $clean_biz_customizer_all_values;
        
        $clean_biz_home_blog_category = absint($clean_biz_customizer_all_values['clean-biz-home-blog-category']);
        $clean_biz_home_blog_title = esc_html($clean_biz_customizer_all_values['clean-biz-home-blog-title']);
        $clean_biz_home_blog_sub_title = esc_html($clean_biz_customizer_all_values['clean-biz-home-blog-sub-title']);
        $clean_biz_home_blog_content_no = absint($clean_biz_customizer_all_values['clean-biz-home-blog-single-words']);
        $clean_biz_home_blog_no = absint($clean_biz_customizer_all_values['clean-biz-home-blog-blog-no']);
        $clean_biz_home_blog_button_link = esc_url($clean_biz_customizer_all_values['clean-biz-home-blog-button-link']);
        $clean_biz_home_blog_button_text = esc_html($clean_biz_customizer_all_values['clean-biz-home-blog-button-text']);
        if( 1 != $clean_biz_customizer_all_values['clean-biz-home-blog-enable'] ){
            return null;
        }
        ?>
        <section class="wrapper wrapper-blog">
            <div class="container">
                <div class="section-title">
                    <h2><?php echo esc_html($clean_biz_home_blog_title); ?></h2>
                    <div class="block-title-par">
                        <?php echo esc_html($clean_biz_home_blog_sub_title);?>
                    </div>
                </div>
            </div>
            <div class="container wrapper-port">
                <div class="row carousel-group content-outer">
                    <?php $clean_biz_blog_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $clean_biz_home_blog_no,
                        'cat'           => $clean_biz_home_blog_category,
                        'ignore_sticky_posts' => 1,
                    );
                    $clean_biz_home_blog_post_query = new WP_Query($clean_biz_blog_args);
                    if ($clean_biz_home_blog_post_query->have_posts()) :
                        while ($clean_biz_home_blog_post_query->have_posts()) : $clean_biz_home_blog_post_query->the_post();
                            if(has_post_thumbnail()){
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'clean-biz-blog-image' );
                                $url = $thumb['0'];
                            }
                            else{
                                $url = get_template_directory_uri().'/assets/images/blog-fallback-360-220.png';
                            }
                            ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="blog-list-inner">
                                    <div class="single-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url($url); ?>">
                                            <div class="content-area">
                                                <i class="fa fa-send"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <div class="cat">
                                            <?php echo wp_kses_post(get_the_category_list( ", ", "", get_the_id())); ?>
                                        </div>
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="text">
                                            <?php
                                            if ( has_excerpt() ) {
                                                the_excerpt();
                                            } else {
                                                echo wp_kses_post(clean_biz_words_count( $clean_biz_home_blog_content_no, get_the_content()));
                                            }
                                            ?>
                                        </div> 
                                    </div>
                                    <div class="post-footer">
                                        <span>
                                            <?php 
                                            $author_name = get_the_author();
                                            $author_url   = get_author_posts_url( get_the_author_meta( 'ID' ) );?>
                                            <a href="<?php echo esc_url($author_url); ?>" class="icon" title=""><i class="fa fa-user"></i><span><?php echo esc_html($author_name ); ?></span></a>
                                        </span>
                                        <span>
                                            <?php $archive_year = get_the_time('M j, Y'); ?>
                                            <a href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d') )); ?>" class="icon"><i class="fa fa-calendar"></i> <?php echo esc_html($archive_year);?></a>
                                        </span>
                                        <span>
                                            <a href="<?php the_permalink(); ?>" class="icon">
                                                <i class="fa fa-comment"></i> 
                                                <?php
                                                    $commentscount = get_comments_number();
                                                    echo absint($commentscount);
                                                ?>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; 
                        wp_reset_postdata();
                    endif; ?>
                </div>
                <?php
                if( !empty( $clean_biz_home_blog_button_link ) && !empty( $clean_biz_home_blog_button_text ) ){
                    ?>
                    <div class="btn-holder">
                        <a class="button" href="<?php echo esc_url( $clean_biz_home_blog_button_link );?>">
                            <?php echo esc_html( $clean_biz_home_blog_button_text );?>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
        <?php
    }
endif;
add_action( 'clean_biz_action_front_page', 'clean_biz_home_blog', 100 );