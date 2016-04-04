<div class="yeah-carousel-fancyboxes-wraper <?php echo esc_attr($atts['template']);?>">
    <?php if($atts['title']!=''):?>
        <div class="yeah-carousel-fancyboxes-head">
            <div class="yeah-carousel-fancyboxes-title">
                <?php echo apply_filters('the_title',$atts['title']);?>
            </div>
            <div class="yeah-carousel-fancyboxes-description">
                <?php echo apply_filters('the_content',$atts['description']);?>
            </div>
        </div>
    <?php endif;?>
    <div id="<?php echo esc_attr($atts['html_id']);?>" class="row yeah-carousel-fancyboxes-body">
        <?php
            $columns = ((int)$atts['zo_cols'])?(int)$atts['zo_cols']:1;
            
            for($i=1;$i<=$columns;$i++){ ?>
                <?php
                $icon = isset($atts['icon'.$i])?$atts['icon'.$i]:'';
                $content = isset($atts['description'.$i])?$atts['description'.$i]:'';
                $image = isset($atts['image'.$i])?$atts['image'.$i]:'';
                $title = isset($atts['title'.$i])?$atts['title'.$i]:'';
                $button_link = isset($atts['button_link'.$i])?$atts['button_link'.$i]:'';
                $image_url = '';
                if (!empty($image)) {
                    $attachment_image = wp_get_attachment_image_src($image, 'full');
                    $image_url = $attachment_image[0];
                }
                ?>
                    <div class="yeah-carousel-fancy-item">
                        <?php if($image_url):?>
                        <div class="yeah-carousel-fancy-box-image">
                            <img src="<?php echo esc_attr($image_url);?>" />
                        </div>
                        <?php else:?>
                        <div class="yeah-carousel-fancy-box-icon">
                            <i class="<?php echo esc_attr($icon);?>"></i>
                        </div>
                        <?php endif;?>
                        <?php if($title):?>
                            <h3><?php echo apply_filters('the_title',$title);?></h3>
                        <?php endif;?>
                        <div class="yeah-carousel-fancy-box-content">
                            <?php echo apply_filters('the_content',$content);?>
                        </div>
                        <?php if($atts['button_text']!=''):?>
                            <div class="yeah-carousel-fancyboxes-button">
                                <?php
                                $class_btn = ($atts['button_type']== 1)?'btn btn-large':'';
                                ?>
                                <a href="<?php echo esc_url($button_link);?>" class="<?php echo esc_attr($class_btn);?>"><?php echo esc_attr($atts['button_text']);?></a>
                            </div>
                        <?php endif;?>
                    </div>
            <?php }
        ?>
    </div>
</div>