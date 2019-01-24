<?php
/**
 * The template for displaying home page.
 * @package clean-biz
 */
global $clean_biz_customizer_all_values;
get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
    }
else{
	/**
	 * clean_biz_action_front_page hook
	 * @since clean-biz 1.0.0
	 *
	 * @hooked clean_biz_action_front_page -  10
	 * @sub_hooked clean_biz_action_front_page -  30
	 */
	do_action( 'clean_biz_action_front_page' );	 ?>
	<?php  
	$clean_biz_selected_page = absint($clean_biz_customizer_all_values['clean-biz-enable-selected-page']);
	if ($clean_biz_selected_page == 1) { 
		if( (1 != $clean_biz_customizer_all_values['clean-biz-home-about-enable']) && ( 1 != $clean_biz_customizer_all_values['clean-biz-home-service-enable'] ) && ( 1 != $clean_biz_customizer_all_values['clean-biz-feature-slider-enable'] )){
            $div_class_container = 'not-enabled';
        } else{
            $div_class_container = 'enabled';
        	}?>
		    <div class="container <?php echo esc_attr($div_class_container); ?>">
				<div id="primary" class="content-area col-sm-8">
				    <main id="main" class="site-main" role="main">

				        <?php
				        while ( have_posts() ) : the_post();

				            get_template_part( 'template-parts/content', 'page' );

				            // If comments are open or we have at least one comment, load up the comment template.
				            if ( comments_open() || get_comments_number() ) :
				                comments_template();
				            endif;

				        endwhile; // End of the loop.
				        ?>

				    </main><!-- #main -->
				</div><!-- #primary -->
				<?php get_sidebar(); ?>
				</div>
		

	<?php
	}
}
get_footer();