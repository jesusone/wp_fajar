<?php
/**
 * Created by PhpStorm.
 * User: ngocchau
 * Date: 09/03/2016
 * Time: 21:36
 */
new YeahWooDealsAdminModule();
class YeahWooDealsAdminModule {

    public function  __construct(){
        $this->yeah_query_woo_deals_detail();
        // ajax get models.
        add_action('wp_ajax_short_code_detail', array($this, 'yeah_ajax_load_short_code_id'));
        add_action('wp_ajax_short_code_new_update', array($this, 'yeah_ajax_short_code_new_update'));
        add_action('wp_ajax_short_code_delete_item', array($this, 'yeah_short_code_delete_item'));
        add_action('wp_ajax_yeah_search_products', array($this, 'yeah_search_products'));
    }
    public function yeah_search_products(){
        global $wpdb;
        $nonce = $_POST['yeahNone'];
        $data = $_POST['data'];
        if ( ! wp_verify_nonce( $nonce, 'yeah-nonce' ) ) {
            return  json_encode($result = array('status'=>false,'message'=>'Whoops, something went wrong on our end.'));
        }
        $sql_like = $query_cat = '';
        $query = "SELECT p.* FROM  `".$wpdb->posts."` as p";
        /*Check category*/
        if(!empty($data['category'])){
            $query_cat = " INNER JOIN wp_term_relationships AS tr ON ( p.ID = tr.object_id AND tr.term_taxonomy_id
IN ( ".esc_sql($data['category'])." )) ";
        }
        if(!empty($data['keyword'])){
           $sql_like =  "AND  p.post_title LIKE '%".esc_sql($wpdb->esc_like($data['keyword']))."%'";
        }
        $query .=  $query_cat."   WHERE p.post_type = 'product' AND p.post_status='publish'  ".$sql_like;
        $results = $wpdb->get_results($query, OBJECT );
        if($results) {
            global $post;
            $i=0;
            foreach ($results as $product) :
                $post = $product;
                  yeah_get_template_part_admin('ajax-products/content','ajax');
            $i++;
            endforeach;

        }
        else {
            yeah_get_template_part_admin('ajax-products/content','none');
        }
        exit();
    }
    /*Get categories product*/
    public  function  yeah_query_cart_lists(){
        $taxonomy     = 'product_cat';
        $orderby      = 'name';
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
       $all_categories = get_categories( $args );
        return $all_categories;

    }

    /*List woo deals*/
    public function  yeah_query_woo_deals_detail()
    {
        global $wpdb;
        $tablename = "yeah_woo_deals";
        $query = "SELECT d.*,p.* FROM `".$tablename."` as d
            INNER JOIN $wpdb->posts as p
            ON p.ID= d.product_id
              WHERE p.post_type = 'product' AND p.post_status='publish' ";
        $results = $wpdb->get_results($query, OBJECT );
        return $results;
    }
    /*Ajax Delete item short code*/
    public function yeah_short_code_delete_item(){
        global $wpdb;
        $nonce = $_POST['yeahNone'];
        $data = $_POST['data'];
        if ( ! wp_verify_nonce( $nonce, 'yeah-nonce' ) ) {
            return  json_encode($result = array('status'=>false,'message'=>'Whoops, something went wrong on our end.'));
        }
        if($data['id'] >0 ){
           $result = array();
            $delete =  $wpdb->delete( 'yeah_woo_deals_short_code', array( 'ID' => $data['id'] ), array( '%d' ) );
           $result['status'] = ($delete) ? true : false;
           $result['message'] = ($delete) ? "Delete success short code." : "Can't delete short code.";
           echo json_encode($result);
        }
        exit();
    }
    public  function yeah_get_group_widget(){
        global $wpdb;
        $tablename = "yeah_woo_deals_short_code";
      $result =  $wpdb->get_results( 'SELECT * FROM '.$tablename.' ', OBJECT );
        return $result;

    }
    /*Ajax add update short code*/
    public  function yeah_ajax_short_code_new_update(){
        global $wpdb;
        $nonce = $_POST['yeahNone'];
        $data = $_POST['data'];
        $result = array('status'=>false,'message'=>'');
        if (    ! wp_verify_nonce( $nonce, 'yeah-nonce' ) ) {
             return  json_encode($result = array('status'=>false,'message'=>'Whoops, something went wrong on our end.'));
        }
        $validate = $this->yeah_validate_form($data);
        if(!$validate['status']){
           echo   json_encode($validate); exit();
        }
        $alias_input = str_replace(' ','-',strtolower($data['alias']));
        $alias = $this->yeah_check_alias($alias_input,$data['id']);
        $description =  $data['description'] ;
        if(!$alias['status']){
            echo   json_encode($alias); exit();
        }
        $table_name = 'yeah_woo_deals_short_code';
        $data_input =  array(
                'alias' => $alias_input,	// string
                'name' => $data['title'],	// integer (number)
                'content' => '[yeah_woo_deals alias="'.$alias_input.'"]',	// integer (number)
        );

        $format =  array(
            '%s',	// value1
            '%s',	// value2
            '%s'	// value2
        );
        if($data['id'] == 0){
            global $yeah_short_code;
            $insert = $wpdb->insert( $table_name, $data_input, $format);
            $result['status'] = ($insert) ? true : false;
            $result['message'] = ($insert) ? "Save success Group Deals." : "Can't save Group Deals.";
            $yeah_short_code = array('name'=>$data['title'],$wpdb->insert_id);
            $data_output = array(
                'id' => $wpdb->insert_id,
                'alias' => $alias_input,
                'title' => $data['title'],
                'content' => $description,
            );
            $data_output['html'] = $this->yeah_rend_html($data_output);
            $result['data']= $data_output;

        }
        else {
            /*Update item*/
            $update =  $wpdb->update($table_name,$data_input ,array( 'id' => $data['id'] ),$format, array( '%d' ));
            $result['message'] = ($update) ? "Save success short code." : "Can't save Group Deals.";
            $result['status'] = ($update) ? true : false;
            $data_ouput = array(
                'id' => $wpdb->insert_id,
                'alias' => $alias_input,
                'title' => $data['title'],
                'content' => $description,
            );
            $result['data']= $data_ouput;

        }

       echo json_encode($result);
        exit();
    }
    /*Render html*/
   public function  yeah_rend_html($data){
    $html = '';
    $html .=  '<div class="yeah-short-code-item">';
       $html .= '<div class="yeah-main-media">';
       $html .= '<div class="yeah-main-hover">';
            $html .= '<a class="yeah-setting" data-id="'.esc_attr($data['id']).'" href="javascript:void(0);"><i class="fa fa-cogs"></i></a>';
            $html .='<a class="yeah-edit" href="?page=yeah-woo-deals-short-codes&view=yeah-woo-detail&id='.$data['id'].'"><i class="fa fa-pencil"></i></a>';
            $html .='<a class="yeah-trash" data-id="'.esc_attr($data['id']).'"  href="javascript:void(0);"><i class="fa fa-trash"></i></a>';
        $html .='</div>';
    $html .= '</div>';
    $html .='<div class="yeah-main-content">'.$data['title'].'</div>';
    $html .='</div>';
    return $html;
   }
    /*Check alias*/
    function  yeah_check_alias($alias,$id){
        global $wpdb;
        $query = '';
        if($id == 0 ){
            $query = " SELECT  COUNT(*) as count_alias  FROM  `yeah_woo_deals_short_code` WHERE alias= '".$alias."'";
}
        else {
            $query = " SELECT  COUNT(*) as count_alias   FROM  `yeah_woo_deals_short_code` WHERE alias= '".$alias."' AND id NOT IN (".$id.")";
        }
        $data_count = $wpdb->get_row($query);
        $error = array('status'=>true);
        if($data_count) {
            $error['status'] = ($data_count->count_alias > 0) ? false : true;
            $error['message'] = ($data_count->count_alias > 0) ? "Field <b>Alias</b> exsist" : '';

        }
        return $error;

    }
    /*Validate Form*/
    function  yeah_validate_form($data){
        $error = array('status'=>true);

        if($data['alias'] == ''){
            $error['message'] = "Field <b>Alias</b> should not be empty";
            $error['status'] = false;
        }
        if($data['title'] == ''){
            $error['message'] = "Field <b>Name</b> should not be empty";
            $error['status'] = false;
        }

        return $error;
    }
    /*Ajax get short code detail*/
    function yeah_ajax_load_short_code_id(){
        global $wpdb;
        $nonce = $_POST['yeahNone'];
        $id = (int)$_POST['data'];

        if ( ! wp_verify_nonce( $nonce, 'yeah-nonce' ) ) {
            die ( 'Busted!' );
        }
        $data = array();
        if($id > 0){
            $tablename = "yeah_woo_deals_short_code";
            $query = "SELECT d.* FROM `".$tablename."` as d WHERE d.id=".$id;
            $results = $wpdb->get_results($query, OBJECT );
            $data = array('status'=>true,'data'=>$results);
        }
        else{
            $data = array('status'=>false,'message'=>"Can't load short code.",'data'=>'');
        }
        echo json_encode($data);
        exit();
    }
    /*Get sale off Widget*/
    public  function  yeah_get_sale_off($yeah_group = ''){
        global $wpdb;
        $current_datetimes = date('Y/m/d H:i:s');
        for ($i=0; $i< count($yeah_group); $i++)
        {
            $count = count($yeah_group);
            $arrays[$count] = array(
                'key' => '_yeah_group_deals',
                'value' => $yeah_group[$i],
                'compare' => 'LIKE'
            );
        }
        $args = array(
            'posts_per_page' => 1,
            'post_type' => 'product',
            'paged' => 1,
            'orderby' => 'meta_value_num',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_yeah_dates_end',
                    'value' => $current_datetimes,
                    'compare' => '>',
                    'type' => 'DATETIME'
                ),
                array(
                    'key' => '_yeah_price_sale',
                ),
                $arrays,


            ),
        );
        $min = $args;
        $min = $min['order']=  "ASC";
        $posts_min = new WP_Query( $min );
        $sale_off = array();
        if($posts_min){
           $price_sale = get_post_meta($posts_min->posts[0]->ID,'_yeah_price_sale',true);
           $price_regular = get_post_meta($posts_min->posts[0]->ID,'_regular_price',true);
            var_dump($price_sale);
            var_dump($price_regular);
            $sale_off['min'] = ($price_sale * 0.01) / $price_regular;
        }
        var_dump($sale_off);
    }
    /*Get Data to widget*/
    public function yeah_get_data_widget($yeah_group = ''){
        global $wpdb;
        $current_datetimes = date('Y/m/d H:i:s');
        for ($i=0; $i< count($yeah_group); $i++)
        {
            $count = count($yeah_group);
            $arrays[$count] = array(
                'key' => '_yeah_group_deals',
                'value' => $yeah_group[$i],
                'compare' => 'LIKE'
            );
        }
        $args = array(
            'posts_per_page' => 1,
            'post_type' => 'product',
            'paged' => 1,
            'orderby' => '_yeah_dates_end',
            'order' => 'ASC',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_yeah_dates_end',
                    'value' => $current_datetimes,
                    'compare' => '>',
                    'type' => 'DATETIME'
                ),
                $arrays,

            ),
        );
        $posts = new WP_Query( $args );

        return $posts;
    }
  
}