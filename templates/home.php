<?php
/*
Template Name: Template Home
*/

get_header();
?>
<div class="tpl-home-warp">
	<div class="container">
		<div class="row post-row">
			<div class="col-12 col-md-8">
                <?php get_template_part('template-parts/tpl-home/inc','list-cate'); ?>
			</div>

			<?php if( is_active_sidebar( 'sidebar-main' ) ): ?>
                <aside class="col-12 col-md-4 site-sidebar">
                    <div class="site-sidebar__inner">
                        <?php dynamic_sidebar( 'sidebar-main' ); ?>
                    </div>
                </aside>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
get_footer();