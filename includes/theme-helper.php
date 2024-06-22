<?php
//
add_filter("use_block_editor_for_post_type", "disable_gutenberg_editor");
function disable_gutenberg_editor()
{
	return false;
}

// get version theme
function newshealth_get_version_theme(): string {
	return wp_get_theme()->get( 'Version' );
}

// check is blog
function newshealth_is_blog (): bool {
	return ( is_archive() || is_category() || is_tag() || is_author() || is_home() || is_search() );
}

// Callback Comment List
function newshealth_comments( $newshealth_comment, $newshealth_comment_args, $newshealth_comment_depth ): void
{
	if ( $newshealth_comment_args['style'] == 'div' ) :
		$newshealth_comment_tag       = 'div';
		$newshealth_comment_add_below = 'comment';
	else :
		$newshealth_comment_tag       = 'li';
		$newshealth_comment_add_below = 'div-comment';
	endif;

?>
	<<?php echo $newshealth_comment_tag ?> <?php comment_class( empty( $newshealth_comment_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

        <?php if ( 'div' != $newshealth_comment_args['style'] ) : ?>

		<div id="div-comment-<?php comment_ID() ?>" class="comment__body">

        <?php endif; ?>
            <div class="author vcard">
                <div class="author__avatar">
	                <?php if ( $newshealth_comment_args['avatar_size'] != 0 ) {
		                echo get_avatar( $newshealth_comment, $newshealth_comment_args['avatar_size'] );
	                } ?>
                </div>

                <div class="author__info">
                    <span class="name"><?php comment_author_link(); ?></span>

                    <span class="date"><?php comment_date(); ?></span>
                </div>
            </div>

            <?php if ( $newshealth_comment->comment_approved == '0' ) : ?>
                <div class="awaiting">
                    <?php esc_html_e( 'Your comment is awaiting moderation.', 'newshealth' ); ?>
                </div>
            <?php endif; ?>

            <div class="content">
	            <?php comment_text(); ?>
            </div>

            <div class="action">
	            <?php edit_comment_link( esc_html__( 'Edit ', 'newshealth' ) ); ?>

	            <?php comment_reply_link( array_merge( $newshealth_comment_args, array(
		            'add_below' => $newshealth_comment_add_below,
		            'depth'     => $newshealth_comment_depth,
		            'max_depth' => $newshealth_comment_args['max_depth']
	            ) ) ); ?>
            </div>

	    <?php if ( $newshealth_comment_args['style'] != 'div' ) : ?>

		</div>

    <?php
        endif;
}

// Content Nav
function newshealth_comment_nav(): void {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
?>
	<nav class="navigation comment-navigation">
		<h2 class="screen-reader-text">
			<?php esc_html_e( 'Comment navigation', 'newshealth' ); ?>
		</h2>

		<div class="nav-links">
			<?php
			if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'newshealth' ) ) ) :
				printf( '<div class="nav-previous">%s</div>', $prev_link );
			endif;

			if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'newshealth' ) ) ) :
				printf( '<div class="nav-next">%s</div>', $next_link );
			endif;
			?>
		</div>
	</nav>
<?php
	endif;
}

// Pagination
function newshealth_pagination(): void {
	the_posts_pagination( array(
		'type'               => 'list',
		'mid_size'           => 2,
		'prev_text'          => '<<',
		'next_text'          => '>>',
		'screen_reader_text' => '&nbsp;',
	) );
}

// Pagination Nav Query
function newshealth_paging_nav_query( $query ): void {

	$args = array(
		'prev_text' => esc_html__( ' Previous', 'newshealth' ),
		'next_text' => esc_html__( 'Next', 'newshealth' ),
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $query->max_num_pages,
		'type'      => 'list',
	);

	$paginate_links = paginate_links( $args );

	if ( $paginate_links ) :

		?>
		<nav class="pagination">
			<?php echo $paginate_links; ?>
		</nav>

	<?php

	endif;
}

// Get col global
function newshealth_col_use_sidebar( $option_sidebar, $active_sidebar ): string
{
	if ( $option_sidebar != 'hide' && is_active_sidebar( $active_sidebar ) ):

		if ( $option_sidebar == 'left' ) :
			$class_position_sidebar = ' order-1 order-md-2';
		else:
			$class_position_sidebar = ' order-1';
		endif;

		$class_col_content = 'col-12 col-md-8 col-lg-8' . $class_position_sidebar;
	else:
		$class_col_content = 'col-md-12';
	endif;

	return $class_col_content;
}

function newshealth_col_sidebar(): string
{
	return 'col-12 col-md-4 col-lg-4';
}

// Post Meta
function newshealth_post_meta(): void {
	?>

	<div class="post-meta">
        <div class="post-meta__item">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <rect x="2.5" y="5" width="15" height="12.5" rx="2" stroke="#969C9F" stroke-width="2"/>
                    <path d="M3.3335 9.16669H16.6668" stroke="#969C9F" stroke-width="2" stroke-linecap="round"/>
                    <path d="M7.5 13.3333H12.5" stroke="#969C9F" stroke-width="2" stroke-linecap="round"/>
                    <path d="M6.6665 2.5L6.6665 5.83333" stroke="#969C9F" stroke-width="2" stroke-linecap="round"/>
                    <path d="M13.3335 2.5L13.3335 5.83333" stroke="#969C9F" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>

            <div class="content">
	            <?php esc_html_e( 'Ngày đăng: ', 'newshealth' ); the_date(); ?>
            </div>
        </div>
	</div>

	<?php
}

// Link Pages
function newshealth_link_page(): void {

	wp_link_pages( array(
		'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'newshealth' ),
		'after'       => '</div>',
		'link_before' => '<span class="page-number">',
		'link_after'  => '</span>',
	) );

}

// Get Category Check Box
function newshealth_check_get_cat( $type_taxonomy ): array
{
	$cat_check = array();
	$category  = get_terms(
		array(
			'taxonomy'   => $type_taxonomy,
			'hide_empty' => false
		)
	);

	if ( isset( $category ) && ! empty( $category ) ):
		foreach ( $category as $item ) {
			$cat_check[ $item->term_id ] = $item->name;
		}
	endif;

	return $cat_check;
}

// Get Contact Form 7
function newshealth_get_form_cf7(): array {
	$options = array();

	if ( function_exists('wpcf7') ) {

		$wpcf7_form_list = get_posts( array(
			'post_type' => 'wpcf7_contact_form',
			'numberposts' => -1,
		) );

		$options[0] = esc_html__('Select a Contact Form', 'newshealth');

		if ( !empty($wpcf7_form_list) && !is_wp_error($wpcf7_form_list) ) :
			foreach ( $wpcf7_form_list as $item ) :
				$options[$item->ID] = $item->post_title;
			endforeach;
		else :
			$options[0] = esc_html__('Create a Form First', 'newshealth');
		endif;

	}

	return $options;
}

function newshealth_preg_replace_ony_number($string): string|null
{
    $number = '';

    if (!empty( $string )) {
        $number = preg_replace('/[^0-9]/', '', strip_tags( $string ) );
    }

    return $number;
}

// create meta post views count
function newshealth_add_post_views_count_field($post_id): void {
    add_post_meta($post_id, 'post_views_count', 0, true);
}
add_action('publish_post', 'newshealth_add_post_views_count_field');

// update post views count
function newshealth_update_post_views_count(): void {
    $post_id = get_the_ID();

    if ($post_id) {
        $current_views = (int)get_post_meta($post_id, 'post_views_count', true);
        update_post_meta($post_id, 'post_views_count', $current_views + 1);
    }
}