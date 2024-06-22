( function( $ ) {
    "use strict";

    $( document ).ready( function () {
        $('#btn-add-image-overlay').click(function (e) {
            e.preventDefault();

            // Create a media frame
            var frame = wp.media({
                title: 'Thêm media',
                button: {
                    text: 'Insert'
                },
                multiple: false  // Allow multiple selections or not
            });

            // When an image is selected, run a callback
            frame.on('select', function () {
                const attachment = frame.state().get('selection').first().toJSON()

                // You can customize the following lines to handle the selected image data as needed
                const imageSrc = attachment.url
                const imageAlt = attachment.alt
                const imageWidth = attachment.width
                const imageHeight = attachment.height

                // Insert the image HTML into the editor
                insertImageHTML(imageSrc, imageAlt, imageWidth, imageHeight)
            });

            // Open the media frame
            frame.open()
        })

        // Function to insert the image HTML into the editor
        function insertImageHTML(imageSrc, imageAlt, imageWidth, imageHeight) {
            // Create the image HTML
            const imageHTML = '<img class="image-overlay" src="' + imageSrc + '" alt="' + imageAlt + '" width="' + imageWidth + '" height="' + imageHeight + '">'

            // Insert the image HTML into the editor
            wp.media.editor.insert(imageHTML);
        }
    })
} )( jQuery );