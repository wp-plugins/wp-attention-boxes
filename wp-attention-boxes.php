<?php
/*
Plugin Name: WP Attention Boxes
Plugin URI: http://stevebailey.biz/blog/wp-attention-boxes
Description: Instantly add 10 of your most commonly used CSS-styled DIV's for different purposes, such as bringing attention to an important update, or just bringing visual focus to a quote..
Version: 1.0.0
Author: Steve Bailey
Author URI: http://stevebailey.biz/blog/wp-attention-boxes
License: GPL

Copyright 2015 Steve Bailey (email steveswdev@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
			
*/

include_once "includes/wp-attention-includes.inc";

include_once "attn-boxes-admin-menu.php";

add_action( 'admin_init', 'wp_attn_boxes_add_div_carousel');
add_action('wp_enqueue_scripts', 'wp_attn_box_enqueue_my_styles');


register_activation_hook(__FILE__, 'attnbox_register_hook');



wp_attn_box_run_upgrade_procedure();


function wp_box_div_carousel ( $post ) {
?>
<div id="makeMeScrollable">
		<div class="scrollingHotSpotLeft"></div>
		<div class="scrollingHotSpotRight"></div>
		<div class="scrollWrapper">
			<div class="scrollableArea">
	<?php		
             $options = get_option('attnbox_options'); 
	       foreach (range(1,10) as $indx) {
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
		echo '<div class="custom_attn_box_metabox"  onclick="wp_attnbox_handler_' . $indx . '()"' . $style .  '>' . $options['box_name_' . $indx] . '</div>';
	}
	?>
  
   
				
			</div>

		</div>
	</div>

<?php 
}


function wp_attn_boxes_add_div_carousel() {

	add_meta_box( 
		'attnbox_sectionid',
		__( 'Your Attention Boxes', 'wp-attention-boxes' ),
		'wp_box_div_carousel',
		'post' 
	);
    
	add_meta_box( 
		'attnbox_sectionid',
		__( 'Your Attention Boxes', 'wp-attention-boxes' ),
		'wp_box_div_carousel',
		'page' 
	);

     // Add custom css to the Visual Editor tinymce, so that the boxes match the style of the live site/front end look while editing	 
	 $myStyleUrl = WP_PLUGIN_URL . '/wp-attention-boxes/css/styles.css';
	 add_editor_style( $myStyleUrl );
}


   
function attnbox_register_hook() {
	global $wp_version; 
	if (version_compare($wp_version, "2.7", "<")) { 
		deactivate_plugins(basename(__FILE__)); // Deactivate our plugin
		wp_die(__("This plugin requires WordPress version 2.7 or higher.", 'wp-attention-boxes'));
	}
}

function wp_attn_box_run_upgrade_procedure() {
	global $wp_attention_box_version;

	$pre_six_version = array("0.1", "0.2", "0.3", "0.4", "0.4.1", "0.4.2", "0.5.0", NULL);
	$pre_four_version = array("0.1", "0.2", "0.3", NULL);
	$options = get_option('attnbox_options'); 
	$attn_box_version = get_option('wp_attention_box_version');
 	$update_opt = false;
 
	if (is_array($options)) {
		if ( (empty($attn_box_version)) || ($attn_box_version != "0.6.0" )) {
			if ((in_array($attn_box_version, $pre_four_version))) {
				foreach ( range( 1, 4) as $indx ) {
					if (is_numeric( $options['bwidth'.$indx] )) {
	 					$options['bwidth'.$indx] .= "px";
					}
					if (empty( $options['roundsize'.$indx] )) {
						$options['roundsize'.$indx] = "10px";
					}
					if (empty( $options['align'.$indx] )) {
						$options['align'.$indx] = "center";
					}
				}
				$update_opt = true;  
			}
			
			if (in_array($attn_box_version, $pre_six_version)) {
				// Add default rounded corner widths if they're not already set, but don't actually enable rounded
				// also, add default alignment of center
				foreach ( range( 5, 10) as $indx ) {
					if (empty( $options['roundsize'.$indx] )) {
						$options['roundsize'.$indx] = "10px";
					}
					if (empty( $options['align'.$indx] )) {
						$options['align'.$indx] = "center";
					}
					if ( is_numeric( $options['bwidth'.$indx] )) {
   						$options['bwidth'.$indx] .= "px";
   					}
   				}
   				$update_opt = true;
			}
			
			if ( $update_opt ) {
			  update_option('attnbox_options', $options);
			}
			
			update_option('wp_attention_box_version', "0.6.0");
			
			update_option('wp_attention_box_upgrade_to_6', 1);
		}


	} // if options array exists
	else {
		update_option('wp_attention_box_version', "1.0.0");
		update_option('wp_attention_box_upgrade_to_6', 0);
	}
}
   
   

// The Wordpress-preferred method of adding CSS needed by plugin.
// Basically making this plugin's styles.css available to posts   
function wp_attn_box_enqueue_my_styles() {
    //$loghandle = fopen("C:\\xampp2\\apps\\wordpress\\htdocs\\wp-content\\plugins\\wp-attention-boxes\\newlogfile.txt",'w'); 
    //fwrite($loghandle,WP_PLUGIN_DIR); 
   
    
    $myStyleUrl = WP_PLUGIN_URL . '/wp-attention-boxes/css/styles.css';
    $myStyleFile = WP_PLUGIN_DIR . '/wp-attention-boxes/css/styles.css';
    if ( file_exists($myStyleFile) ) {

        wp_register_style('my_wpattn_box_StyleSheets', $myStyleUrl);
        wp_enqueue_style( 'my_wpattn_box_StyleSheets');
    }
    
    //fclose($loghandle);
}




// ---------------------------------------------------------------------------------------------------------------------------------------------
function wp_attnbox_add_js_insert_handlers() {
	if (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'page.php')) {
		$options = get_option('attnbox_options'); 
		foreach (range(1,10) as $indx) {
		?>
            <script type="text/javascript">//<![CDATA[
			function wp_attnbox_handler_<?php echo $indx; ?>() {
		    
				textcolor = "<?php echo $options['color' . $indx]; ?>";
				backcolor = "<?php echo $options['backcolor'  . $indx]; ?>";
				border_width = "<?php echo $options['bwidth'  . $indx]; ?>";
				border_color = "<?php echo $options['bcolor'  . $indx]; ?>";
				border_style = "<?php echo $options['bstyle'  . $indx]; ?>";
				textalign = "<?php echo $options['align' . $indx]; ?>";
				
				roundenabled = <?php if (isset($options['enable_rounded'  . $indx]))
				                         echo $options['enable_rounded'  . $indx];
				                       else 
				                         echo "0";
				                     ?>;
				borderradius = "<?php echo $options['roundsize'  . $indx]; ?>";
				
				styled_div = '\n<div class="custom_attn_box" style="border: ';
				styled_div += border_width;
				styled_div += ' ' + border_style;
				styled_div += ' ' + border_color + ';';
				styled_div += ' color: ' + textcolor + ';';
				styled_div += ' background-color: ' + backcolor + ';';
				
				if (roundenabled == 1) {
				  styled_div += ' -webkit-border-radius: ' + borderradius + ';';
				  styled_div += ' -moz-border-radius: ' + borderradius + ';';
				  styled_div += ' border-radius: ' + borderradius + ';';
				}
				
				styled_div += ' text-align: ' + textalign + ';"';
				styled_div += "> Your Amazing Text Here </div><br>\n";
				myValue = styled_div;
				
				//tinyMCE.execInstanceCommand
				var tmce_ver=window.tinyMCE.majorVersion;
				
				var chtml= jQuery('#content-html');
                var ctmce= jQuery('#content-tmce');
                
                var c= jQuery('#content'); // textarea
                var vismode= c.css('display')=='none';
                
                if (!vismode) {
                    edInsertContent(edCanvas, myValue);
                } 
                else {
                    
                    if (tmce_ver >= 4) {
                    /* In TinyMCE 4, we must be use the execCommand */
                      window.tinyMCE.execCommand('mceInsertContent', false, myValue);
                    } else {
                        /* In TinyMCE 3x and lower, we must be use the execInstanceCommand */
                         window.tinyMCE.execInstanceCommand(id, 'mceInsertContent', false, myValue);
                    }
                }
				
				
				
			}
			//]]></script>
<?php	}
	
	} 
}


?>