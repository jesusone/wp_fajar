<?php
if( !function_exists('zo_woo_share') ) {

    /**
     * WooCommerce Share Hook
     */
    function zo_woo_share() {
        global $post;
?>
        <ul class="social-list">
            <li class="box"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-facebook"></i></a></li>
            <li class="box"><a href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-twitter"></i></a></li>
            <li class="box"><a href="https://www.linkedin.com/cws/share?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-linkedin"></i></a></li>
            <li class="box"><a href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-google-plus"></i></a></li>
            <li class="box"><a href="http://pinterest.com/pin/create/button?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-pinterest"></i></a></li>
        </ul>
<?php
    }
}
add_action('woocommerce_share', 'zo_woo_share');


/*
** Remove tabs from product details page
*/
function zo_woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); // Remove the additional information tab
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'zo_woo_remove_product_tabs', 98 );

/**
 * Add Cart Clear Cart Function
 */
add_action('init', 'yeah_woo_clear_cart_url');
function yeah_woo_clear_cart_url() {
    global $woocommerce;
    if( isset($_REQUEST['clear_cart']) ) {
        $woocommerce->cart->empty_cart();
    }
}

//add wrap for '(Free)' or '(FREE!)' label text on cart page for Shipping and Handling
function yeah_custom_shipping_free_label( $label ) {
    $label =  str_replace( "(Free)", '<span class="amount">Free</span>', $label );
    $label =  str_replace( "(FREE!)", '<span class="amount">FREE!</span>', $label );
    return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label' , 'yeah_custom_shipping_free_label' );

/*Product Lists Get Form sort*/
add_action( 'woocommerce_before_shop_loop', 'yeah_archive_product_form_search', 20 );
function yeah_archive_product_form_search(){
?>
    <div class="sort-widget">

        <div class="row sort-widget-headings">

            <div class="sort-devices-heading">
                Sort Product
            </div>

            <div class="show-desktop">

                <div class="col-md-3">
                    <span>categories</span>
                </div>
                <div class="col-md-3">
                    <span>size</span>
                </div>
                <div class="col-md-3">
                    <span>colour</span>
                </div>
                <div class="col-md-3">
                    <span>BY PRICE</span>
                </div>

            </div>

            <div class="clearfix"></div>

            <div class="row sort-widget-options" id="sort-widget-options">

                <div class="col-md-3">
                    <span class="mobile-heading">categories</span>
                    <span class="clearfix"><input type="checkbox" id="option1"> <label for="option1">Suits &amp; Blazer</label></span>
                    <span class="clearfix"><input type="checkbox" id="option2"> <label for="option2">Tuxedo</label></span>
                    <span class="clearfix"><input type="checkbox" id="option3"> <label for="option3">Suits &amp; Bowler Hat</label></span>
                    <span class="clearfix"><input type="checkbox" id="option4"> <label for="option4">Dress Pants</label></span>
                </div>

                <div class="col-md-3">
                    <span class="mobile-heading">size</span>
                    <span class="clearfix"><input type="checkbox" id="option5"> <label for="option5">S</label></span>
                    <span class="clearfix"><input type="checkbox" id="option6"> <label for="option6">M</label></span>
                    <span class="clearfix"><input type="checkbox" id="option7"> <label for="option7">L</label></span>
                    <span class="clearfix"><input type="checkbox" id="option8"> <label for="option8">XL</label></span>
                    <span class="clearfix"><input type="checkbox" id="option9"> <label for="option9">XXL</label></span>
                    <span class="clearfix"><input type="checkbox" id="option10"> <label for="option10">XXXL</label></span>
                </div>

                <div class="col-md-3">
                    <span class="mobile-heading">colour</span>
                    <span class="clearfix"><input type="checkbox" id="option11"> <label for="option11">Black</label></span>
                    <span class="clearfix"><input type="checkbox" id="option12"> <label for="option12">Blue</label></span>
                    <span class="clearfix"><input type="checkbox" id="option13"> <label for="option13">Grey</label></span>
                    <span class="clearfix"><input type="checkbox" id="option14"> <label for="option14">Yellow</label></span>
                    <span class="clearfix"><input type="checkbox" id="option15"> <label for="option15">Red</label></span>
                </div>

                <div class="col-md-3">
                    <span class="mobile-heading">BY PRICE</span>
                    <span class="clearfix"><input type="checkbox" id="option16"> <label for="option16">$0.00 - $50.00</label></span>
                    <span class="clearfix"><input type="checkbox" id="option17"> <label for="option17">$100.00 - $200.00</label></span>
                    <span class="clearfix"><input type="checkbox" id="option18"> <label for="option18">$200.00 - $400.00</label></span>
                    <span class="clearfix"><input type="checkbox" id="option19"> <label for="option19">$400.00 - $600.00</label></span>
                    <span class="clearfix"><input type="checkbox" id="option20"> <label for="option20">$50.00 - $100.00</label></span>
                    <span class="clearfix"><input type="checkbox" id="option21"> <label for="option21">$600.00 - $3.000.00</label></span>
                </div>


            </div>

            <a href="" class="sort-widget-toggle-btn" id="sort-widget-toggle-btn"><i class="fa fa-caret-down"></i></a>

        </div>

    </div>
<?php
}


