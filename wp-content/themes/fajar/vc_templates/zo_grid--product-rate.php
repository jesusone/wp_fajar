<?php 
    /* get categories */
        $taxo = 'category';
        $_category = array();
        if(!isset($atts['cat']) || $atts['cat']==''){
            $terms = get_terms($taxo);
            foreach ($terms as $cat){
                $_category[] = $cat->term_id;
            }
        } else {
            $_category  = explode(',', $atts['cat']);
        }
        $atts['categories'] = $_category;
?>
<div class="yeah-grid-wrapper woocommerce <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">

	<!-- Get Filter Query -->
	<?php if (isset($atts['filter']) && $atts['filter'] == 1 && $atts['layout'] == 'masonry'): ?>
        <div class="yeah-grid-filter">
            <ul class="yeah-filter-category list-unstyled list-inline">
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
    <?php endif; ?>
	
    <div class="<?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $size = ( isset($atts['layout']) && $atts['layout']=='basic')?'thumbnail':'medium';
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            ?>
            <div class="zo-grid-item product <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <?php 
                    if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                        $class = ' has-thumbnail';
                        $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
                    else:
                        $class = ' no-image';
                        $thumbnail = '<img src="'.ZO_IMAGES.'no-image.jpg" alt="'.get_the_title().'" />';
                    endif;
                    echo '<div class="zo-grid-media '.esc_attr($class).'">'.$thumbnail.'</div>';
                ?>
				<div>
					<?php echo do_shortcode( "[yith_wcwl_add_to_wishlist]" ); ?>
				</div>
                <div class="zo-grid-title">
                    <a href="<?php the_permalink();?>" title="<?php echo esc_html__('View Detials');?>"><?php the_title();?></a>
                </div>
                <div class="zo-grid-content">
                    <?php echo yeah_limit_words(get_the_content(), 9);?>
                </div>
				<div class="zo-grid-rate woocommerce-product-rating">
					<?php woocommerce_template_loop_rating();?>
				</div>
				<div class="zo-grid-price">
					<?php woocommerce_template_loop_price();?>
				</div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    wp_reset_postdata();
    ?>
</div>