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
   $style .= 'border:' . $options['bwidth' . $indx] . "px";
   $style .= ' ' . $options['bstyle' . $indx];
   $style .= ' ' . $options['bcolor' . $indx] . '"';
   
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
        <form method="post" action="options.php">
        <?php settings_fields('attnbox_user_options'); ?>
        <?php $options = get_option('attnbox_options'); 
        
        if (empty($options[enable_div1]))
            $disabled_text_1 = " disabled_text";
        if (empty($options[enable_div2]))
            $disabled_text_2 = " disabled_text";
        if (empty($options[enable_div3]))
            $disabled_text_3 = " disabled_text";
        if (empty($options[enable_div4]))
            $disabled_text_4 = " disabled_text";
        ?>    
        <table id="group_1" class="form-table <?php echo $disabled_text_1; ?>">
            
        <tr valign="top">
           <th><input id="1" name="attnbox_options[enable_div1]" type="checkbox" value="1" <?php checked('1', $options['enable_div1']); ?>> Enabled</th> 
           <th scope="row"><span><input type="text" size="45" class="name_input" name="attnbox_options[box_name_1]" value="<?php echo $options['box_name_1']; ?>" /></span></th>
        </tr>    
        <tr>
            <th scope="row" >Text Color</th>
            <td><label><input type="text" name="attnbox_options[color1]" value="<?php echo $options['color1']; ?>" />
                <span style="color:#666666;margin-left:40px;"> [ex: either "red" or "#ff0000"]</span>  </label>
           </td>
        </tr>
        <tr>
            <th scope="row" >Background Color</th>
            <td><label><input type="text" name="attnbox_options[backcolor1]" value="<?php echo $options['backcolor1']; ?>" />
                <span style="color:#666666;margin-left:40px;"> [ex: either "red" or "#ff0000"]</span>  </label>
           </td>
        </tr>
        <tr>    
            <th scope="row">Border Style</th>
            <td>
                 <select name="attnbox_options[bstyle1]">
                    <option value='solid' <?php selected('solid', $options['bstyle1']); ?>>Solid</option>
                    <option value='dotted' <?php selected('dotted', $options['bstyle1']); ?>>Dotted</option>
                    <option value='dashed' <?php selected('dashed', $options['bstyle1']); ?>>Dashed</option>
                    <option value='double' <?php selected('double', $options['bstyle1']); ?>>Double</option>
                    <option value='groove' <?php selected('groove', $options['bstyle1']); ?>>Groove</option>
                    <option value='ridge' <?php selected('ridge', $options['bstyle1']); ?>>Ridge</option>
                    <option value='inset' <?php selected('inset', $options['bstyle1']); ?>>Inset</option>
                    <option value='outset' <?php selected('outset', $options['bstyle1']); ?>>Outset</option>
                  </select>
            </td>
         </tr>
         <tr> 
            <th scope="row">Border Color</th> 
            <td>
                <label><input type="text" name="attnbox_options[bcolor1]" value="<?php echo $options['bcolor1']; ?>" />
                    <span style="color:#666666;margin-left:40px;"> [ex: either "red" or "#ff0000"]</span>
                    </label>
             </td>
         </tr>
         <tr>   
           <th scope="row">Border Width</th>
            <td>
                <label><input type="text" name="attnbox_options[bwidth1]" value="<?php echo $options['bwidth1']; ?>" />
                    <span style="color:#666666;margin-left:40px;"> [must be integer]</span>
                    </label>
            </td>
         </tr>
         
         </table>
         
         <p>&nbsp;</p>
         
         <table id="group_2" class="form-table <?php echo $disabled_text_2; ?>">
         
         <tr>
            <th><input id="2" name="attnbox_options[enable_div2]" type="checkbox" value="1" <?php checked('1', $options['enable_div2']); ?>> Enabled</th> 
            <th scope="row"><span><input type="text" size="45" class="name_input" name="attnbox_options[box_name_2]" value="<?php echo $options['box_name_2']; ?>" /></span></span></th>
         </tr>
      
         <tr>
            <th scope="row" >Text Color</th>
            <td><label><input type="text" name="attnbox_options[color2]" value="<?php echo $options['color2']; ?>" />
                <span style="color:#666666;margin-left:40px;"> [ex: either "red" or "#ff0000"]</span>  </label>
           </td>
        </tr>
        <tr>
            <th scope="row" >Background Color</th>
            <td><label><input type="text" name="attnbox_options[backcolor2]" value="<?php echo $options['backcolor2']; ?>" />
                <span style="color:#666666;margin-left:40px;"> [ex: either "red" or "#ff0000"]</span>  </label>
           </td>
        </tr>
            
         <tr>    
             <th scope="row">Border Style</th>
             <td>
                <label>
                 <select name="attnbox_options[bstyle2]">
                    <option value='solid' <?php selected('solid', $options['bstyle2']); ?>>Solid</option>
                    <option value='dotted' <?php selected('dotted', $options['bstyle2']); ?>>Dotted</option>
                    <option value='dashed' <?php selected('dashed', $options['bstyle2']); ?>>Dashed</option>
                    <option value='double' <?php selected('double', $options['bstyle2']); ?>>Double</option>
                    <option value='groove' <?php selected('groove', $options['bstyle2']); ?>>Groove</option>
                    <option value='ridge' <?php selected('ridge', $options['bstyle2']); ?>>Ridge</option>
                    <option value='inset' <?php selected('inset', $options['bstyle2']); ?>>Inset</option>
                    <option value='outset' <?php selected('outset', $options['bstyle2']); ?>>Outset</option>
                  </select>
                 </label> 
             </td>
         </tr>
         <tr> 
            <th scope="row">Border Color</th>     
            <td><input type="text" name="attnbox_options[bcolor2]" value="<?php echo $options['bcolor2']; ?>" /></td>
         </tr>
         <tr>   
            <th scope="row">Border Width</th>     
            <td><input type="text" name="attnbox_options[bwidth2]" value="<?php echo $options['bwidth2']; ?>" /></td>
         </tr>
         
          
         </table>
         
         <p>&nbsp;</p>
         
         <table id="group_3" class="form-table <?php echo $disabled_text_3; ?>">
         
          <tr>
            <th><input id="3" name="attnbox_options[enable_div3]" type="checkbox" value="1" <?php checked('1', $options['enable_div3']); ?>> Enabled</th> 
            <th scope="row" ><span><input type="text" size="45" class="name_input" name="attnbox_options[box_name_3]" value="<?php echo $options['box_name_3']; ?>" /></span></th>
         </tr>
      
         <tr>
            <th scope="row" >Text Color</th>
            <td><label><input type="text" name="attnbox_options[color3]" value="<?php echo $options['color3']; ?>" />
                <span style="color:#666666;margin-left:40px;"> [ex: either "red" or "#ff0000"]</span>  </label>
           </td>
        </tr>
        <tr>
            <th scope="row" >Background Color</th>
            <td><label><input type="text" name="attnbox_options[backcolor3]" value="<?php echo $options['backcolor3']; ?>" />
                <span style="color:#666666;margin-left:40px;"> [ex: either "red" or "#ff0000"]</span>  </label>
           </td>
        </tr>
            
         <tr>    
             <th scope="row">Border Style</th>
             <td>
                 <select name="attnbox_options[bstyle3]">
                    <option value='solid' <?php selected('solid', $options['bstyle3']); ?>>Solid</option>
                    <option value='dotted' <?php selected('dotted', $options['bstyle3']); ?>>Dotted</option>
                    <option value='dashed' <?php selected('dashed', $options['bstyle3']); ?>>Dashed</option>
                    <option value='double' <?php selected('double', $options['bstyle3']); ?>>Double</option>
                    <option value='groove' <?php selected('groove', $options['bstyle3']); ?>>Groove</option>
                    <option value='ridge' <?php selected('ridge', $options['bstyle3']); ?>>Ridge</option>
                    <option value='inset' <?php selected('inset', $options['bstyle3']); ?>>Inset</option>
                    <option value='outset' <?php selected('outset', $options['bstyle3']); ?>>Outset</option>
                  </select>
             </td>
         </tr>
         <tr> 
            <th scope="row">Border Color</th>     
            <td><input type="text" name="attnbox_options[bcolor3]" value="<?php echo $options['bcolor3']; ?>" /></td>
         </tr>
         <tr>   
            <th scope="row">Border Width</th>     
            <td><input type="text" name="attnbox_options[bwidth3]" value="<?php echo $options['bwidth3']; ?>" /></td>
         </tr>
         
          
         </table>
         
         <p>&nbsp;</p>
         
         <table id="group_4" class="form-table <?php echo $disabled_text_4; ?>">
         
          <tr>
            <th><input id="4" name="attnbox_options[enable_div4]" type="checkbox" value="1" <?php checked('1', $options['enable_div4']); ?>> Enabled</th> 
            <th scope="row" ><span><input type="text" size="45" class="name_input" name="attnbox_options[box_name_4]" value="<?php echo $options['box_name_4']; ?>" /></span></th>
         </tr>
      
         <tr>
            <th scope="row" >Text Color</th>
            <td><label><input type="text" name="attnbox_options[color4]" value="<?php echo $options['color4']; ?>" />
                <span style="color:#666666;margin-left:40px;"> [ex: either "red" or "#ff0000"]</span>  </label>
           </td>
        </tr>
        <tr>
            <th scope="row" >Background Color</th>
            <td><label><input type="text" name="attnbox_options[backcolor4]" value="<?php echo $options['backcolor4']; ?>" />
                <span style="color:#666666;margin-left:40px;"> [ex: either "red" or "#ff0000"]</span>  </label>
           </td>
        </tr>
            
         <tr>    
             <th scope="row">Border Style</th>
             <td>
                 <select name="attnbox_options[bstyle4]">
                    <option value='solid' <?php selected('solid', $options['bstyle4']); ?>>Solid</option>
                    <option value='dotted' <?php selected('dotted', $options['bstyle4']); ?>>Dotted</option>
                    <option value='dashed' <?php selected('dashed', $options['bstyle4']); ?>>Dashed</option>
                    <option value='double' <?php selected('double', $options['bstyle4']); ?>>Double</option>
                    <option value='groove' <?php selected('groove', $options['bstyle4']); ?>>Groove</option>
                    <option value='ridge' <?php selected('ridge', $options['bstyle4']); ?>>Ridge</option>
                    <option value='inset' <?php selected('inset', $options['bstyle4']); ?>>Inset</option>
                    <option value='outset' <?php selected('outset', $options['bstyle4']); ?>>Outset</option>
                  </select>
             </td>
         </tr>
         <tr> 
            <th scope="row">Border Color</th>     
            <td><input type="text" name="attnbox_options[bcolor4]" value="<?php echo $options['bcolor4']; ?>" /></td>
         </tr>
         <tr>   
            <th scope="row">Border Width</th>     
            <td><input type="text" name="attnbox_options[bwidth4]" value="<?php echo $options['bwidth4']; ?>" /></td>
         </tr>
         
      </table>
             <p class="submit"> <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  </p>
    
     </form>
    
    </div>

<?php }

} 




function attnboxes_validate($input) {
       
    $input['bwidth1'] =  intval($input['bwidth1']);
    $input['bwidth2'] =  intval($input['bwidth2']);
    $input['bwidth3'] =  intval($input['bwidth3']);
    $input['bwidth4'] =  intval($input['bwidth4']);
    
	return $input;
}
?>