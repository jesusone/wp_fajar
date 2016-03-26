<?php

$results = YeahWooDealsAdminModule::yeah_query_woo_deals_detail();
?>
<link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">
<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>

<section>

    <h2><?php ?></h2>

    <div class="yeah-sortable-grid">
        <?php foreach($results as $item): ?>
            <div class="yeah-detail-item" id="yeah-detail-<?php esc_attr($item->id); ?>">
                <?php
                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'thumbnail' );
                ?>
                <img src="<?php echo esc_attr($image_url[0]); ?>">
                <div class="yeah-main-hover">
                    <a class="yeah-detail-edit" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
                    <a class="yeah-detail-trash" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
                </div>
                <div class="yeah-main-content">
                    <?php echo esc_attr($item->post_title);?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="yeah-detail-item">
            <div class="yeah-main-hover">
                <a class="yeah-detail-edit" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
                <a class="yeah-detail-trash" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
            </div>
            <div class="yeah-main-content">
                <?php echo esc_html__('Add Product','yeah-woo-deals') ?>
            </div>
        </div>
    </div>
    <!-- div#dialog-box-->
    <div id="dialog-box">
        <div class="yeah-dialog-content">
            <!--DIV select Product-->
            <div class="yeah-select-product">
                <!--div.yeah-filter-product-->
                <div class="yeah-filter-product">
                    <form action="index.php" id="yeah-pro-search-form" class="clearfix">
                    <div class="yeah-pro-group">
                        <input type="text" id="yeah-search-input" name="yeah-search-input"  />
                    </div>
                    <div class="yeah-pro-group yeah-pro-categories">
                        <?php
                        $cat_lists = YeahWooDealsAdminModule::yeah_query_cart_lists();
                        ?>
                        <select name="yeah-search-cat" id="yeah-search-cat">
                            <option value=""><?php echo esc_html__('--Select Category--','yeah-woo-deals') ?></option>
                            <?php
                            if(!empty($cat_lists)){
                                foreach ($cat_lists as $cat) {
                                    echo "<option value='".$cat->term_id."'>".$cat->name."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="yeah-pro-group">
                        <input type="button" id="yeah-pro-search" name="yeah-search-btn" value="Search"  />
                    </div>
                    </form>
                </div>
                <!--End div.yeah-filter-product-->
                <!--div.yeah-data-product-->
                <div id="yeah-data-product" class="clearfix">

                </div>
                <!--End div.yeah-data-product-->
            </div><!--End DIV select Product-->
            <form action="index.php" class="clearfix">
                <div class="yeah-group">
                   <img class="yeah-image" src="" alt="" />
                </div>
                <div class="yeah-group">
                    <label for=""><?php echo esc_html__('Product Name','yeah-woo-deals') ?></label>
                    <label class="yeah-product-name">Product 1</label>
                </div>
                <div class="yeah-group">
                    <label for=""><?php echo esc_html__('Date Start Sale','yeah-woo-deals') ?></label>
                    <input id="yeah-dealstart"  class="datepicker"  name="alias" value="" placeholder="<?php echo esc_html__('Choice date start','yeah-woo-deals');?>"/>
                    <input id="yeah-deals-start-time" type="text" class="timepicker" name="content"  value="" placeholder="<?php echo esc_html__('Choice time','yeah-woo-deals');?>"/>
                </div>
                <div class="yeah-group">
                    <label for=""><?php echo esc_html__('Date End Sale','yeah-woo-deals') ?></label>
                    <input id="yeah-deals-end" class="datepicker" type="text"  name="content"  value="" placeholder="<?php echo esc_html__('Choice date start','yeah-woo-deals');?>"/>
                    <input id="yeah-deals-end-time" type="text" class="timepicker" name="content"  value="" placeholder="<?php echo esc_html__('Choice time','yeah-woo-deals');?>"/>
                </div>
                <div class="yeah-group">
                    <label for=""><?php echo esc_html__('Price Sale','yeah-woo-deals') ?></label>
                    <input id="yeah-content" type="text"  name="content"  value="" placeholder="<?php echo esc_html__('Price sale','yeah-woo-deals');?>"/>

                </div>
                <div class="yeah-hidden">
                    <input type="hidden" name="id" id="yeah-id" value="<?php echo $_GET['id'];?>"/>
                </div>
            </form>
        </div>
    </div>
    <!--End Dialog box-->

</section>
<script>
    jQuery(document).ready(function(){
        jQuery('.yeah-sortable-grid').sortable();
    })
</script>

