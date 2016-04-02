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
            $yeah_group = !empty($instance['group_deals']) ? $instance['group_deals'] : '';

            $module = new YeahWooDealsAdminModule();
            $posts = $module->yeah_get_data_widget($yeah_group);
            $current_datetimes = date('Y/m/d H:i:s');
            while ( $posts->have_posts() ) {
                $posts->the_post();
                $meta_fields = get_post_custom($posts->ID);
                $dates = ( isset( $meta_fields['_yeah_woo_dates'] ) )? unserialize( $meta_fields['_yeah_woo_dates'][0] ) : "";
                $date_now = date( 'Y/m/d H:i:s' );
                $date_start = date( $dates['start'] );
                $date_end = date( $dates['end'] );

                $date_countdown = $dates['end'];
                $_extra_class = array();
                $_extra_data = array('date_start' => $dates['start'],
                    'date_end' => $dates['end'],
                    'view' => 'list');

                if( $date_start > $current_datetimes ) {
                    array_push( $_extra_class, 'wa-product-not-start' );
                    $date_countdown = $dates['start'];
                    $_extra_data['status'] = 'close';
                }else {
                    $_extra_data['status'] = 'open';
                }
                ?>
                <div class="yeah-weekend-deals-widget-top">
                    <img src="<?php echo yeah_woo_deals()->acess_url; ?>/images/weekend-deals.png">
                    <h3 class="museo_slab_500">25% - 90% off</h3>
                </div>
                <!--Start CountDown-->
                <!---->
                <div class="yeah-countdown-content">
                    <h2 class="yeah-title-countdown"><?php echo esc_html__('Time Left','yeah-woo-deals') ?></h2>
                    <div class="countdown yeah-countdown-inner" data-extradata="<?php echo esc_attr( json_encode( $_extra_data ) ); ?>" data-datatime="<?php echo "{$date_countdown}"; ?>"  data-format='<div>%-d<span>day%!d</span></div><div>%H<span>hrs</span></div><div>%M<span>min</span></div><div>%S<span>sec</span></div>'>
                        <div class="clock"></div>
                    </div>
                </div>
                <!--End CountDown-->
                <?php
            }

            ?>

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
            $title = !empty($instance['title']) ? $instance['title'] : '';
            $group_deals = !empty($instance['group_deals']) ? $instance['group_deals'] : '';
            $image_title = !empty($instance['image_title']) ? $instance['image_title'] : yeah_woo_deals()->acess_url.'/images/weekend-deals.png';

            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'yeah-woo-deals' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'group_deals' ); ?>"><?php esc_html_e( 'Woo Deals Group:', 'yeah-woo-deals' ); ?></label>
                <?php $model = new YeahWooDealsAdminModule();
                $groups = $model->yeah_get_group_widget();
                var_dump($this->get_field_name( 'group_deals'));
                ?>
                <?php if($groups){?>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'group_deals' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'group_deals')).'[]'; ?>" multiple="multiple">
                        <?php foreach($groups as $group):?>
                            <option value="<?php $group->id?>"><?php echo $group->name; ?></option>
                        <?php endforeach;?>
                </select>
                <?php } else { ?>
                    <a href="admin.php?page=yeah-woo-deals-groups"><?php echo esc_html__('Create Group Deals','yeah-woo-deals')?></a>
                <?php } ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'image_title' ); ?>"><?php esc_html_e( 'Image Title:', 'yeah-woo-deals' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'image_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'image_title' )); ?>" type="text" value="<?php echo esc_attr( $image_title ); ?>">
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
            $instance['group_deals'] = (! empty($new_instance['group_deals'])) ? strip_tags($new_instance['group_deals']) : '';
            $instance['image_title'] = (! empty($new_instance['image_title'])) ? strip_tags($new_instance['image_title']) : '';

            return $instance;
        }
    }
}
add_action( 'widgets_init', function(){
    register_widget( 'Yeah_Woo_Deal_widget' );
});