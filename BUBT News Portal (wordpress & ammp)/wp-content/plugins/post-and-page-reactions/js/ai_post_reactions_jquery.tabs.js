/**
 * ai_post_reaction Tabs jQuery Plugin
 * Author: Alex Chizhov
 * Author Website: http://alexchizhov.com/ai_post_reactiontabs
 * GitHub: https://github.com/alexchizhovcom/ai_post_reactiontabs
 * Version: 1.4.0
 * Version from: 06.03.2016
 * Licensed under the MIT license
 */
;
(function ($, window, document, undefined)
{

    var pluginName = "ai_post_reaction_tabs",
            defaults = {
                effect: 'scale', // You can change effects of your tabs container: scale / slideleft / slideright / slidetop / slidedown / none
                defaultTab: 1, // The tab we want to be opened by default
                containerWidth: '100%', // Set custom container width if not set then 100% is used
                tabsPosition: 'horizontal', // Tabs position: horizontal / vertical
                horizontalPosition: 'top', // Tabs horizontal position: top / bottom
                verticalPosition: 'left', // Tabs vertical position: left / right
                responsive: false, // BETA: Make tabs container responsive: true / false - boolean
                theme: '', // Theme name, you can add your own and define it here. This way you dont have to change default CSS. theme: 'name' - string
                rtl: false                  // Right to left support: true/ false
            };


    function Plugin(element, options)
    {
        this.element = $(element);
        this.$elem = $(this.element);
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }


    Plugin.prototype = {
        // Constructing Tabs Plugin
        init: function ()
        {

            // Array of effects @1.3.0
            var arEffects = [
                'scale',
                'slideleft',
                'slideright',
                'slidetop',
                'slidedown',
                'none'
            ];

            // Variable for our selector @1.3.0
            var selector = this.$elem;

            // Tabs variable @1.4.0
            var tabs = selector.children('[data-ai_post_reaction-tab]');

            // Add class to our selector
            selector.addClass('ai_post_reaction_tabs_list');

            // Place selector into container @1.2.0
            selector.wrap('<div class="ai_post_reaction_tabs_container"></div>');

            // Container variable @1.3.0
            var container = selector.closest('.ai_post_reaction_tabs_container');


            /*
             * Settings: container width
             * Default: 100%
             */
            if (this.settings.containerWidth !== '100%')
                container.css('width', this.settings.containerWidth);
            

            /*
             * Settings: Position
             * Default: horizontal
             */
            if (this.settings.tabsPosition == 'vertical') {
                
                /* 
                 * We need to check if current container is nested, 
                 * if so, add width style equals to parents tab width
                 * @1.4.0
                 */
                if (container.closest('.ai_post_reaction_tab_single').length) {
                    var parentWidth = container.closest('.ai_post_reaction_tab_single').innerWidth()

                    container.css('width', parentWidth);
                }
                
                this.settings.verticalPosition == 'left'
                        ? container.addClass('ai_post_reaction_tabs_vertical ai_post_reaction_tabs_vertical_left')
                        : container.addClass('ai_post_reaction_tabs_vertical ai_post_reaction_tabs_vertical_right');

            } else {

                this.settings.horizontalPosition == 'top'
                        ? container.addClass('ai_post_reaction_tabs_horizontal ai_post_reaction_tabs_horizontal_top')
                        : container.addClass('ai_post_reaction_tabs_horizontal ai_post_reaction_tabs_horizontal_bottom');

            }


            /*
             * Settings: Right to left support
             * Default: false
             */
            if (this.settings.rtl)
                container.addClass('ai_post_reaction_tabs_rtl');


            /*
             * Settings: If effect is none
             */
            if (this.settings.effect == 'none')
                container.addClass('ai_post_reaction_tabs_noeffect');


            /*
             * Settings: Theme
             * Default: ''
             */
            if (this.settings.theme)
                container.addClass(this.settings.theme);


            /*
             * Check if effect exists @1.3.0
             * If effect doesnt exist add scale by default
             */
            if ($.inArray(this.settings.effect, arEffects) >= 0)
                container.addClass('ai_post_reaction_' + this.settings.effect);
            else
                container.addClass('ai_post_reaction_scale');


            /*
             * Hide tabs content @1.4.0
             */
            tabs.addClass('ai_post_reaction_hide').hide();



            /*
             * Add controlls
             */
            if (this.settings.tabsPosition == 'vertical') {

                this.settings.verticalPosition == 'left'
                        ? container.prepend('<ul class="ai_post_reaction_tabs_controll"></ul>')
                        : container.append('<ul class="ai_post_reaction_tabs_controll"></ul>');

            } else { // Horizontal

                this.settings.horizontalPosition == 'top'
                        ? container.prepend('<ul class="ai_post_reaction_tabs_controll"></ul>')
                        : container.append('<ul class="ai_post_reaction_tabs_controll"></ul>');

            }


            // Controlls variable @1.4.0
            var controlls = container.children('.ai_post_reaction_tabs_controll');
            
            
            /*
             * Create Tabs controlls for each Tab 
             * (div with HTML5 data attribute)
             */
            var counter = 1;
            tabs.each(function () {

                // Set Data attributes with tab id number 1+
                $(this).attr('data-ai_post_reaction-tab-id', counter);

                // Tab Id @1.3.0
                var id = $(this).data('ai_post_reaction-tab');

                // Tab Title @1.3.0
                var title = $(this).data('ai_post_reaction-tab-name');

                // Add LIs and A controls
                controlls.append('<li><a data-tab-id="' + id + '">' + title + '</a></li>');

                // Adding class to our selector children (Tabs)
                $(this).addClass('ai_post_reaction_tab_single');

                counter++;

            });


            // Controller variable @1.3.0
            var controller = controlls.find('a');

            // Controller li variable @1.3.0
            var controllerLi = controlls.find('li');

            // Default tab variable @1.4.0
            var defaultTab = selector.children('[data-ai_post_reaction-tab-id="' + this.settings.defaultTab + '"]');


            /*
             * Check if a controller has icon data @1.1.4
             */
            selector.children('[data-ai_post_reaction-tab-icon]').each(function () {

                var tabId = $(this).attr('data-ai_post_reaction-tab');
                var tabName = $(this).attr('data-ai_post_reaction-tab-name');
                var iconData = $(this).attr('data-ai_post_reaction-tab-icon');

                // If no tab name is set
                if (tabName == '') {
                    controlls.find('[data-tab-id="' + tabId + '"]')
                            .addClass('ai_post_reaction_tab_noname');
                }

                // Add icon to the tab
                controlls.find('[data-tab-id="' + tabId + '"]')
                        .prepend('<i class="fa ' + iconData + '"></i>');

            });


            /**
             * Width and height settings for verticaly positioned tabs
             */
            if (this.settings.tabsPosition == 'vertical') {
                var coefficient = container.innerWidth() / 450;
                var letterSize = parseInt(controller.css('font-size')) / coefficient; // @1.4.0
                var controllerPaddings = parseInt(controller.css('padding-left')) + parseInt(controller.css('padding-right')); // @1.4.0.
                var verticalTabsWidth = controller.html().length*letterSize+controllerPaddings; // @1.4.0
                var verticalTabsHeight = controlls.outerHeight();
                var verticalContentWidth = container.outerWidth() - verticalTabsWidth;
                var verticalContentHeight = selector.outerHeight();
                
                // Set tabs width
                controlls.width(verticalTabsWidth);

                // Set content width
                selector.outerWidth(verticalContentWidth);

                /*
                 * if selectors height less than controlls height
                 * make selector the same height as controlls
                 */
                if (verticalContentHeight < verticalTabsHeight)
                    selector.css('min-height', verticalTabsHeight);

            }


            // Show default tab @1.4.0
            defaultTab.addClass('ai_post_reaction_show').show();


            /* 
             * Add active class to default tabs controller
             */
            controlls.find('[data-tab-id="' + defaultTab.data('ai_post_reaction-tab') + '"]')
                    .addClass('ai_post_reaction_tab_active');



            /*
             * Controller click function
             */
            controller.on('click', function (e) {

                // Prevent use of href attribute;
                e.preventDefault();

                // Remove active class from all controllers
                controller.removeClass('ai_post_reaction_tab_active');
                // Add active class to current controller
                $(this).addClass('ai_post_reaction_tab_active');

                var tabId = $(this).data('tab-id');
                var currentTab = selector.children('[data-ai_post_reaction-tab="' + tabId + '"]');

                // Add an effect to a tab on click @1.4.0
                tabs.removeClass('ai_post_reaction_show');

                setTimeout(function () {
                    tabs.hide();
                    currentTab.show();
                }, 400);

                setTimeout(function () {
                    currentTab.addClass('ai_post_reaction_show');
                }, 450);

            });






            /**
             * ###########################################################
             * CODE TO MAKE TABS RESPONSIVE @1.2.0
             * ###########################################################
             */

            if (this.settings.responsive) {

                // Add Responsive class to Tabs container
                container.addClass('ai_post_reaction_tabs_responsive');

                // Lets count LI's
                var ai_aioResponsiveControllLiCounter = parseInt(controlls.children('li').length);

                var ai_aioResponsiveControllLiPercentage = 100 / ai_aioResponsiveControllLiCounter;

                // Get highest LI
                var ai_aioResponsiveControllLiMaxHeight = Math.max.apply(null, controllerLi.map(function () {
                    return $(this).height();
                }).get());


                $(window).on('resize load', {pluginSettings: this.settings}, function (e) {

                    var $pluginSettings = e.data.pluginSettings;
                    var tabsPosition = $pluginSettings.tabsPosition;
                    var containerWidth = $pluginSettings.containerWidth;

                    // Check window width if less than 60em ( 960px ) then:
                    if ($(window).width() <= 960) {

                        // Remove container width style
                        container.width('');

                        // Add width to LIs
                        controllerLi.css('width', ai_aioResponsiveControllLiPercentage + '%');

                        // Add height to each LIs
                        controller.each(function () {
                            $(this).height(ai_aioResponsiveControllLiMaxHeight);
                        });

                        // If vertical, make it horizontal
                        if (tabsPosition == 'vertical') {
                            controlls.width('');
                            selector.width('');
                            selector.css('min-height', '');
                            selector.height(defaultTab.height());
                        }

                    }
                    if ($(window).width() <= 600) {
                        if (container.find('.ai_post_reaction_responsive_small_menu').length < 1) {
                            // Add new button to trigger tabs menu
                            $('<div class="ai_post_reaction_responsive_small_menu"><a data-visible="0"><i class="fa fa-bars"></i></a></div>').insertBefore(controlls);
                        }

                        // Add new class to UL controll
                        controlls.addClass('ai_post_reaction_tabs_menu_popup');

                        controller.height('');
                        controllerLi.width('');

                        // Hide popup menu
                        container.find('ul.ai_post_reaction_tabs_menu_popup').hide();

                        // Popup tabs menu trigger
                        container.find('.ai_post_reaction_responsive_small_menu a').click(function (e) {
                            e.preventDefault();
                            // We will add data atribute and check it 0/1
                            if ($(this).attr('data-visible') == '0') {
                                container.find('ul.ai_post_reaction_tabs_menu_popup').show();
                                $(this).attr('data-visible', '1');
                            } else {
                                container.find('ul.ai_post_reaction_tabs_menu_popup').hide();
                                $(this).attr('data-visible', '0');
                            }
                        });

                        // Hide menu on tab pick
                        container.find('ul.ai_post_reaction_tabs_menu_popup li a').on('click', function (e) {
                            e.preventDefault();
                            $(this).closest('.ai_post_reaction_tabs_menu_popup').hide();
                            container.find('.ai_post_reaction_responsive_small_menu a').attr('data-visible', '0');
                        });

                    } else if ($(window).width() > 960) {
                        container.css('width', containerWidth);
                        controllerLi.width('');
                        controller.height('');
                        container.find('.ai_post_reaction_responsive_small_menu').remove();
                        controlls.removeClass('ai_post_reaction_tabs_menu_popup');
                        controlls.show();
                    } else if ($(window).width() > 600) {
                        // Remove 600px screen menu
                        container.find('.ai_post_reaction_responsive_small_menu').remove();
                        controlls.removeClass('ai_post_reaction_tabs_menu_popup');
                        controlls.show();
                        controller.on('click', function (e) {
                            e.preventDefault();
                            $(this).parent().parent().show();
                        });
                    }
                });

            } // EOF: IF RESPONSIVE


        } // Init function END

    };



    $.fn[pluginName] = function (options) {
        return this.each(function () {
            new Plugin(this, options);
        });
    };


})(jQuery, window, document);