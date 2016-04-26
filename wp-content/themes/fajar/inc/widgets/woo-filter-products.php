<?php
class Yeah_Woo_Filter_Products extends WP_Widget {

	var $size;  // size attr
	var $categories; // number of current plugin version
	var $colour;  // number of posts to show in the widget
	var $price;  // width of the thumbnail
	function __construct() {
		$this->plugin_slug  = 'yeah-filter-products';
        parent::__construct(
            $this->plugin_slug, // Base ID
            __('Yeah  Filter Products', 'fajar'), // Name
            array('description' => __('show filter products woomence', 'fajar'),) // Args
        );
		$this->categories  = 'all';
		$this->size  = null;
		$this->colour  = null;
		$this->price = null;
	}

	function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( $this->plugin_slug, 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		if ( isset( $cache[ $args[ 'widget_id' ] ] ) ) {
			echo do_shortcode($cache[ $args[ 'widget_id' ] ]);
			return;
		}

		ob_start();
		extract( $args );

		$title = ( ! empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$categories		= ( ! empty( $instance[ 'categories' ] ) ) ? absint( $instance[ 'categories' ] ) : $this->categories;
		$size 		= ( ! empty( $instance[ 'size' ] ) ) ? absint( $instance[ 'size' ] ) : $this->size;
		$colour 		= ( ! empty( $instance[ 'colour' ] ) ) ? absint( $instance[ 'colour' ] ) : $this->colour;
		$price 		= ( ! empty( $instance[ 'price' ] ) ) ? $instance[ 'price' ] : $this->price;
		$show_cat		= isset( $instance[ 'show_cat' ] ) ? $instance[ 'show_cat' ] : false;
		$show_size 			= isset( $instance[ 'show_size' ] ) ? $instance[ 'show_size' ] : false;
		$show_price 		= isset( $instance[ 'show_price' ] ) ? $instance[ 'show_price' ] : false;
		$show_colour		= isset( $instance[ 'show_colour' ] ) ? $instance[ 'show_colour' ] : false;


		// sanitizes vars
		if ( ! $categories ) 	$categories = $this->categories ;
		if ( ! $size )	$size = $this->size;
		if ( ! $colour )	$colour = $this->colour;
		if ( ! $price )	$price = $this->price;


		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 1.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */


		?>
		<?php echo do_shortcode($before_widget); ?>
		<?php if ( $title ) echo do_shortcode($before_title) . do_shortcode($title) . do_shortcode($after_title); ?>

		<?php echo do_shortcode($after_widget); ?>
<?php
		/*Displays Filter*/
		?>
		<div class="sort-widget">
			<form action="?<?php echo $_GET['page_id'];?>" class="form-sort" method="GET">
				<div class="sort-widget-headings clearfix">

					<div class="sort-devices-heading">
						<?php echo esc_html__('Sort Product','fajar')?>
					</div>

					<div class="show-desktop">

						<div class="col-md-3">
							<span> <?php echo esc_html__('categories','fajar')?></span>
						</div>
						<div class="col-md-3">
							<span><?php echo esc_html__('size','fajar')?></span>
						</div>
						<div class="col-md-3">
							<span><?php echo esc_html__('colour','fajar')?></span>
						</div>
						<div class="col-md-3">
							<span><?php echo esc_html__('BY PRICE','fajar')?></span>
						</div>

					</div>

					<div class="clearfix"></div>

					<div class="sort-widget-options" id="sort-widget-options">
						<?php
						$product_cat = get_terms( 'product_cat', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
						$cart_slug = isset($_GET["product_cat"]) ? $_GET["product_cat"] : '';
						?>
						<div class="col-md-3">
							<span class="mobile-heading"><?php echo esc_html__('categories','fajar')?></span>
							<?php  if(!empty($product_cat)):?>
								<?php  foreach($product_cat as $cat):?>
									<span class="clearfix"><input <?php echo $cart_slug == $cat->term_id ? "checked" : "" ?> type="checkbox" name="product_cat" value="<?php echo $cat->term_id; ?>" id="option1"> <label for="option1"><?php echo esc_html($cat->name);?></span>
								<?php  endforeach;?>
							<?php  endif;?>
						</div>

						<div class="col-md-3">
							<?php
							$pa_size = get_terms( 'pa_size', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
							$pa_slug = isset($_GET["pa_size"]) ? $_GET["pa_size"] : '';
							?>
							<span class="mobile-heading"><?php echo esc_html__('size','fajar')?></span>
							<?php  if(!empty($pa_size)):?>
								<?php  foreach($pa_size as $size):?>
									<span class="clearfix"><input name="pa_size" type="checkbox" id="option5"> <label for="option5"><?php echo esc_html($size->name);?></label></span>
								<?php  endforeach;?>
							<?php  endif;?>
						</div>

						<div class="col-md-3">
							<?php
							$pa_colour = get_terms( 'pa_colour', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
							$pa_slug = isset($_GET["pa_colour"]) ? $_GET["pa_colour"] : '';
							?>
							<span class="mobile-heading"><?php echo esc_html__('colour','fajar')?></span>
							<?php  if(!empty($pa_colour)):?>
								<?php  foreach($pa_colour as $colour):?>
									<span class="clearfix"><input name="pa_colour" type="checkbox" id="option5"> <label for="option5"><?php echo esc_html($colour->name);?></label></span>
								<?php  endforeach;?>
							<?php  endif;?>
						</div>

						<div class="col-md-3">
							<span class="mobile-heading"><?php echo esc_html__('BY PRICE','fajar')?></span>
							<span class="clearfix"><input type="checkbox" id="option16"> <label for="option16">$0.00 - $50.00</label></span>
							<span class="clearfix"><input type="checkbox" id="option17"> <label for="option17">$100.00 - $200.00</label></span>
							<span class="clearfix"><input type="checkbox" id="option18"> <label for="option18">$200.00 - $400.00</label></span>
							<span class="clearfix"><input type="checkbox" id="option19"> <label for="option19">$400.00 - $600.00</label></span>
							<span class="clearfix"><input type="checkbox" id="option20"> <label for="option20">$50.00 - $100.00</label></span>
							<span class="clearfix"><input type="checkbox" id="option21"> <label for="option21">$600.00 - $3.000.00</label></span>
						</div>
						<div class="col-md-12">
							<input type="submit" class="btn btn default btn-fill" value="<?php echo esc_html__('Filter','fajar') ?>">
							<?php
							// Keep query string vars intact
							foreach ( $_GET as $key => $val ) {
								if ( 'pa_brand' === $key || 'submit' === $key ) {
									continue;
								}
								if ( is_array( $val ) ) {
									foreach( $val as $innerVal ) {
										echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
									}
								} else {
									echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
								}
							}
							?>
						</div>

					</div>

					<a href="" class="sort-widget-toggle-btn" id="sort-widget-toggle-btn"><i class="fa fa-caret-down"></i></a>

				</div>
			</form>
		</div>
		<?php
		/*End Displays Filter*/

		if ( ! $this->is_preview() ) {
			$cache[ $args[ 'widget_id' ] ] = ob_get_flush();
			wp_cache_set( $this->plugin_slug, $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	function update( $new_widget_settings, $old_widget_settings ) {
		$instance = $old_widget_settings;
		// sanitize user input before update
		$instance[ 'number_posts' ]	= absint( $new_widget_settings[ 'number_posts' ] );
		$instance[ 'thumb_width' ] 	= absint( $new_widget_settings[ 'thumb_width' ] );
		$instance[ 'thumb_height' ] = absint( $new_widget_settings[ 'thumb_height' ] );
		$instance[ 'title' ] 		= strip_tags( $new_widget_settings[ 'title' ]);
		$instance[ 'default_url' ] 	= strip_tags( $new_widget_settings[ 'default_url' ]);
		$instance[ 'keep_aspect_ratio' ] = isset( $new_widget_settings[ 'keep_aspect_ratio' ] ) ? (bool) $new_widget_settings[ 'keep_aspect_ratio' ] : false;
		$instance[ 'hide_title' ] 	= isset( $new_widget_settings[ 'hide_title' ] ) ? (bool) $new_widget_settings[ 'hide_title' ] : false;
		$instance[ 'show_date' ] 	= isset( $new_widget_settings[ 'show_date' ] ) ? (bool) $new_widget_settings[ 'show_date' ] : false;
		$instance[ 'show_thumb' ] 	= isset( $new_widget_settings[ 'show_thumb' ] ) ? (bool) $new_widget_settings[ 'show_thumb' ] : false;
		$instance[ 'use_default' ] 	= isset( $new_widget_settings[ 'use_default' ] ) ? (bool) $new_widget_settings[ 'use_default' ] : false;
		$instance[ 'try_1st_img' ] 	= isset( $new_widget_settings[ 'try_1st_img' ] ) ? (bool) $new_widget_settings[ 'try_1st_img' ] : false;
		$instance[ 'only_1st_img' ] = isset( $new_widget_settings[ 'only_1st_img' ] ) ? (bool) $new_widget_settings[ 'only_1st_img' ] : false;

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions[ $this->plugin_slug ]) )
			delete_option( $this->plugin_slug );

		// return sanitized current widget settings
		return $instance;
	}

	function form( $instance ) {

		$title        = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$categories  = isset( $instance[ 'categories' ] ) ? esc_attr( $instance[ 'categories' ] ) : $this->categories;
		$show_cat   = isset( $instance[ 'show_cat' ] ) ? (bool) $instance[ 'show_cat' ] : false;
		$show_size   = isset( $instance[ 'show_size' ] ) ? (bool) $instance[ 'show_size' ] : false;
		$show_price   = isset( $instance[ 'show_price' ] ) ? (bool) $instance[ 'show_price' ] : true;
		$show_colour  = isset( $instance[ 'show_colour' ] ) ? (bool) $instance[ 'show_colour' ] : false;

		
		// sanitize vars
		if ( ! $categories ) 	$categories = $this->categories ;


		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'fajar' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'categories' )); ?>"><?php _e( 'Categories:', 'fajar' ); ?></label>
		<?php  $cats = get_terms( 'product_cat', array('order'=>'asc') );?>
		<?php if(!empty($cats)): ?>
		<select name="categories" >
			<?php foreach($cats as $cat): ?>
				<option value="<?php echo esc_attr($cat->team_id);?>"><?php echo esc_html($cat->name);?></option>
			<?php endforeach; ?>
		</select>
		<?php endif; ?>
		<h4><?php _e( 'Show Options', 'fajar' ); ?>:</h4>
		<p><input class="checkbox" type="checkbox" <?php checked( $show_cat ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_cat' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_cat' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'show_cat' )); ?>"><?php _e( 'Display Categories?', 'fajar' ); ?></label></p>
		<p><input class="checkbox" type="checkbox" <?php checked( $show_size ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_size' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'show_size' )); ?>"><?php _e( 'Display Size?', 'fajar' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_price ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_price' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'hide_title' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'show_price' )); ?>"><?php _e( 'Display Price?', 'fajar' ); ?> </label> </p>
		<p><input class="checkbox" type="checkbox" <?php checked( $show_colour ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_colour' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'hide_title' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'show_colour' )); ?>"><?php _e( 'Display Colour?', 'fajar' ); ?> </label> </p>


		<p><label for="<?php echo esc_attr($this->get_field_id( 'default_url' )); ?>"><?php _e( 'URL of default thumbnail (start with http://)', 'fajar' ); ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'default_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'default_url' )); ?>" type="text" value="<?php echo esc_attr($default_url); ?>" /></p>
	<?php
	}



} 

/**
 * Register widget on init
 *
 * @since 1.0
 */
function yeah_register_woo_filter () {
	register_widget('Yeah_Woo_Filter_Products');
}
add_action('widgets_init', 'yeah_register_woo_filter');