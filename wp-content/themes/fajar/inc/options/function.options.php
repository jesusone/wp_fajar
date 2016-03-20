<?php
global $zo_base;
/* get local fonts. */
$local_fonts = is_admin() ? $zo_base->getListLocalFontsName() : array() ;
/**
 * Home Options
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Main Options', 'fajar'),
    'icon' => 'el-icon-dashboard',
    'fields' => array(
        array(
            'id' => 'intro_product',
            'type' => 'intro_product',
        )
    )
);

/**
 * Header Options
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Header', 'fajar'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'title' => __('Layouts', 'fajar'),
            'subtitle' => __('select a layout for header', 'fajar'),
            'default' => '',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/header/header-1.png',
            )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu.', 'fajar'),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => __('Sticky Header', 'fajar'),
            'default' => true,
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Tablets.', 'fajar'),
            'id' => 'menu_sticky_tablets',
            'type' => 'switch',
            'title' => __('Sticky Tablets', 'fajar'),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Mobile.', 'fajar'),
            'id' => 'menu_sticky_mobile',
            'type' => 'switch',
            'title' => __('Sticky Mobile', 'fajar'),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/* Header Top */
$this->sections[] = array(
    'title' => __('Header Top', 'fajar'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable header top.', 'fajar'),
            'id' => 'header_top',
            'type' => 'switch',
            'title' => __('Enable Header Top', 'fajar'),
            'default' => true
        ),
    )
);

/* Logo */
$this->sections[] = array(
    'title' => __('Logo', 'fajar'),
    'icon' => 'el-icon-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => __('Select Logo', 'fajar'),
            'subtitle' => __('Select an image file for your logo.', 'fajar'),
            'id' => 'main_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/logo.png'
            )
        ),
        array(
            'id'       => 'main_logo_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Logo Height', 'fajar'),
            'width' => false,
            'default'  => array(
                'height'  => '60px'
            ),
        ),
        array(
            'id'       => 'sticky_logo_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Sticky Logo Height', 'fajar'),
            'width' => false,
            'default'  => array(
                'height'  => '80px'
            ),
        ),
    )
);

/* Menu */
$this->sections[] = array(
    'title' => __('Menu', 'fajar'),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Menu position.',
            'id' => 'menu_position',
            'options' => array(
                '' => 'Initial',
                'left' => 'Menu Left',
                'right' => 'Menu Right',
                'center' => 'Menu Center',
            ),
            'type' => 'select',
            'title' => __('Menu Position', 'fajar'),
            'default' => 'left'
        ),
        array(
            'id' => 'menu_margin_first_level',
            'title' => __('Menu Margin - First Level', 'fajar'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('#yeah-header-navigation .main-navigation .menu-main-menu > li > a',
                '#yeah-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'menu_padding_first_level',
            'title' => __('Menu Padding - First Level', 'fajar'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('#yeah-header-navigation .main-navigation .menu-main-menu > li > a',
                '#yeah-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'default' => array(
                'padding-top'     => '15px',
                'padding-right'   => '28px',
                'padding-bottom'  => '16px',
                'padding-left'    => '28px',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'menu_fontsize_first_level',
            'type' => 'typography',
            'title' => __('Menu Font Size - First Level', 'fajar'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#yeah-header-navigation .main-navigation .menu-main-menu > li > a',
                '#yeah-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '15px',
            )
        ),
        array(
            'id' => 'menu_fontsize_sub_level',
            'type' => 'typography',
            'title' => __('Menu Font Size - Sub Level', 'fajar'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#yeah-header-navigation .main-navigation .menu-main-menu > li ul a',
                '#yeah-header-navigation .main-navigation .menu-main-menu > ul > li ul a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '16px',
            )
        ),
        array(
            'subtitle' => __('Enable mega menu.', 'fajar'),
            'id' => 'menu_mega',
            'type' => 'switch',
            'title' => __('Mega Menu', 'fajar'),
            'default' => true,
        ),
        array(
            'subtitle' => __('Enable menu first level uppercase.', 'fajar'),
            'id' => 'menu_first_level_uppercase',
            'type' => 'switch',
            'title' => __('Menu First Level Uppercase', 'fajar'),
            'default' => true,
        ),
        array(
            'subtitle' => __('Enable sub menu uppercase.', 'fajar'),
            'id' => 'sub_menu_uppercase',
            'type' => 'switch',
            'title' => __('Sub menu Uppercase', 'fajar'),
            'default' => false,
        ),
        array(
            'id' => 'menu_icon_font_size',
            'type' => 'typography',
            'title' => __('Menu Icon Font Size', 'fajar'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#yeah-header-navigation .main-navigation .menu-main-menu > li.menu-item-has-children .zo-menu-toggle'),
            'units' => 'px',
            'default' => array(
                'font-size' => '14px',
            )
        ),
    )
);

/**
 * Page Title
 *
 * @author ZoTheme
 */

/**
 * Page title settings
 *
 */
$page_title = array(
    array(
        'id' => 'page_title_layout',
        'title' => __('Layouts', 'fajar'),
        'subtitle' => __('select a layout for page title', 'fajar'),
        'default' => '5',
        'type' => 'image_select',
        'options' => array(
            '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
            '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
            '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
            '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
            '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
            '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
            '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
        )
    ),
    array(
        'id'       => 'page_title_background',
        'type'     => 'background',
        'title'    => __( 'Background', 'fajar' ),
        'subtitle' => __( 'page title background with image, color, etc.', 'fajar' ),
        'output'   => array('#zo-page-element-wrap'),
        'default'   => array(
            'background-color'=>'#ffffff',
            'background-image'=> get_template_directory_uri().'/assets/images/pagetitle.jpg',
            'background-repeat'=>'',
            'background-size'=>'cover',
            'background-attachment'=>'',
            'background-position'=>'center center'
        )
    ),
    array(
        'id' => 'page_title_margin',
        'title' => __('Margin', 'fajar'),
        'type' => 'spacing',
        'units' => 'px',
        'mode' => 'margin',
        'output' => array('#zo-page-element-wrap'),
        'default' => array(
            'margin-top'     => '0',
            'margin-right'   => '0',
            'margin-bottom'  => '80px',
            'margin-left'    => '0',
            'units'          => 'px',
        )
    ),
    array(
        'id' => 'page_title_padding',
        'title' => __('Padding', 'fajar'),
        'type' => 'spacing',
        'units' => 'px',
        'mode' => 'padding',
        'output' => array('#zo-page-element-wrap'),
        'default' => array(
            'padding-top'     => '340px',
            'padding-right'   => '0',
            'padding-bottom'  => '260px',
            'padding-left'    => '0',
            'units'          => 'px',
        )
    ),
    array(
        'id' => 'page_title_parallax',
        'title' => __('Enable Header Parallax', 'fajar'),
        'type' => 'switch',
        'default' => false
    ),
    array(
        'id' => 'page_title_custom_post',
        'title' => __('Custom Background For Post Type', 'fajar'),
        'type' => 'switch',
        'default' => false
    ),
);
/**
 * add custom background for post type
 */
$post_types = zo_list_post_types();
foreach( $post_types as $type => $name) {
    $page_title[] = array(
        'id'       => 'page_title_custom_post_' . $type,
        'type'     => 'background',
        'title'    => sprintf( __( 'Background For %s' , 'fajar'), $name),
        'subtitle' => sprintf( __( 'Custom background image for post type %s', 'fajar' ), $name),
        'output'   => array('.single-'.$type.' #zo-page-element-wrap'),
        'background-color' => false,
        'background-repeat' => false,
        'background-size' => false,
        'background-attachment' => false,
        'background-position' => false,
        'default'   => array(
            'background-image'=> '',
        ),
        'required' => array( 'page_title_custom_post', '=', 1 )
    );
}
/**
 * Section settings
 */
$this->sections[] = array(
    'title' => __('Page Title & BC', 'fajar'),
    'icon' => 'el-icon-map-marker',
    'fields' => $page_title
);

/* Page Title */
$this->sections[] = array(
    'icon' => 'el-icon-podcast',
    'title' => __('Page Title', 'fajar'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'page_title_typography',
            'type' => 'typography',
            'title' => __('Typography', 'fajar'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text h1'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', 'fajar'),
            'default' => array(
                'color' => '#fff',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '48px',
                'line-height' => '60px',
                'text-align' => 'center'
            )
        ),
        array(
            'id' => 'page_sub_title_typography',
            'type' => 'typography',
            'title' => __('Sub Title', 'fajar'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text .page-sub-title'),
            'units' => 'px',
            'subtitle' => __('Typography option with sub title text.', 'fajar'),
            'default' => array(
                'color' => '#fff',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '36px',
                'text-align' => 'center'
            )
        ),
    )
);
/* Breadcrumb */
$this->sections[] = array(
    'icon' => 'el-icon-random',
    'title' => __('Breadcrumb', 'fajar'),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('The text before the breadcrumb home.', 'fajar'),
            'id' => 'breacrumb_home_prefix',
            'type' => 'text',
            'title' => __('Breadcrumb Home Prefix', 'fajar'),
            'default' => 'Home'
        ),
        array(
            'id' => 'breacrumb_typography',
            'type' => 'typography',
            'title' => __('Typography', 'fajar'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('#breadcrumb #breadcrumb-text .breadcrumbs','#breadcrumb #breadcrumb-text ul li a'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', 'fajar'),
            'default' => array(
                'color' => '',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '12px',
                'line-height' => '12px',
                'text-align' => 'center'
            )
        ),
    )
);

/**
 * Body
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Body', 'fajar'),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'subtitle' => __('Set layout boxed default(Wide).', 'fajar'),
            'id' => 'body_layout',
            'type' => 'switch',
            'title' => __('Boxed Layout', 'fajar'),
            'default' => false,
        ),
        array(
            'id'       => 'body_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'fajar' ),
            'subtitle' => __( 'body background with image, color, etc.', 'fajar' ),
            'output'   => array('body'),
        ),
        array(
            'id' => 'body_margin',
            'title' => __('Margin', 'fajar'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #page'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'body_padding',
            'title' => __('Padding', 'fajar'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #page'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
    )
);

/**
 * Content
 *
 * Archive, Pages, Single, 404, Search, Category, Tags ....
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Content', 'fajar'),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'container_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'fajar' ),
            'subtitle' => __( 'Container background with image, color, etc.', 'fajar' ),
            'output'   => array('#main'),
        ),
        array(
            'id' => 'container_margin',
            'title' => __('Margin', 'fajar'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #page #main'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'container_padding',
            'title' => __('Padding', 'fajar'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #page #main'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        )
    )
);

/**
 * Page Loadding
 *
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Page Loadding', 'fajar'),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable page loadding.', 'fajar'),
            'id' => 'enable_page_loadding',
            'type' => 'switch',
            'title' => __('Enable Page Loadding', 'fajar'),
            'default' => false,
        ),
        array(
            'subtitle' => __('Select Style Page Loadding.', 'fajar'),
            'id' => 'page_loadding_style',
            'type' => 'select',
            'options' => array(
                '1' => 'Style 1',
                '2' => 'Style 2'
            ),
            'title' => __('Page Loadding Style', 'fajar'),
            'default' => 'style-1',
            'required' => array( 0 => 'enable_page_loadding', 1 => '=', 2 => 1 )
        )
    )
);

/**
 * Footer
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Footer', 'fajar'),
    'icon' => 'el-icon-credit-card',
	'fields' => array(
		array(
            'id' => 'footer_layout',
            'title' => __('Layouts', 'fajar'),
            'subtitle' => __('select a layout for footer', 'fajar'),
            'default' => '',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/footer/footer-layout.png',
            )
        ),
		array(
            'title' => __('Select Logo', 'fajar'),
            'subtitle' => __('Select an image file for your logo.', 'fajar'),
            'id' => 'footer_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/footer-logo.png'
            )
        )
	)
);

/* Custom Footer */
$this->sections[] = array(
    'title' => __('Customize Footer', 'fajar'),
    'icon' => 'el-icon-fork',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'footer_row_1',
            'type' => 'switch',
            'title' => __('Enable Footer Row 1', 'fajar'),
            'default' => true,
        ),
        array(
            'id' => 'footer_row_2',
            'type' => 'switch',
            'title' => __('Enable Footer Row 2', 'fajar'),
            'default' => true,
        ),
        array(
            'id' => 'footer_row_3',
            'type' => 'switch',
            'title' => __('Enable Footer Row 3', 'fajar'),
            'default' => true,
        ),
        array(
            'id' => 'footer_banners',
            'type' => 'switch',
            'title' => __('Enable Footer Banners', 'fajar'),
            'default' => true,
        ),
		array(
            'subtitle' => __('Enable footer bottom.', 'fajar'),
            'id' => 'footer_bottom',
            'type' => 'switch',
            'title' => __('Enable Footer Bottom', 'fajar'),
            'default' => true,
        ),
        array(
            'subtitle' => __('enable button back to top.', 'fajar'),
            'id' => 'footer_botton_back_to_top',
            'type' => 'switch',
            'title' => __('Back To Top', 'fajar'),
            'default' => true,
        )
    )
);

/**
 * Button Option
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Button', 'fajar'),
    'icon' => 'el el-bold',
    'fields' => array(
        array(
            'id' => 'button_font_size',
            'type' => 'typography',
            'title' => __('Button Font Size', 'fajar'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('.vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3 , .button, .btn, input[type="submit"]'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'subtitle' => __('Enable button uppercase.', 'fajar'),
            'id' => 'button_text_uppercase',
            'type' => 'switch',
            'title' => __('Button Text Uppercase', 'fajar'),
            'default' => true,
        ),
    )
);

/* Button Default */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => __('Button Default', 'fajar'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'btn_default_padding',
            'title' => __('Button Default - Padding', 'fajar'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('.btn, .vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3, .button, .btn, input[type="submit"]'),
            'default' => array(
                'padding-top'     => '15px',
                'padding-right'   => '35px',
                'padding-bottom'  => '15px',
                'padding-left'    => '35px',
                'units'          => 'px',
            ),
        ),
        array(
            'id'       => 'btn_default_border',
            'type'     => 'border',
            'title'    => __('Button Default - Border', 'fajar'),
            'output'   => array('.btn, .vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3, .button, .btn, input[type="submit"]'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#f0ba00',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_default_border_hover',
            'type'     => 'border',
            'title'    => __('Button Default - Border Hover', 'fajar'),
            'output'   => array('.btn, .vc_general.vc_btn3.btn:hover, button.vc_general.vc_btn3:hover, a.vc_general.vc_btn3:hover, .button:hover, .btn:hover, input[type="submit"]:hover, .vc_general.vc_btn3.btn:focus, button.vc_general.vc_btn3:focus, a.vc_general.vc_btn3:focus, .button:focus, .btn:focus, input[type="submit"]:focus'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#f0ba00',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_default_border_radius',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Button Default - Border Radius', 'fajar'),
            'width' => false,
            'default'  => array(
                'height'  => '0'
            ),
        ),
    )
);

/* Button Primary */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => __('Button Primary', 'fajar'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'btn_primary_padding',
            'title' => __('Button Primary - Padding', 'fajar'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('.btn.btn-primary, .vc_general.btn.btn-primary'),
            'default' => array(
                'padding-top'     => '15px',
                'padding-right'   => '35px',
                'padding-bottom'  => '15px',
                'padding-left'    => '35px',
                'units'          => 'px',
            ),
        ),
        array(
            'id'       => 'btn_primary_border',
            'type'     => 'border',
            'title'    => __('Button Primary - Border', 'fajar'),
            'output'   => array('.btn.btn-primary, .vc_general.vc_btn3.btn.btn-primary'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#ee3b24',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_primary_border_hover',
            'type'     => 'border',
            'title'    => __('Button Primary - Border Hover', 'fajar'),
            'output'   => array('.btn.btn-primary, .vc_general.vc_btn3.btn.btn-primary:hover, .vc_general.vc_btn3.btn.btn-primary:focus'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#ee3b24',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_primary_border_radius',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Button Primary - Border Radius', 'fajar'),
            'width' => false,
            'default'  => array(
                'height'  => '0'
            ),
        ),
    )
);
/**
 * Styling
 *
 * css color.
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Styling', 'fajar'),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => __('set color main color.', 'fajar'),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => __('Primary Color', 'fajar'),
            'default' => '#ee3b24'
        ),
        array(
            'subtitle' => __('set color for tags <a></a>.', 'fajar'),
            'id' => 'link_color',
            'type' => 'link_color',
            'title' => __('Link Color', 'fajar'),
            'output'  => array('a'),
            'default' => array(
				'regular'  => '#333',
				'hover'    => '#ee3b24',
				'active'    => '#ee3b24',
			)
        ),
    )
);

/** Header Main Color **/
$this->sections[] = array(
    'title' => __('Header Main Color', 'fajar'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('set color for header background color.', 'fajar'),
            'id' => 'bg_header',
            'type' => 'color_rgba',
            'title' => __('Header Background Color', 'fajar'),
            'default'   => array(
                'alpha'     => 1,
				'color'		=> '#fff',
				'rgba'		=> 'rgba(255,255,255,1)'
            )
        )
    )
);

/** Sticky Header Color **/
$this->sections[] = array(
    'title' => __('Sticky Header', 'fajar'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('set color for sticky header.', 'fajar'),
            'id' => 'bg_sticky_header',
            'type' => 'color_rgba',
            'title' => __('Sticky Background Color', 'fajar'),
            'default'   => array(
                'alpha'     => 0
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/** Menu Color **/

$this->sections[] = array(
    'title' => __('Menu Color', 'fajar'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Controls the text color of first level menu items.', 'fajar'),
            'id' => 'menu_color_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color - First Level', 'fajar'),
            'default' => '#333'
        ),
        array(
            'subtitle' => __('Controls the text hover color of first level menu items.', 'fajar'),
            'id' => 'menu_color_hover_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color Hover - First Level', 'fajar'),
            'default' => '#333'
        ),
        array(
            'subtitle' => __('Controls the text hover color of first level menu items.', 'fajar'),
            'id' => 'menu_color_active_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color Active - First Level', 'fajar'),
            'default' => '#333'
        ),
        array(
            'subtitle' => __('Controls the text color of sub level menu items.', 'fajar'),
            'id' => 'menu_color_sub_level',
            'type' => 'color',
            'title' => __('Menu Font Color - Sub Level', 'fajar'),
            'default' => '#333'
        ),
        array(
            'subtitle' => __('Controls the text hover color of sub level menu items.', 'fajar'),
            'id' => 'menu_color_hover_sub_level',
            'type' => 'color',
            'title' => __('Menu Font Color Hover - Sub Level', 'fajar'),
            'default' => '#333'
        )
    )
);

/** Button Color **/

$this->sections[] = array(
    'title' => __('Button Color', 'fajar'),
    'icon' => 'el el-bold',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Controls the button text color.', 'fajar'),
            'id' => 'btn_default_color',
            'type' => 'color',
            'title' => __('Button Default - Font Color', 'fajar'),
            'default' => '#000000'
        ),
        array(
            'subtitle' => __('Controls the button text hover color.', 'fajar'),
            'id' => 'btn_default_color_hover',
            'type' => 'color',
            'title' => __('Button Default - Font Color Hover', 'fajar'),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button background color.', 'fajar'),
            'id' => 'btn_default_bg_color',
            'type' => 'color',
            'title' => __('Button Default - Background Color', 'fajar'),
            'default' => 'transparent'
        ),
        array(
            'subtitle' => __('Controls the button background color.', 'fajar'),
            'id' => 'btn_default_bg_color_hover',
            'type' => 'color',
            'title' => __('Button Default - Background Color Hover', 'fajar'),
            'default' => '#f0ba00'
        ),
        array(
            'subtitle' => __('Controls the button text color.', 'fajar'),
            'id' => 'btn_primary_color',
            'type' => 'color',
            'title' => __('Button Primary - Font Color', 'fajar'),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button text hover color.', 'fajar'),
            'id' => 'btn_primary_color_hover',
            'type' => 'color',
            'title' => __('Button Primary - Font Color Hover', 'fajar'),
            'default' => '#ee3b24'
        ),
        array(
            'subtitle' => __('Controls the button background color.', 'fajar'),
            'id' => 'btn_primary_bg_color',
            'type' => 'color',
            'title' => __('Button Primary - Background Color', 'fajar'),
            'default' => '#ee3b24'
        ),
        array(
            'subtitle' => __('Controls the button background color.', 'fajar'),
            'id' => 'btn_primary_bg_color_hover',
            'type' => 'color',
            'title' => __('Button Primary - Background Color Hover', 'fajar'),
            'default' => 'transparent'
        ),
    )
);

/** Footer Top Color **/
$this->sections[] = array(
    'title' => __('Footer Top Color', 'fajar'),
    'icon' => 'el-icon-chevron-up',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set color footer top.', 'fajar'),
            'id' => 'footer_top_color',
            'type' => 'color',
            'output' => array('#zo-footer-top'),
            'title' => __('Footer Top Color', 'fajar'),
            'default' => '#636363'
        ),
        array(
            'subtitle' => __('Set title color footer top.', 'fajar'),
            'id' => 'footer_heading_color',
            'type' => 'color',
            'output' => array('#zo-footer-top h1,#zo-footer-top h2,#zo-footer-top h3,#zo-footer-top h4,#zo-footer-top h5,#zo-footer-top h6'),
            'title' => __('Footer Heading Color', 'fajar'),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Set title link color footer top.', 'fajar'),
            'id' => 'footer_top_link_color',
            'type' => 'link_color',
            'output' => array('#zo-footer-top a'),
            'title' => __('Footer Link Color', 'fajar'),
            'default' => '#636363',
            'default' => array(
				'regular'  => '#636363',
				'hover'    => '#ee3b24',
			)
        ),
    )
);

/** Footer Bottom Color **/
$this->sections[] = array(
    'title' => __('Footer Bottom Color', 'fajar'),
    'icon' => 'el-icon-chevron-down',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set color footer top.', 'fajar'),
            'id' => 'footer_bottom_color',
            'type' => 'color',
            'output' => array('#yeah-footer-bottom'),
            'title' => __('Footer Bottom Color', 'fajar'),
            'default' => '#3a3a3a'
        )
    )
);

/**
 * Typography
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Typography', 'fajar'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => __('Body Font', 'fajar'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
			'line-height' => false,
			'subsets' => false,
            'units' => 'px',
            'default' => array(
                'color' => '#404040',
                'font-weight' => '400',
                'font-family' => 'Source Sans Pro',
				'font-backup' => 'Arial, Helvetica, sans-serif',
                'google' => true,
                'font-size' => '18px',
            ),
            'subtitle' => __('Typography option with each property can be called individually.', 'fajar'),
        ),
        array(
            'id' => 'font-body-selector',
            'type' => 'textarea',
            'title' => __('Selector of Body Font', 'fajar'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id, Note: no use characters: > * + & ^ @ ...), extend class ".body_font" to using this font', 'fajar'),
            'validate' => 'no_html',
            'default' => 'body, .body_font',
        ),
    )
);

/* extra font. */
$this->sections[] = array(
    'title' => __('Extra Fonts', 'fajar'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => __('Font 1', 'fajar'),
            'google' => true,
            'font-backup' => true,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '400',
                'font-family' => 'Source Sans Pro',
				'font-backup' => 'Arial, Helvetica, sans-serif',
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => __('Selector of Body Font', 'fajar'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id, Note: no use characters: > * + & ^ @ ...), extend class ".google-font-1" to using this font', 'fajar'),
            'validate' => 'no_html',
            'default' => '.google-font-1',
        ),
        array(
            'id' => 'google-font-2',
            'type' => 'typography',
            'title' => __('Font 2', 'fajar'),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'output' => array('.extra_font2'),
            'default' => array(
                'font-weight' => '',
                'font-family' => ''
            )
        ),
        array(
            'id' => 'google-font-selector-2',
            'type' => 'textarea',
            'title' => __('Selector of Body Font', 'fajar'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id, Note: no use characters: > * + & ^ @ ...), extend class ".google-font-2" to using this font', 'fajar'),
            'validate' => 'no_html',
            'default' => '.google-font-2',
        ),
    )
);

/* local fonts. */
$this->sections[] = array(
    'title' => __('Local Fonts', 'fajar'),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'local-fonts-1',
            'type'     => 'select',
            'title'    => __( 'Fonts 1', 'fajar' ),
            'options'  => $local_fonts,
            'default'  => 'museo_slab_100',
        ),
        array(
            'id' => 'local-fonts-selector-1',
            'type' => 'textarea',
            'title' => __('Selector 1', 'fajar'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id, Note: no use characters: > * + & ^ @ ...), or extend ".museo_slab_100" to use font', 'fajar'),
            'validate' => 'no_html',
            'default' => '.museo_slab_100, h1, h2, h3, h4, h5, h6',
            'required' => array(
                0 => 'local-fonts-1',
                1 => '!=',
                2 => ''
            )
        ),
        array(
            'id'       => 'local-fonts-2',
            'type'     => 'select',
            'title'    => __( 'Fonts 2', 'fajar' ),
            'options'  => $local_fonts,
            'default'  => 'museo_slab_300',
        ),
        array(
            'id' => 'local-fonts-selector-2',
            'type' => 'textarea',
            'title' => __('Selector 2', 'fajar'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id, Note: no use characters: > * + & ^ @ ...), or extend ".museo_slab_300" to use font', 'fajar'),
            'validate' => 'no_html',
            'default' => '.museo_slab_300, #yeah-header-menu',
            'required' => array(
                0 => 'local-fonts-2',
                1 => '!=',
                2 => ''
            )
        )
    )
);

/**
 * Custom CSS
 *
 * extra css for customer.
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Custom CSS', 'fajar'),
    'icon' => 'el-icon-bulb',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => __('CSS Code', 'fajar'),
            'subtitle' => __('create your css code here.', 'fajar'),
            'mode' => 'css',
            'theme' => 'monokai',
        )
    )
);
/**
 * Animations
 *
 * Animations options for theme. libs css, js.
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Animations', 'fajar'),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'subtitle' => __('Enable animation mouse scroll...', 'fajar'),
            'id' => 'smoothscroll',
            'type' => 'switch',
            'title' => __('Smooth Scroll', 'fajar'),
            'default' => false
        ),
        array(
            'subtitle' => __('Enable animation parallax for images...', 'fajar'),
            'id' => 'paralax',
            'type' => 'switch',
            'title' => __('Images Paralax', 'fajar'),
            'default' => true
        ),
    )
);
/**
 * Optimal Core
 *
 * Optimal options for theme. optimal speed
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Optimal Core', 'fajar'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => __('no minimize , generate css over time...', 'fajar'),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => __('Dev Mode (not recommended)', 'fajar'),
            'default' => true
        )
    )
);