<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package clean-biz
 */

global $clean_biz_customizer_all_values;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="entry-header">
	<?php
	if ( is_single() ) {
	} else {
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}
	if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php clean_biz_posted_on(); ?>
			<?php clean_biz_entry_footer(); ?>
		</div><!-- .entry-meta -->
	<?php
	endif; ?>
</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		$clean_biz_archive_layout = $clean_biz_customizer_all_values['clean-biz-archive-layout'];
		$clean_biz_archive_image_align = $clean_biz_customizer_all_values['clean-biz-archive-image-align'];
		if( 'excerpt-only' == $clean_biz_archive_layout ){
			the_excerpt();
		}
		elseif( 'full-post' == $clean_biz_archive_layout ){
			the_content( sprintf(
			/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'clean-biz' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}
		elseif( 'thumbnail-and-full-post' == $clean_biz_archive_layout ){
			if( 'left' == $clean_biz_archive_image_align ){
				echo "<div class='image-left'>";
				the_post_thumbnail('medium');
			}
			elseif( 'right' == $clean_biz_archive_image_align ){
				echo "<div class='image-right'>";
				the_post_thumbnail('medium');
			}
			else{
				echo "<div class='image-full'>";
				the_post_thumbnail('full');
			}
			echo "</div>";/*div end*/
			the_content( sprintf(
			/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'clean-biz' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}
		else{
			if( 'left' == $clean_biz_archive_image_align ){
				echo "<div class='image-left'>";
				the_post_thumbnail('medium');
			}
			elseif( 'right' == $clean_biz_archive_image_align ){
				echo "<div class='image-right'>";
				the_post_thumbnail('medium');
			}
			else{
				echo "<div class='image-full'>";
				the_post_thumbnail('full');
			}
			echo "</div>";/*div end*/
			the_excerpt();
		}
		?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'clean-biz' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
