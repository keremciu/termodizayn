$('document').ready(function(){

    $(".currency-usd").currency({
        region: "USD",
        convertFrom: "TRY",
        thousands: ".",
        decimals: 3,
        decimal: ".",
        convertLoading: " ",
        convertLocation: "./convert.php"
    });
    $(".currency-eur").currency({
        region: "EUR",
        convertFrom: "TRY",
        thousands: ".",
        decimals: 3,
        decimal: ".",
        convertLoading: " ",
        convertLocation: "./convert.php"
    });

    // Form Validations
    $(".forgot-password-form").validate({
        // submitHandler: function(form) {
        //     form.submit();
        // }
    });

    $(".register-form").validate({
        ignore: [],
        rules: {
            usercountry: {
                errorPlacement: function(element) {
                    $(element).parent().find('.sbHolder').addClass('error-selectbox');
                },
            }
        }
    });
    
    // FastClick
    FastClick.attach(document.body);

    // Mobile Menu
    $(".mobile-nav-button").on("click", function() {
        $(this).toggleClass('isActive').next().slideToggle(300);
        $('body').removeClass('mobileUserBoxOpened').toggleClass('mobileMenuOpened');

        if ($('body').is('.mobileMenuOpened')) {
            $('.overlay--mobile').show();
        } else {
            $('.overlay--mobile').hide();
        }

        $(".mobile-sign-in-button").removeClass('isActive').next().hide();
    });

    $(".mobile-sign-in-button").on("click", function() {
        $(this).toggleClass('isActive').next().slideToggle(300);        
        $('body').removeClass('mobileMenuOpened').toggleClass('mobileUserBoxOpened');

        if ($('body').is('.mobileUserBoxOpened')) {
            $('.overlay--mobile').show();
        } else {
            $('.overlay--mobile').hide();
        }

        $(".mobile-nav-button").removeClass('isActive').next().hide();
    });

    $('.overlay--mobile').click(function(){
        $(this).hide();
        $('body').removeClass('mobileUserBoxOpened mobileMenuOpened');
        $(".mobile-nav-button, .mobile-sign-in-button").removeClass('isActive');
        $('.mobile-nav-frame, .user-box--mobile').fadeOut(200);
    });

    // Sidebar Menu Toggle
    $('.sidebar-title').on('click', function() {
        var sidebarMenu = $(this).next('ul');

        if(false == sidebarMenu.is(':visible')) {
            $('.sidebar-title').next('ul').slideUp(300);
        }
        sidebarMenu.stop().slideToggle(300);
    });

    

    // Split Product Content
    $('#product-summary').readmore({
        moreLink: '<a href="" class="detail-info_readmore">Devamını Gör</a>',
        lessLink: '<a href="" class="detail-info_readmore">Gizle</a>',
        collapsedHeight: 85,
        embedCSS: false
    });

    // bxSlider
    $('.site-slider').bxSlider({
        speed: 400,
        swipeThreshold: 100,
        oneToOneTouch: false
    });

    $('.references-slider').bxSlider({
        slideWidth: 160,
        maxSlides: 7,
        minSlides: 2,
        oneToOneTouch: false
    });

    var detailSlide = $('.detail-slider').bxSlider({
        oneToOneTouch: false,
        pagerCustom: '#detail-pager',
        onSliderLoad: function(currentIndex){
            $('.detail-slider li').eq(1).addClass('active-slide');
        },
        onSlideBefore: function(){
            $('.detail-slider li').removeClass('active-slide');
        },
        onSlideAfter: function($slideElement){
            $slideElement.addClass('active-slide');
        }
    });

    var windowWidth    = $(window).width(),
        slideNews      = $('.news-slider'),
        slideCatalog   = $('.home-catalog');

    if (windowWidth < 991) {

        slideNews.bxSlider({
            oneToOneTouch: false
        });

        slideCatalog.bxSlider({
            slideWidth: 240,
            oneToOneTouch: false
        });

        detailSlide.bxSlider({
            oneToOneTouch: false
        });

        $('#product-summary').readmore({
            moreLink: '<a href="" class="detail-info_readmore">Devamını Gör</a>',
            lessLink: '<a href="" class="detail-info_readmore">Gizle</a>',
            collapsedHeight: 75,
            embedCSS: false
        });

    }

    // Masked Inputs
    $("#filter-textbox").mask("9999", {placeholder:""});
    $("#user-gsm").mask("9999 999 99 99", {placeholder:""});

    // Detail Current Photo Set
    $('.detail-photo-zoom').click(function() {
        var activeSlideData = $('.detail-slider .active-slide').data('href');
        $(this).attr('href', activeSlideData);
    });

    // Magnific Popup
    $('.detail-photo-zoom, .news-detail_gallery').magnificPopup({
        type:'image',
        tLoading: 'Yükleniyor...',
        gallery: {
            enabled: true
        },
        image : {
            tError: 'Resim Yüklenemedi',
        }
    });

    $('.news-detail-gallery').magnificPopup({
        type:'image',
        delegate: 'a',
        tLoading: 'Yükleniyor...',
        gallery: {
            enabled: true
        },
        image : {
            tError: 'Resim Yüklenemedi',
        }
    });

    $('.detail-video').magnificPopup({
        type: 'iframe',
    });

    // Homepage Machines Category
    $('.home-category-button--all').on('click', function() {
        var $this           = $(this),
            $overlay        = $('.overlay'),
            $button         = $('.home-category-button--all'),
            parentContainer = $this.parents('.category-container');

        if (parentContainer.is('.isActive')) {
            $overlay.hide();
            parentContainer.removeClass('isActive');
            $button.removeClass('isActive');
        }
        else {
            $overlay.show();
            $button.removeClass('isActive');
            $this.addClass('isActive');
            $('.category-container').removeClass('isActive');
            parentContainer.addClass('isActive');
            // Hide Active Categories
            $('body').click(function(){
                $overlay.hide();
                $('.category-container').removeClass('isActive');
                $button.removeClass('isActive');
            });
            $('.category-container').click(function(event){
                event.stopPropagation();
            });
        }
    });

    // Product List Image Change
    $('.product-list_item').on('mouseenter', function() {
        var $this           = $(this),
            dataPhoto       = $this.data("photo"),
            dataTitle       = $this.attr("title"),
            dataSource       = $this.data("sourcepath"),
            $categoryPhoto  = $this.parents('.home-category').find('.home-category_image');

        $categoryPhoto.attr({
            src: dataSource + dataPhoto,
            alt: dataTitle
        });

    });

    // Range Water
    $("#range-water").noUiSlider({
        start: 23,
        step: 1,
        range: {
        min: 0,
        max: 35
        }
    }).noUiSlider_pips({
        mode: 'values',
        density: 6,
        values: [3, 32],
        stepped: true,
        format: wNumb({
            decimals: 0,
            postfix: '℃'
        })
    }).on('set', function (event, value) {
        if (value < 3) {
            $(this).val(3);
        } else if (value > 32) {
            $(this).val(32);
        }
    });

    // Range Ambient
    $("#range-ambient").noUiSlider({
        start: 32,
        step: 1,
        range: {
            min: -18,
            max: 47
        }
    }).noUiSlider_pips({
      mode: 'values',
      density: 5,
      values: [-15, 44],
      stepped: true,
      format: wNumb({
        decimals: 0,
        postfix: '℃'
      })
    }).on('set', function (event, value) {
        if (value < -15) {
            $(this).val(-15);
        } else if (value > 44) {
            $(this).val(44);
        }
    });

    $(".range").Link('lower').to('-inline-<div class="tooltip"></div>', function (value) {
      $(this).html('<span>' + roundingNumvers(value) + "℃" + '</span>');
    });

    function roundingNumvers(value) {
      value = value | 0;
      return value;
    }

});

$(document).on('click', 'a[href=""], a[href^="#"]', function (e) {
    e.preventDefault();
});