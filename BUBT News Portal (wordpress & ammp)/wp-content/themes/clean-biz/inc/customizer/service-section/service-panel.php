<?php
global $clean_biz_panels;
/*creating panel for fonts-setting*/
$clean_biz_panels['clean-biz-home-service'] =
    array(
        'title'          => __( 'Service Section', 'clean-biz' ),
        'priority'       => 150
    );

/*service selection from custom options */
require get_template_directory().'/inc/customizer/service-section/font-icon.php';

/*service selection from page options */
require get_template_directory().'/inc/customizer/service-section/from-page.php';

/*service selection from custom options */
require get_template_directory().'/inc/customizer/service-section/service-options.php';