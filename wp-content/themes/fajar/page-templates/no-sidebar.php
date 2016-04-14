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
var_dump("es");
get_header(); ?>

<?php global $product; ?>
    <div id="page-front-page">
        <div class="container">
            <div class="row">
                <div id="primary" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-content none-sidebar">
                    <div id="content" role="main">
                        <div class="product-filter">
                            <?php
                            $brand_categories = get_terms( 'pa_brand' );
                            $terms_b = array();
                            $count = 0;
                            if ( is_array( $brand_categories ) ) {
                                foreach ( $brand_categories as $cat ) {
                                    $terms_b[$count++] = $cat->term_id;
                                }
                            }
                            ?>
                            <form action="#" method='get' class='zo-filter-product'>

                            </form>
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