<?php
/**
 * Template Name: No Sidebar For Shop
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 * @author ZoTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $breadcrumb, $pagetitle, $product;

get_header(); ?>

<?php global $product; ?>
    <div id="page-front-page">
        <div class="container">
            <div class="row">
                <div id="primary" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-content none-sidebar">
                    <div id="content" role="main">
                        <div class="product-filter">
                            <div class="sort-widget">
                                <form action="index.php" class="form-sort" method="GET">
                                <div class="row sort-widget-headings">

                                    <div class="sort-devices-heading">
                                        <?php echo esc_html__('Sort Product','fajar')?>
                                    </div>

                                    <div class="show-desktop">

                                        <div class="col-md-3">
                                            <span> <?php echo esc_html__('categories','fajar')?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <span><?php echo esc_html__('size','fajar')?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <span><?php echo esc_html__('colour','fajar')?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <span><?php echo esc_html__('BY PRICE','fajar')?></span>
                                        </div>

                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="sort-widget-options" id="sort-widget-options">
                                        <?php
                                         $product_cat = get_terms( 'product_cat', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
                                         $cart_slug = isset($_GET["product_cat"]) ? $_GET["product_cat"] : '';
                                        ?>
                                        <div class="col-md-3">
                                            <span class="mobile-heading"><?php echo esc_html__('categories','fajar')?></span>
                                            <?php  if(!empty($product_cat)):?>
                                            <?php  foreach($product_cat as $cat):?>
                                                  <span class="clearfix"><input type="checkbox" value="<?php echo $cat->term_id; ?>" id="option1"> <label for="option1"><?php echo esc_html($cat->name);?></span>
                                            <?php  endforeach;?>
                                            <?php  endif;?>
                                        </div>

                                        <div class="col-md-3">
                                            <?php
                                            $pa_size = get_terms( 'pa_size', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
                                            $pa_slug = isset($_GET["pa_size"]) ? $_GET["pa_size"] : '';
                                            ?>
                                            <span class="mobile-heading"><?php echo esc_html__('size','fajar')?></span>
                                            <?php  if(!empty($pa_size)):?>
                                                <?php  foreach($pa_size as $size):?>
                                                     <span class="clearfix"><input type="checkbox" id="option5"> <label for="option5"><?php echo esc_html($size->name);?></label></span>
                                                <?php  endforeach;?>
                                            <?php  endif;?>
                                        </div>

                                        <div class="col-md-3">
                                            <?php
                                            $pa_colour = get_terms( 'pa_colour', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
                                            $pa_slug = isset($_GET["pa_colour"]) ? $_GET["pa_colour"] : '';
                                            ?>
                                            <span class="mobile-heading"><?php echo esc_html__('colour','fajar')?></span>
                                            <?php  if(!empty($pa_colour)):?>
                                                <?php  foreach($pa_colour as $colour):?>
                                                    <span class="clearfix"><input type="checkbox" id="option5"> <label for="option5"><?php echo esc_html($colour->name);?></label></span>
                                                <?php  endforeach;?>
                                            <?php  endif;?>
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
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn default btn-fill" value="<?php echo esc_html__('Filter','fajar') ?>">
                                        </div>

                                    </div>

                                    <a href="" class="sort-widget-toggle-btn" id="sort-widget-toggle-btn"><i class="fa fa-caret-down"></i></a>

                                </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        ob_start();
                        global $wp_query, $paged;


                        $num = isset($_GET['numberShow']) ? $_GET['numberShow'] : 8;
                        $order = isset( $_GET['selectOrder'] ) ? $_GET['selectOrder'] : 'bestsellers';


                        $query_args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => $num,
                            'paged'         => $paged,
                            'order'          => 'asc',
                            'meta_query'     => array()
                        );

                        $query_args['meta_query'] = array();
                        $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
                        $query_args['meta_query']   = array_filter( $query_args['meta_query'] );


                        switch ( $order ) {
                            case 'onsale' :
                                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                                $product_ids_on_sale[]  = 0;
                                $query_args['post__in'] = $product_ids_on_sale;
                                break;
                            case 'bestsellers':
                                $query_args['meta_query'][] = array(
                                    'meta_key'      => 'total_sales',
                                    'orderby'       => 'meta_value_num',
                                    'no_found_rows' => 1,
                                );
                                break;
                            default :
                                $query_args['meta_query'][] = array(
                                    'key'   => '_featured',
                                    'value' => 'yes'
                                );
                                break;
                        }
                        ?>

                        <?php $wp_query->query($query_args); ?>

                        <?php if ( have_posts() ) : ?>
                            <div class="nav-top">
                                <?php zo_paging_nav(); ?>
                            </div>
                            <div class="content-detail">
                                <?php
                                while ( have_posts() ) : the_post();
                                    ob_start();
                                    wc_get_template( 'woocommerce/content-product.php', array('columns'=>4) );
                                    $content_product = ob_get_contents();
                                    ob_end_clean();
                                    echo $content_product;
                                endwhile;
                                ?>
                                <?php zo_paging_nav(); ?>
                            </div>
                        <?php else : ?>
                            <?php wc_get_template( 'loop/no-products-found.php' ); ?>
                        <?php endif; ?>
                        <?php
                        wp_reset_postdata();
                        $content = ob_get_clean();
                        echo ent2ncr( $content );
                        ?>
                    </div><!-- #content -->
                </div><!-- #primary -->
            </div>
        </div>
    </div>
<?php get_footer();