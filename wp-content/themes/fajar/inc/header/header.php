<?php
/**
 * @name : Default
 * @package : OhyeahThemes
 * @author : OhyeahThemes
 */
?>
<?php global $smof_data, $zo_meta; ?>

<!-- Header Top -->
<div id="yeah-header-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<?php if(is_active_sidebar('sidebar-2')){ dynamic_sidebar('sidebar-2'); } ?>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<?php if(is_active_sidebar('sidebar-3')){ dynamic_sidebar('sidebar-3'); } ?>
			</div>
		</div>
	</div>
</div>

<!-- Header Logo, Icon, Cart -->
<div id="yeah-header-brand">
	<div class="container">
		<div class="row">
			<div id="yeah-header-logo" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="" src="<?php echo esc_url(zo_page_header_logo()); ?>"></a>
			</div>
			<div id="yeah-header-banners" class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
				<?php if(is_active_sidebar('header-baners')){ dynamic_sidebar('header-baners'); } ?>
			</div>
			<div id="yeah-header-cart" class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
				<?php if(is_active_sidebar('sidebar-4')){ dynamic_sidebar('sidebar-4'); } ?>
			</div>
		</div>
	</div>
</div>

<!-- Header Navigation -->
<div id="zo-header" class="zo-main-header header-default <?php if (!$smof_data['menu_sticky']) {
	echo 'no-sticky';
} ?> <?php if ($smof_data['menu_sticky_tablets']) {
	echo 'sticky-tablets';
} ?> <?php if ($smof_data['menu_sticky_mobile']) {
	echo 'sticky-mobile';
} ?> <?php if (!empty($zo_meta->_zo_enable_header_fixed)) {
	echo 'header-fixed-page';
} ?> <?php if (!empty($zo_meta->_zo_enable_header_menu)) {
	echo 'header-menu-custom';
} ?>">
	<div class="container">
		<div class="row">
			<div id="zo-header-navigation" class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<nav id="site-navigation" class="main-navigation">
					<?php

					$attr = array(
						'menu' => zo_menu_location(),
						'menu_class' => 'nav-menu menu-main-menu',
					);

					$menu_locations = get_nav_menu_locations();

					if (!empty($menu_locations['primary'])) {
						$attr['theme_location'] = 'primary';
					}

					/* enable mega menu. */
					if (class_exists('HeroMenuWalker')) {
						$attr['walker'] = new HeroMenuWalker();
					}

					/* main nav. */
					wp_nav_menu($attr); ?>
				</nav>
			</div>
			<div id="zo-menu-mobile" class="collapse navbar-collapse"><i class="pe-7s-menu"></i></div>
		</div>
	</div>
	<!-- #site-navigation -->
</div>
<!--#zo-header-->