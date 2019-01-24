<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package clean-biz
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="page-content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'That page can&rsquo;t be found.', 'clean-biz' ); ?></h1>
							</header><!-- .page-header -->
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'clean-biz' ); ?></p>
									<div class="widget clear">
										<?php
											get_search_form();

										?>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12 pnf-widget pull-right">
									<?php 
										the_widget( 'WP_Widget_Recent_Posts' );

										// Only show the widget if site has multiple categories.
										if ( clean_biz_categorized_blog() ) :
									?>

									<div class="widget widget_categories">
										<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'clean-biz' ); ?></h2>
										<ul>
										<?php
											wp_list_categories( array(
												'orderby'    => 'count',
												'order'      => 'DESC',
												'show_count' => 1,
												'title_li'   => '',
												'number'     => 10,
											) );
										?>
										</ul>
									</div><!-- .widget -->

									<?php
										endif;

										/* translators: %1$s: smiley */
										$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'clean-biz' ), convert_smilies( ':)' ) ) . '</p>';
										the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

										the_widget( 'WP_Widget_Tag_Cloud' );
									?>
								</div>
							</div>
						</div>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
