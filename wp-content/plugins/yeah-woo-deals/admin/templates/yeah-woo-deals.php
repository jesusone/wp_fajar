<?php
$tablename = "yeah_woo_deals_short_code";
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM '.$tablename.' ', OBJECT );
?>
<div class="yeah-message">
    <div class="yeah-message-content"></div>
</div>
<div class="yeah-loading">
    <div class="yeah-loading-content">
        <i class="fa fa-spinner fa-spin"></i>
        <span class="yeah-text-loading">Loading...</span>
    </div>
</div>
<section class="yeah-deals-admin">
    <div class="yeah-deals-plugin-title">
        <div class="yeah-title">
           <h2><?php echo esc_html__('Woo Deals','yeah-woo-deals')?></h2>
        </div>
    </div>
    <div class="yeah-deals-main">
        <div class="yeah-short-code-lists">
            <div class="yeah-short-code-title">
                <?php echo esc_html__('Woo deals short codes','yeah-woo-deals') ?>
            </div>
            <div class="yeah-deals-filter">
                <span class="yeah-deals-show yeah-show-lists"><i class="fa fa-list"></i></span>
                <span class="yeah-deals-show yeah-show-grid" ><i class="fa fa-th"></i></span>
            </div>
        </div>
    </div>
    <div class="yeah-sortable-grid">
        <?php foreach($results as $item): ?>
        <div class="yeah-short-code-item" id="yeah-item-<?php echo esc_attr($item->id); ?>">
            <div class="yeah-main-media">
                <div class="yeah-main-hover">
                    <a class="yeah-setting" data-id="<?php echo esc_attr($item->id); ?>" href="javascript:void(0);"><i class="fa fa-cogs"></i></a>
                    <a class="yeah-edit" href="?page=yeah-woo-deals-short-codes&view=yeah-woo-detail&id=<?php echo $item->id; ?>"><i class="fa fa-pencil"></i></a>
                    <a class="yeah-trash" data-id="<?php echo esc_attr($item->id);?>"  href="javascript:void(0);"><i class="fa fa-trash"></i></a>
                </div>
            </div>
            <div class="yeah-main-content">
                <?php echo $item->name;?>
            </div>
        </div>
       <?php endforeach; ?>
        <div class="yeah-short-code-item add-new">
            <div class="yeah-main-media">
                <div class="yeah-main-hover">
                    <a class="yeah-new yeah-setting" data-id="0" href="javascript:void(0);"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="yeah-main-content">
               <?php echo  esc_html__('Add New','yeah-woo-deals')?>
            </div>
        </div>
    </div>
</section>
<div id="dialog-box">
    <div class="dialog-content">
       <form action="index.php">
           <div class="yeah-group">
               <label for=""><?php echo esc_html__('Name','yeah-woo-deals') ?></label>
               <input id="yeah-name" name="name" value="" placeholder="<?php echo esc_html__('Name Short Code','yeah-woo-deals');?>"/>
           </div>
           <div class="yeah-group">
               <label for=""><?php echo esc_html__('Alias','yeah-woo-deals') ?></label>
               <input id="yeah-alias" name="alias" value="" placeholder="<?php echo esc_html__('Alias Short Code','yeah-woo-deals');?>"/>
           </div>
           <div class="yeah-group">
               <label for=""><?php echo esc_html__('Name','yeah-woo-deals') ?></label>
               <textarea id="yeah-content"  name="content" value="" placeholder="<?php echo esc_html__('Name Short Code','yeah-woo-deals');?>">

               </textarea>
           </div>
           <div class="yeah-hidden">
               <input type="hidden" name="id" id="yeah-id" value=""/>
           </div>
       </form>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('.yeah-sortable-grid').sortable();
    })
</script>

