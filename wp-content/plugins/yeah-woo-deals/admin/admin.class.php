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
      //  add_action('wp_enqueue_scripts', array($this, 'add_admin_script'));

        // add admin page.
        /*add_action ( 'admin_menu', array ($this, 'add_admin_page'));

        add_filter( 'woocommerce_product_data_tabs', array( &$this, 'yeah_product_tab' ) );
        add_action( 'woocommerce_product_data_panels', array( &$this, 'yeah_product_tab_content' ) );
        add_action( 'save_post', array( &$this,'yeah_update_custom_meta_fields' ) );*/
        $this->yeah_get_group_deals();
    }
    function yeah_product_tab_content(){
            // enqueue
          //  wp_enqueue_script('jquery');
          /*  wp_enqueue_script('jquery.datetimepicker');
            wp_enqueue_style('jquery.datetimepicker');*/
         /*   wp_enqueue_script('script.yeahwoodeals');
            wp_enqueue_style('style.yeahwoodeals');*/

            $yeah_fields = $this->yeah_fields_meta();

            ob_start();
            require_once ( yeah_woo_deals()->admin_dir . '/templates/yeah-product-tab.php' );
            echo ob_get_clean();

    }
    function yeah_update_custom_meta_fields( $post_id ) {

        //disable autosave,so custom fields will not be empty
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

        if( isset($_POST['yeah_fields']) ){
            do_action('before_yeah_fields_save', $_POST);

            // save product type Woo
            update_post_meta( $post_id, '_yeah_product-type', ( isset( $_POST['product-type'] ) )? $_POST['product-type'] : '' );

            $yeah_fields = apply_filters( 'yeah_fields_product_data_before_save', $_POST['yeah_fields'] );

            $yeah_fields['_yeah_dates_start'] = $_POST['yeah_fields']['_yeah_woo_dates']['start'];
            $yeah_fields['_yeah_dates_end'] = $_POST['yeah_fields']['_yeah_woo_dates']['end'];
            $implode = '';

            // save
            foreach( $yeah_fields as $f_name => $f_val ){
                update_post_meta( $post_id, $f_name, $f_val );
            }

            do_action('after_yeah_fields_save', $_POST);
        }
    }
    function yeah_fields_meta() {
        global $post;
        $custom = get_post_custom($post->ID);

        //echo '<pre>'; print_r($custom); echo '</pre>';
        $dates = ( isset( $custom['_yeah_woo_dates'] ) )? unserialize( $custom['_yeah_woo_dates'][0] ) : "";

        $fields = apply_filters( 'yeah_fields_product_data_tabs', array(

            "yeah_fields[_yeah_price_sale]" => array(
                "title" => "Price Sale",
                "type" => "number",
                "default" => ( isset( $custom['_yeah_price_sale'][0] ) )? $custom['_yeah_price_sale'][0] : 9,
            ),
            "yeah_fields[_yeah_woo_dates]" => array(
                "title" => "Woo deals dates",
                "type" => "yeah_woo_dates",
                "start" => ( isset( $dates['start'] ) )? $dates['start'] : date('Y-m-d H:i:s'),
                "end" => ( isset( $dates['end'] ) )? $dates['end'] : '',
            ),
            "yeah_fields[_yeah_group_deals][]" => array(
                "title" => "Group Deals",
                "type" => "group_deals",
                "class" => "yeah-group-deal",
                "options" => $this->yeah_get_group_deals(),
                "default" => (isset($custom['_yeah_group_deals']) ? unserialize($custom['_yeah_group_deals'][0]) : '' )
            ),
            "yeah_fields[_yeah_owner_description]" => array(
                "title" => "Description",
                "type" => "textarea",
                "default" => ( isset( $custom['_yeah_owner_description'][0] ) )? $custom['_yeah_owner_description'][0] : '',
            ),
        ) );

        return $fields;
    }
    public function yeah_get_group_deals(){
        global $wpdb;
        $tablename = "yeah_woo_deals_short_code";
        $results = $wpdb->get_results( 'SELECT * FROM '.$tablename.' ', OBJECT );
        $data = array();
        if($results){
            foreach ($results as $item){
                $data[$item->id] = $item->name;
            }
        }
       return $data;
    }
    function yeah_product_tab($tabs) {
        $tabs['woo_yeah_woo_deals_tab'] = array(
            'label'  => __( 'Woo Deals', 'yeah-woo-deals' ),
            'target' => 'woo_yeah_woo_deals_tab',
            'class'  => array( 'show_if_woo_yeah_woo_deals_tab' ),
        );

        return $tabs;
    }
    public  function add_admin_page(){
        add_menu_page(
            esc_html__( 'Woo Deals', 'yeah-woo-deals' ),
            'Woo Deals',
            'manage_options',
            'yeah-woo-deals-short-codes',
            array($this,'yeah_woo_deals_setting'),
            yeah_woo_deals()->admin_url.'assets/images/menu-icon.png',
            25
        );
        /*Add page short code setting*/
    }
    function add_ajax_url(){
        wp_localize_script( 'jquery-ui', 'WooDeals', array(
                'ajaxurl'   => admin_url( 'admin-ajax.php' ),
                'yeahNonce' => wp_create_nonce( 'yeah-nonce' )
            )
        );
    }
    public  function add_admin_script()
    {
        /** post-type */
            wp_enqueue_script('jquery');
            wp_enqueue_style('font-awesome', yeah_woo_deals()->admin_url . 'assets/css/font-awesome.min.css', array(), '4.5.0');
            wp_enqueue_style('chosen', yeah_woo_deals()->admin_url . 'assets/css/chosen.min.css', array(), '4.5.0');
            wp_enqueue_style('jquery-ui', yeah_woo_deals()->admin_url . 'assets/css/jquery-ui.min.css', array(), '4.5.0');
            wp_enqueue_style('yeah-short-codes-lists', yeah_woo_deals()->admin_url . 'assets/css/yeah_short_code_lists.css');
            wp_register_script('jquery.datetimepicker', yeah_woo_deals()->admin_url . 'assets/js/jquery.datetimepicker.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('jquery.sortable', yeah_woo_deals()->admin_url . 'assets/js/jquery.sortable.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('jquery.chosen', yeah_woo_deals()->admin_url . 'assets/js/chosen.jquery.min.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('jquery-ui', yeah_woo_deals()->admin_url . 'assets/js/jquery-ui.min.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('yeah-short-codes-lists', yeah_woo_deals()->admin_url . 'assets/js/yeah_short_code_lists.js', array('jquery'), '1.0.0', true);

    }
    /*List woo deals*/
    public function  yeah_woo_deals_setting()
    {
        $view = $_REQUEST['view'];
        switch($view){
            case '':
                require_once(yeah_woo_deals()->admin_dir.'/templates/yeah-woo-deals.php');
                break;
            case 'yeah-woo-detail':
                require_once(yeah_woo_deals()->admin_dir.'templates/yeah-woo-deals-detail.php');
                break;
            default:
                break;
        }
    }

}