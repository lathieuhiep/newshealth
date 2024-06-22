<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class newshealth_working_time_widget extends WP_Widget {
    /* Widget setup */
    public function __construct() {
        $newshealth_working_time_widget_ops = array(
            'classname'     =>  'working-time-widget',
            'description'   =>  esc_html__( 'A widget that displays', 'newshealth' ),
        );

        parent::__construct( 'working-time-widget', 'My Theme: Thời gian làm việc', $newshealth_working_time_widget_ops );
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
        <div class="widget-warp">
            <div class="work-box">
                <div class="time">
                    <span class="time__box"><?php echo esc_html($instance['open_hours']); ?></span>
                    <span class="time__box"><?php echo esc_html($instance['open_minute']); ?></span>
                </div>

                <div class="time">
                    <span class="time__box"><?php echo esc_html($instance['closed_hours']); ?></span>
                    <span class="time__box"><?php echo esc_html($instance['closed_minute']); ?></span>
                </div>
            </div>

            <div class="note text-center mt-4">
                <?php esc_html_e('Tất cả các ngày, cả chủ nhật, lễ', 'newshealth'); ?>
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
            'title' => esc_html__('Thời gian làm việc', 'newshealth'),
            'open_hours' => '07',
            'open_minute' => '30',
            'closed_hours' => '20',
            'closed_minute' => '00',
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

            <input class="widefat" id="<?php echo $this->get_field_id( 'open_hours' ); ?>" name="<?php echo $this->get_field_name( 'open_hours' ); ?>" value="<?php echo $instance['open_hours']; ?>" style="margin-bottom: 12px" />

            <input class="widefat" id="<?php echo $this->get_field_id( 'open_minute' ); ?>" name="<?php echo $this->get_field_name( 'open_minute' ); ?>" value="<?php echo $instance['open_minute']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'closed_hours' ); ?>">
                <?php esc_html_e( 'Giờ đóng cửa phòng khám:', 'newshealth' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'closed_hours' ); ?>" name="<?php echo $this->get_field_name( 'closed_hours' ); ?>" value="<?php echo $instance['closed_hours']; ?>" style="margin-bottom: 12px" />

            <input class="widefat" id="<?php echo $this->get_field_id( 'closed_minute' ); ?>" name="<?php echo $this->get_field_name( 'closed_minute' ); ?>" value="<?php echo $instance['closed_minute']; ?>" />
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
        $instance['open_minute'] = strip_tags( $new_instance['open_minute'] );
        $instance['closed_hours'] = strip_tags( $new_instance['closed_hours'] );
        $instance['closed_minute'] = strip_tags( $new_instance['closed_minute'] );

        return $instance;
    }
}

// Register widget
function newshealth_working_time_widget_register(): void {
    register_widget( 'newshealth_working_time_widget' );
}

add_action( 'widgets_init', 'newshealth_working_time_widget_register' );