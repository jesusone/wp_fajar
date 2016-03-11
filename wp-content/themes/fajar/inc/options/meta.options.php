<?php
/**
 * Meta options
 *
 * @author ZoTheme
 * @since 1.0.0
 */
class ZOMetaOptions
{
	public function __construct()
	{
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
		add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
	}
	/* add script */
	function admin_script_loader()
	{
		global $pagenow;
		if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
			wp_enqueue_style('metabox', get_template_directory_uri() . '/inc/options/css/metabox.css');

			wp_enqueue_script('easytabs', get_template_directory_uri() . '/inc/options/js/jquery.easytabs.min.js');
			wp_enqueue_script('metabox', get_template_directory_uri() . '/inc/options/js/metabox.js');
		}
	}
	/* add meta boxs */
	public function add_meta_boxes()
	{
		$this->add_meta_box('template_page_options', __('Setting', 'creativ'), 'page');
		$this->add_meta_box('testimonial_options', __('Testimonial about', 'creativ'), 'testimonial');
		$this->add_meta_box('pricing_options', __('Pricing Option', 'creativ'), 'pricing');
		$this->add_meta_box('team_options', __('Team About', 'creativ'), 'team');
		$this->add_meta_box('portfolio_options', __('Portfolio About', 'creativ'), 'portfolio');
	}

	public function add_meta_box($id, $label, $post_type, $context = 'advanced', $priority = 'default')
	{
		add_meta_box('_zo_' . $id, $label, array($this, $id), $post_type, $context, $priority);
	}
	/* --------------------- PAGE ---------------------- */
	function template_page_options() {
		?>
		<div class="tab-container clearfix">
			<ul class='etabs clearfix'>
				<li class="tab"><a href="#tabs-general"><i class="fa fa-server"></i><?php _e('General', 'creativ'); ?></a></li>
				<li class="tab"><a href="#tabs-header"><i class="fa fa-diamond"></i><?php _e('Header', 'creativ'); ?></a></li>
				<li class="tab"><a href="#tabs-page-title"><i class="fa fa-connectdevelop"></i><?php _e('Page Title', 'creativ'); ?></a></li>
			</ul>
			<div class='panel-container'>
				<div id="tabs-general">
					<?php
					zo_options(array(
						'id' => 'full_width',
						'label' => __('Full Width','creativ'),
						'type' => 'switch',
						'options' => array('on'=>'1','off'=>''),
					));
					?>
				</div>
				<div id="tabs-header">
					<?php
					/* header. */
					zo_options(array(
						'id' => 'header',
						'label' => __('Header','creativ'),
						'type' => 'switch',
						'options' => array('on'=>'1','off'=>''),
						'follow' => array('1'=>array('#page_header_enable'))
					));
					?>  <div id="page_header_enable"><?php
						zo_options(array(
							'id' => 'header_layout',
							'label' => __('Layout','creativ'),
							'type' => 'imegesselect',
							'options' => array(
								'' => get_template_directory_uri().'/inc/options/images/header/header-1.png',
							)
						));
						zo_options(array(
							'id' => 'header_margin',
							'label' => __('Header Margin','creativ'),
							'type' => 'text',
						));
						zo_options(array(
							'id' => 'header_padding',
							'label' => __('Header Padding','creativ'),
							'type' => 'text',
						));
						zo_options(array(
							'id' => 'header_logo',
							'label' => __('Logo','creativ'),
							'type' => 'image'
						));
						/*
						 * Custom main menu color
						 */
						zo_options(array(
							'id' => 'enable_header_menu',
							'label' => __('Custom Header Menu Color','creativ'),
							'type' => 'switch',
							'options' => array('on'=>'1','off'=>''),
							'follow' => array('1'=>array('#page_header_menu_enable'))
						));
						?> <div id="page_header_menu_enable"><?php
							zo_options(array(
								'id' => 'header_menu_color',
								'label' => __('Menu Color - First Level','creativ'),
								'type' => 'color',
								'default' => ''
							));
							zo_options(array(
								'id' => 'header_menu_color_hover',
								'label' => __('Menu Hover - First Level','creativ'),
								'type' => 'color',
								'default' => ''
							));
							zo_options(array(
								'id' => 'header_menu_color_active',
								'label' => __('Menu Active - First Level','creativ'),
								'type' => 'color',
								'default' => ''
							));
							?> </div><?php
						/*
						 * Custom menu color for header fixed
						 */
						zo_options(array(
							'id' => 'enable_header_fixed',
							'label' => __('Header Fixed','creativ'),
							'type' => 'switch',
							'options' => array('on'=>'1','off'=>''),
							'follow' => array('1'=>array('#page_header_fixed_enable'))
						));
						?> <div id="page_header_fixed_enable"><?php
							zo_options(array(
								'id' => 'header_fixed_bg_color',
								'label' => __('Header Fixed - Background Color','creativ'),
								'type' => 'color',
								'default' => '#fff',
								'rgba' => true
							));
							zo_options(array(
								'id' => 'header_fixed_menu_color',
								'label' => __('Header Fixed - Menu Color - First Level','creativ'),
								'type' => 'color',
								'default' => ''
							));
							zo_options(array(
								'id' => 'header_fixed_menu_color_hover',
								'label' => __('Header Fixed - Menu Hover Color - First Level','creativ'),
								'type' => 'color',
								'default' => ''
							));
							zo_options(array(
								'id' => 'header_fixed_menu_color_active',
								'label' => __('Header Fixed - Menu Active Color - First Level','creativ'),
								'type' => 'color',
								'default' => ''
							));
							?> </div><?php
						$menus = array();
						$menus[''] = 'Default';
						$obj_menus = wp_get_nav_menus();
						foreach ($obj_menus as $obj_menu){
							$menus[$obj_menu->term_id] = $obj_menu->name;
						}
						$navs = get_registered_nav_menus();
						foreach ($navs as $key => $mav){
							zo_options(array(
								'id' => $key,
								'label' => $mav,
								'type' => 'select',
								'options' => $menus
							));
						}
						?>
					</div>
				</div>
				<div id="tabs-page-title">
					<?php
					/* page title. */
					zo_options(array(
						'id' => 'page_title',
						'label' => __('Page Title','creativ'),
						'type' => 'switch',
						'options' => array('on'=>'1','off'=>''),
						'follow' => array('1'=>array('#page_title_enable'))
					));
					?>  <div id="page_title_enable"><?php
						zo_options(array(
							'id' => 'page_title_text',
							'label' => __('Title','creativ'),
							'type' => 'text',
						));
						zo_options(array(
							'id' => 'page_title_sub_text',
							'label' => __('Sub Title','creativ'),
							'type' => 'text',
						));
						zo_options(array(
							'id' => 'page_title_margin',
							'label' => __('Page Title Margin','creativ'),
							'type' => 'text',
						));
						zo_options(array(
							'id' => 'page_title_background',
							'label' => __('Page Title Background','creativ'),
							'type' => 'image',
						));
						zo_options(array(
							'id' => 'page_title_type',
							'label' => __('Layout','creativ'),
							'type' => 'imegesselect',
							'options' => array(
								'' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
								'1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
								'2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
								'3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
								'4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
								'5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
								'6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
							)
						));
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	/* --------------------- RATING TESTIMONIAL ---------------------- */
	function testimonial_options(){
		?>
		<div class="testimonial-rating">
			<?php
			zo_options(array(
				'id' => 'testimonial_position',
				'label' => __('Client Position','creativ'),
				'type' => 'text',
			));
			?>
		</div>
	<?php
	}
	/* --------------------- PRICING ---------------------- */

	function pricing_options() {
		?>
		<div class="pricing-option-wrap">
			<table class="wp-list-table widefat fixed">
				<tr>
					<td>
						<?php
						zo_options(array(
							'id' => 'price',
							'label' => __('Price','creativ'),
							'type' => 'text',
						));

						zo_options(array(
							'id' => 'value',
							'label' => __('Value','creativ'),
							'type' => 'select',
							'options' => array(
								'Monthly' => 'Monthly',
								'Year' => 'Year'
							)
						));

						zo_options(array(
							'id' => 'color',
							'label' => __('Header Color','creativ'),
							'type' => 'color',
							'default' => ''
						));

						?>
					</td>
					<td>
						<?php
						zo_options(array(
							'id' => 'is_feature',
							'label' => __('Is feature','creativ'),
							'type' => 'switch',
							'options' => array('on'=>'1','off'=>''),
						));

						zo_options(array(
							'id' => 'button_url',
							'label' => __('Button Url','creativ'),
							'type' => 'text',
						));

						zo_options(array(
							'id' => 'button_text',
							'label' => __('Button Text','creativ'),
							'type' => 'text',
						));
						?>
					</td>
				</tr>
			</table>
		</div>
	<?php
	}
	/* --------------------- PRICING ---------------------- */

	/*-----------------------TEAM-------------------------*/
	function team_options() {
		?>

		<div class="tab-container clearfix">
			<ul class='etabs clearfix'>
				<li class="tab"><a href="#tabs-position"><i class="fa fa-server"></i><?php _e('Position', 'creativ'); ?></a></li>
			</ul>
			<div class='panel-container'>
				<div id="tabs-position">
					<?php
					zo_options(array(
						'id' => 'team_position',
						'label' => __('Position', 'creativ'),
						'type' => 'text',
						'placeholder' => '',
					));
					?>
					<?php
					zo_options(array(
						'id' => 'socials',
						'label' => __('Socials of team','creativ'),
						'type' => 'social',
					));
					?>
				</div>
			</div>
		</div>
	<?php
	}
	/*-----------------------Portfolio-------------------------*/
	function portfolio_options() {
		?>
		<div class="tab-container clearfix">
			<ul class='etabs clearfix'>
				<li class="tab"><a href="#tabs-about"><i class="fa fa-server"></i><?php _e('About', 'creativ'); ?></a></li>
				<li class="tab"><a href="#tabs-layout"><i class="fa fa-server"></i><?php _e('Layout', 'creativ'); ?></a></li>
			</ul>
			<div class='panel-container'>
				<div id="tabs-about">
					<?php
					zo_options(array(
						'id' => 'portfolio_client',
						'label' => __('Client', 'creativ'),
						'type' => 'text',
						'placeholder' => '',
					));
					zo_options(array(
						'id' => 'portfolio_date',
						'label' => __('Date', 'creativ'),
						'type' => 'date',
						'placeholder' => '',
					));
					zo_options(array(
						'id' => 'portfolio_skills',
						'label' => __('Skills', 'creativ'),
						'type' => 'text',
						'placeholder' => '',
					));
					zo_options(array(
						'id' => 'portfolio_url',
						'label' => __('URL', 'creativ'),
						'type' => 'text',
						'value' => '#',
					));
					zo_options(array(
						'id' => 'portfolio_images',
						'label' => __('Gallery', 'creativ'),
						'type' => 'images',
					));
					?>
				</div>
				<div id="tabs-layout">
					<?php
					zo_options(array(
						'id' => 'portfolio_layout',
						'label' => __('Layout', 'creativ'),
						'type' => 'select',
						'options' => array(
							'' => 'Default',
							'gallery' => 'Gallery'
						)
					));
					?>
				</div>
			</div>
		</div>


	<?php
	}
}

new ZOMetaOptions();