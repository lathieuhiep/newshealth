<?php
/**
 * Widget Name: Info Company Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class newshealth_categories_dropdown_widget extends WP_Widget {
	/* Widget setup */
	public function __construct() {
		$newshealth_categories_dropdown_widget_ops = array(
			'classname'   => 'categories-dropdown-widget',
			'description' => esc_html__( 'A widget that displays', 'newshealth' ),
		);

		parent::__construct( 'categories-dropdown-widget', 'My Theme: Danh mục bài viết', $newshealth_categories_dropdown_widget_ops );
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

		$parent_categories = get_categories( array(
			'parent'     => 0,
			'hide_empty' => true
		) );
		?>
        <ul class="widget-warp">
			<?php
			foreach ( $parent_categories as $parent_category ) :
				$this->get_list_categories($parent_category, 'cat-item-parent');
            endforeach; ?>
        </ul>
		<?php

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	function form( $instance ): void {
		$defaults = array(
			'title' => esc_html__( 'Hạng mục điều trị', 'newshealth' )
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php esc_html_e( 'Tiêu đề:', 'newshealth' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"/>
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
	function update( $new_instance, $old_instance ): array {
		$instance = array();

		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function get_list_categories( $parent_category, $class = '' ): void {
		$parent_category_id = $parent_category->term_id;

		$child_categories = get_categories( array(
			'parent'     => $parent_category->term_id,
			'hide_empty' => true,
		) );

		// check category current
		$term_current_id = 0;
		if ( is_archive() || is_category() ) {
			$category = get_queried_object();
			$term_current_id = $category->term_id;
		}
    ?>
        <li class="cat-item<?php echo esc_attr($class ? ' ' . $class : '') . esc_attr( !empty( $child_categories ) ? ' cat-item-has-child' : '' ); ?>">
            <a class="cat-item__link<?php echo esc_attr( !empty( $child_categories ) ? ' cate-link-has-child' : '' ) . esc_attr( $term_current_id == $parent_category_id ? ' current-cate' : '' ) ?>" href="<?php echo esc_url( get_category_link( $parent_category_id ) ); ?>">
				<?php echo esc_html( $parent_category->name ); ?>
            </a>

			<?php if ( !empty( $child_categories ) ) : ?>
                <div class="icon-has-child-cate">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="8" viewBox="0 0 10 8"
                         fill="none">
                        <path d="M5 8L0.669873 0.499999L9.33013 0.5L5 8Z" fill="white"/>
                    </svg>
                </div>

                <ul class="children">
                    <?php
                    foreach ( $child_categories as $child_category ) :
                        $this->get_list_categories($child_category);
                    endforeach;
                    ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php
	}
}

// Register widget
function newshealth_categories_dropdown_widget_register(): void {
	register_widget( 'newshealth_categories_dropdown_widget' );
}

add_action( 'widgets_init', 'newshealth_categories_dropdown_widget_register' );