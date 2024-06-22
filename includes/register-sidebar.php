<?php
// Remove gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');

/* Better way to add multiple widgets areas */
function newshealth_widget_registration($name, $id, $description = ''): void {
	register_sidebar( array(
		'name' => $name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
}

function newshealth_multiple_widget_init(): void {
	newshealth_widget_registration( esc_html__('Sidebar Main', 'newshealth'), 'sidebar-main' );
	newshealth_widget_registration( esc_html__('Sidebar Post', 'newshealth'), 'sidebar-post', esc_html__('Display sidebar on post.', 'newshealth') );

    // sidebar footer
    $opt_number_columns = newshealth_get_option('opt_footer_columns', '4');

    for ( $i = 1; $i <= $opt_number_columns; $i++ ) {
        newshealth_widget_registration( esc_html__('Sidebar Footer Column ' . $i, 'newshealth'), 'sidebar-footer-column-' . $i );
    }
}

add_action('widgets_init', 'newshealth_multiple_widget_init');