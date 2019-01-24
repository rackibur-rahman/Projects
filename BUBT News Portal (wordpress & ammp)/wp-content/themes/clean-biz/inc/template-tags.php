<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package clean-biz
 */

if ( ! function_exists( 'clean_biz_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function clean_biz_posted_on() {
	global $post;
	$author_id=$post->post_author;
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'On %s', 'post date', 'clean-biz' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'By %s', 'post author', 'clean-biz' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>'
	);

	echo '<span class="posted-on"><i class="fa fa-calendar-check-o"></i>' . $posted_on . '</span><span class="byline"> <i class="fa fa-user-circle-o"></i>' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'clean_biz_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function clean_biz_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'clean-biz' ) );
		if ( $categories_list && clean_biz_categorized_blog() ) {
			printf( '<i class="fa fa-folder-open-o"></i><span class="cat-links">' . esc_html__( 'Posted in %1$s', 'clean-biz' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( esc_html( ', ') );
		if ( $tags_list ) {
			printf( '<i class="fa fa-comments"></i><span class="tags-links">' . esc_html__( 'Tagged %1$s', 'clean-biz' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<i class="fa fa-comments"></i><span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'clean-biz' ), esc_html__( '1 Comment', 'clean-biz' ), esc_html__( '% Comments', 'clean-biz' ) );
		echo '</span>';
	}
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'clean-biz' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function clean_biz_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'clean_biz_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'clean_biz_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so clean_biz_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so clean_biz_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in clean_biz_categorized_blog.
 */
function clean_biz_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'clean_biz_categories' );
}
add_action( 'edit_category', 'clean_biz_category_transient_flusher' );
add_action( 'save_post',     'clean_biz_category_transient_flusher' );
