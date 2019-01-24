<?php
global $clean_biz_panels;
/*creating panel for fonts-setting*/
$clean_biz_panels['clean-biz-featured-slider'] =
    array(
        'title'          => __( 'Slider Section', 'clean-biz' ),
        'priority'       => 150
    );

/*slider selection from slider options */
require get_template_directory().'/inc/customizer/slider-section/slider-settings.php';

/*slider selection from slider from page */
require get_template_directory().'/inc/customizer/slider-section/slider-from-page.php';

/*slider selection from custom slider property controll */
require get_template_directory().'/inc/customizer/slider-section/slider-property.php';