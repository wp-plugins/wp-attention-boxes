var g_group_id;

jQuery(document).ready(function () {
 
   // Attach handler to checkbox, so that after page loads, 
   // checking/unchecking the Enable checkbox makes it
   // clear you are disabling the Box/Div via css
   // ------------------------------------------------
    jQuery("input:checkbox.enable_check").click( function () {
        id = jQuery(this).parents("table").attr("id");
        if (this.checked) {
            jQuery("table#" + id + " tr td :input").css({color:'#000000'});
            jQuery("table#" + id + " tr th .name_input").css({color:'#000000'});
        }
         else {
            jQuery("table#" + id + " tr td :input").css({color:'#808080'}); 
            jQuery("table#" + id + " tr th .name_input").css({color:'#808080'});


        }
    });


    jQuery("table :input").focus( function() {
       
        group_id = jQuery(this).parents("table").attr("id");
        if (group_id != g_group_id) {
          jQuery(".preview_box_div").hide();
          g_group_id = group_id;
        }
           jQuery("#preview_" + group_id).fadeIn("fast");
           
    });

       jQuery("table :input").change( function() {
       
         table_id = jQuery(this).parents("table").attr("id");
       
         textcolor=jQuery("#color" + table_id).val();
         backcolor=jQuery("#backcolor" + table_id).val();
         bwidth=jQuery("#bwidth" + table_id).val();
         bcolor=jQuery("#bcolor" + table_id).val();
         bstyle=jQuery("#bstyle" + table_id).val();
         round_enabled = jQuery("#round" + table_id).val();
         
         bround=jQuery("#roundsize" + table_id).val();
         radioName="align" + table_id;
         alignment = jQuery('table#' + table_id + " input[type='radio']:checked").val();
        
         jQuery("#preview_"+table_id).css({'color': textcolor, 'background-color':backcolor, 'border-left': bwidth + " " + bstyle + " " + bcolor });
         jQuery("#preview_"+table_id).css({'border-right': bwidth + " " + bstyle + " " + bcolor});
         jQuery("#preview_"+table_id).css({'border-top': bwidth + " " + bstyle + " " + bcolor});
         jQuery("#preview_"+table_id).css({'border-bottom': bwidth + " " + bstyle + " " + bcolor});
         
         
         if (jQuery("#round" + table_id).is(':checked')) {
             jQuery("#preview_"+table_id).css({borderTopLeftRadius: bround,
                                               borderTopRightRadius: bround,
                                               borderBottomLeftRadius: bround,
                                               borderBottomRightRadius: bround})
         } else {
            jQuery("#preview_"+table_id).css({borderTopLeftRadius: 0,
                                               borderTopRightRadius: 0,
                                               borderBottomLeftRadius: 0,
                                               borderBottomRightRadius: 0})
         }
        
       
          
          jQuery("#preview_"+table_id).css({"text-align": alignment});
         
       
       });


});

