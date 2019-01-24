<?php
/**
* Returns word count of the sentences.
*
* @since clean-biz 1.0.0
*/
if ( ! function_exists( 'clean_biz_words_count' ) ) :
	function clean_biz_words_count( $length = 25, $clean_biz_content = null ) {
		$length = absint( $length );
		$source_content = preg_replace( '`\[[^\]]*\]`', '', $clean_biz_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;
	}
endif;