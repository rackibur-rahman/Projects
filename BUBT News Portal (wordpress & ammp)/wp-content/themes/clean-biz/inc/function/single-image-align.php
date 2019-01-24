<?php 
/*image alignment single post*/

if( ! function_exists( 'clean_biz_single_post_image_align' ) ) :
    /**
     * clean-biz default layout function
     *
     * @since  clean-biz 1.0.0
     *
     * @param int
     * @return string
     */
    function clean_biz_single_post_image_align( $post_id = null ){
        global $clean_biz_customizer_all_values,$post;
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $clean_biz_single_post_image_align = $clean_biz_customizer_all_values['clean-biz-single-post-image-align'];
        $clean_biz_single_post_image_align_meta = get_post_meta( $post_id, 'clean-biz-single-post-image-align', true );

        if( false != $clean_biz_single_post_image_align_meta ) {
            $clean_biz_single_post_image_align = $clean_biz_single_post_image_align_meta;
        }
        return $clean_biz_single_post_image_align;
    }
endif;