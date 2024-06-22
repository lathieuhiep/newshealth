/**
 * Custom js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let timer_clear;

    $( document ).ready( function () {
        // handle click show submenu on mobile
        handleClickShowSubmenuOnMobile()

        // handle dropdown category widget
        handleDropdownCategoryWidget()

        // handle slider manin
        handleSliderMain()

        // handle click zalo
        handleZaLoClick()
    })

    // loading
    $( window ).on( "load", function() {
        // handle remove loading page after loaded successfully
        handleRemoveLoadingPage()
    })

    /*
    ** Function
    * */

    // handle remove loading page after loaded successfully
    const handleRemoveLoadingPage = () => {
        const siteLoading = $( '#site-loading' )

        if ( siteLoading.length ) {
            siteLoading.remove()
        }
    }

    // handle click show submenu on mobile
    const handleClickShowSubmenuOnMobile = () => {
        const subMenuToggle = $('.sub-menu-toggle')

        if ( subMenuToggle.length ) {
            subMenuToggle.each(function () {
                $(this).on( 'click', function () {
                    const widthScreen = $(window).width()

                    if ( widthScreen < 992 ) {
                        $(this).toggleClass('active')
                        $(this).closest( '.menu-item-has-children' ).siblings().find( subMenuToggle ).removeClass( 'active' )
                        $(this).parent().children( '.sub-menu' ).slideToggle()
                        $(this).parents( '.menu-item-has-children' ).siblings().find( '.sub-menu' ).slideUp()
                    }
                } )
            })
        }
    }

    // handle dropdown category widget
    const handleDropdownCategoryWidget = () => {
        // handle show cate current
        const cateItemLink = $('.categories-dropdown-widget .cat-item__link')
        if ( cateItemLink.length ) {
            cateItemLink.each(function () {
                const hasClassCurrent = $(this).hasClass('current-cate')

                if ( hasClassCurrent ) {
                    const catItemParent = $(this).closest('.cat-item-parent')

                    catItemParent.children('.cate-link-has-child').addClass('active')
                    catItemParent.children( '.children' ).slideDown()
                }
            })
        }

        // handle slideToggle
        const cateLinkHasChildWidget = $('.categories-dropdown-widget .cate-link-has-child')
        if ( cateLinkHasChildWidget.length ) {
            cateLinkHasChildWidget.each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault()

                    $(this).toggleClass('active')
                    $(this).closest( '.cat-item' ).siblings().find(cateLinkHasChildWidget).removeClass( 'active' )
                    $(this).parent().children( '.children' ).slideToggle()
                    $(this).parents( '.cat-item-has-child' ).siblings().find('.children').slideUp();
                })
            })
        }
    }

    // handle slider main
    const handleSliderMain = () => {
        const sliderMain = $('.slider-main__warp')

        if ( sliderMain.length ) {
            sliderMain.each(function () {
                $(this).owlCarousel({
                    items: 1,
                    loop: true,
                    dots: false,
                    autoplay: true,
                    autoplaySpeed: 800,
                    dragEndSpeed: 800
                })
            })
        }
    }

    // handle check mobile device
    const isMobileDevice = () => {
        return /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)
    }

    // handle click zalo
    const handleZaLoClick = () => {
        const chatWithUsZalo = $('.chat-with-us__zalo')

        if ( chatWithUsZalo.length ) {
            chatWithUsZalo.on('click', function (e) {
                e.preventDefault()

                let link;
                const phone = $(this).data('phone')
                const qrCode = $(this).data('qr-code')

                if ( isMobileDevice() ) {
                    if (navigator.userAgent.includes('Android')) {
                        // android
                        link = `https://zaloapp.com/qr/p/${qrCode}`;
                    } else {
                        // ios
                        link = `zalo://qr/p/${qrCode}`;
                    }
                } else {
                    // pc
                    link = `zalo://conversation?phone=${phone}`
                }

                window.open(link, '_parent');
            })
        }
    }
} )( jQuery );