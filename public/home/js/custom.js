(function($) {
    "use strict";
    $(".saas_testimonial_slider,.portfolio_slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        nav: true,
        navText: ['<i class="arrow_left"></i>', '<i class="arrow_right"></i>'],
        autoplay: true,
        navContainer: ".nav_container,.portfolio_slider",
        smartSpeed: 2000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
        },
    });

    /* ===== Parallax Effect===== */

    function parallaxEffect() {
        if ($(".bg-parallax").length) {
            $(".bg-parallax").parallax();
        }
    }
    parallaxEffect();

    function customeSlider() {
        var $item = $(".integration_info .integrations_item,.p_logo_inner .p_logo");
        var $firstListItem = $item.first();
        if ($(".integration_info,.p_logo_inner").length) {
            $item.first().addClass("current");
            setInterval(function() {
                var $activeListItem = $(".current");
                $activeListItem.removeClass("current");
                var $nextListItem = $activeListItem
                    .closest(".integrations_item,.p_logo")
                    .next();
                if ($nextListItem.length == 0) {
                    $nextListItem = $firstListItem;
                }
                $nextListItem.addClass("current");
            }, 2500);
        }
    }
    customeSlider();

    if ($(".testimonial_text_slider").length) {
        $(".testimonial_text_slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: ".testimonial_author_slider",
            dots: false,
            arrows: true,
            speed: 1200,
        });
    }
    if ($(".testimonial_author_slider").length) {
        $(".testimonial_author_slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            asNavFor: ".testimonial_text_slider",
            fade: true,
        });
    }

    if ($(".slider").length) {
        $(".slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            fade: true,
            autoplay: true,
            autoplaySpeed: 4000,
        });
    }

    if ($(".screen_slider").length) {
        $(".screen_slider").slick({
            dots: false,
            vertical: true,
            slidesToShow: 7,
            slidesToScroll: 1,
            arrows: false,
            verticalSwiping: true,
            centerMode: true,
            focusOnSelect: true,
            infinite: true,
            autoplay: true,
            centerPadding: "0px",
            autoplaySpeed: 1500,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 7,
                        slidesToScroll: 1,
                        centerMode: true,
                    },
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 2,
                        centerMode: true,
                    },
                },
            ],
        });
    }

    function tab_hover() {
        var tab = $(".price_tab");
        if ($(window).width() > 450) {
            if ($(tab).length > 0) {
                tab.append('<li class="hover_bg"></li>');
                if ($(".price_tab li a").hasClass("active_hover")) {
                    var pLeft = $(".price_tab li a.active_hover").position().left,
                        pWidth = $(".price_tab li a.active_hover").css("width");
                    $(".hover_bg").css({
                        left: pLeft,
                        width: pWidth,
                    });
                }
                $(".price_tab li a").on("click", function() {
                    $(".price_tab li a").removeClass("active_hover");
                    $(this).addClass("active_hover");
                    var pLeft = $(".price_tab li a.active_hover").position().left,
                        pWidth = $(".price_tab li a.active_hover").css("width");
                    $(".hover_bg").css({
                        left: pLeft,
                        width: pWidth,
                    });
                });
            }
        }
    }
    tab_hover();

    /*===== progress-bar =====*/
    function circle_progress() {
        if ($(".circle").length) {
            $(".circle").each(function() {
                $(".circle").appear(
                    function() {
                        $(".circle").circleProgress({
                            startAngle: -14.1,
                            size: 150,
                            duration: 2000,
                            easing: "circleProgressEase",
                            emptyFill: "rgb(241, 241, 241)",
                            lineCap: "round",
                            thickness: 5,
                        });
                    }, {
                        triggerOnce: true,
                        offset: "bottom-in-view",
                    }
                );
            });
        }
    }
    circle_progress();

    function counterActivator() {
        if ($(".counter").length) {
            $(".counter").counterUp({
                delay: 70,
                time: 1000,
            });
        }
    }
    counterActivator();

    //    /*----------------------------------------------------*/
    //    /*  Home Slider Bg
    //    /*----------------------------------------------------*/
    //
    //    var slider_text = $('.testimonial_author_slider');
    //    function author_slider(){
    //        if ( slider_text.length ){
    //            slider_text.owlCarousel({
    //                loop: false,
    //                margin: 0,
    //                dots: true,
    //                autoplay: true,
    //                mouseDrag: true,
    //                touchDrag: true,
    ////                animateOut: 'slideOutUp',
    ////                animateIn: 'fadeInUp',
    //                navSpeed: 500,
    //                items: 1,
    //                smartSpeed: 2500,
    //            })
    //        }
    //    }
    //    author_slider();
    //
    //    /*----------------------------------------------------*/
    //    /*  Home Slider Text
    //    /*----------------------------------------------------*/
    //    var slider_bg = $('.testimonial_text_slider');
    //    function testimonial_slider(){
    //        if ( slider_bg.length ){
    //            slider_bg.owlCarousel({
    //                loop: false,
    //                margin: 0,
    //                dots: true,
    //                autoplay: true,
    //                mouseDrag: true,
    //                touchDrag: true,
    //                items: 1,
    //                smartSpeed: 2500,
    //            })
    //        }
    //    }
    //    testimonial_slider();
    //
    //    /*----------------------------------------------------*/
    //    /*  Home Slider Next Prev
    //    /*----------------------------------------------------*/
    //    $('.home_screen_nav .testi_next').on('click', function () {
    //        slider_text.trigger('next.owl.carousel');
    //        slider_bg.trigger('next.owl.carousel');
    //    });
    //    $('.home_screen_nav .testi_prev').on('click', function () {
    //        slider_text.trigger('prev.owl.carousel');
    //        slider_bg.trigger('prev.owl.carousel');
    //    });
    //
    //    /*----------------------------------------------------*/
    //    /*  Home Slider Click
    //    /*----------------------------------------------------*/
    //    slider_text.on('translate.owl.carousel', function (property) {
    //        $('.slider_bg_inner .owl-dots:eq(' + property.page.index + ')').click();
    //    });
    //    slider_bg.on('translate.owl.carousel', function (property) {
    //        $('.text_slider_inner .owl-dots:eq(' + property.page.index + ')').click();
    //    });
    //
    //    /*----------------------------------------------------*/
    //    /*  Home Slider Drg
    //    /*----------------------------------------------------*/
    //    slider_bg.on('drag.owl.carousel',function(){
    //        slider_text.trigger('next.owl.carousel');
    //        slider_bg.trigger('next.owl.carousel');
    //    });
    //    slider_text.on('drag.owl.carousel',function(){
    //        slider_text.trigger('next.owl.carousel');
    //        slider_bg.trigger('next.owl.carousel');
    //    });

    //    $('.icon').bind('mouseenter mouseleave', function(now,e){
    //        if(e.type == 'mouseenter'){
    //            $(this).css({"transform": "translate3d(0px, " + now + "px, 0px)"});
    //        }
    ////        else{
    ////            $(this).css('background', 'red');
    ////        }
    //
    //    });

    if ($(".testimonial_slider").length) {
        $(".testimonial_img").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: ".testimonial_content",
            dots: false,
            arrows: false,
            speed: 1200,
        });
        $(".testimonial_content").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: ".testimonial_img",
            prevArrow: ".left",
            nextArrow: ".right",
        });
    }

    /*===========Portfolio isotope js===========*/
    function portfolioMasonry() {
        var portfolio = $("#work-portfolio");
        if (portfolio.length) {
            portfolio.imagesLoaded(function() {
                // images have loaded
                // Activate isotope in container
                portfolio.isotope({
                    itemSelector: ".pr_item",
                    layoutMode: "masonry",
                    filter: "*",
                    animationOptions: {
                        duration: 1000,
                    },
                    hiddenStyle: {
                        opacity: 0,
                        transform: "scale(.4)rotate(60deg)",
                    },
                    visibleStyle: {
                        opacity: 1,
                        transform: "scale(1)rotate(0deg)",
                    },
                    stagger: 0,
                    transitionDuration: "0.9s",
                    masonry: {},
                });

                // Add isotope click function
                $("#portfolio_filter div").on("click", function() {
                    $("#portfolio_filter div").removeClass("active");
                    $(this).addClass("active");

                    var selector = $(this).attr("data-filter");
                    portfolio.isotope({
                        filter: selector,
                        animationOptions: {
                            animationDuration: 750,
                            easing: "linear",
                            queue: false,
                        },
                    });
                    return false;
                });
            });
        }
    }
    portfolioMasonry();

    if ($(".payment_features_tab").length) {
        $(".tab_slider").slick({
            slidesToShow: 5,
            slidesToScroll: 5,
            asNavFor: ".tab_slider_img",
            focusOnSelect: true,
            infinite: false,
            speed: 1200,
            dots: false,
            arrows: false,
        });
        $(".tab_slider_img").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: ".tab_slider",
            dots: false,
            arrows: false,
        });
    }

    /*--------------- Start popup-js--------*/
    function popupGallery() {
        if ($(".popup-youtube").length) {
            $(".popup-youtube").magnificPopup({
                disableOn: 700,
                type: "iframe",
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false,
                mainClass: "mfp-with-zoom mfp-img-mobile",
            });
        }
    }
    popupGallery();

    //    $('.tab_slider div').on('click', function() {
    //        $('.tab_slider div').removeClass('active');
    //        $(this).addClass('active');
    //        var selector = $(this).attr('data-filter');
    //        $('.tab_slider').fadeOut(300);
    //        $('.tab_slider').fadeIn(300);
    //        setTimeout(function() {
    //            $('.tab_slider_img img').hide();
    //            $(selector).closest('.tab_slider_img img').show();
    //        }, 300);
    //        return false;
    //    });

    /*-------------------------------------------------------------------------------
	  Navbar 
	-------------------------------------------------------------------------------*/

    //* Navbar Fixed
    function navbarFixed() {
        if ($("#sticky_menu").length) {
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll) {
                    $("#sticky_menu").addClass("navbar_fixed");
                } else {
                    $("#sticky_menu").removeClass("navbar_fixed");
                }
            });
        }
    }
    navbarFixed();

    /*----------------------------------------------------*/
    /*  Custome Click Header Top
      /*----------------------------------------------------*/
    $(".cross").on("click", function() {
        $(".add_container").addClass("open");
        $(".add_container.open").css({
            "margin-top": "-35px"
        });
        return false;
    });

    //    wavify js
    function wavify() {
        if ($(".animated-waves").length) {
            $("#animated-wave-three").wavify({
                height: 35,
                bones: 5,
                amplitude: 70,
                color: "rgba(73, 69, 140, 0.4)",
                speed: 0.2,
            });

            $("#animated-wave-four").wavify({
                height: 60,
                bones: 4,
                amplitude: 90,
                color: "rgba(188, 214, 234, 0.04)",
                speed: 0.25,
            });
        }
    }
    wavify();
    /*----------------------------------------------------*/
    /*  Google map js
      /*----------------------------------------------------*/

    if ($("#mapBox").length) {
        var $lat = $("#mapBox").data("lat");
        var $lon = $("#mapBox").data("lon");
        var $zoom = $("#mapBox").data("zoom");
        var $marker = $("#mapBox").data("marker");
        var $info = $("#mapBox").data("info");
        var $markerLat = $("#mapBox").data("mlat");
        var $markerLon = $("#mapBox").data("mlon");
        var map = new GMaps({
            el: "#mapBox",
            lat: $lat,
            lng: $lon,
            scrollwheel: false,
            scaleControl: true,
            streetViewControl: false,
            panControl: true,
            disableDoubleClickZoom: true,
            mapTypeControl: false,
            zoom: $zoom,
            styles: [{
                    featureType: "water",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#dcdfe6",
                    }, ],
                },
                {
                    featureType: "transit",
                    stylers: [{
                            color: "#808080",
                        },
                        {
                            visibility: "off",
                        },
                    ],
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.stroke",
                    stylers: [{
                            visibility: "on",
                        },
                        {
                            color: "#dcdfe6",
                        },
                    ],
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#ffffff",
                    }, ],
                },
                {
                    featureType: "road.local",
                    elementType: "geometry.fill",
                    stylers: [{
                            visibility: "on",
                        },
                        {
                            color: "#ffffff",
                        },
                        {
                            weight: 1.8,
                        },
                    ],
                },
                {
                    featureType: "road.local",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#d7d7d7",
                    }, ],
                },
                {
                    featureType: "poi",
                    elementType: "geometry.fill",
                    stylers: [{
                            visibility: "on",
                        },
                        {
                            color: "#ebebeb",
                        },
                    ],
                },
                {
                    featureType: "administrative",
                    elementType: "geometry",
                    stylers: [{
                        color: "#a7a7a7",
                    }, ],
                },
                {
                    featureType: "road.arterial",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#ffffff",
                    }, ],
                },
                {
                    featureType: "road.arterial",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#ffffff",
                    }, ],
                },
                {
                    featureType: "landscape",
                    elementType: "geometry.fill",
                    stylers: [{
                            visibility: "on",
                        },
                        {
                            color: "#efefef",
                        },
                    ],
                },
                {
                    featureType: "road",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#696969",
                    }, ],
                },
                {
                    featureType: "administrative",
                    elementType: "labels.text.fill",
                    stylers: [{
                            visibility: "on",
                        },
                        {
                            color: "#737373",
                        },
                    ],
                },
                {
                    featureType: "poi",
                    elementType: "labels.icon",
                    stylers: [{
                        visibility: "off",
                    }, ],
                },
                {
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [{
                        visibility: "off",
                    }, ],
                },
                {
                    featureType: "road.arterial",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#d6d6d6",
                    }, ],
                },
                {
                    featureType: "road",
                    elementType: "labels.icon",
                    stylers: [{
                        visibility: "off",
                    }, ],
                },
                {},
                {
                    featureType: "poi",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#dadada",
                    }, ],
                },
            ],
        });
    }

    /*--------- WOW js-----------*/
    function wowAnimation() {
        new WOW({
            offset: 100,
            mobile: true,
        }).init();
    }
    wowAnimation();

    /*----------------------------------------------------*/
    /*  Go To
      /*----------------------------------------------------*/
    if ($(".scroll_btn").length > 0) {
        $(".scroll_btn").on("click", function() {
            $("html, body").animate({
                    scrollTop: 0,
                },
                600
            );
            return false;
        });
    }

    if ($(".recent_portfolio_slider").length) {
        $(".recent_portfolio_slider").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
            autoplay: true,
            speed: 1200,
            responsive: [{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });
    }

    /*------------- preloader js --------------*/

    function loader() {
        $(window).on("load", function() {
            $("#ctn-preloader").addClass("loaded");
            if ($("#ctn-preloader").hasClass("loaded")) {
                // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
                $("#preloader")
                    .delay(900)
                    .queue(function() {
                        $(this).remove();
                    });
            }
        });
    }
    loader();
})(jQuery);