<?php
/**
 * Created by PhpStorm.
 * User: ngocchau
 * Date: 09/03/2016
 * Time: 21:36
 */
class YeahWooDealsAdmin {
    public function  __construct(){
        // add admin page.
        add_action ( 'admin_menu', array ($this, 'add_admin_page'));
    }
    public  function add_admin_page(){
        add_menu_page(
            __( 'Yeah Woo Deals', 'yeah-woo-deals' ),
            'custom menu',
            'manage_options',
            'custompage',
            'my_custom_menu_page',
            plugins_url( 'yeah-woo-deals/assets/images/icon.png' ),
            6
        );
    }
}