<?php
/* Get Categories */
$taxonomy = 'category';
$_category = array();
if(!isset($atts['cat']) || $atts['cat']=='' && taxonomy_exists($taxonomy)){
    $terms = get_terms($taxonomy);
    foreach ($terms as $cat){
        $_category[] = $cat->term_id;
    }
} else {
    $_category  = explode(',', $atts['cat']);
}
$atts['categories'] = $_category;
?>
<div class="zo-carousel-wrap">

	<!-- Get Filter Query -->
	<?php if ( $atts['filter'] == "true" && !$atts['loop'] ):?>
        <div class="zo-carousel-filter">
            <ul>
                <li><a class="active" href="#" data-group="all"><?php esc_html_e("All", 'fajar');?></a></li>
				<?php
					$posts = $atts['posts'];
					$query = $posts->query;
					$taxs  = array();
					if(isset($query['tax_query'])){
						$tax_query=$query['tax_query'];
						foreach($tax_query as $tax){
							if(is_array($tax)){
								$taxs[] = $tax['terms'];
							}
						}
					}
					foreach ($atts['categories'] as $category):
						if(!empty($taxs)){
							if(in_array($category,$taxs)) {
								$term = get_term($category, $taxonomy); 
					?>
								<li><a href="#" data-group="<?php echo esc_attr('category-' . $term->slug); ?>"><?php echo esc_attr($term->name); ?></a></li>
				<?php 		}
						}else{
							$term = get_term($category, $taxonomy); 
				?>
							<li><a href="#" data-group="<?php echo esc_attr('category-' . $term->slug); ?>"><?php echo esc_attr($term->name); ?></a></li>
				<?php
						} 
					endforeach; 
				?>
            </ul>
        </div>
		<div class="yeah-carousel-filter-hidden" style="display: none"></div>
    <?php endif; ?>
	
    <div class="yeah-carousel <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
        <?php
        $posts = $atts['posts'];
        while ($posts->have_posts()) :
            $posts->the_post();
            $groups = array();
            $groups[] = 'yeah-carousel-filter-item all';
            foreach (zoGetCategoriesByPostID(get_the_ID(), $taxonomy) as $category) {
                $groups[] = 'category-' . $category->slug;
            }
            ?>
            <div class="yeah-carousel-item <?php echo implode(' ', $groups);?>">
                <?php 
					get_template_part( 'single-templates/content/content', get_post_format() );
				?>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</div>