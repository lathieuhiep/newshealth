<?php
// Register Back-End script
add_action('admin_enqueue_scripts', 'newshealth_register_back_end_scripts');
function newshealth_register_back_end_scripts(): void
{
	/* Start Get CSS Admin */
	wp_enqueue_style( 'admin', get_theme_file_uri( '/assets/admin/admin.css' ) );

	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}

	wp_enqueue_script('admin-custom', get_theme_file_uri( '/assets/admin/admin.js' ), array(), "1.0", true);
}

// Remove jquery migrate
add_action( 'wp_default_scripts', 'newshealth_remove_jquery_migrate' );
function newshealth_remove_jquery_migrate( $scripts ): void
{
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}

// Register Front-End Styles
add_action('wp_enqueue_scripts', 'newshealth_register_front_end');
function newshealth_register_front_end(): void
{
	// remove style gutenberg
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style( 'classic-theme-styles' );

	wp_dequeue_style('wc-blocks-style');
	wp_dequeue_style('storefront-gutenberg-blocks'); // disable storefront frontend block styles

	/** Load css **/

	// font google
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&family=Roboto:wght@400;500;700;900&display=swap', array(), null );

	// bootstrap css
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/libs/bootstrap/bootstrap.min.css' ), array(), '5.3.2' );

	// style theme
	wp_enqueue_style( 'newshealth-style', get_theme_file_uri( '/assets/css/style-theme.min.css' ), array(), newshealth_get_version_theme() );

	// style post
	if ( newshealth_is_blog() ) {
		wp_enqueue_style( 'post', get_theme_file_uri( '/assets/css/post-type/post/archive.min.css' ), array(), newshealth_get_version_theme() );
	}

	if (is_singular('post')) {
		wp_enqueue_style( 'post', get_theme_file_uri( '/assets/css/post-type/post/single.min.css' ), array(), newshealth_get_version_theme() );
	}

	// style page 404
	if ( is_404() ) {
		wp_enqueue_style( 'page-404', get_theme_file_uri( '/assets/css/page-templates/page-404.min.css' ), array(), newshealth_get_version_theme() );
	}

	/** Load js **/

	// bootstrap js
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/libs/bootstrap/bootstrap.bundle.min.js' ), array('jquery'), '5.2.3', true );

	// comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// custom js
	wp_enqueue_script( 'newshealth-custom', get_theme_file_uri( '/assets/js/custom.min.js' ), array('jquery'), newshealth_get_version_theme(), true );

    // slider main js
    if ( newshealth_is_blog() || is_singular('post') ) {
        wp_enqueue_script( 'jquery.sticky-sidebar', get_theme_file_uri( '/assets/libs/sticky-sidebar/jquery.sticky-sidebar.min.js' ), array('jquery'), '3.3.1', true );

        wp_enqueue_script( 'post', get_theme_file_uri( '/assets/js/post.min.js' ), array('jquery'), newshealth_get_version_theme(), true );
    }

	if (is_singular('post')) {
		wp_enqueue_script( 'single-post', get_theme_file_uri( '/assets/js/single-post.min.js' ), array('jquery'), newshealth_get_version_theme(), true );
	}
}