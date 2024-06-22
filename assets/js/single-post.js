( function( $ ) {
    "use strict";

    $(window).on('load', function () {
        const imageOverlay = $('.single-post-content__detail img.image-overlay');

        if ( imageOverlay.length ) {
            imageOverlay.each(function () {
                $(this).parent('p').replaceWith('<div class="box-image-overlay">' + $(this).parent('p').html() + '</div>');
            })
        }
    });
} )( jQuery );