<?php

/**
 * Auto create .css file from Theme Options
 * @author ZoTheme
 * @version 1.0.0
 */
class ZoTheme_StaticCss
{

    public $scss;

    function __construct()
    {
        global $smof_data;

        /* scss */
        $this->scss = new scssc();

        /* set paths scss */
        $this->scss->setImportPaths(get_template_directory() . '/assets/scss/');

        /* generate css over time */
        if (isset($smof_data['dev_mode']) && $smof_data['dev_mode']) {
            $this->generate_file();
        } else {
            /* save option generate css */
            add_action("redux/options/smof_data/saved", array(
                $this,
                'generate_file'
            ));
        }
    }

    /**
     * generate css file.
     *
     * @since 1.0.0
     */
    public function generate_file()
    {
        global $smof_data;
        if (! empty($smof_data)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            WP_Filesystem();
            global $wp_filesystem;

            /* write options to scss file */
            
			if ( ! $wp_filesystem->put_contents( get_template_directory() . '/assets/scss/options.scss', $this->css_render(), 0644 ) ) {
				_e( 'Error saving file!', 'creativ' );
			}

            /* minimize CSS styles */
            if (!$smof_data['dev_mode']) {
                $this->scss->setFormatter('scss_formatter_compressed');
            }

            /* compile scss to css */
            $css = $this->scss_render();

            $file = "static.css";

            if(!empty($smof_data['presets_color']) && $smof_data['presets_color']){
                $file = "presets-".$smof_data['presets_color'].".css";
            }

            /* write static.css file */
			if ( ! $wp_filesystem->put_contents( get_template_directory() . '/assets/css/' . $file, $css, 0644) ) {
				_e( 'Error saving file!', 'creativ' );
			}
        }
    }

    /**
     * scss compile
     *
     * @since 1.0.0
     * @return string
     */
    public function scss_render(){
        /* compile scss to css */
        return $this->scss->compile('@import "master.scss"');
    }

    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $smof_data, $zo_base;
        ob_start();
        /* local fonts */
        $zo_base->setTypographyLocal($smof_data['local-fonts-1'], $smof_data['local-fonts-selector-1']);
        $zo_base->setTypographyLocal($smof_data['local-fonts-2'], $smof_data['local-fonts-selector-2']);
		zo_setvariablescss($smof_data['primary_color'],'$primary_color','#ee3b24');
		zo_setvariablescss($smof_data['link_color']['regular'],'$link_color','#333333');
		zo_setvariablescss($smof_data['link_color']['hover'],'$link_color_hover','#ee3b24');
		zo_setvariablescss($smof_data['main_logo_height']['height'],'$main_logo_height','');
		zo_setvariablescss($smof_data['sticky_logo_height']['height'],'$sticky_logo_height','');
        /* ==========================================================================
           Start Header
        ========================================================================== */      

        /* Header Main */
        if($smof_data['main_logo_height']){
            echo "#yeah-header-logo a img { max-height: \$main_logo_height; }";
        }
        if(!empty($smof_data['bg_header']['rgba'])) {
            echo "#yeah-header-menu { background-color:".esc_attr($smof_data['bg_header']['rgba'])."; }";
        }
        /* End Header Main */

        /* Sticky Header */
        if(!empty($smof_data['bg_sticky_header']['rgba'])){
            echo "#yeah-header-menu.zo-main-header.header-fixed { background-color:".esc_attr($smof_data['bg_sticky_header']['rgba'])."; }";
        }
        if($smof_data['sticky_logo_height']){
            echo "#yeah-header-menu.header-fixed #yeah-header-logo a img { max-height: \$sticky_logo_height; }";
        }
        /* End Sticky Header */
        /* Main Menu */
        echo '@media(min-width: 992px) {';
			if( isset($smof_data['menu_position']) && $smof_data['menu_position'] != '' ) {
				echo "#zo-header-navigation .main-navigation .menu-main-menu,
				#zo-header-navigation .main-navigation div.nav-menu > ul {
					text-align: ".esc_attr($smof_data['menu_position']).";
				}";
			}
			if($smof_data['menu_color_first_level']){
				echo "#zo-header-navigation .main-navigation .menu-main-menu > li.menu-item-has-children > .zo-menu-toggle {
				color:".esc_attr($smof_data['menu_color_first_level']).";
				}";
			}
			if($smof_data['menu_color_hover_first_level']){
				echo "#zo-header-navigation .main-navigation .menu-main-menu > li > a:hover,
				#zo-header-navigation .main-navigation .menu-main-menu >ul > li > a:hover {
					color:".esc_attr($smof_data['menu_color_hover_first_level']).";
				}";
			}
			if($smof_data['menu_color_active_first_level']){
				echo "#zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a,
				#zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a,
				#zo-header-navigation .main-navigation .menu-main-menu > li.current_page_item > a,
				#zo-header-navigation .main-navigation .menu-main-menu > li.current_page_ancestor > a,
				#zo-header-navigation .main-navigation .menu-main-menu > ul > li.current-menu-item > a,
				#zo-header-navigation .main-navigation .menu-main-menu > ul > li.current-menu-ancestor > a,
				#zo-header-navigation .main-navigation .menu-main-menu > ul > li.current_page_item > a,
				#zo-header-navigation .main-navigation .menu-main-menu > ul > li.current_page_ancestor > a {
					color:".esc_attr($smof_data['menu_color_active_first_level']).";
				}";
			}
			if($smof_data['menu_first_level_uppercase']){
				echo "#zo-header-navigation .main-navigation .menu-main-menu > li > a,
				#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a {
					text-transform: uppercase;
				}";
			}
			if(!empty($smof_data['sub_menu_uppercase'])){
				echo "#zo-header-navigation .main-navigation .menu-main-menu li ul a {
					text-transform: uppercase;
				}";
			}
        echo '}';
        /* End Main Menu */

        /* Main Menu Header Fixed Only Page */
        if($smof_data['menu_color_first_level']){
            echo "#yeah-header-menu.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li > a {
				color:".esc_attr($smof_data['menu_color_first_level']).";
			}";
        }
        if($smof_data['menu_color_hover_first_level']){
            echo "#yeah-header-menu.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li > a:hover {
				color:".esc_attr($smof_data['menu_color_hover_first_level']).";
			}";
        }
        if($smof_data['menu_color_active_first_level']){
            echo "#yeah-header-menu.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a,
			#yeah-header-menu.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a,
			#yeah-header-menu.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_item > a,
			#yeah-header-menu.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_ancestor > a {
				color:".esc_attr($smof_data['menu_color_active_first_level']).";
			}";
        }
        /* End  Main Menu Header Fixed Only Page */
        /* Sub Menu */
        if(!empty($smof_data['menu_color_sub_level'])){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li ul li > a,
			#zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li .zo-menu-toggle {
				color:".esc_attr($smof_data['menu_color_sub_level']).";
			}";
        }
        if(!empty($smof_data['menu_color_hover_sub_level'])){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li ul li:hover > a,
			#zo-header-navigation .main-navigation .menu-main-menu > li ul li:hover .zo-menu-toggle,
			#zo-header-navigation .main-navigation .menu-main-menu > li ul a:focus,
			#zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-item > a,
			#zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li:hover a,
			#zo-header-navigation .main-navigation .menu-main-menu > ul > li ul a:focus,
			#zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li.current-menu-item > a,
			#zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-parent > a,
			#zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-parent > .zo-menu-toggle,
			#zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-ancestor > a,
			#zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-ancestor > .zo-menu-toggle {
				color:".esc_attr($smof_data['menu_color_hover_sub_level']).";
			}";
        }
        /* End Sub Menu */

        /* ==========================================================================
           End Header
        ========================================================================== */
        /* ==========================================================================
           Start Footer
        ========================================================================== */
        /* Footer Top */
        if($smof_data['footer_heading_color']){
            echo "#zo-footer-top .wg-title:before {
				background-color:".esc_attr($smof_data['footer_heading_color']).";
			}";
        }
        /* End Footer Top */

        /* ==========================================================================
           Start Button
        ========================================================================== */
        /** Button Default **/
        if($smof_data['btn_default_color']){
            echo ".vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3, .btn, .button, input[type='submit'] {
                    color:".esc_attr($smof_data['btn_default_color']).";
                    background-color:".esc_attr($smof_data['btn_default_bg_color']).";
                    @include border-radius(".esc_attr($smof_data['btn_default_border_radius']['height']).");
                }";
        }
        if($smof_data['btn_default_color_hover']) {
            echo ".vc_general.vc_btn3.btn:hover, button.vc_general.vc_btn3:hover, a.vc_general.vc_btn3:hover, .btn:hover, .button:hover, input[type='submit']:hover,.vc_general.vc_btn3.btn:focus, button.vc_general.vc_btn3:focus, a.vc_general.vc_btn3:focus, .btn:focus, .button:focus, input[type='submit']:focus {
                    color:".esc_attr($smof_data['btn_default_color_hover']).";
                    background-color:".esc_attr($smof_data['btn_default_bg_color_hover']).";
                }";
        }
        /** Button Primary **/
        if($smof_data['btn_primary_color']){
            echo ".vc_general.vc_btn3.btn.btn-primary, .btn.btn-primary {
                    color:".esc_attr($smof_data['btn_primary_color']).";
                    background-color:".esc_attr($smof_data['btn_primary_bg_color']).";
					@include border-radius(".esc_attr($smof_data['btn_primary_border_radius']['height']).");
                }";
        }
        if($smof_data['btn_primary_color_hover']) {
            echo ".vc_general.vc_btn3.btn.btn-primary:hover, .btn.btn-primary:hover,
			.vc_general.vc_btn3.btn.btn-primary:focus, .btn.btn-primary:focus {
				color:".esc_attr($smof_data['btn_primary_color_hover']).";
				background-color:".esc_attr($smof_data['btn_primary_bg_color_hover']).";
			}";
        }
        if($smof_data['button_text_uppercase'] == '1'){
            echo ".btn , button, .button, a.vc_general.vc_btn3, input[type='submit'] {
				text-transform: uppercase;
			}";
        }
        /* ==========================================================================
           End Button
        ========================================================================== */
        return ob_get_clean();
    }
}

new ZoTheme_StaticCss();