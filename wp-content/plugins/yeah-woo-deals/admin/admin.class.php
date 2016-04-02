<?php
/**
 * Created by PhpStorm.
 * User: ngocchau
 * Date: 09/03/2016
 * Time: 21:36
 */
new YeahWooDealsAdmin();
class YeahWooDealsAdmin {

    public function  __construct(){
        // wp head.
        //add_action('admin_head', array($this, 'add_ajax_url'));
        // admin scripts.
       // add_action('wp_enqueue_scripts', array($this, 'add_admin_script'));

        // add admin page.
       // add_action ( 'admin_menu', array ($this, 'add_admin_page'));

      /*  add_filter( 'woocommerce_product_data_tabs', array( &$this, 'yeah_product_tab' ) );
        add_action( 'woocommerce_product_data_panels', array( &$this, 'yeah_product_tab_content' ) );
        add_action( 'save_post', array( &$this,'yeah_update_custom_meta_fields' ) );*/
      //  $this->yeah_get_group_deals();
    }
    function yeah_product_tab_content(){
            // enqueue
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery.datetimepicker');
            wp_enqueue_style('jquery.datetimepicker');
            wp_enqueue_script('script.yeahwoodeals');
            wp_enqueue_style('style.yeahwoodeals');

            $yeah_fields = $this->yeah_fields_meta();

            ob_start();
            require_once ( yeah_woo_deals()->admin_dir . '/templates/yeah-product-tab.php' );
            echo ob_get_clean();

    }
    

}