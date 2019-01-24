<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 *
 */


/**
 * clean_biz_action_after_content hook
 * @since clean-biz 1.0.0
 *
 * @hooked null
 */
do_action( 'clean_biz_action_after_content' );

/**
 * clean_biz_action_before_footer hook
 * @since clean-biz 1.0.0
 *
 * @hooked clean_biz_before_footer - 10
 */
do_action( 'clean_biz_action_before_footer' );

/**
 * clean_biz_action_widget_before_footer hook
 * @since clean-biz 1.0.0
 *
 * @hooked clean_biz_widget_before_footer - 10
 */
do_action( 'clean_biz_action_widget_before_footer' );

/**
 * clean_biz_action_footer hook
 * @since clean-biz 1.0.0
 *
 * @hooked clean_biz_footer - 10
 */
do_action( 'clean_biz_action_footer' );

/**
 * clean_biz_action_after_footer hook
 * @since clean-biz 1.0.0
 *
 * @hooked null
 */
do_action( 'clean_biz_action_after_footer' );

/**
 * clean_biz_action_after hook
 * @since clean-biz 1.0.0
 *
 * @hooked clean_biz_page_end - 10
 */
do_action( 'clean_biz_action_after' );
?>
<?php wp_footer(); ?>
</body>
</html>