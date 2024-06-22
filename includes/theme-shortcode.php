<?php
// short code title has icon
add_shortcode('title_has_icon' , 'newshealth_title_has_icon');
function newshealth_title_has_icon ($args): false|string {
	ob_start();
	?>
    <div class="title-has-icon">
        <h2 class="title-has-icon__text"><?php echo esc_html( $args['title'] ); ?></h2>
    </div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

/*
 * short code image overlay
 * */

// Add button to the editor
add_action('media_buttons', 'newshealth_button_add_image_overlay');
function newshealth_button_add_image_overlay(): void {
	echo '<a href="#" id="btn-add-image-overlay" class="button">'. esc_html__('Thêm Ảnh Làm Mờ', 'newshealth') .'</a>';
}

// shortcode image overlay
add_shortcode('image_overlay', 'newshealth_image_overlay_shortcode');
function newshealth_image_overlay_shortcode ($args): false|string {
	ob_start();
?>
    <div class="image-overlay-box">
        <!-- Your image editor content goes here -->
    </div>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// short code contact us
add_shortcode('single_contact_us' , 'newshealth_shortcode_contactus');
function newshealth_shortcode_contactus(): bool|string {
	ob_start();

	get_template_part( 'components/inc','post-contact-us' );

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}