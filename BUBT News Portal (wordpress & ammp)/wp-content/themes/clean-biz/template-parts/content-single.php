<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package clean-biz
 */

?>
<header class="entry-header">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<div class="entry-meta">
		<?php clean_biz_posted_on(); ?>
	</div><!-- .entry-meta -->
</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		$clean_biz_single_post_image_align = clean_biz_single_post_image_align(get_the_ID());
		if( 'no-image' != $clean_biz_single_post_image_align ){
			if( 'left' == $clean_biz_single_post_image_align ){
				echo "<div class='image-left'>";
				the_post_thumbnail('medium');
			}
			elseif( 'right' == $clean_biz_single_post_image_align ){
				echo "<div class='image-right'>";
				the_post_thumbnail('medium');
			}
			else{
				echo "<div class='image-full'>";
				the_post_thumbnail('full');
			}
			echo "</div>";/*div end*/
		}
		?>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'clean-biz' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php clean_biz_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

