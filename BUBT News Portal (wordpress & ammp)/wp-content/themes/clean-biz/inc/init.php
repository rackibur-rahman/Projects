<?php
/**
 * evision themes init file
 *
 * @package eVision themes
 * @subpackage clean-biz
 * @since clean-biz 1.0.0
 */

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer/customizer.php';

/**
*sidebar widget.
*/
require get_template_directory() . '/inc/sidebar-widget-init.php';

/**
Layout additions
 */
 require get_template_directory() . '/inc/post-meta/layout-meta.php';

/**
 * Include 
 */
require get_template_directory().'/inc/hooks/excerpt.php';

require get_template_directory().'/inc/hooks/inline-style.php';

require get_template_directory().'/inc/function/words-count.php';

require get_template_directory().'/inc/function/single-image-align.php';

require get_template_directory() . '/inc/function/header-logo.php';

require get_template_directory() . '/inc/hooks/header.php';

require get_template_directory() . '/inc/hooks/footer.php';

require get_template_directory() . '/inc/hooks/homepage-slider.php';

require get_template_directory() . '/inc/hooks/homepage-service.php';

require get_template_directory() . '/inc/hooks/homepage-about.php';

require get_template_directory() . '/inc/hooks/homepage-portfolio.php';

require get_template_directory() . '/inc/hooks/homepage-testimonial.php';

require get_template_directory() . '/inc/hooks/homepage-team.php';

require get_template_directory() . '/inc/hooks/homepage-callback.php';

require get_template_directory() . '/inc/hooks/homepage-blog.php';

