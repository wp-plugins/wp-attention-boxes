<?php

class Attention_Box_Options {

    // Hook up some handler functions at start of plugin load
    // -------------------------------------------------------
    function __construct() {
        add_action('admin_menu', array( &$this,'attn_box_plugin_menu'));
        add_action( 'admin_init', array( &$this,'attnbox_register_settings' ));
        add_action( 'admin_init', array( &$this,'wp_attn_boxes_add_div_carousel'));
        wp_register_script( 'myPluginScript', WP_PLUGIN_URL . '/wp-attention-boxes/js/attnbox_option.js' );
    }
    
    
    

/* Adds a box to the main column on the Post and Page edit screens */
function wp_attn_boxes_add_div_carousel() {
   $this->enqueue_metabox_styles();

    add_meta_box( 
        'attnbox_sectionid',
        __( 'View Your Attention Boxes', 'attnbox_textdomain' ),
        array($this, 'wp_box_div_carousel'),
        'post' 
    );
    
     add_meta_box( 
        'attnbox_sectionid',
        __( 'View Your Attention Boxes', 'attnbox_textdomain' ),
        array($this, 'wp_box_div_carousel'),
        'page' 
    );
}



function enqueue_metabox_styles() {
      $myStyleUrl = WP_PLUGIN_URL . '/wp-attention-boxes/css/attnbox_postmetabox_styles.css';
        $myStyleFile = WP_PLUGIN_DIR . '/wp-attention-boxes/css/attnbox_postmetabox_styles.css';
        if ( file_exists($myStyleFile) ) {
            wp_register_style('my_wpattn_box_metabox_StyleSheets', $myStyleUrl);
            wp_enqueue_style( 'my_wpattn_box_metabox_StyleSheets');
        }
   }


/* Prints the box content */
function wp_box_div_carousel ( $post ) {


  // Use nonce for verification
  // wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );

  // print the configured boxes ________________________________

  echo '<div class="outer_div_post_page">';
  $options = get_option('attnbox_options'); 
  foreach (range(1,4) as $indx) {
   $style = 'style="color:' . $options['color' . $indx] . ';';
   $style .= 'background-color:' . $options['backcolor' . $indx] . ';';
   $style .= 'border:' . $options['bwidth' . $indx];
   $style .= ' ' . $options['bstyle' . $indx];
   $style .= ' ' . $options['bcolor' . $indx] . ';';
   if (isset($options['enable_rounded' . $indx]) && ($options['enable_rounded'.$indx] == "1")) {
     $style .= ' -webkit-border-radius: ' . $options['roundsize' . $indx] . ';';
     $style .= ' -moz-border-radius: ' . $options['roundsize' . $indx] . ';';
     $style .= ' border-radius: ' . $options['roundsize' . $indx] . ';';
   }
   $style .= ' text-align: ' . $options['align' . $indx] . ';"';
   echo '<div ' . $style .  '>' . $options['box_name_' . $indx] . '</div>';
  }
    
  echo '</div>'; 
 }
    
    function attn_box_plugin_menu() {
        $mypage = add_options_page('WP Attention Boxes Options Page','Attention Div Boxes', 
                         'administrator', __FILE__, array( &$this,'attn_box_plugin_options'));
        add_action( "admin_print_scripts-$mypage", array( &$this,'attnbox_admin_head') );
    }

    // Tell Wordpress to load a custom CSS file which only be used for this plugin, while using the Options Page
    // ---------------------------------------------------------------------------------------------------
    function attnbox_admin_head() {
        $plugindir = get_settings('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
    	wp_enqueue_script('myPluginScript');
    	echo '<link rel="stylesheet" href="' . $plugindir . '/css/attnbox_admin_styles.css" type="text/css" />';
    	echo '<link rel="stylesheet" href="' . $plugindir . '/css/styles.css" type="text/css" />';
    }


    function attnbox_register_settings(){
       register_setting( 'attnbox_user_options', 'attnbox_options', 'attnboxes_validate' );
    }

    function attn_box_plugin_options() {
  ?>
        
        <div class="wrap">
        <div class="icon32" id="icon-options-general"><br></div>
        <h2>Set your Attention Box(Div) Properties</h2>
        <p>Configure the plugin options below</p>
        
        <div id="main_settings_section">
        
        
        <form method="post" action="options.php">
        <?php settings_fields('attnbox_user_options'); ?>
        <?php $options = get_option('attnbox_options'); 
        
        /*-webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;*/
        
        
        ?>    
        <table id="1" class="form-table" cellpadding="0" cellspacing="0">
            
        <tr valign="top">
           <th ><input  name="attnbox_options[enable_div1]" class="enable_check" type="checkbox" value="1" <?php checked('1', $options['enable_div1']); ?>> Name: </th> 
           <th scope="row">
              <span>   <input id="boxname_1" type="text" size="45" class="name_input" name="attnbox_options[box_name_1]" value="<?php echo $options['box_name_1']; ?>" />
              </span>
            </th>
        </tr>    
        <tr>
            <th scope="row" >Text Color</th>
            <td><input id="color1" type="text" name="attnbox_options[color1]" value="<?php echo $options['color1']; ?>" />
               
           </td>
        </tr>
        <tr>
            <th scope="row" >Background Color</th>
            <td><input  id="backcolor1" type="text" name="attnbox_options[backcolor1]" value="<?php echo $options['backcolor1']; ?>" />
                
           </td>
        </tr>
        <tr>    
            <th  scope="row">Border: </th>
            <td>
                 
                 <input id="bwidth1" size=6 type="text" name="attnbox_options[bwidth1]" value="<?php echo $options['bwidth1']; ?>" />
                 
                 <select id="bstyle1" class="border_style"  name="attnbox_options[bstyle1]">
                    <option value='solid' <?php selected('solid', $options['bstyle1']); ?>>Solid</option>
                    <option value='dotted' <?php selected('dotted', $options['bstyle1']); ?>>Dotted</option>
                    <option value='dashed' <?php selected('dashed', $options['bstyle1']); ?>>Dashed</option>
                    <option value='double' <?php selected('double', $options['bstyle1']); ?>>Double</option>
                    <option value='groove' <?php selected('groove', $options['bstyle1']); ?>>Groove</option>
                    <option value='ridge' <?php selected('ridge', $options['bstyle1']); ?>>Ridge</option>
                    <option value='inset' <?php selected('inset', $options['bstyle1']); ?>>Inset</option>
                    <option value='outset' <?php selected('outset', $options['bstyle1']); ?>>Outset</option>
                  </select>
                  
                 <input id="bcolor1" class="border_color" type="text" name="attnbox_options[bcolor1]" value="<?php echo $options['bcolor1']; ?>" /> 
                  
            </td>
         </tr>
         
          <tr>    
            <th scope="row"><input id="round1" type="checkbox" name="attnbox_options[enable_rounded1]" value="1" <?php checked('1', $options['enable_rounded1']); ?>> Rounded Corners: </th>
            <td><input id="roundsize1" class="border_color" type="text" name="attnbox_options[roundsize1]" value="<?php echo $options['roundsize1']; ?>" /> </td> 
          </tr>  
          <tr>
            <td><hr style="margin-top: 1px;"></td>
          </tr>
          
           <tr>
           <th>Text Alignment</th>
            <td>Left Align: <input type="radio"  <?php checked('left', $options['align1']); ?> name="attnbox_options[align1]" value="left" > 
                Center Align: <input type="radio" <?php checked('center', $options['align1']); ?> name="attnbox_options[align1]" value="center"></td>
          </tr>
          
         </table>
         
         <p>&nbsp;</p>
         
        
         <table id="2" class="form-table">
            
        <tr valign="top">
           <th> <input  name="attnbox_options[enable_div2]" class="enable_check" type="checkbox" value="1" <?php checked('1', $options['enable_div2']); ?>> Name: </th> 
           <th scope="row"><span><input type="text" size="45" class="name_input" name="attnbox_options[box_name_2]" value="<?php echo $options['box_name_2']; ?>" /></span></th>
        </tr>    
        <tr>
            <th scope="row" >Text Color</th>
            <td><input id="color2" type="text" name="attnbox_options[color2]" value="<?php echo $options['color2']; ?>" />
               
           </td>
        </tr>
        <tr>
            <th scope="row" >Background Color</th>
            <td><input id="backcolor2" type="text" name="attnbox_options[backcolor2]" value="<?php echo $options['backcolor2']; ?>" />
                
           </td>
        </tr>
        <tr>    
            <th scope="row">Border: </th>
            <td>
                 
                 <input id="bwidth2" size=6 type="text" name="attnbox_options[bwidth2]" value="<?php echo $options['bwidth2']; ?>" />
                 
                 <select id="bstyle2" class="border_style" name="attnbox_options[bstyle2]">
                    <option value='solid' <?php selected('solid', $options['bstyle2']); ?>>Solid</option>
                    <option value='dotted' <?php selected('dotted', $options['bstyle2']); ?>>Dotted</option>
                    <option value='dashed' <?php selected('dashed', $options['bstyle2']); ?>>Dashed</option>
                    <option value='double' <?php selected('double', $options['bstyle2']); ?>>Double</option>
                    <option value='groove' <?php selected('groove', $options['bstyle2']); ?>>Groove</option>
                    <option value='ridge' <?php selected('ridge', $options['bstyle2']); ?>>Ridge</option>
                    <option value='inset' <?php selected('inset', $options['bstyle2']); ?>>Inset</option>
                    <option value='outset' <?php selected('outset', $options['bstyle2']); ?>>Outset</option>
                  </select>
                  
                 <input id="bcolor2" class="border_color"  type="text" name="attnbox_options[bcolor2]" value="<?php echo $options['bcolor2']; ?>" /> 
                  
            </td>
           </tr> 
           
            <tr>    
             <th scope="row"><input id="round2" type="checkbox" name="attnbox_options[enable_rounded2]" value="1" <?php checked('1', $options['enable_rounded2']); ?>> Rounded Corners: </th>
              <td><input id="roundsize2" class="border_color" type="text" name="attnbox_options[roundsize2]" value="<?php echo $options['roundsize2']; ?>" /> </td> 
          </tr> 
          <tr>
            <td><hr style="margin-top: 1px;"></td>
          </tr>
          <tr>
            <th>Text Alignment</th>
            <td>Left Align: <input type="radio"  <?php checked('left', $options['align2']); ?> name="attnbox_options[align2]" value="left" > 
                Center Align: <input type="radio" <?php checked('center', $options['align2']); ?> name="attnbox_options[align2]" value="center"></td>
          </tr>
           
         </table>
         
         <p>&nbsp;</p>
         
          <table id="3" class="form-table">
            
        <tr valign="top">
           <th><input  name="attnbox_options[enable_div3]" class="enable_check" type="checkbox" value="1" <?php checked('1', $options['enable_div3']); ?>> Name: </th> 
           <th scope="row"><span><input type="text" size="45" class="name_input" name="attnbox_options[box_name_3]" value="<?php echo $options['box_name_3']; ?>" /></span></th>
        </tr>    
        <tr>
            <th scope="row" >Text Color</th>
            <td><input  id="color3" type="text" name="attnbox_options[color3]" value="<?php echo $options['color3']; ?>" />
               
           </td>
        </tr>
        <tr>
            <th scope="row" >Background Color</th>
            <td><input id="backcolor3" type="text" name="attnbox_options[backcolor3]" value="<?php echo $options['backcolor3']; ?>" />
                
           </td>
        </tr>
        <tr>    
            <th scope="row">Border: </th>
            <td>
                 
                 <input id="bwidth3" size=6 type="text" name="attnbox_options[bwidth3]" value="<?php echo $options['bwidth3']; ?>" />
                 
                 <select id="bstyle3" class="border_style" name="attnbox_options[bstyle3]">
                    <option value='solid' <?php selected('solid', $options['bstyle3']); ?>>Solid</option>
                    <option value='dotted' <?php selected('dotted', $options['bstyle3']); ?>>Dotted</option>
                    <option value='dashed' <?php selected('dashed', $options['bstyle3']); ?>>Dashed</option>
                    <option value='double' <?php selected('double', $options['bstyle3']); ?>>Double</option>
                    <option value='groove' <?php selected('groove', $options['bstyle3']); ?>>Groove</option>
                    <option value='ridge' <?php selected('ridge', $options['bstyle3']); ?>>Ridge</option>
                    <option value='inset' <?php selected('inset', $options['bstyle3']); ?>>Inset</option>
                    <option value='outset' <?php selected('outset', $options['bstyle3']); ?>>Outset</option>
                  </select>
                  
                 <input id="bcolor3" class="border_color" type="text" name="attnbox_options[bcolor3]" value="<?php echo $options['bcolor3']; ?>" /> 
                  
            </td>
          </tr>
           <tr>    
              <th scope="row"><input id="round3" type="checkbox" name="attnbox_options[enable_rounded3]" value="1" <?php checked('1', $options['enable_rounded3']); ?>> Rounded Corners: </th>
               <td><input id="roundsize3" class="border_color" type="text" name="attnbox_options[roundsize3]" value="<?php echo $options['roundsize3']; ?>" /> </td> 
          </tr> 
          <tr>
            <td><hr style="margin-top: 1px;"></td>
          </tr>
           <tr>
            <th>Text Alignment</th>
            <td>Left Align: <input type="radio"  <?php checked('left', $options['align3']); ?> name="attnbox_options[align3]" value="left" > 
                Center Align: <input type="radio" <?php checked('center', $options['align3']); ?> name="attnbox_options[align3]" value="center"></td>
          </tr>
          
         </table>
         
         <p>&nbsp;</p>
         
          <table  id="4" class="form-table">
            
        <tr valign="top">
           <th><input  name="attnbox_options[enable_div4]" class="enable_check" type="checkbox" value="1" <?php checked('1', $options['enable_div4']); ?>> Name: </th> 
           <th scope="row"><span><input type="text" size="45" class="name_input" name="attnbox_options[box_name_4]" value="<?php echo $options['box_name_4']; ?>" /></span></th>
        </tr>    
        <tr>
            <th scope="row" >Text Color</th>
            <td><input  id="color4" type="text" name="attnbox_options[color4]" value="<?php echo $options['color4']; ?>" />
               
           </td>
        </tr>
        <tr>
            <th scope="row" >Background Color</th>
            <td><input id="backcolor4" type="text" name="attnbox_options[backcolor4]" value="<?php echo $options['backcolor4']; ?>" />
                
           </td>
        </tr>
        <tr>    
            <th scope="row">Border: </th>
            <td>
                 
                 <input id="bwidth4" size=6 type="text" name="attnbox_options[bwidth4]" value="<?php echo $options['bwidth4']; ?>" />
                 
                 <select id="bstyle4" class="border_style" name="attnbox_options[bstyle4]">
                    <option value='solid' <?php selected('solid', $options['bstyle4']); ?>>Solid</option>
                    <option value='dotted' <?php selected('dotted', $options['bstyle4']); ?>>Dotted</option>
                    <option value='dashed' <?php selected('dashed', $options['bstyle4']); ?>>Dashed</option>
                    <option value='double' <?php selected('double', $options['bstyle4']); ?>>Double</option>
                    <option value='groove' <?php selected('groove', $options['bstyle4']); ?>>Groove</option>
                    <option value='ridge' <?php selected('ridge', $options['bstyle4']); ?>>Ridge</option>
                    <option value='inset' <?php selected('inset', $options['bstyle4']); ?>>Inset</option>
                    <option value='outset' <?php selected('outset', $options['bstyle4']); ?>>Outset</option>
                  </select>
                  
                 <input id="bcolor4" class="border_color"  type="text" name="attnbox_options[bcolor4]" value="<?php echo $options['bcolor4']; ?>" /> 
                  
            </td>
           </tr>
            <tr>    
              <th scope="row"><input id="round4" type="checkbox" name="attnbox_options[enable_rounded4]" value="1" <?php checked('1', $options['enable_rounded4']); ?>> Rounded Corners: </th>
              <td><input id="roundsize4" class="border_color" type="text" name="attnbox_options[roundsize4]" value="<?php echo $options['roundsize4']; ?>" /> </td> 
          </tr> 
          <tr>
            <td><hr style="margin-top: 1px;"></td>
          </tr>
           <tr>
            <th>Text Alignment</th>
            <td>Left Align: <input type="radio"  <?php checked('left', $options['align4']); ?> name="attnbox_options[align4]" value="left" > 
                Center Align: <input type="radio" <?php checked('center', $options['align4']); ?> name="attnbox_options[align4]" value="center"></td>
          </tr>
         </table>
        
             <p class="submit"> <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  </p>
    
     </form>
    
    </div>
    
    
    </div> <!--main_settings_section-->
    
    <?php 
   
     foreach (range(1,4) as $indx) {
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
    
        <div class="preview_box_div custom_attn_box" id="preview_1" style="<?php echo $init_preview_box_styles1; ?>" >
          some text in my custom <?php echo $options['box_name_1']; ?> div.   
       </div>
       
        <div class="preview_box_div custom_attn_box" id="preview_2" style="<?php echo $init_preview_box_styles2; ?>" >
          some text in my custom <?php echo $options['box_name_2']; ?> div.   
       </div>
       
        <div class="preview_box_div custom_attn_box" id="preview_3" style="<?php echo $init_preview_box_styles3; ?>" >
           some text in my custom <?php echo $options['box_name_3']; ?> div.   
       </div>
       
        <div class="preview_box_div custom_attn_box" id="preview_4" style="<?php echo $init_preview_box_styles4; ?>" >
           some text in my custom <?php echo $options['box_name_4']; ?> div.   
       </div>
       
    </div>

<?php }

} 




function attnboxes_validate($input) {
  
  foreach (range(1,4) as $indx) {
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