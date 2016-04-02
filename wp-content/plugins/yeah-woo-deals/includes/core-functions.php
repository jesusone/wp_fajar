<?php
/**
 * Created by PhpStorm.
 * User: ngocchau
 * Date: 19/03/2016
 * Time: 16:43
 */
/*Register Sidebar Woo-deals*/
register_sidebar( array(
    'name' => __( 'Woo Deals', 'yeah-woo-deals' ),
    'id' => 'sidebar-deals',
    'description' => __( 'Appears when using the optional Woo Deals with a page set as Woo Deals', 'yeah-woo-deals' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="wg-title">',
    'after_title' => '</h3>',
) );
function yeah_get_template_part( $slug, $name = '') {
    $template = '';

    // Look in yourtheme/slug-name.php and yourtheme/woocommerce/slug-name.php
    if ( $name && ! WC_TEMPLATE_DEBUG_MODE ) {
        $template = locate_template( array( "{$slug}-{$name}.php", yeah_woo_deals()->template_dir . "{$slug}-{$name}.php" ) );
    }

    // Get default slug-name.php
    if ( ! $template && $name && file_exists( yeah_woo_deals()->template_dir . "/templates/{$slug}-{$name}.php" ) ) {
        $template = yeah_woo_deals()->template_dir . "/templates/{$slug}-{$name}.php";
    }

    // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/yeah-woo-deals/slug.php
    if ( ! $template ) {
        $template = locate_template( array( "{$slug}.php",  yeah_woo_deals()->template_dir . "{$slug}.php" ) );
    }

    // Allow 3rd party plugins to filter template file from their plugin.
    $template = apply_filters( 'yeah_get_template_part', $template, $slug, $name );

    if ( $template ) {
        load_template( $template, false );
    }
}
function yeah_get_template_part_admin( $slug, $name = '') {
    $template = '';

    // Look in yourtheme/slug-name.php and yourtheme/woocommerce/slug-name.php
    if ( $name ) {
        $template = locate_template( array( "{$slug}-{$name}.php", yeah_woo_deals()->admin_dir . "templates/.{$slug}-{$name}.php" ) );
    }

    // Get default slug-name.php
    if ( ! $template && $name && file_exists( yeah_woo_deals()->admin_dir . "templates/{$slug}-{$name}.php" ) ) {

        $template = yeah_woo_deals()->admin_dir . "templates/{$slug}-{$name}.php";
    }

    // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/yeah-woo-deals/slug.php
    if ( ! $template ) {
        $template = locate_template( array( "{$slug}.php",  yeah_woo_deals()->admin_dir . "/templates/{$slug}.php" ) );
    }

    // Allow 3rd party plugins to filter template file from their plugin.
    $template = apply_filters( 'yeah_get_template_part_admin', $template, $slug, $name );

    if ( $template ) {
        load_template( $template, false );
    }
}