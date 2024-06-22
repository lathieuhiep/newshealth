<?php
/**
 * Widget Name: Related Post
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class newshealth_related_posts_widget extends WP_Widget {
	/* Widget setup */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'related-posts-widget',
			'description' => esc_html__( 'A widget show post', 'newshealth' ),
		);

		parent::__construct( 'related-posts-widget', 'My Theme: Bài viết liên quan', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ): void {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$limit = $instance['number'] ?? 5;

		if ( !is_singular('post')) {
			return;
		}

		$term_ids  = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

		if ( empty( $term_ids ) ) {
			return;
		}

		$post_arg = array(
			'post_type'           => 'post',
			'cat'                 => $term_ids,
			'posts_per_page'      => $limit,
			'orderby'             => $instance['order_by'],
			'order'               => $instance['order'],
			'post__not_in'        => array( get_the_ID() ),
			'ignore_sticky_posts' => 1,
		);

		$post_query = new WP_Query( $post_arg );

		if ( $post_query->have_posts() ) :
		?>
			<div class="related-posts-widget__list recent-post-widget__list">
				<?php
				while ( $post_query->have_posts() ) :
					$post_query->the_post();
					?>
					<div class="post">
						<div class="image">
							<?php
							if ( has_post_thumbnail() ):
								the_post_thumbnail( 'medium' );
							else:
								?>
								<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ); ?>"
								     alt="post">
							<?php endif; ?>
						</div>

						<div class="content">
							<h4 class="title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
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
		<?php
		endif;

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	function form( $instance ) {

		$defaults = array(
			'title' => esc_html__('Bài viết liên quan', 'newshealth'),
			'order' => 'DESC'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$number     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$order      = $instance['order'];
		$order_by   = $instance['order_by'] ?? 'ID';

		$terms = get_terms( array(
			'taxonomy' => 'category',
			'orderby'  => 'id'
		) );

		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'newshealth' ); ?>
			</label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"/>
		</p>

		<!-- Start Order -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
				<?php esc_html_e( 'Order:', 'newshealth' ); ?>
			</label>

			<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"
			        name="<?php echo $this->get_field_name( 'order' ) ?>" class="widefat">
				<option value="ASC" <?php echo ( $order == 'ASC' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'ASC', 'newshealth' ); ?>
				</option>

				<option value="DESC" <?php echo ( $order == 'DESC' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'DESC', 'newshealth' ); ?>
				</option>
			</select>
		</p>

		<!-- Start OrderBy -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>">
				<?php esc_html_e( 'Order:', 'newshealth' ); ?>
			</label>

			<select id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"
			        name="<?php echo $this->get_field_name( 'order_by' ) ?>" class="widefat">
				<option value="ID" <?php echo ( $order_by == 'ID' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'ID', 'newshealth' ); ?>
				</option>

				<option value="date" <?php echo ( $order_by == 'date' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'Date', 'newshealth' ); ?>
				</option>

				<option value="title" <?php echo ( $order_by == 'title' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'Title', 'newshealth' ); ?>
				</option>

				<option value="rand" <?php echo ( $order_by == 'rand' ) ? 'selected' : ''; ?>>
					<?php esc_html_e( 'Rand', 'newshealth' ); ?>
				</option>
			</select>
		</p>

		<!-- Start Number Post Show -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
				<?php esc_html_e( 'Number of posts to show:', 'newshealth' ); ?>
			</label>

			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" class="tiny-text"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1"
			       value="<?php echo esc_attr( $number ); ?>" size="3"/>
		</p>

		<?php

	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['order']      = $new_instance['order'];
		$instance['order_by']   = $new_instance['order_by'];
		$instance['number']     = (int) $new_instance['number'];

		return $instance;
	}

}

// Register widget
function newshealth_related_posts_widget_register() {
	register_widget( 'newshealth_related_posts_widget' );
}

add_action( 'widgets_init', 'newshealth_related_posts_widget_register' );