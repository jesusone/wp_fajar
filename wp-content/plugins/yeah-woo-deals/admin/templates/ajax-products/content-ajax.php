<?php
/**
 * Created by PhpStorm.
 * User: ngocchau
 * Date: 19/03/2016
 * Time: 16:51
 */
global $post;

?>
<div class="yeah-product-item">
    <div class="yeah-pro-media">
        <?php if(has_post_thumbnail()) : ?>
            <?php the_post_thumbnail( 'thumbnail' ); ?>
        <?php endif ?>
        <div class="yeah-action">
            <input type="checkbox" class="radio" value="<?php echo esc_attr($post->ID)  ?>" name="product-name[1][]">
        </div>
    </div>
    <div class="yeah-pro-title">
        <?php echo $post->post_title; ?>
    </div>
</div>