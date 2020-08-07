/* ------------------------------------
Template Name: Maken
Description: Responsive HTML5 / CSS3 Template
Version: 1.0
-------------------------------------- */

(function ($) {

    "use strict";

    $(document).ready(function () {

        // Bootstrap 4 Popover
        $('[data-toggle="popover"]').popover();

        // Bootstrap 4 Tooltip
        $('[data-toggle="tooltip"]').tooltip();


        // Remove PlaceHolder.
        function placeHolder() {
            $('input,textarea').focus(function () {
                $(this).data('placeholder', $(this).attr('placeholder'))
                    .attr('placeholder', '');
            }).blur(function () {
                $(this).attr('placeholder', $(this).data('placeholder'));
            });
        }
        placeHolder();


        function stickyHeader() {
            var $window = $(window);
            var lastScrollTop = 0;
            var $header = $('#header');
            var headerBottom = $header.position().top + $header.outerHeight(true);

            $window.scroll(function () {

                var windowTop = $window.scrollTop();

                // Add custom sticky class 
                if (windowTop >= 200) {
                    $header.addClass('header-sticky');
                } else {
                    $header.removeClass('header-sticky');
                    $header.removeClass('header-show');
                }

                // Show/hide
                if ($header.hasClass('header-sticky')) {
                    if (windowTop <= 200 || windowTop < lastScrollTop) {
                        $header.addClass('header-show');
                    } else {
                        $header.removeClass('header-show');
                    }
                }

                lastScrollTop = windowTop;

            });
        }
        stickyHeader();

        // Sticky Sidebar
        $('#sidebar').stickySidebar({
            topSpacing: 40,
            bottomSpacing: 40
        });

        $('#new_ad_list').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 9500,
            margin: 30,
            nav: true,
            rtl: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: false,
                    dots: true,
                    margin: 0,

                },
                600: {
                    items: 2,
                    nav: false,
                    dots: true,
                    margin: 0,
                },
                1000: {
                    items: 4,
                    dots: false,
                    nav: true,
                    loop: true
                }
            }
        });

        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            rtl:true,
            thumbItem: 5
        });

        $('#show_password').click(function () {
            if ('password' == $('.password-input').attr('type')) {
                $('.password-input').prop('type', 'text');
            } else {
                $('.password-input').prop('type', 'password');
            }
        });


    });
})(jQuery);
