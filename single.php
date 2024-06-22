<?php
get_header();

$sidebar = newshealth_get_option('opt_post_single_sidebar_position', 'right');
$class_col_content = newshealth_col_use_sidebar( $sidebar, 'sidebar-post' );
?>

<div class="site-container single-post-warp">
    <div class="container">
        <div class="row post-row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();
                    newshealth_update_post_views_count();
                    get_template_part( 'template-parts/post/content','single' );
                    endwhile;
                endif;
                ?>
            </div>

            <?php
            if ( $sidebar !== 'hide' ) :
	            get_sidebar('post');
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

