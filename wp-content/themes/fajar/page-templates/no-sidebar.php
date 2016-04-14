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
global $breadcrumb, $pagetitle;
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
                                <div class="filter col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="select-filter select-cat">
                                        <?php $selectBrand = isset($_GET["selectBrand"]) ? $_GET["selectBrand"] : $terms_b; ?>
                                        <select name="selectBrand" class="select-brand" onchange="form.submit()" >
                                            <option value='all' selected>All Brand</option>
                                            <?php
                                            $terms_brand = get_terms("pa_brand");
                                            foreach ( $terms_brand as $term_brand ) { ?>
                                                <option value="<?php echo $term_brand->term_id; ?>" <?php if(isset($_GET['selectBrand']) && ($term_brand->term_id == $_GET['selectBrand'])) echo "selected"; ?>><?php echo $term_brand->name; ?></option>
                                            <?php   }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="filter col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <span>Sort By</span>
                                    <div class="select-filter select-order">
                                        <?php $order = isset($_GET["selectOrder"]) ? $_GET["selectOrder"] : 'bestsellers'; ?>
                                        <select name="selectOrder" class="select-order" onchange="form.submit()">
                                            <option value='bestsellers' <?php if($order== "bestsellers") echo "selected"; ?>>Best Selling</option>
                                            <option value='featured' <?php if($order== "featured") echo "selected"; ?>>Featured</option>
                                            <option value='onsale' <?php if($order== "onsale") echo "selected"; ?>>On Sale</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="filter col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <span class="number">Show</span>
                                    <div class="select-filter show-num no-sidebar">
                                        <?php $number = isset($_GET["numberShow"]) ? $_GET["numberShow"] : '4'; ?>
                                        <select name="numberShow" id="numberShow" onchange="form.submit()">
                                            <option value='8' <?php if($number== "8") echo "selected"; ?>>8</option>
                                            <option value='12' <?php if($number== "12") echo "selected"; ?>>12</option>
                                            <option value='16' <?php if($number== "16") echo "selected"; ?>>16</option>
                                            <option value='20' <?php if($number== "20") echo "selected"; ?>>20</option>
                                            <option value='24' <?php if($number== "24") echo "selected"; ?>>24</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                        ob_start();
                        global $wp_query, $paged;

                        $brand = isset( $_GET['selectBrand'] ) ? $_GET['selectBrand'] : 'all';
                        $num = isset($_GET['numberShow']) ? $_GET['numberShow'] : 8;
                        $order = isset( $_GET['selectOrder'] ) ? $_GET['selectOrder'] : 'bestsellers';

                        if( $brand == 'all' ) {
                            $brand = $terms_b;
                        }

                        $query_args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => $num,
                            'paged'         => $paged,
                            'order'          => 'asc',
                            'meta_query'     => array(),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'pa_brand',
                                    'field' => 'term_id',
                                    'terms'    => $brand
                                )
                            )
                        );

                        $query_args['meta_query'] = array();
                        $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
                        $query_args['meta_query']   = array_filter( $query_args['meta_query'] );
                        $query_args['meta_query'][] = array(
                            'key'   => '_zo_meta_data',
                            'value' => '"_zo_product_type":"3d-print"',
                            'compare'   => 'LIKE'
                        );

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