<?php

// Label
function vh_gap($atts, $content = null, $code) {
	extract( shortcode_atts( array(
		'height' => 10,
	), $atts ) );

	$output = '<div class="gap" style="line-height: ' . absint($height) . 'px; height: ' . absint($height) . 'px;"></div>';

	return $output;
}
add_shortcode('vh_gap', 'vh_gap');

// Pricing table
function vh_pricing_table( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'pricing_title'       => '',
				'pricing_block_color' => '',
				'content1'            => '',
				'content2'            => '',
				'price'               => '',
				'button_link'         => '',
				'el_class'            => '',
			), $atts ) );

	$attributes = '';
	$button_link = vc_build_link($button_link);

	if ( !empty($button_link['target']) ) {
		$attributes = ' target="' . $button_link['target'] . '"';
	}

	$output = '
	<div class="pricing-table pricing_color_' . $pricing_block_color . '">
		<div class="pricing-content">
			<div class="pricing-title">' . $pricing_title . '</div>
			<div class="pricing-desc-1">' . $content1 . '</div>
			<div class="pricing-desc-2">' . $content2 . '</div>
			<div class="pricing-price">' . $price . '</div>
			<div class="pricing-button"><a href="' . $button_link['url'] . '" class="no_before blue-button"' . $attributes . '>' . $button_link['title'] . '</a></div>
		</div>
	</div>';

	return $output;
}
add_shortcode('vh_pricing_table', 'vh_pricing_table');

// Spotlight
function vh_spotlight( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'spotlight_title'  => '',
				'spot_category'    => ''
			), $atts ) );

		global $wp_query;

		$random = rand();
		query_posts(array(
			'post_type' => 'movies',
			'event_categories' => $spot_category,
			'posts_per_page' => -1
		));

		if ( !have_posts() ) {
			return;
		}

		$output = '';
		$output .= '
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							
							jQuery(".spotlight_carousel_id_'.$random.'").jcarousel({
								wrap: "circular",
								items: ".spotlight_item"
							})
							// 	.on("jcarousel:create jcarousel:reload", function() {
							// 	var element = $(this),
							// 	width = element.innerWidth();
							// 	console.log(Math.round(width/7)+3);

							// 	if (width > 950) {
							// 		width = Math.round(width/7)+3;
							// 	} else if (width < 435) {
							// 		width = width - 10;
							// 	} else {
							// 		width = (width / 3) - 15;
							// 	}

							// 	element.jcarousel("items").css("width", width + "px");
							// });

							jQuery(".spotlight_next").click(function() {
								jQuery(this).parent().find(".spotlight_cont").jcarousel("scroll", "+=1");
							});

							jQuery(".spotlight_prev").click(function() {
								jQuery(this).parent().find(".spotlight_cont").jcarousel("scroll", "-=1");
							});
						});

					</script>';

		$output .= "<h2 class='module_title'>$spotlight_title</h2>";

		$output .= '<div class="spotlight_cont spotlight_carousel_id_'.$random.'"><ul class="spotlight">';

		while ( have_posts() ) {
			the_post();
			$output .= '<li class="spotlight_item shadows"><div class="spotlight_container"><div class="spotlight_image">';
			if ( kd_mfi_get_featured_image_id( 'event-poster', 'movies' ) != '' ) {
				$attachment_id = kd_mfi_get_featured_image_id( 'event-poster', 'movies' );
				$image = wp_get_attachment_image_src( $attachment_id, 'spotlight' );
				$output .= '<img src="'.$image[0].'" width="165" height="260" alt="'.get_post()->post_title.'">';
			} elseif ( has_post_thumbnail( get_post()->ID ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_post()->ID ), 'spotlight' );
				$output .= '<img src="'.$image[0].'" width="165" height="260" alt="'.get_post()->post_title.'">';
			}
			$output .= '</div>';
			$output .= '<div class="movie_title">'.get_post()->post_title.'</div>';
			$youtube = explode('=',get_post_meta( get_post()->ID, 'event_trailer', true ));
			if ( $youtube[0] == '' ) {
				$class = ' two';
			} else {
				$class = '';
			}
			$output .= '<div class="spotlight_controls'.$class.'">';
			$output .= '<div class="spotlight_info"><a class="icon-info" href="'.get_permalink( get_post()->ID ).'"></a></div>';
			$youtube = explode('=',get_post_meta( get_post()->ID, 'event_trailer', true ));
			if ( $youtube[0] != '' ) {
				if ( $youtube[0] != '' ) {
					$youtube_url = $youtube['1'];
				} else {
					$youtube_url = '';
				}
				$output .= '<div class="spotlight_trailer"><a class="icon-play-1" href="'.get_permalink( get_post()->ID ).'"></a><input type="hidden" value="'.$youtube_url.'"></div>';
			}
			$output .= '<div class="spotlight_tickets"><a class="icon-ticket" href="'.get_permalink( get_post()->ID ).'#tickets'.'"></a></div>';
			$output .= '</div><div class="line"></div></div></li>';

		}
		$output .= '</ul></div>';
		$output .= '<div class="spotlight_next icon-right-open-big hover_right"></div>
					<div class="spotlight_prev icon-left-open-big hover_left"></div>';

		wp_reset_query();

	return $output;
}
add_shortcode('vh_spotlight', 'vh_spotlight');

// Special offers
function vh_offers( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'offers_title'       => '',
				'offers_category'    => '',
				'offers_limit'       => '0',
				'offers_c_autoplay'  => 'false',
				'offers_c_speed'     => ' 2000'
			), $atts ) );

		global $wp_query;
		$random = rand();

		if ( $offers_c_autoplay == 'true' ) {
			$offers_c_autoplay_output = 'interval: 2000,
							 target: "+=4",
							 autostart: true';
		} elseif ( $offers_c_autoplay == 'false' ) {
			$offers_c_autoplay_output = 'autostart: false';
		} else {
			$offers_c_autoplay_output = 'autostart: true,
							 target: "+=4",
							 interval: ' . $offers_c_autoplay;
		}

		if ($offers_c_speed == null ) {
			$offers_c_speed = ' 2000';
		} else {
			$offers_c_speed =  $offers_c_speed;
		}

		if ( $offers_limit == '0' ) {
			$offers_limit = -1;
		}

		query_posts(array(
			'post_type' => 'special_offers',
			'offers_categories' => $offers_category,
			'posts_per_page' => $offers_limit
		));

		if ( !have_posts() ) {
			return;
		}

		$output = '';

		$output .= '
					<script type="text/javascript">
						jQuery(document).ready(function($) {
								[].slice.call( document.querySelectorAll( ".dotstyle.number_' . $random . ' > ul" ) ).forEach( function( nav ) {
									new DotNav( nav, {
										callback : function( idx ) {
										}
									});
								});
							jQuery(".imageSliderExt.number_' . $random . ' ul li").eq(0).addClass("current");

							var carousel_' . $random . ' = jQuery(".special_offers_container.number_' . $random . '").on("jcarousel:animate", function(event, carousel) {
									jQuery(".offer_image").addClass("active");
								}).on("jcarousel:animateend", function(event, carousel) {
									jQuery(".offer_image").removeClass("active");
								}).jcarousel({
								wrap: "circular",
								animation: {
									easing: "linear",
							        duration:' . $offers_c_speed . '
							    }
							}).jcarouselAutoscroll({
								' . $offers_c_autoplay_output . '
							});';

							if ( $offers_c_autoplay != 'false' ) {
								$output .= '
									jQuery(".special_offers_container.number_' . $random . ', .imageSliderExt.number_' . $random . '").hover(function() {
										jQuery(".special_offers_container.number_' . $random . '").jcarouselAutoscroll("stop");
									}, function() {
										jQuery(".special_offers_container.number_' . $random . '").jcarouselAutoscroll("start");
									});';
							}

							$output .= '
							jQuery(".imageSliderExt.number_' . $random . ' ul").on("jcarouselpagination:active", "li", function() {
								jQuery(this).addClass("current");
							}).on("jcarouselpagination:inactive", "li", function() {
								jQuery(this).removeClass("current");
							}).jcarouselPagination({
								carousel: carousel_' . $random . ',
								perPage: 4,';
							
							$output .= '
								"item": function(page, carouselItems) {
									return \'<li><a href="#\' + page + \'"></a></li>\';
								}
							});

							jQuery(".imageSliderExt.number_' . $random . ' ul").append("<li><!-- dummy dot --></li>");

							jQuery(window).bind("debouncedresize", function() {
								jQuery(".imageSliderExt.number_' . $random . ' ul").append("<li><!-- dummy dot --></li>");
								jQuery(".dotstyle.number_' . $random . ' li").removeClass("current");
								jQuery(".dotstyle.number_' . $random . ' li:first-child").addClass("current");
							});
							
						});
					</script>';

		$output .= "<h2 class='module_title offers'>$offers_title</h2>";
		if ( $offers_limit > 4 ) {
			$output .= '<div class="imageSliderExt dotstyle number_' . $random . ' dotstyle-dotmove"><ul></ul></div>';
		}
		$output .= '<div class="special_offers_container number_' . $random . '"><ul class="offers">';
		while(have_posts()) : the_post();
			$offer_link_text = get_post_meta( get_post()->ID, 'offer_link_text', true );

			if ( get_post_meta( get_post()->ID, 'offer_link', true ) != '' ) {
				$offer_link = get_post_meta( get_post()->ID, 'offer_link', true );
			} else {
				$offer_link = get_permalink( get_post()->ID );
			}

			$output .= '<li class="vc_col-sm-3"><div class="offer_container"><div class="offer_image shadows">';
			if (has_post_thumbnail( get_post()->ID ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_post()->ID ), 'offer' );
				$output .= '<a href="' . $offer_link . '"><img src="'.$image[0].'" alt="'.get_post()->post_title.'" width="262" height="155"></a>';
			}
			$output .= '</div>';
			$output .= '<div class="offer_title"><a href="' . $offer_link . '">'.get_post()->post_title.'</a></div>';
			if ( strlen(get_post()->post_content) > 100 ) {
				get_post()->post_content = substr(get_post()->post_content, 0, 100) . '..';
			} else {
				get_post()->post_content;
			}
			$output .= '<div class="offer_text">'.get_post()->post_content.'</div>';

			$output .= '<a href="'.$offer_link.'" class="offer_link">' . $offer_link_text . '</a>';

			if ( get_post_meta( get_post()->ID, 'offer_save', true ) != '') {
				$output .= '<div class="offer_sale"><span>'.get_post_meta( get_post()->ID, 'offer_save', true ).'</span></div>';
			}
			$output .= '</div></li>';

		endwhile;
		$output .= '</ul></div>';

		wp_reset_query();

	return $output;
}
add_shortcode('vh_offers', 'vh_offers');

// Theatres
function vh_movies( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'theatres_title'      => '',
				'theatres_date'       => '',
				'theatres_time'       => '',
				'theatres_limit'      => '',
				'theatres_all_events' => ''
			), $atts ) );

		global $wp_query;

		query_posts(array(
			'post_type' => 'movies'
		));

		if ( !have_posts() ) {
			return;
		}

		$output = '';
		$output .= "<h2 class='module_title'>$theatres_title</h2>";

		$output .= '<div class="dropdown_container">';
		$output .= get_movie_theatres();
		if ( $theatres_all_events != '1' ) {
			$output .= get_movie_upcoming_dates($theatres_date);
			$output .= get_movie_upcoming_times($theatres_time);
		}
		$output .= get_movie_categories();
		$output .= '<div class="clearfix"></div></div>';

		$output .= '<div id="movie_post_content"></div>';
		$output .= '<div class="vh_loading_effect"></div>';
		$output .= '<input type="hidden" id="event_limit" value="'.$theatres_limit.'">';
		$output .= '<input type="hidden" id="todays_date" value="'.date('m.d.Y').'">
					<input type="hidden" id="theatres_all_events" value="'.$theatres_all_events.'">';

		wp_reset_query();

	return $output;
}
add_shortcode('vh_movies', 'vh_movies');

// Event tickets
function vh_event_tickets( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'event_title'       => '',
				'event_max_dates'   => '',
				'event_tickets'     => ''
			), $atts ) );
		$output = '';
		$output .= '<h2 id="tickets" class="module_title event">'.$event_title.'</h2>';
		if ( $event_max_dates == '' ) {
			$event_max_dates = 7;
		}
		if ( $event_tickets != '1' ) {
			$output .= vh_get_event_dates($event_max_dates);
		}
		$output .= '<div id="event_ticket_content"></div>';
		$output .= '<input type="hidden" id="post_id" value="'.get_the_ID().'">
					<input type="hidden" id="show_all_tickets" value="'.$event_tickets.'">';

	return $output;
}
add_shortcode('vh_event_tickets', 'vh_event_tickets');

// Movies list
function vh_movies_list( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'movies_list_title'  => '',
				'movies_list_events' => '',
				'movies_list_per_page' => ''
			), $atts ) );

	if ( $movies_list_per_page == '' ) {
		$per_page = 9999;
	} else {
		$per_page = $movies_list_per_page;
	}

	$output = '';
	$output .= '<h2 class="module_title event list">'.$movies_list_title.'</h2>';
	$output .= '<div class="dropdown_container">';
		if ( $movies_list_events != '1' ) {
			$output .= get_movie_upcoming_dates('','movies_list');
		}
		$output .= get_movie_theatres();
		$output .= get_movie_categories();
		$output .= vh_get_movies_list_sorting();
	$output .= '<div class="clearfix"></div></div>';
	$output .= '<div id="movies_list_content"></div>
				<input type="hidden" id="movies_list_events" value="' . $movies_list_events . '">
				<input type="hidden" id="movies_list_per_page" value="' . $per_page . '">';
	$output .= '<div class="vh_loading_effect movies_list"></div>';

	return $output;
}
add_shortcode('vh_movies_list', 'vh_movies_list');

// Image gallery
function vh_image_gallery( $atts, $content = null ) {
	$output = $title = $type = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $interval = '';
	extract(shortcode_atts(array(
		'title'               => '',
		'type'                => 'image_grid',
		'onclick'             => 'link_image',
		'custom_links'        => '',
		'custom_links_target' => '',
		'img_size'            => '170x170',
		'images'              => '',
		'el_class'            => '',
		'interval'            => '5',
	), $atts));

	$gal_images        = $gal_video = '';
	$link_start        = '';
	$link_end          = '';
	$el_start          = '';
	$el_end            = '';
	$slides_wrap_start = '';
	$slides_wrap_end   = '';
	$post_video        = array();

	if ( $el_class != '' ) {
		$el_class = " " . str_replace(".", "", $el_class);
	}

	if ( $type == 'image_grid' ) {
		$el_start          = '<li class="item shadows">';
		$el_end            = '</li>';
		$slides_wrap_start = '<ul>';
		$slides_wrap_end   = '</ul>';
	}

	if ( $onclick == 'link_image' ) {
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
	}

	$flex_fx = '';
	if ( $type == 'image_grid' ) {
		$type = ' wpb_image_grid';
	}

	//if ( $images == '' ) return null;
	if ( $images == '' ) $images = '-1,-2,-3';
	$pretty_rel_random = ' rel="prettyPhoto[rel-'.rand().']"'; //rel-'.rand();

	if ( $onclick == 'custom_link' ) { $custom_links = explode( ',', $custom_links); }
	$images = explode( ',', $images);
	$i = -1;

	foreach ( $images as $attach_id ) {
		$i++;
		if ($attach_id > 0) {
			if ( array_key_exists('sizes',wp_get_attachment_metadata($attach_id)) == false ) {
				$img_size_array = explode('x',$img_size);
				$fileformat     = wp_get_attachment_metadata($attach_id);
				$post_video     = array( 'thumbnail' => '<div class="video_container" style="width: '.$img_size_array['0'].'px; height: '.$img_size_array['1'].'px"><div class="bottom_line"></div><div class="play icon-play-1"></div>' . do_shortcode('[video width="640" height="360" src="' . wp_get_attachment_url($attach_id) . '"]') . '</div>', 'p_img_large' => array(wp_get_attachment_url($attach_id),111,111,false) );
			} else {
				$post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
			}
		} else {
			$post_thumbnail = array();
			$post_thumbnail['thumbnail'] = '<img src="#" />';
			$post_thumbnail['p_img_large'][0] = '#';
		}

		$thumbnail = $post_thumbnail['thumbnail'];
		if ( $post_video != null ) {
			$video = $post_video['thumbnail'];
		}
		$p_img_large = $post_thumbnail['p_img_large'];
		$link_start = $link_end = '';

		if ( $onclick == 'link_image' ) {
			$link_start = '<div class="image_container"><div class="bottom_line"></div><a class="prettyphoto" href="'.$p_img_large[0].'"'.$pretty_rel_random.'>';
			$link_end   = '</a></div>';
		} else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
			$link_start = '<a href="'.$custom_links[$i].'"' . (!empty($custom_links_target) ? ' target="'.$custom_links_target.'"' : '') . '>';
			$link_end   = '</a>';
		}

		if ( wp_get_attachment_metadata($attach_id) != false && array_key_exists('sizes',wp_get_attachment_metadata($attach_id)) == false ) {
			$gal_video .= $el_start . $video . $el_end;
		} else {
			$gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
		}
		$extra = '<div class="image_carousel_buttons">
					<div class="event_open_next icon-right-open-big hover_right"></div>
					<div class="event_open_prev icon-left-open-big hover_left"></div>
					<script type="text/javascript">jQuery(document).ready(function($) {	jQuery(".image_gallery_container").jcarousel({wrap: "circular",items: ".item"});jQuery(".event_open_next").click(function() {jQuery(".image_gallery_container").jcarousel("scroll", "+=1");});jQuery(".event_open_prev").click(function() {jQuery(".image_gallery_container").jcarousel("scroll", "-=1");});});</script>
				</div>';
	}
	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gallery wpb_content_element'.$el_class.' vc_clearfix', '');
	$output .= "\n\t".'<div class="'.$css_class.'">';
	$output .= "\n\t\t".'<div class="wpb_wrapper">';
	$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'image_module_title'));
	$output .= '<div class="image_gallery"><div class="image_gallery_container">'.$slides_wrap_start.$gal_video.$gal_images.$slides_wrap_end.'</div>'.$extra.'</div>';
	$output .= "\n\t\t".'</div>';
	$output .= "\n\t".'</div>';

	return $output;
}
add_shortcode('vh_image_gallery', 'vh_image_gallery');

// Post carousel
function vh_post_carousel( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'post_carousel_title'      => '',
				'post_carousel_categories' => '',
				'post_carousel_count'      => '0',
				'post_c_autoplay'          => 'false',
				'post_c_speed'             => '2000'
			), $atts ) );

		global $wp_query;
		$random = rand();

		if ($post_c_speed == null) {
			$post_c_speed = '2000';
		} else {
			$post_c_speed =  $post_c_speed;
		}

		if ( $post_c_autoplay == 'true' ) {
			$post_c_autoplay_output = 'interval: 2000,
							 target: "+=4",
							 autostart: true';
		} elseif ( $post_c_autoplay == 'false' ) {
			$post_c_autoplay_output = 'autostart: false';
		} else {
			$post_c_autoplay_output = 'autostart: true,
							 target: "+=4",
							 interval: '.$post_c_autoplay;
		}

		if ( $post_carousel_count == '0' ) {
			$post_carousel_count = -1;
		}

		ob_start();
		query_posts(array(
			'post_type' => 'post',
			'category_name' => $post_carousel_categories,
			'posts_per_page' => $post_carousel_count
		));
		$output .= ob_get_contents();
		ob_end_clean();

		if ( !have_posts() ) {
			return;
		}

		$output = '';
		$output .= '
					<script type="text/javascript">
						jQuery(document).ready(function($) {
								[].slice.call( document.querySelectorAll( ".dotstyle.number_' . $random . ' > ul" ) ).forEach( function( nav ) {
									new DotNav( nav, {
										callback : function( idx ) {
										}
									});
								});
							jQuery(".imageSliderExt.number_' . $random . ' ul li").eq(0).addClass("current");

							var carousel_' . $random . ' = jQuery(".teaser_grid_container_carousel.number_' . $random . '").on("jcarousel:animate", function(event, carousel) {
									jQuery(".post-thumb-img-wrapper").addClass("active");
								}).on("jcarousel:animateend", function(event, carousel) {
									jQuery(".post-thumb-img-wrapper").removeClass("active");
								}).jcarousel({
								wrap: "circular",
								animation: {
									easing: "linear",
							        duration:' . $post_c_speed . '
							    }
							}).jcarouselAutoscroll({
								' . $post_c_autoplay_output . '
							});';

							if ( $post_c_autoplay != 'false' ) {
								$output .= '
									jQuery(".teaser_grid_container_carousel.number_' . $random . ', .imageSliderExt.number_' . $random . '").hover(function() {
										jQuery(".teaser_grid_container_carousel.number_' . $random . '").jcarouselAutoscroll("stop");
									}, function() {
										jQuery(".teaser_grid_container_carousel.number_' . $random . '").jcarouselAutoscroll("start");
									});';
							}

							$output .= '
							jQuery(".imageSliderExt.number_' . $random . ' ul").on("jcarouselpagination:active", "li", function() {
								jQuery(this).addClass("current");
							}).on("jcarouselpagination:inactive", "li", function() {
								jQuery(this).removeClass("current");
							}).jcarouselPagination({
								carousel: carousel_' . $random . ',
								perPage: 4,';
							
							$output .= '
								"item": function(page, carouselItems) {
									return \'<li><a href="#\' + page + \'"></a></li>\';
								}
							});

							jQuery(".imageSliderExt.number_' . $random . ' ul").append("<li><!-- dummy dot --></li>");

							jQuery(window).bind("debouncedresize", function() {
								jQuery(".imageSliderExt.number_' . $random . ' ul").append("<li><!-- dummy dot --></li>");
								jQuery(".dotstyle.number_' . $random . ' li").removeClass("current");
								jQuery(".dotstyle.number_' . $random . ' li:first-child").addClass("current");
							});
							
						});
					</script>';

		$output .= '<h2 class="module_title latest_news">' . $post_carousel_title . '</h2>';
		if ( $post_carousel_count > 4 ) {
			$output .= '<div class="imageSliderExt dotstyle number_' . $random . ' dotstyle-dotmove"><ul></ul></div>';
		}
		$output .= '<div class="teaser_grid_container_carousel number_' . $random . '">';
		$output .= '<ul class="teaser_grid_carousel">';
		while(have_posts()) {
			the_post();
			
			$output .= '<li class="post_carousel_item"><div class="post-grid-item-wrapper"><div class="post-thumb-img-wrapper shadows"><div class="bottom_line"></div>';
			if (has_post_thumbnail( get_post()->ID ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_post()->ID ), 'in_theatres' );
				$output .= '<a href="' . get_permalink( get_post()->ID ) . '"><img src="'.$image[0].'" alt="' . get_post()->post_title . '" width="100" height="155"></a>';
			}
			$output .= '</div>';
			if ( strlen(get_post()->post_content) > 100 ) {
				get_post()->post_content = substr(get_post()->post_content, 0, 100) . '..';
			} else {
				get_post()->post_content;
			}
			$output .= '<div class="entry-content">
							<div class="blog_time top icon-clock">'.get_the_date('d M Y').'</div>
							<a href="' . get_permalink( get_post()->ID ) . '">' . get_post()->post_title . '</a>
						</div>';
			ob_start();
			$output .= '<div class="bottom-part-container">
							<div class="read_more">
								<a href="' . get_permalink( get_post()->ID ) . '" class="vc_read_more hover_right">' .
									_e("Read more", "vh");
			$output .= ob_get_contents();
			ob_end_clean();
			$output .= '		</a>
							</div>
						</div>';

			$output .= '</div></li>';

		}
		$output .= '</ul>';
		$output .= '</div>';

		wp_reset_query();
		wp_reset_postdata();

	return $output;
}
add_shortcode('vh_post_carousel', 'vh_post_carousel');

function vh_vcgi_image( $atts ) {
	$output = '{{vh_post_image_module}}';
	return $output;
}
add_shortcode( 'vh_vcgi_image', 'vh_vcgi_image' );

function vh_vcgi_bottom( $atts ) {
	$output = '{{vh_post_bottom_module}}';
	return $output;
}
add_shortcode( 'vh_vcgi_bottom', 'vh_vcgi_bottom' );