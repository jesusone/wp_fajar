<?php
/**
 * The default template for displaying content
 *
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */
?>
<?php
global $template;
if( basename($template) === 'blog-classic.php') {
    $zo_image_size = 'full';
} else {
    $zo_image_size = 'zo-blog-medium';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
    <div class="zo-blog-image zo-blog-gallery">
        <?php echo zo_archive_gallery( $zo_image_size); ?>
    </div>

    <div class="zo-blog-detail">
        <h2 class="zo-blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></h2>
        <div class="zo-blog-meta"><?php zo_archive_detail(); ?></div>
        <div class="zo-blog-content">
            <?php the_excerpt();
            wp_link_pages( array(
                'before'      => '<p class="page-links"><span class="page-links-title">' . __( 'Pages:', 'fajar' ) . '</span>',
                'after'       => '</p>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'fajar' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
            ?>
        </div>
        <a class="btn-readmore" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php _e('Read More ', 'fajar') ?></a>
    </div>
</article>
