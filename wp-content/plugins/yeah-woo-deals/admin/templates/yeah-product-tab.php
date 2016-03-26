<?php
/**
 * Created by PhpStorm.
 * User: ngocchau
 * Date: 22/03/2016
 * Time: 21:19
 */
?>
<div id="woo_yeah_woo_deals_tab" class="panel woocommerce_options_panel wc-metaboxes-wrapper">
    <?php
    foreach($yeah_fields as $f_name => $params){
        ?>
        <div class="options_group">
            <p class="form-field">
                <label for="<?php echo esc_attr($f_name); ?>"><?php echo "{$params['title']}"; ?></label>
                <?php echo Yeah_Woo_Deals_Helper::_HTML( $f_name, $params ); ?>
            </p>
        </div>
        <?php
    }
    ?>
</div>
