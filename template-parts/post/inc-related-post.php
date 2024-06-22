<?php
$term_ids  = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

if ( !empty( $term_ids ) ):
	$limit = newshealth_get_option('opt_post_single_related_limit', 6);

    $arg = array(
        'post_type' => 'post',
        'cat' => $term_ids,
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => $limit,
    );

    $query = new WP_Query($arg);

    if ($query->have_posts()) :
    ?>
        <div class="related-posts">
            <div class="related-posts__top">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" viewBox="0 0 22 16" fill="none">
                      <path d="M2.74919 4.06885C2.24319 4.06885 1.83252 4.36751 1.83252 4.73551C1.83252 5.10351 2.24319 5.40218 2.74919 5.40218H19.2492C19.7552 5.40218 20.1659 5.10351 20.1659 4.73551C20.1659 4.36751 19.7552 4.06885 19.2492 4.06885H2.74919ZM2.74919 7.40218C2.24319 7.40218 1.83252 7.70085 1.83252 8.06885C1.83252 8.43685 2.24319 8.73551 2.74919 8.73551H19.2492C19.7552 8.73551 20.1659 8.43685 20.1659 8.06885C20.1659 7.70085 19.7552 7.40218 19.2492 7.40218H2.74919ZM2.74919 10.7355C2.24319 10.7355 1.83252 11.0342 1.83252 11.4022C1.83252 11.7702 2.24319 12.0688 2.74919 12.0688H19.2492C19.7552 12.0688 20.1659 11.7702 20.1659 11.4022C20.1659 11.0342 19.7552 10.7355 19.2492 10.7355H2.74919Z" fill="white"/>
                    </svg>
                </div>

                <h3 class="title mb-0">
	                <?php esc_html_e('BÀI VIẾT LIÊN QUAN', 'newshealth'); ?>
                </h3>
            </div>

            <div class="grid-layout">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                ?>
                    <div class="item">
                        <div class="related-post-item">
                            <?php if (has_post_thumbnail()) : ?>
                                <figure class="post-image mb-2">
                                    <?php the_post_thumbnail('large'); ?>
                                </figure>
                            <?php endif; ?>

                            <h4 class="title-post">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    <?php
    endif;
endif;