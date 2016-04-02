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

        public  $admin_dir = null;
        public  $admin_url = null;
         public static function  instance(){
             static $_instance = null;
             if (is_null($_instance)) {
                 $_instance = new YeahWooDeals();
                 /*Include Setting*/
                 $_instance->yeah_globalSetting();
                 // Install Deal.
                 $_instance->yeah_install();

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
            /* Admin url. */
            $this->admin_dir = trailingslashit($this->plugin_dir. 'admin');
            $this->admin_url = trailingslashit($this->plugin_url . 'admin');
        }
        private function  yeah_includes(){
            /*Include class admin*/
            /*require_once $this->plugin_dir . 'includes/core-functions.php';
            require_once $this->plugin_dir . 'includes/helper.class.php';
           // require_once $this->plugin_dir . 'admin/admin.class.php';
          //  require_once $this->plugin_dir . 'admin/admin.module.class.php';
            require_once $this->plugin_dir . 'includes/widgets/class.widgets.php';*/
        }
        /*@author: OyeahThemes
        @function: Install tables
        */
        public  function yeah_install(){
            register_activation_hook(__FILE__,array($this,'yeah_install_table'));
            // datetimepicker
            wp_enqueue_script( 'jquery.countdown', $this->plugin_url . '/assets/js/jquery.countdown.min.js', array( 'jquery' ) );
            wp_enqueue_script( 'yeah-woo-deals', $this->plugin_url . '/assets/js/yeah_woo_deals.js', array( 'jquery' ) );
            wp_register_style( 'jquery.datetimepicker', $this->plugin_url . '/assets/css/jquery.datetimepicker.css' );

        }
        /*@author: OyeahThemes
        @function: Install tables
        */
        public function yeah_install_table(){

            global $wpdb;
            global $yeah_db_name;
            global $yeah_table_short_code;
            $yeah_db_name = 'yeah_woo_deals';
            $yeah_table_short_code = 'yeah_woo_deals_short_code';
            // create the  database table short code

            if($wpdb->get_var("show tables like '$yeah_table_short_code'") != $yeah_table_short_code)
            {
                $sql_short_code = "CREATE TABLE " . $yeah_table_short_code . " (
                `id` INT(11) NOT NULL AUTO_INCREMENT ,
                `name` varchar(200)	 NOT NULL ,
                `content` TEXT NOT NULL ,
                 PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql_short_code);
            }

            // create the  database table
            if($wpdb->get_var("show tables like '$yeah_db_name'") != $yeah_db_name)
            {
                $sql = "CREATE TABLE " . $yeah_db_name ." (
                `id` INT(11) NOT NULL AUTO_INCREMENT ,
                `product_id` INT(11) NOT NULL ,
                `dealsstart` DATETIME NOT NULL ,
                `dealsend` DATETIME NOT NULL ,
                `dealssale` INT NOT NULL ,
                `dealsprice` INT NOT NULL ,
                `short_code_id` INT(11) NOT NULL,
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