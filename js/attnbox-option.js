var g_group_id;

jQuery(document).ready(function () {
 
	jQuery('.close-link').click( function() {
		div_id = jQuery(this).parents("div").attr("id");
		
		jQuery('#' + div_id).fadeOut("medium");
	
	});
 
  	jQuery("div#makeMeScrollable").smoothDivScroll({});
 
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
		setHoverDiv(table_id);
         
	});
       
       
       // wp_attention_box_upgrade_to_6
     
	jQuery('.set_div_default').click(function() {
	  
		button_clicked = jQuery(this).attr("id");
		if (button_clicked == "new_user") {
			confirm_text = 'Are you sure you want to reset all of your your current DIV values with Defaults ?';
		} else {
			confirm_text = 'Are you sure you want to fill DIV #5 - DIV #10 with default values ?';
		}
		
		if (confirm(confirm_text)) {
		    button_clicked = jQuery(this).attr("id");
		
			jQuery("input[value='center']").attr("checked", "checked");
			
			if (button_clicked == "new_user") 
			{
			
				jQuery("input[value='center']").attr("checked", "checked");
				jQuery("#boxname_1").val("Rounded Outset Box");
				jQuery("#preview_1").html("Some text in my custom <strong>Rounded Outset Box</strong>");
				jQuery("#color1").val("red");
				jQuery("#backcolor1").val("yellow");
				jQuery("#bwidth1").val("6px");
				jQuery("#bcolor1").val("gray");
				jQuery("#bstyle1").val("outset");
				jQuery("#round1").attr('checked', 'checked');
				jQuery("#roundsize1").val("12px");
				
				jQuery("#boxname_2").val("Dotted Line Box");
				jQuery("#preview_2").html("Some text in my custom <strong>Dotted Line Box</strong>");
				jQuery("#color2").val("black");
				jQuery("#backcolor2").val("#fffacd");
				jQuery("#bwidth2").val("2px");
				jQuery("#bstyle2").val("dashed");
				jQuery("#bcolor2").val("brown");
				jQuery("#roundsize2").val("10px");
	          
				jQuery("#boxname_3").val("My Quote Box");
				jQuery("#preview_3").html("Some text in my custom <strong>My Quote Box</strong>");
				jQuery("#color3").val("black");
				jQuery("#backcolor3").val("white");
				jQuery("#bwidth3").val("4px");
				jQuery("#bstyle3").val("ridge");
				jQuery("#bcolor3").val("black");
				jQuery("#round3").attr('checked', 'checked');
				jQuery("#roundsize3").val("10px");
			    
				jQuery("#boxname_4").val("Summary Box");
				jQuery("#preview_4").html("Some text in my custom <strong>Summary Box</strong>");
				jQuery("#color4").val("#000000");
				jQuery("#backcolor4").val("#eeeeee");
				jQuery("#bwidth4").val("5px");
				jQuery("#bstyle4").val("solid");
				jQuery("#bcolor4").val("#bbbbbb");
				jQuery("#roundsize4").val("10px");
			}
                  
			jQuery("#boxname_5").val("Misc Box 5");
			jQuery("#preview_5").html("Some text in my custom <strong>Misc Box 5</strong>");
			jQuery("#color5").val("#fff");
			jQuery("#backcolor5").val("#008000");
			jQuery("#bwidth5").val("1px");
			jQuery("#bstyle5").val("solid");
			jQuery("#bcolor5").val("#bbbbbb");
			jQuery("#roundsize5").val("10px");
			jQuery("#round5").attr('checked', 'checked');
		   
			jQuery("#boxname_6").val("Misc Box 6");
			jQuery("#preview_6").html("Some text in my custom <strong>Misc Box 6</strong>");
			jQuery("#color6").val("#000");
			jQuery("#backcolor6").val("#efe4a4");
			jQuery("#bwidth6").val("4px");
			jQuery("#bstyle6").val("solid");
			jQuery("#bcolor6").val("#e12e11");
			jQuery("#round6").attr('checked', 'checked');
			jQuery("#roundsize6").val("10px");
    
			jQuery("#boxname_7").val("Misc Box 7");
			jQuery("#preview_7").html("Some text in my custom <strong>Misc Box 7</strong>");
			jQuery("#color7").val("black");
			jQuery("#backcolor7").val("#eeeee4");
			jQuery("#bwidth7").val("3px");
			jQuery("#bstyle7").val("solid");
			jQuery("#bcolor7").val("#bbbbbb");
			jQuery("#round7").attr('checked', 'checked');
			jQuery("#roundsize7").val("10px");
             
			jQuery("#boxname_8").val("Misc Box 8");
			jQuery("#preview_8").html("Some text in my custom <strong>Misc Box 8</strong>");
			jQuery("#color8").val("yellow");
			jQuery("#backcolor8").val("blue");
			jQuery("#bwidth8").val("1px");
			jQuery("#bstyle8").val("solid");
			jQuery("#bcolor8").val("#bbbbbb");
			jQuery("#round8").attr('checked', 'checked');
			jQuery("#roundsize8").val("4px");
               
			jQuery("#boxname_9").val("Misc Box 9");
			jQuery("#preview_9").html("Some text in my custom <strong>Misc Box 9</strong>");
			jQuery("#color9").val("white");
			jQuery("#backcolor9").val("gray");
			jQuery("#bwidth9").val("5px");
			jQuery("#bstyle9").val("solid");
			jQuery("#bcolor9").val("lightgray");
			jQuery("#round9").attr('checked', 'checked');
			jQuery("#roundsize9").val("10px");
           
			jQuery("#boxname_10").val("Misc Box 10");
			jQuery("#preview_10").html("Some text in my custom <strong>Misc Box 10</strong>");
			jQuery("#color10").val("#a121bb");
			jQuery("#backcolor10").val("#eeff64");
			jQuery("#bwidth10").val("5px");
			jQuery("#bstyle10").val("solid");
			jQuery("#bcolor10").val("gray");
			jQuery("#round10").attr('checked', 'checked');
			jQuery("#roundsize10").val("10px");
			
			for ( indx=1; indx<=10; indx++ ) {
				setHoverDiv(indx);
			}   
		
		}
       
	});

	jQuery('#close_first_time_message').click( function() {
		jQuery("#first_message_div").hide();
	})
	
	
	jQuery('#close_upgrade_message').click( function() {
		jQuery("#upgraded_first_message_div").hide();
	})

});

function setHoverDiv(table_id) {
	
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
         
}