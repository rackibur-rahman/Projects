<?php
global $clean_biz_panels;
/*creating panel for fonts-setting*/
$clean_biz_panels['clean-biz-home-team'] =
    array(
        'title'          => __( 'Team Section', 'clean-biz' ),
        'priority'       => 175
    );


/*team selection from page options */
require get_template_directory().'/inc/customizer/team-section/from-page.php';

/*team selection from custom options */
require get_template_directory().'/inc/customizer/team-section/team-options.php';