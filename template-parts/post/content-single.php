<?php
$show_related = newshealth_get_option('opt_post_single_related', '1');
?>

<div id="post-<?php the_ID() ?>" class="single-post-content">
    <?php get_template_part( 'components/inc', 'breadcrumbs' ); ?>

    <h1 class="single-post-content__title f-family-body mt-5">
		<?php the_title(); ?>
    </h1>

	<?php newshealth_post_meta(); ?>

    <div class="single-post-content__detail">
		<?php the_content(); ?>
    </div>
</div>

<?php
get_template_part( 'components/inc','comment-form' );

if ( $show_related == '1' ) :
    get_template_part( 'template-parts/post/inc','related-post' );
endif;