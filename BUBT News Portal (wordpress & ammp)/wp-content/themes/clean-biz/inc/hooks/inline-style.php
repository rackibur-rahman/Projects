<?php

if( ! function_exists( 'clean_biz_inline_style' ) ) :

    /**
     * clean-biz wp_head hook
     *
     * @since  clean-biz 1.0.0
     */
    function clean_biz_inline_style(){
      
        global $clean_biz_customizer_all_values;
        global $clean_biz_google_fonts;

        $clean_biz_background_color = get_background_color();
        $clean_biz_primary_color_option = $clean_biz_customizer_all_values['clean-biz-primary-color'];
        $clean_biz_secondary_color_option = $clean_biz_customizer_all_values['clean-biz-secondary-color'];
        $clean_biz_site_identity_color_option = $clean_biz_customizer_all_values['clean-biz-site-identity-color'];

        /*font settings*/
        $clean_biz_font_family_primary_option = $clean_biz_google_fonts[$clean_biz_customizer_all_values['clean-biz-font-family-Primary']];
        $clean_biz_font_family_site_identity_option = $clean_biz_google_fonts[$clean_biz_customizer_all_values['clean-biz-font-family-site-identity']];
        $clean_biz_font_family_title_option = $clean_biz_google_fonts[$clean_biz_customizer_all_values['clean-biz-font-family-title']];
        ?>
        <style type="text/css">
        /*=====COLOR OPTION=====*/

        /*Color*/
        /*----------------------------------*/
        /*background color*/ 
        <?php 
        if( !empty($clean_biz_background_color) ){
        ?>
          .top-header,
          .site-header{
            background-color: #<?php echo esc_attr( $clean_biz_background_color );?>;
          }
        <?php
        } 
        /*Primary*/
        if( !empty($clean_biz_primary_color_option) ){
        ?>
            section.wrapper-slider .slide-pager .cycle-pager-active,
            section.wrapper-slider .slide-pager .cycle-pager-active:visited,
            section.wrapper-slider .slide-pager .cycle-pager-active:hover,
            section.wrapper-slider .slide-pager .cycle-pager-active:focus,
            section.wrapper-slider .slide-pager .cycle-pager-active:active,
            .title-divider,
            .title-divider:visited,
            .block-overlay-hover,
            .block-overlay-hover:visited,
            #gmaptoggle,
            #gmaptoggle:visited,
            .evision-back-to-top,
            .evision-back-to-top:visited,
            .widget_calendar tbody a,
            .widget_calendar tbody a:visited,
            .wrap-portfolio .button.is-checked,
            .radius-thumb-holder,
            .radius-thumb-holder:before,
            .radius-thumb-holder:hover:before, 
            .radius-thumb-holder:focus:before, 
            .radius-thumb-holder:active:before,
            #pbCloseBtn:hover:before,
            .slide-pager .cycle-pager-active, 
            .slide-pager span:hover,
            .featurepost .latestpost-footer .moredetail a,
            .featurepost .latestpost-footer .moredetail a:visited,
            #load-wrap,
            .back-tonav,
            .back-tonav:visited,
            .wrap-service .box-container .box-inner:hover .box-content, 
            .wrap-service .box-container .box-inner:focus .box-content,
            .top-header .noticebar .notice-title,
            .top-header .timer,
            .nav-buttons,
            .widget .widgettitle:after,
            .widget .widget-title:after,
            .widget .search-form .search-submit,
            .widget .search-form .search-submit:focus,
            .main-navigation.sec-main-navigation ul li.current_page_item:before,
            .comments-area input[type="submit"],
            .slick-prev:before,
            .slick-next:before,
            .single-icon a .icon-holder:after,
            .single-icon a .hover-content,
            .section-title h2:after,
            .button,
            button,
            html input[type="button"],
            input[type="button"],
            input[type="reset"],
            input[type="submit"],
            .button:visited,
            button:visited,
            html input[type="button"]:visited,
            input[type="button"]:visited,
            input[type="reset"]:visited,
            input[type="submit"]:visited,
            .wrapper-port .single-thumb .content-area,
            .wrapper-testimonial .controls a:hover,
            .wrapper-testimonial .controls a:focus,
            .wrapper-testimonial .controls a:active,
            .evision-back-to-top,
            .evision-back-to-top:focus,
            .evision-back-to-top:visited,
            .evision-back-to-top:hover,
            .evision-back-to-top:focus,
            .evision-back-to-top:active,
            .wrapper-blog .slick-arrow,
            .wrapper-blog .carousel-group .text:after,
            .carousel-group .slick-dots .slick-active,
            .button-search-close,
            .widget .search-form .search-submit,
            .widget .search-form .search-submit:visited,
            body.woocommerce #respond input#submit, 
            body.woocommerce a.button, 
            body.woocommerce button.button, 
            body.woocommerce input.button,
            body.woocommerce #respond input#submit:focus, 
            body.woocommerce a.button:focus, 
            body.woocommerce button.button:focus, 
            body.woocommerce input.button:focus,
            body.woocommerce .cart .button, 
            body.woocommerce .cart input.button,
            body.woocommerce div.product form.cart .button,
            body.woocommerce div.product form.cart .button,
            body.woocommerce div.product form.cart .button,
            body.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
            body.woocommerce-cart .woocommerce #respond input#submit,
            body.woocommerce-cart .woocommerce a.button,
            body.woocommerce-cart .woocommerce button.button,
            body.woocommerce-cart .woocommerce input.button,
            body.woocommerce-checkout .woocommerce input.button.alt,
            .widget_calendar tbody a,
            h1.page-title:before,
            h1.entry-title:before {
              background-color: <?php echo esc_attr( $clean_biz_primary_color_option );?>;
            }

            .widget-title,
            .widgettitle,
            .wrapper-slider,
            .flip-container .front,
            .flip-container .back,
            .wrapper-about a.button,
            .widget .widgettitle, .blog article.hentry .widgettitle,
            #blog-post article.hentry .widgettitle,
            .search article.hentry .widgettitle,
            .archive article.hentry .widgettitle,
            .tag article.hentry .widgettitle,
            .category article.hentry .widgettitle,
            #ak-blog-post article.hentry .widgettitle,
            .page article.hentry .widgettitle,
            .single article.hentry .widgettitle,
            body.woocommerce article.hentry .widgettitle, body.woocommerce .site-main .widgettitle,
            .widget .widget-title, .blog article.hentry .widget-title,
            #blog-post article.hentry .widget-title,
            .search article.hentry .widget-title,
            .archive article.hentry .widget-title,
            .tag article.hentry .widget-title,
            .category article.hentry .widget-title,
            #ak-blog-post article.hentry .widget-title,
            .page article.hentry .widget-title,
            .single article.hentry .widget-title,
            body.woocommerce article.hentry .widget-title,
            body.woocommerce .site-main .widget-title{
              border-color: <?php echo esc_attr( $clean_biz_primary_color_option );?>; /*#2e5077*/
            }

            @media screen and (min-width: 768px){
            .main-navigation .current_page_item > a:after,
            .main-navigation .current-menu-item > a:after,
            .main-navigation .current_page_ancestor > a:after,
            .main-navigation li.active > a:after,
            .main-navigation li.active > a:after,
            .main-navigation li.active > a:after,
            .main-navigation li.current_page_parent a:after {
                background-color: <?php echo esc_attr( $clean_biz_primary_color_option );?>;
              }
            }

            .latestpost-footer .moredetail a,
            .latestpost-footer .moredetail a:visited,
            .single-icon a .icon-holder,
            .wrapper-about a.button,
            .team-item:hover h3 a,
            .team-item:focus h3 a,
            .team-item:active h3 a,
            .post-content .cat a{
              color: <?php echo esc_attr( $clean_biz_primary_color_option );?>;
            }
        <?php
        } 
        if( !empty($clean_biz_site_identity_color_option) ){
        ?>
            /*Site identity / logo & tagline*/
            .site-header .wrapper-site-identity .site-title a,
            .site-header .wrapper-site-identity .site-title a:visited,
            .site-header .wrapper-site-identity .site-description,
            .page-inner-title .entry-header time {
              color: <?php echo esc_attr( $clean_biz_site_identity_color_option );?>; /*#545C68*/
            }
        <?php
        }
        if( !empty($clean_biz_secondary_color_option) ){
        ?>
            /*Secondary color option goes here*/
            a:active,
            a:hover,
            .site-header .wrapper-site-identity .site-title a:hover,
            .main-navigation a:hover, .main-navigation a:focus, .main-navigation a:active, .main-navigation a:visited:hover, .main-navigation a:visited:focus, .main-navigation a:visited:active, .main-navigation ul ul a:hover, .main-navigation ul ul a:focus, .main-navigation ul ul a:active, .main-navigation ul ul a:visited:hover, .main-navigation ul ul a:visited:focus, .main-navigation ul ul a:visited:active,
            .search-holder .button-search:hover,
            .search-holder .button-search:hover i,
            .wrapper-slider .slide-item .banner-title a:hover,
            .wrapper-slider .slide-item .banner-title a:focus,
            .wrapper-slider .slide-item .banner-title a:active,
            .wrapper-slider .slide-item .banner-title a:visited:hover,
            .wrapper-slider .slide-item .banner-title a:visited:focus,
            .wrapper-slider .slide-item .banner-title a:visited:active,
            .widget li a:hover,
            .widget li a:focus,
            .widget li a:active,
            .widget li a:visited:hover,
            .widget li a:visited:focus,
            .widget li a:visited:active,
            .posted-on a:hover,
            .date a:hover,
            .cat-links a:hover,
            .tags-links a:hover,
            .author a:hover,
            .comments-link a:hover,
            .edit-link a:hover, .edit-link a:focus,
            h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
            .page-inner-title .entry-header a:hover,
            .page-inner-title .entry-header a:focus,
            .page-inner-title .entry-header a:active,
            .page-inner-title .entry-header a:visited:hover,
            .page-inner-title .entry-header a:visited:focus,
            .page-inner-title .entry-header a:visited:active,
            .page-inner-title .entry-header time:hover,
            .page-inner-title .entry-header time:focus,
            .page-inner-title .entry-header time:active,
            .page-inner-title .entry-header time:visited:hover,
            .page-inner-title .entry-header time:visited:focus,
            .page-inner-title .entry-header time:visited:active,
            .nav-links .nav-previous a:hover,
            .nav-links .nav-previous a:focus,
            .nav-links .nav-previous a:active,
            .nav-links .nav-next a:hover,
            .nav-links .nav-next a:focus,
            .nav-links .nav-next a:active,
            .nav-links .nav-previous a:hover span,
            .nav-links .nav-previous a:focus span,
            .nav-links .nav-previous a:active span,
            .nav-links .nav-next a:hover span,
            .nav-links .nav-next a:focus span,
            .nav-links .nav-next a:active span,
            .dropdown-toggle:hover,
            .dropdown-toggle:focus,
            .dropdown-toggle:active,
            .dropdown-toggle:visited:hover,
            .dropdown-toggle:visited:focus,
            .dropdown-toggle:visited:active,
            .post-content .cat a:hover,
            .post-content .cat a:focus,
            .post-content .cat a:active,
            .thumb-post .overlay-post-content a:hover,
            .thumb-post .overlay-post-content a:focus,
            .thumb-post .overlay-post-content a:active,
            .thumb-post .overlay-post-content a:visited:hover,
            .thumb-post .overlay-post-content a:visited:focus,
            .thumb-post .overlay-post-content a:visited:active,
            .site-footer .site-info a:hover,
            .site-footer .site-info a:focus,
            .site-footer .site-info a:active,
            .site-footer .site-info a:visited:hover,
            .site-footer .site-info a:visited:focus,
            .site-footer .site-info a:visited:active,
            .footer-menu a:hover,
            .footer-menu a:focus,
            .footer-menu a:active,
            .footer-menu a:visited:hover,
            .footer-menu a:visited:focus,
            .footer-menu a:visited:active {
                color: <?php echo esc_attr( $clean_biz_secondary_color_option );?>;
            }

            .search-form .search-submit:hover,
            .search-form .search-submit:focus,
            .search-form .search-submit:active,
            .button-search-close:hover,
            .button-search-close:focus,
            .button-search-close:active,
            .wrapper-slider .slide-item .btn-holder .button:hover,
            .wrapper-slider .slide-item .btn-holder .button:focus,
            .wrapper-slider .slide-item .btn-holder .button:active,
            .wrapper-callback .btn-holder .button:hover,
            .wrapper-callback .btn-holder .button:focus,
            .wrapper-callback .btn-holder .button:active,
            .button:hover,
            input[type="button"]:hover,
            input[type="reset"]:hover,
            input[type="submit"]:hover,
            button:focus input[type="button"]:focus,
            input[type="reset"]:focus,
            input[type="submit"]:focus,
            button:active,
            input[type="button"]:active,
            input[type="reset"]:active,
            input[type="submit"]:active,
            .wrapper-about .button:hover,
            .wrapper-about .button:focus,
            .wrapper-about .button:active,
            .widget .search-form .search-submit:hover,
            .widget .search-form .search-submit:focus,
            .widget .search-form .search-submit:active,
            body.woocommerce #respond input#submit:hover, 
            body.woocommerce a.button:hover, 
            body.woocommerce button.button:hover, 
            body.woocommerce input.button:hover,
            body.woocommerce div.product form.cart .button:hover,
            body.woocommerce div.product form.cart .button:focus,
            body.woocommerce div.product form.cart .button:active,
            body.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
            body.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:focus,
            body.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:active,
            body.woocommerce-cart .woocommerce #respond input#submit:hover,
            body.woocommerce-cart .woocommerce a.button:hover,
            body.woocommerce-cart .woocommerce button.button:hover,
            body.woocommerce-cart .woocommerce input.button:hover,
            body.woocommerce-checkout .woocommerce input.button.alt:hover,
            .wrapper-blog .slick-arrow:hover,
            .wrapper-blog .slick-arrow:focus,
            .wrapper-blog .slick-arrow:active,
            .button.button-outline:hover, 
            .button.button-outline:focus, 
            .button.button-outline:active,
            .button.button-outline-small:hover,
            .button.button-outline-small:focus,
            .button.button-outline-small:active,
            .button.button-outline-small:visited:hover,
            .button.button-outline-small:visited:focus,
            .button.button-outline-small:visited:active,
            .bannerbg .button.button-outline:hover,
            .bannerbg .button.button-outline:focus,
            .bannerbg .button.button-outline:active,
            .bannerbg .button.button-outline:visited:hover,
            .bannerbg .button.button-outline:visited:focus,
            .bannerbg .button.button-outline:visited:active {
                background-color: <?php echo esc_attr( $clean_biz_secondary_color_option );?>;
            }

            .wrapper-slider .slide-item .btn-holder .button:hover,
            .wrapper-slider .slide-item .btn-holder .button:focus,
            .wrapper-slider .slide-item .btn-holder .button:active,
            .wrapper-about .button:hover,
            .wrapper-about .button:focus,
            .wrapper-about .button:active,
            .button:hover,
            input[type="button"]:hover,
            input[type="reset"]:hover,
            input[type="submit"]:hover,
            button:focus input[type="button"]:focus,
            input[type="reset"]:focus,
            input[type="submit"]:focus,
            button:active,
            input[type="button"]:active,
            input[type="reset"]:active,
            input[type="submit"]:active,
            .nav-links .nav-previous a:hover,
            .nav-links .nav-previous a:focus,
            .nav-links .nav-previous a:active,
            .nav-links .nav-next a:hover,
            .nav-links .nav-next a:focus,
            .nav-links .nav-next a:active,
            .nav-links .nav-previous a:hover span,
            .nav-links .nav-previous a:focus span,
            .nav-links .nav-previous a:active span,
            .nav-links .nav-next a:hover span,
            .nav-links .nav-next a:focus span,
            .nav-links .nav-next a:active span,
            .wrapper-callback .btn-holder .button:hover,
            .wrapper-callback .btn-holder .button:focus,
            .wrapper-callback .btn-holder .button:active {
                border-color: <?php echo esc_attr( $clean_biz_secondary_color_option );?>;
            }

        <?php
        } 
        if( !empty($clean_biz_font_family_primary_option) ){
        /*=====FONT FAMILY OPTION=====*/
        ?> 
        /*Primary*/
          html,body, button, input, select, textarea, p, button, input, select, textarea, pre, code, kbd, tt, var, samp , .main-navigation a, search-input-holder .search-field,
          .widget .widgettitle, .widget .widget-title,
          .form-allowed-tags code,
          .small-right-post-content-list .entry-title a,
          .sb-round-thumb-widget .entry-title a,
          .site-header .wrapper-site-identity .site-description,
          .wrapper-slider .slide-item .banner-title a,
          .wrapper-slider .slide-item .banner-title a:visited,
          .wrapper-callback h2 {
          font-family: '<?php echo esc_attr( $clean_biz_font_family_primary_option ); ?>', 'sans-serif';
          }
        <?php
        } 

        if( !empty($clean_biz_font_family_site_identity_option) ){
        ?> 
          /*Site identity / logo & tagline*/
          .site-header .wrapper-site-identity .site-title a {
          font-family: '<?php echo esc_attr( $clean_biz_font_family_site_identity_option ); ?>', 'sans-serif';
          }
        <?php
        } 
        if( !empty($clean_biz_font_family_title_option) ){
        ?> 
          /*Title*/
          h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
          .section-title h2{
            font-family: '<?php echo esc_attr( $clean_biz_font_family_title_option ); ?>', 'cursive', 'sans-serif';
          }
        <?php
        } 
        ?>
        </style>
    <?php
    }
endif;
