<?php
global $clean_biz_panels;
/*creating panel for fonts-setting*/
$clean_biz_panels['clean-biz-home-testimonial'] =
    array(
        'title'          => __( 'Testimonial Section', 'clean-biz' ),
        'priority'       => 173
    );

/*testimonial selection from page options */
require get_template_directory().'/inc/customizer/testimonial-section/from-page.php';

/*testimonial options */
require get_template_directory().'/inc/customizer/testimonial-section/testimonial-options.php';
