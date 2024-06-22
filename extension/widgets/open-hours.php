<?php
/**
 * Widget Name: Info Company Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class newshealth_open_hours_widget extends WP_Widget {
	/* Widget setup */
    public function __construct() {
        $newshealth_open_hours_widget_ops = array(
            'classname'     =>  'open-hours-widget',
            'description'   =>  esc_html__( 'A widget that displays', 'newshealth' ),
        );

        parent::__construct( 'open-hours-widget', 'My Theme: Thời gian hoạt động', $newshealth_open_hours_widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
	function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
    ?>
        <div class="open-hours-widget">
            <div class="open-hours-widget__warp text-center">
                <div class="item">
                    <h3 class="item__title">
			            <?php esc_html_e('Giờ mở cửa phòng khám: ', 'newshealth'); echo esc_html($instance['open_hours']); ?>
                    </h3>

                    <p class="item__note">
			            <?php echo esc_html($instance['note']); ?>
                    </p>
                </div>

                <div class="item">
                    <h3 class="item__title">
			            <?php esc_html_e('Giờ bác sĩ tư vấn: ', 'newshealth'); echo esc_html($instance['consulting_doctor']); ?>
                    </h3>

                    <p class="item__note">
			            <?php echo esc_html($instance['note']); ?>
                    </p>
                </div>
            </div>
        </div>
    <?php

        echo $args['after_widget'];
	}

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
	function form( $instance ) {
		$defaults = array(
            'title' => '',
            'open_hours' => '7h30 - 20h',
            'consulting_doctor' => '24h',
            'note' => esc_html__('(Các ngày trong tuần kể cả t7, chủ nhật, lễ tết)', 'newshealth'),
        );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php esc_html_e( 'Tiêu đề:', 'newshealth' ); ?>
            </label>

			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
            <label for="<?php echo $this->get_field_id( 'open_hours' ); ?>">
				<?php esc_html_e( 'Giờ mở cửa phòng khám:', 'newshealth' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'open_hours' ); ?>" name="<?php echo $this->get_field_name( 'open_hours' ); ?>" value="<?php echo $instance['open_hours']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'consulting_doctor' ); ?>">
				<?php esc_html_e( 'Giờ bác sĩ tư vấn', 'newshealth' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'consulting_doctor' ); ?>" name="<?php echo $this->get_field_name( 'consulting_doctor' ); ?>" value="<?php echo $instance['consulting_doctor']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'note' ); ?>">
				<?php esc_html_e( 'Lưu ý:', 'newshealth' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'note' ); ?>" name="<?php echo $this->get_field_name( 'note' ); ?>" value="<?php echo $instance['note']; ?>" />
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

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['open_hours'] = strip_tags( $new_instance['open_hours'] );
        $instance['consulting_doctor'] = strip_tags( $new_instance['consulting_doctor'] );
        $instance['note'] = strip_tags( $new_instance['note'] );

        return $instance;
    }
}

// Register widget
function newshealth_open_hours_widget_register(): void {
    register_widget( 'newshealth_open_hours_widget' );
}

add_action( 'widgets_init', 'newshealth_open_hours_widget_register' );