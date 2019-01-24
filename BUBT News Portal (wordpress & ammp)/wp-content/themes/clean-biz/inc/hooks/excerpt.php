<?php
if( ! function_exists( 'clean_biz_excerpt_length' ) && ! is_admin() ) :

    /**
     * Excerpt length
     *
     * @since  clean-biz 1.0.0
     *
     * @param null
     * @return int
     */
    function clean_biz_excerpt_length( $length ){
        global $clean_biz_customizer_all_values;
        $excerpt_length = $clean_biz_customizer_all_values['clean-biz-excerpt-length'];
        if ( empty( $excerpt_length) ) {
            $excerpt_length = $length;
        }
        return absint( $excerpt_length );

    }

add_filter( 'excerpt_length', 'clean_biz_excerpt_length', 999 );
endif;