<?php


// Hook up some handler functions at start of plugin load
// -------------------------------------------------------

add_action( 'admin_menu', 'attn_box_plugin_menu');
add_action( 'admin_init','attnbox_register_settings');
add_filter('admin_footer', 'wp_attnbox_add_js_insert_handlers');
add_action('admin_enqueue_scripts', 'wp_attention_boxes_admin_scripts_method');


function wp_attention_boxes_admin_scripts_method() {
	$plugindir = get_settings('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
  
	// Enqueue the JS for Admin
	// ------------------------
	wp_register_script( 'wp_attention_boxes_plugin_script', WP_PLUGIN_URL . '/wp-attention-boxes/js/attnbox-option.js' );
	wp_register_script( 'wp_attention_boxes_divscroll_plugin_script', WP_PLUGIN_URL . '/wp-attention-boxes/js/jquery.smoothDivScroll-1.1-min.js', array('jquery-ui-core', 'jquery-ui-widget') );
	wp_enqueue_script('wp_attention_boxes_divscroll_plugin_script');
	wp_enqueue_script('wp_attention_boxes_plugin_script');
  
    // Enqueue the CSS for Admin
    // -------------------------
	$myStyleUrl = plugins_url('/css/attnbox-admin-styles.css', __FILE__);
	wp_register_style('my_attnbox_admin_StyleSheets', $myStyleUrl);
	wp_enqueue_style( 'my_attnbox_admin_StyleSheets');
	
	$myStyleUrl = plugins_url('/css/styles.css', __FILE__);
	wp_register_style('my_attnbox_StyleSheets', $myStyleUrl);
	wp_enqueue_style( 'my_attnbox_StyleSheets');
	
	$myStyleUrl = plugins_url('/css/attnbox-postmetabox-styles.css', __FILE__);
	wp_register_style('my_wpattn_box_metabox_StyleSheets', $myStyleUrl);
	wp_enqueue_style( 'my_wpattn_box_metabox_StyleSheets');
	
	$myStyleUrl = plugins_url('/css/smoothDivScroll.css', __FILE__);
	wp_register_style('wpattn_box_smoothdivscroll_StyleSheets', $myStyleUrl);
	wp_enqueue_style( 'wpattn_box_smoothdivscroll_StyleSheets');
	
}

function attn_box_plugin_menu() {
	$mypage = add_options_page('WP Attention Boxes Options Page','Attention DIV Boxes', 
                         'administrator', __FILE__, 'attn_box_plugin_options');
	
}


function attnbox_register_settings(){
	register_setting( 'attnbox_user_options', 'attnbox_options', 'attnboxes_validate' );
}


function attn_box_plugin_options() {
	
	?>
        
	<div class="wrap">
	<div class="icon32" id="icon-options-general"><br></div>
	<h2><?php _e("Set your") ?> Attention Box(DIV) <?php _e("Properties") ?></h2>
	<p><?php _e("Configure the plugin options below") ?></p>
        
	<div id="main_settings_section">
        
        
	<form method="post" action="options.php">
	
	
	<?php settings_fields('attnbox_user_options'); ?>
	<?php $options = get_option('attnbox_options'); 
	if ((!$options) && !is_array($options)) { 
		$plugindir = get_settings('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
		$img_tag1 = '<img style="margin-right: 8px;" src="' . $plugindir . '/images/1.gif">';
		$img_tag2 = '<img style="margin-right: 8px;" src="' . $plugindir . '/images/2.gif">';
    	  
	?>
          
	<div id="first_message_div" class="custom_attn_box">
	<span id="ft_message_title"><?php _e("Looks like you just activated this plugin.")?></span> <a id="close_first_time_message" href="#"><strong><?php _e("Close")?></strong></a><br><br>
	<?php echo $img_tag1; ?><?php _e("You can either start creating the DIV's by simply entering your own CSS settings,")?> <br>
                            == <?php _e("or")?> == <br>
    <?php echo $img_tag1; ?><?php _e("You can use the Auto-Populate Button at the very bottom of this page, to create a set of Starter DIV's to begin with.")?>
							</div>
	<?php }
	$wp_attention_box_upgrade_to_6 = get_option("wp_attention_box_upgrade_to_6");
	
	if (!empty($wp_attention_box_upgrade_to_6)) {
		
		update_option('wp_attention_box_upgrade_to_6', 0);
		?>
		<div id="upgraded_first_message_div" class="custom_attn_box">
		<span id="ft_message_title"><?php _e("Looks like you just upgraded to")?> <strong>0.6.x</strong> </span> <a id="close_upgrade_message" href="#"><strong>Close</strong></a><br><br>
		<?php _e("Since you have 6 empty DIV settings, you can pre-fill those with 'starter styles', using the buttons at the very bottom of this Settings Page.")?>
		<br><br><?php _e("( Note: Make sure to use the Prefill button on the Left if you wish to Keep your current DIV settings for the first 4! )")?>
		</div>
		
	<?php	} 
	foreach (range(1,10) as $idx) { ?>
        
        <table id="<?php echo $idx;?>" class="form-table" cellpadding="0" cellspacing="0">
            
        <tr valign="top">
           <th><?php _e(" Name:")?> </th> 
           <th scope="row">
              <span>  <input id="boxname_<?php echo $idx;?>" type="text" size="45" class="name_input" name="attnbox_options[box_name_<?php echo $idx;?>]" value="<?php echo $options['box_name_' . $idx]; ?>" />
              </span>
            </th>
        </tr>    
        <tr>
            <th scope="row" ><?php _e("Text Color")?></th>
            <td><input id="color<?php echo $idx;?>" type="text" name="attnbox_options[color<?php echo $idx;?>]" value="<?php echo $options['color' . $idx]; ?>" />
               
           </td>
        </tr>
        <tr>
            <th scope="row" ><?php _e("Background Color")?></th>
            <td><input  id="backcolor<?php echo $idx;?>" type="text" name="attnbox_options[backcolor<?php echo $idx;?>]" value="<?php echo $options['backcolor' . $idx]; ?>" />
                
           </td>
        </tr>
        <tr>    
            <th  scope="row"><?php _e("Border:")?> </th>
            <td>
                 
                 <input id="bwidth<?php echo $idx;?>" size=6 type="text" name="attnbox_options[bwidth<?php echo $idx;?>]" value="<?php echo $options['bwidth' . $idx]; ?>" />
                 
                 <select id="bstyle<?php echo $idx;?>" class="border_style"  name="attnbox_options[bstyle<?php echo $idx;?>]">
                    <option value='solid' <?php selected('solid', $options['bstyle' . $idx]); ?>><?php _e("Solid")?></option>
                    <option value='dotted' <?php selected('dotted', $options['bstyle' . $idx]); ?>><?php _e("Dotted")?></option>
                    <option value='dashed' <?php selected('dashed', $options['bstyle' . $idx]); ?>><?php _e("Dashed")?></option>
                    <option value='double' <?php selected('double', $options['bstyle' . $idx]); ?>><?php _e("Double")?></option>
                    <option value='groove' <?php selected('groove', $options['bstyle' . $idx]); ?>><?php _e("Groove")?></option>
                    <option value='ridge' <?php selected('ridge', $options['bstyle' . $idx]); ?>><?php _e("Ridge");?></option>
                    <option value='inset' <?php selected('inset', $options['bstyle' . $idx]); ?>><?php _e("Inset");?></option>
                    <option value='outset' <?php selected('outset', $options['bstyle' . $idx]); ?>><?php _e("Outset")?></option>
                  </select>
                  
                 <input id="bcolor<?php echo $idx;?>" class="border_color" type="text" name="attnbox_options[bcolor<?php echo $idx;?>]" value="<?php echo $options['bcolor' . $idx]; ?>" /> 
                  
            </td>
         </tr>
         
          <tr>    
            <th scope="row"><input id="round<?php echo $idx;?>" type="checkbox" name="attnbox_options[enable_rounded<?php echo $idx;?>]" value="1" <?php checked('1', $options['enable_rounded' . $idx]); ?>> <?php _e("Rounded Corners:")?> </th>
            <td><input id="roundsize<?php echo $idx;?>" class="border_color" type="text" name="attnbox_options[roundsize<?php echo $idx;?>]" value="<?php echo $options['roundsize' . $idx]; ?>" /> </td> 
          </tr>  
          <tr>
            <td><hr style="margin-top: 1px;"></td>
          </tr>
          
           <tr>
           <th><?php _e("Text Alignment")?></th>
            <td><?php _e("Left Align:")?> <input type="radio"  <?php checked('left', $options['align' . $idx]); ?> name="attnbox_options[align<?php echo $idx;?>]" value="left" > 
                <?php _e("Center Align:")?> <input type="radio" <?php checked('center', $options['align' . $idx]); ?> name="attnbox_options[align<?php echo $idx;?>]" value="center"></td>
          </tr>
          
         </table>
         
         <?php }  
        
         ?>

           <p class="submit"> <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  </p>
    
     </form>
    
    </div>
    
    <?php settings_fields('attnbox_user_set_defaults'); ?>
    
    <fieldset id="first_time_defaults">
    <legend><b>For First Time Activation (Optional)</b></legend>
    
    <div>
      <p><?php _e("If you've just upgraded to ")?><strong>0.6.x</strong> <?php _e("and you")?> ... <br> ...<span><?php _e("Don't Want to Overwrite")?></span> <?php _e("your existing first four")?> DIV's</p>
        <input title="<?php _e('You will need to Click \'Save Changes\' after')?>" class="set_div_default button-primary" id="existing_user" type="button" value="<?php _e("Prefill remaining 6 with Defaults")?>">
    </div>
    
     <div>
      <p><?php _e("If you're new to WP Attention Boxes")?></p>
        <input title="<?php _e('You will need to Click \'Save Changes\' after')?>" id="new_user" class="set_div_default  button-primary" type="button" value='<?php _e("Prefill Defaults for ALL 10")?> DIV Boxes'>
    </div>
    
   
   
    </fieldset>
    
    
    
    </div> <!--main_settings_section-->
    
    <?php 
   
     foreach (range(1,10) as $indx) {
          $var = "init_preview_box_styles" . $indx;
          $$var = "color: " .  $options['color'.$indx] . "; "; 
          $$var.= "background-color: " .  $options['backcolor'.$indx] . "; ";
          $$var.= "border-width: " .  $options['bwidth'.$indx] . "; ";
          $$var.= "border-style: " . $options['bstyle'.$indx] . "; ";
          $$var.= "border-color: " . $options['bcolor'.$indx] . "; ";
          $$var.= "text-align: " . $options['align'.$indx] . "; ";
          
          
          if ( isset($options['enable_rounded'.$indx]) && ($options['enable_rounded'.$indx] == "1")) {
            //echo "in here!";
            $$var .= "-webkit-border-radius: " .  $options['roundsize'.$indx] . "; ";
            $$var .= "-moz-border-radius: " .  $options['roundsize'.$indx] . "; ";
            $$var .= "border-radius: " .  $options['roundsize'.$indx] . "; ";
          }
          
     }
    ?>
    
    <div id="preview_box_container">
    
        <div class="preview_box_div" id="preview_1" style="<?php echo $init_preview_box_styles1; ?>" >
          Some text in my custom <strong><?php echo $options['box_name_1']; ?></strong>
          <span class="close-link">Close</span>
       </div>
       
        <div class="preview_box_div" id="preview_2" style="<?php echo $init_preview_box_styles2; ?>" >
          Some text in my custom <strong><?php echo $options['box_name_2']; ?> 
           <span class="close-link">Close</span>
          </strong>
       </div>
       
        <div class="preview_box_div" id="preview_3" style="<?php echo $init_preview_box_styles3; ?>" >
           Some text in my custom <strong><?php echo $options['box_name_3']; ?>
            <span class="close-link">Close</span>
           </strong>
       </div>
       
        <div class="preview_box_div" id="preview_4" style="<?php echo $init_preview_box_styles4; ?>" >
           Some text in my custom <strong><?php echo $options['box_name_4']; ?> 
            <span class="close-link">Close</span>
           </strong>
       </div>
       
       <div class="preview_box_div" id="preview_5" style="<?php echo $init_preview_box_styles5; ?>" >
          Some text in my custom <strong><?php echo $options['box_name_5']; ?>
           <span class="close-link">Close</span>
          </strong>
       </div>
       
        <div class="preview_box_div" id="preview_6" style="<?php echo $init_preview_box_styles6; ?>" >
          Some text in my custom <strong><?php echo $options['box_name_6']; ?>
           <span class="close-link">Close</span>
          </strong>
       </div>
       
        <div class="preview_box_div" id="preview_7" style="<?php echo $init_preview_box_styles7; ?>" >
           Some text in my custom <strong><?php echo $options['box_name_7']; ?>
            <span class="close-link">Close</span>
          </strong>
       </div>
       
        <div class="preview_box_div" id="preview_8" style="<?php echo $init_preview_box_styles8; ?>" >
           Some text in my custom <strong><?php echo $options['box_name_8']; ?> </strong>
          <span class="close-link">Close</span> 
       </div>
       
       <div class="preview_box_div" id="preview_9" style="<?php echo $init_preview_box_styles9; ?>" >
           Some text in my custom <strong><?php echo $options['box_name_9']; ?> </strong>
            <span class="close-link">Close</span>
       </div>
       
       <div class="preview_box_div" id="preview_10" style="<?php echo $init_preview_box_styles10; ?>" >
           Some text in my custom <strong><?php echo $options['box_name_10']; ?> </strong>
            <span class="close-link">Close</span>
       </div>
       
    </div>

<?php }





function attnboxes_validate($input) {
  
	foreach (range(1,10) as $indx) {
	    if (is_numeric($input['bwidth' . $indx])) {
	      $input['bwidth' . $indx] .= "px";
	    }
	    
	    if (is_numeric($input['roundsize' . $indx])) {
	      $input['roundsize' . $indx] .= "px";
	    }
	  } 
	    
		return $input;
	}
	

?>