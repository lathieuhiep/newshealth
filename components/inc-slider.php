<?php
$gallery_ids = newshealth_get_general_slider();

if ( !empty( $gallery_ids ) ) :
?>

<div class="slider-main lSSlideCustom">
    <div class="slider-main__warp owl-carousel owl-theme">
        <?php foreach ( $gallery_ids as $gallery_item_id ): ?>
            <div class="item">
                <?php echo wp_get_attachment_image( $gallery_item_id, 'full' ); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
endif;