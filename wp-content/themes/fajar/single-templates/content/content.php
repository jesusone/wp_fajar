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
    $zo_image_size = 'yeah-blog-medium';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
    
	<?php if(has_post_thumbnail()) : ?>
		<!-- Thumb -->
		<div class="yeah-blog-image">
			<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_post_thumbnail( $zo_image_size ); ?></a>
		</div>
    <?php endif ?>
	
	<!-- Title -->
	<h2 class="yeah-blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></h2>
	
	<!-- Content -->
	<div class="yeah-blog-content">
		<?php
		if(get_post_type( get_the_ID() ) != 'page'):
			the_excerpt();
		endif;
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
	
	<!-- Detail -->
    <div class="yeah-blog-detail">
        <div class="yeah-blog-meta"><?php zo_archive_detail(); ?></div>
    </div>
</article>
