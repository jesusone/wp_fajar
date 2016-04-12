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

get_header( 'shop' ); ?>
    <section id="primary" class="content-area<?php if($breadcrumb == '0'){ echo ' no_breadcrumb'; }; ?> <?php if(!$pagetitle){ echo ' no_page_title'; }; ?>">
        <main id="main" class="site-main" role="main">
            <div class="<?php echo get_post_meta(get_the_ID(), 'zo_layout', true) ? 'no-container' : 'container'; ?>">
                <div class="row">

                </div>
            </div>
        </main><!-- #main -->
    </section><!-- #primary -->
<?php get_footer( 'shop' ); ?>