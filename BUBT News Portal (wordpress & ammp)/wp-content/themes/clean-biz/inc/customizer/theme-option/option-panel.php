<?php
global $clean_biz_panels;
/*creating panel for theme settings*/
$clean_biz_panels['clean-biz-theme-options'] =
    array(
        'title'          => __( 'Theme Options', 'clean-biz' ),
        'priority'       => 235
    );

/*footer options */
require get_template_directory().'/inc/customizer/theme-option/footer.php';

/*search options */
require get_template_directory().'/inc/customizer/theme-option/search.php';

/*layout options */
require get_template_directory().'/inc/customizer/theme-option/layout-options.php';

/*breadcrumb options */
require get_template_directory().'/inc/customizer/theme-option/breadcrumb.php';

/*back to top options */
require get_template_directory().'/inc/customizer/theme-option/back-to-top.php';