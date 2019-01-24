<?php
/**
 * clean-biz Custom Metabox
 *
 * @package clean-biz
 */
$clean_biz_post_types = array(
    'post',
    'page'
);

add_action('add_meta_boxes', 'clean_biz_add_layout_metabox');
function clean_biz_add_layout_metabox() {
    global $post;
    $frontpage_id = get_option('page_on_front');
    if( $post->ID == $frontpage_id ){
        return;
    }

    global $clean_biz_post_types;
    foreach ( $clean_biz_post_types as $post_type ) {
        add_meta_box(
            'clean_biz_layout_options', // $id
            __( 'Layout options', 'clean-biz' ), // $title
            'clean_biz_layout_options_callback', // $callback
            $post_type, // $page
            'normal', // $context
            'high'// $priority
        );
    }

}
/* clean-biz sidebar layout */
$clean_biz_default_layout_options = array(
    'left-sidebar' => array(
        'value'     => 'left-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/left-sidebar.png'
    ),
    'right-sidebar' => array(
        'value' => 'right-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'value'     => 'no-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/no-sidebar.png'
    )
);
/* clean-biz featured layout */
$clean_biz_single_post_image_align_options = array(
    'full' => array(
        'value' => 'full',
        'label' => __( 'Full', 'clean-biz' )
    ),
    'right' => array(
        'value' => 'right',
        'label' => __( 'Right ', 'clean-biz' ),
    ),
    'left' => array(
        'value'     => 'left',
        'label' => __( 'Left', 'clean-biz' ),
    ),
    'no-image' => array(
        'value'     => 'no-image',
        'label' => __( 'No Image', 'clean-biz' )
    )
);

function clean_biz_layout_options_callback() {

    global $post , $clean_biz_default_layout_options, $clean_biz_single_post_image_align_options;
    $clean_biz_customizer_saved_values = clean_biz_get_all_options(1);

    /*clean-biz-single-post-image-align*/
    $clean_biz_single_post_image_align = $clean_biz_customizer_saved_values['clean-biz-single-post-image-align'];

    /*clean-biz default layout*/
    $clean_biz_single_sidebar_layout = $clean_biz_customizer_saved_values['clean-biz-default-layout'];

    wp_nonce_field( basename( __FILE__ ), 'clean_biz_layout_options_nonce' );
    ?>
    <table class="form-table page-meta-box">
        <!--Image alignment-->
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'clean-biz' ); ?></em></td>
        </tr>
        <tr>
            <td>
                <?php
                $clean_biz_single_sidebar_layout_meta = get_post_meta( $post->ID, 'clean-biz-default-layout', true );
                if( false != $clean_biz_single_sidebar_layout_meta ){
                   $clean_biz_single_sidebar_layout = $clean_biz_single_sidebar_layout_meta;
                }
                foreach ($clean_biz_default_layout_options as $field) {
                    ?>
                    <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                        <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="clean-biz-default-layout"
                               value="<?php echo esc_attr( $field['value'] ); ?>"
                            <?php checked( $field['value'], $clean_biz_single_sidebar_layout ); ?>/>
                        <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                            <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </label>
                    </div>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
        <tr>
            <td><em class="f13"><?php esc_html_e( 'You can set up the sidebar content', 'clean-biz' ); ?> <a href="<?php echo esc_url( admin_url('/widgets.php') ); ?>"><?php esc_html_e( 'here', 'clean-biz' ); ?></a></em></td>
        </tr>
        <!--Image alignment-->
        <tr>
            <td colspan="4"><?php esc_html_e( 'Featured Image Alignment', 'clean-biz' ); ?></td>
        </tr>
        <tr>
            <td>
                <?php
                $clean_biz_single_post_image_align_meta = get_post_meta( $post->ID, 'clean-biz-single-post-image-align', true );
                if( false != $clean_biz_single_post_image_align_meta ){
                    $clean_biz_single_post_image_align = $clean_biz_single_post_image_align_meta;
                }
                foreach ($clean_biz_single_post_image_align_options as $field) {
                    ?>
                    <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="clean-biz-single-post-image-align" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $clean_biz_single_post_image_align ); ?>/>
                    <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                        <?php echo esc_html( $field['label'] ); ?>
                    </label>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>

<?php }

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function clean_biz_save_sidebar_layout( $post_id ) {
    global $post;
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'clean_biz_layout_options_nonce' ] ) || !wp_verify_nonce( sanitize_key($_POST[ 'clean_biz_layout_options_nonce' ]), basename( __FILE__ ) ) ) {
        return;
    }

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( !current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
    }
    
    if(isset($_POST['clean-biz-default-layout'])){
        $old = get_post_meta( $post_id, 'clean-biz-default-layout', true);
        $new = sanitize_text_field(wp_unslash($_POST['clean-biz-default-layout']));
        if ($new && $new != $old) {
            update_post_meta($post_id, 'clean-biz-default-layout', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'clean-biz-default-layout', $old);
        }
    }

    /*image align*/
    if(isset($_POST['clean-biz-single-post-image-align'])){
        $old = get_post_meta( $post_id, 'clean-biz-single-post-image-align', true);
        $new = sanitize_text_field(wp_unslash($_POST['clean-biz-single-post-image-align']));
        if ($new && $new != $old) {
            update_post_meta($post_id, 'clean-biz-single-post-image-align', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'clean-biz-single-post-image-align', $old);
        }
    }
}
add_action('save_post', 'clean_biz_save_sidebar_layout');
