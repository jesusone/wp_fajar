<?php
/**
 * Plugin Name: Yeah Woo Deals
 * Description: Deals WordPress Plugin.
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
             static $_instance = null;
             if (is_null($_instance)) {
                 $_instance = new YeahWooDeals();
                 // Install Deal.
                 $_instance->yeah_install();
             }
             return $_instance;
        }
        /*@author: OyeahThemes
        @function: Install tables
        */
        private  function yeah_install(){
            global $yeah_db_name;
            $yeah_db_name = 'yeah_woo_deals';
            register_activation_hook(__FILE__,array($this,'yeah_install_table'));


        }
        /*@author: OyeahThemes
        @function: Install tables
        */
        private function yeah_install_table(){
            var_dump("ssss");die;
            global $wpdb;
            global $yeah_db_name;
            var_dump($yeah_db_name);die;
            // create the  database table
            if($wpdb->get_var("show tables like '$yeah_db_name'") != $yeah_db_name)
            {
                $sql = "CREATE TABLE " . $yeah_db_name . "(
                `id` INT(11) NOT NULL AUTO_INCREMENT ,
                `product_id` INT(11) NOT NULL ,
                `dealsstart` DATETIME NOT NULL ,
                `dealsend` DATETIME NOT NULL ,
                `dealssale` INT NOT NULL ,
                `dealsprice` INT NOT NULL ,
                 PRIMARY KEY (`id`)) ENGINE = InnoDB;";

                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);
            }
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
?>