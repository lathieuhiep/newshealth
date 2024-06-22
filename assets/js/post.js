( function( $ ) {
    "use strict";

    $( document ).ready( function () {
        // handle sticky sidebar
        handleStickySidebar()
    })

    // handle sticky sidebar
    const handleStickySidebar = () => {
        $('.site-sidebar').stickySidebar({
            containerSelector: '.post-row',
            innerWrapperSelector: '.site-sidebar__inner',
            resizeSensor: true,
            topSpacing: 20,
            bottomSpacing: 20
        })
    }

} )( jQuery );