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
       
       jQuery('#set_div_default').click(function() {
       
          if (confirm('Are you sure you want to reset your current values with Defaults')) {
             
             jQuery("input[value='center']").attr("checked", "checked");
             
             jQuery("#boxname_1").val("Rounded Outset Box");
             jQuery("#preview_1").html("some text in my custom <strong>Rounded Outset Box</strong>");
             jQuery("#color1").val("red");
             jQuery("#backcolor1").val("yellow");
             jQuery("#bwidth1").val("6px");
             jQuery("#bcolor1").val("gray");
             jQuery("#bstyle1").val("outset");
             jQuery("#round1").attr('checked', 'checked');
             jQuery("#roundsize1").val("12px");
             
             jQuery("#boxname_1").trigger('change');
             
             jQuery("#boxname_2").val("Dotted Line Box");
             jQuery("#preview_2").html("some text in my custom <strong>Dotted Line Box</strong>");
             jQuery("#color2").val("black");
             jQuery("#backcolor2").val("#FFFACD");
             jQuery("#bwidth2").val("2px");
             jQuery("#bstyle2").val("dashed");
             jQuery("#bcolor2").val("brown");
             jQuery("#roundsize2").val("10px");
             
             jQuery("#boxname_2").trigger('change');
             
             jQuery("#boxname_3").val("My Quote Box");
             jQuery("#preview_3").html("some text in my custom <strong>My Quote Box</strong>");
             jQuery("#color3").val("black");
             jQuery("#backcolor3").val("white");
             jQuery("#bwidth3").val("4px");
             jQuery("#bstyle3").val("ridge");
             jQuery("#bcolor3").val("black");
             jQuery("#round3").attr('checked', 'checked');
             jQuery("#roundsize3").val("10px");
             
             jQuery("#boxname_3").trigger('change');
              
             jQuery("#boxname_4").val("Summary Box");
             jQuery("#preview_4").html("some text in my custom <strong>Summary Box</strong>");
             jQuery("#color4").val("#000000");
             jQuery("#backcolor4").val("#EEEEEE");
             jQuery("#bwidth4").val("3px");
             jQuery("#bstyle4").val("solid");
             jQuery("#bcolor4").val("#BBBBBB");
             jQuery("#roundsize4").val("10px");
             
             
             jQuery("#boxname_4").trigger('change');
             
         }
       
     });

     jQuery('#close_first_time_message').click( function() {
       jQuery("#first_message_div").hide();
     })

});

