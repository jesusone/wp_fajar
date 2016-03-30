<?php
if (! defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}
if (! class_exists('Yeah_Woo_Deal_widget')) {

    class Yeah_Woo_Deal_widget extends WP_Widget
    {

        function __construct()
        {

            parent::__construct('yeah_deals_widget', esc_html__('Yeah Deals', 'yeah-woo-deals'), array(
                'description' => esc_html__('Yeah Deals Widget.', 'yeah-woo-deals')
            ));
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance)
        {
            echo $args['before_widget'];

            if (! empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            }
            $module = new YeahWooDealsAdminModule();
            $result = $module->yeah_get_data_widget();
           ?>
            <li class="wa-countdown-content">
                <span class="countdown wa-countdown-inner" data-extradata="<?php echo esc_attr( json_encode( $_extra_data ) ); ?>" data-datatime="<?php echo "{$date_countdown}"; ?>" data-format="%-w week%!w %-d day%!d %H:%M:%S">
                    <span class="clock"></span>
                </span>
            </li>
            <?php
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $title = ! empty($instance['title']) ? $instance['title'] : '';

            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'yeah-woo-deals' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <?php
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance)
        {
            $instance = array();
            $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

            return $instance;
        }
    }
}
add_action( 'widgets_init', function(){
    register_widget( 'Yeah_Woo_Deal_widget' );
});