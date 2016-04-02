jQuery.noConflict();
jQuery(document).ready(function(){

    /*Seting Delas*/
    // end setting page JS
    if( jQuery('.wa-field-dates').length > 0 ){
        jQuery('.wa-field-dates').each(function(){
            jQuery(this).datetimepicker({
                value: jQuery(this).data('dates'),
                step: 10
            });
        })
    }
    jQuery(".yeah-group-deal").chosen();
    jQuery('.chosen-container').css({"width": "300px"});
    jQuery('.yeah-setting').live('click',function(){
       var $_this = jQuery(this);
       jQuery( "#dialog-box" ).dialog({
               modal: true,
               width: 600,
               buttons: [
                   {
                       text: "Save",
                       click: function() {
                           yeah_save_short_code();
                       }
                   },
                   {
                       text: "Close",
                       click: function() {
                           jQuery(this).dialog("close");
                       }
                   }
               ]
       });
       yeah_deals_modal($_this);

   });
    /*Close poup click body*/
    jQuery('.ui-widget-overlay').live('click',function(){
        jQuery('#dialog-box').dialog('close');
        jQuery('.ui-widget-overlay').fadeOut(2000);
    });

    /*Delete Item Short code*/
    jQuery('.yeah-trash').live('click',function(){
        var $_this = jQuery(this);
        if(confirm('Do you really want delete '+jQuery('#yeah-item-'+$_this.data('id')+' .yeah-main-content').html()+'?')){
            var $_data =
            {
                'id': $_this.data('id')
            };
            jQuery.ajax({
                url : ajaxurl,
                type: 'POST',
                beforeSend : function(){
                    yeah_ajax_loading();
                },
                complete : function(){
                    yeah_ajax_loaded();
                },
                dataType:'json',
                data:{'action':'short_code_delete_item','data':$_data,'yeahNone':WooDeals.yeahNonce},
                success: function(data){
                    jQuery('.yeah-message').addClass('yeah-open');
                    /*Add New*/
                    if(data.status){
                        jQuery('#yeah-item-'+$_data['id']).remove();
                        jQuery('.yeah-message-content').html(data.message);
                        jQuery('.yeah-message').removeClass('yeah-error');
                    }
                    else {
                        jQuery('.yeah-message-content').html(data.message);
                        jQuery('.yeah-message').addClass('yeah-error');
                    }

                }
            });
        }else {
            return false;
        }
    });

    /*==================STAR DETAIL SHORT CODE================*/
    /*Only checkbox*/
    jQuery(".yeah-action input:checkbox").live('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = jQuery(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            jQuery(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    jQuery('.yeah-detail-edit').live('click',function(){
        jQuery( "#dialog-box" ).dialog({
            modal: true,
            width: 800,
            buttons: [
                {
                    text: "Save",
                    click: function() {
                        yeah_save_products();
                    }
                },
                {
                    text: "Close",
                    click: function() {
                        jQuery(this).dialog("close");
                    }
                }
            ]
        });
    });

    /*Search products*/
    jQuery('#yeah-pro-search').live('click',function(){
        var $_data =
        {
            'keyword': jQuery('#yeah-search-input').val(),
            'category': jQuery('#yeah-search-cat').val(),
        };
        jQuery.ajax({
            url : ajaxurl,
            type: 'POST',
            beforeSend : function(){
                yeah_ajax_loading();
            },
            complete : function(){
                yeah_ajax_loaded();
            },
            data:{'action':'yeah_search_products','data':$_data,'yeahNone':WooDeals.yeahNonce},
            success: function(data){
                jQuery('.yeah-message').addClass('yeah-open');
                /*Add New*/
                if(data){
                    jQuery('#yeah-data-product').html(data);
                }
            }
        });
    });
});
/*===========================Function Product Detail====================*/
function yeah_save_products(){
    
}
/*===========================End Product Detail====================*/
/*Function save ajax short code*/
function  yeah_save_short_code(){

   var $_data =
       {
           'title': jQuery('#yeah-name').val(),
           'alias': jQuery('#yeah-alias').val(),
           'content': jQuery('#yeah-content').val(),
           'id': jQuery('#yeah-id').val(),
       };
    jQuery.ajax({
        url : ajaxurl,
        type: 'POST',
        beforeSend : function(){
            yeah_ajax_loading();
        },
        complete : function(){
            yeah_ajax_loaded();
        },
        dataType:'json',
        data:{'action':'short_code_new_update','data':$_data,'yeahNone':WooDeals.yeahNonce},
        success: function(data){
            jQuery('.yeah-message').addClass('yeah-open');
            /*Add New*/
            if(data.status){
                jQuery('.dialog-content').show(200);
                jQuery('#yeah-name').attr('value',data.data.title);
                jQuery('#yeah-alias').attr('value',data.data.alias);
                jQuery('#yeah-content').attr('value',data.data.content);
                if($_data['id'] == 0){
                    jQuery('.yeah-short-code-item.add-new').before(data.data.html);
                    jQuery('#dialog-box').dialog('close');
                }
                jQuery('.yeah-message-content').html(data.message);
                jQuery('.yeah-message').removeClass('yeah-error');
            }
            else {
                jQuery('.yeah-message-content').html(data.message);
                jQuery('.yeah-message').addClass('yeah-error');
            }
        }
    });
}

/*Load data setting to short code.*/
function yeah_deals_modal($_this){

    var $_open_modal = jQuery('#dialog-box').dialog( "isOpen" );
    if($_open_modal== true){
        if($_this.hasClass('yeah-new')){
            jQuery('#yeah-name').val('');
            jQuery('#yeah-content').val('');
            jQuery('#yeah-alias').val('');
            jQuery('#yeah-id').attr('value',0);
            jQuery('.dialog-content').show(200);
        }
        else{
            jQuery.ajax({
                url : ajaxurl,
                type: 'POST',
                dataType:'json',
                beforeSend:function(){
                    jQuery('.dialog-content').hide();
                    yeah_ajax_loading();
                },
                complete:function(){
                    yeah_ajax_loaded();
                },
                data:{'action':'short_code_detail','data':$_this.data('id'),'yeahNone':WooDeals.yeahNonce},
                success: function(data){
                    if(data.status){
                        var $yeah_data = data.data[0];
                        jQuery('.dialog-content').show(200);
                        jQuery('#dialog-box #yeah-name').attr('value',$yeah_data.name);
                        jQuery('#dialog-box #yeah-content').attr('value',$yeah_data.content);
                        jQuery('#dialog-box #yeah-id').attr('value',$yeah_data.id);
                    }
                }
            });
        }


    }
}
function  yeah_ajax_loading(){
    jQuery('.yeah-loading').addClass('yeah-open');
}
function  yeah_ajax_loaded(){
    jQuery('.yeah-loading').removeClass('yeah-open');
}





