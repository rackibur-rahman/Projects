<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package clean-biz
 */

/**
 * clean_biz_action_before_head hook
 * @since clean-biz 1.0.0
 *
 * @hooked clean_biz_set_global -  0
 * @hooked clean_biz_doctype -  10
 */
do_action( 'clean_biz_action_before_head' );?>



<head>

	<?php
	/**
	 * clean_biz_action_before_wp_head hook
	 * @since clean-biz 1.0.0
	 *
	 * @hooked clean_biz_before_wp_head -  10
	 */
	do_action( 'clean_biz_action_before_wp_head' );

	wp_head();

	/**
	 * clean_biz_action_after_wp_head hook
	 * @since clean-biz 1.0.0
	 *
	 * @hooked null
	 */
	do_action( 'clean_biz_action_after_wp_head' );
	?>

</head>

<body <?php body_class(); ?>>

<?php
/**
 * clean_biz_action_before hook
 * @since clean-biz 1.0.0
 *
 * @hooked clean_biz_page_start - 15
 */
do_action( 'clean_biz_action_before' );

/**
 * clean_biz_action_before_header hook
 * @since clean-biz 1.0.0
 *
 * @hooked clean_biz_skip_to_content - 10
 */
do_action( 'clean_biz_action_before_header' );

/**
 * clean_biz_action_header hook
 * @since clean-biz 1.0.0
 *
 * @hooked clean_biz_after_header - 10
 */
do_action( 'clean_biz_action_header' );

/**
 * clean_biz_action_after_title hook
 * @since clean-biz 1.0.0
 *
 * @hooked for breadcrum - 10
 */
do_action( 'clean_biz_action_after_title' );

/**
 * clean_biz_action_page_start hook
 * @since clean-biz 1.0.0
 *
 * @hooked page start - 10
 */
do_action( 'clean_biz_action_page_start' );

/**
 * clean_biz_action_on_header hook
 * @since clean-biz 1.0.0
 *
 * @hooked page start and navigations - 10
 */
do_action( 'clean_biz_action_on_header' );

/**
 * clean_biz_action_before_content hook
 * @since clean-biz 1.0.0
 *
 * @hooked null
 */
do_action( 'clean_biz_action_before_content' );

