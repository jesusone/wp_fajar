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
        public $file = null;
        public $basename = null;

        /* base plugin_dir. */
        public $plugin_dir = null;

        public $plugin_url = null;

        /* base acess folder. */
        public $acess_dir = null;

        public $acess_url = null;

        public $template_dir = null;
        public $template_url = null;

        public $theme_dir = null;
        public $theme_url = null;
         public static function  instance(){
             static $_instance = null;
             if (is_null($_instance)) {
                 $_instance = new YeahWooDeals();
                 // Install Deal.
                 $_instance->yeah_install();
                 /*Include Setting*/
                 $_instance->yeah_globalSetting();
                 //Include
                 $_instance->yeah_includes();

             }
             return $_instance;
        }

        private function yeah_globalSetting(){
            $this->file = __FILE__;

            /* base name. */
            $this->basename = plugin_basename($this->file);

            /* base plugin. */
            $this->plugin_dir = plugin_dir_path($this->file);
            $this->plugin_url = plugin_dir_url($this->file);

            /* base assets. */
            $this->acess_dir = trailingslashit($this->plugin_dir . 'assets');
            $this->acess_url = trailingslashit($this->plugin_url . 'assets');

            /* base template. */
            $this->template_dir = trailingslashit($this->plugin_dir . 'templates');
            $this->template_url = trailingslashit($this->plugin_url . 'templates');

            /* custom template. */
            $this->theme_dir = trailingslashit(get_template_directory () . '/yeah-woo-deals');
            $this->theme_url = trailingslashit(get_template_directory_uri() . '/yeah-woo-deals');
        }
        private function  yeah_includes(){
            /*Include class admin*/
            require_once $this->plugin_dir . 'admin/class.admin-page.php';
        }
        /*@author: OyeahThemes
        @function: Install tables
        */
        public  function yeah_install(){
            global $yeah_db_name;
            $yeah_db_name = 'yeah_woo_deals';
            register_activation_hook(__FILE__,array($this,'yeah_install_table'));


        }
        /*@author: OyeahThemes
        @function: Install tables
        */
        public function yeah_install_table(){

            global $wpdb;
            global $yeah_db_name;
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