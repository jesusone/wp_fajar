<?php
/**
 * Plugin Name: Yeah Woo Deals
 * Description: Start listing vehicles online with this easy-to-use and fully featured WordPress Plugin.
 * Version: 1.0.0
 * Author: OyeahThemes
 * License: GPLv2 or later
 * Text Domain: yeah-woo-deals
 */
if (! defined('ABSPATH')) {
    exit();
}
if (! class_exists('YeahWooDeals')) {
    final  class  YeahWooDeals{
         public static function  instance(){
            var_dump("test");
        }
    }
}
if (! function_exists('yeah_woo_deals')) {

    function yeah_woo_deals()
    {
        return YeahWooDeals::instance();
    }
}
if (defined('YEAH_LATE_LOAD')) {

    add_action('plugins_loaded', 'yeah_woo_deals', (int) YEAH_LATE_LOAD);
} else {

    yeah_woo_deals();
}