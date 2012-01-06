<?php
/*
Plugin Name: WP Attention Boxes
Plugin URI: http://stevebailey.biz/blog/wp-attention-boxes
Description: Instantly add four of your most commonly used CSS-styled DIV's for different purposes, such as bringing attention to an important update, or just bringing visual focus to a quote..
Version: 0.5.0
Author: Steve Bailey
Author URI: http://stevebailey.biz/
License: GPL

Copyright 2010 Steve Bailey (email steveswdev@gmail.com)

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

include_once "attn_boxes_admin_menu.php";

add_action( 'admin_init', 'wp_attn_boxes_add_div_carousel');
add_filter('admin_footer', 'wp_attnbox_add_js_insert_handlers');
add_action( 'wp_print_styles', 'wp_attn_box_enqueue_my_styles' );
register_activation_hook(__FILE__, 'attnbox_register_hook');



function wp_attn_box_enqueue_metabox_styles() {
	$myStyleUrl = WP_PLUGIN_URL . '/wp-attention-boxes/css/attnbox_postmetabox_styles.css';
	$myStyleFile = WP_PLUGIN_DIR . '/wp-attention-boxes/css/attnbox_postmetabox_styles.css';
	if ( file_exists($myStyleFile) ) {
		wp_register_style('my_wpattn_box_metabox_StyleSheets', $myStyleUrl);
		wp_enqueue_style( 'my_wpattn_box_metabox_StyleSheets');
	}
}


function wp_box_div_carousel ( $post ) {

  // print the configured boxes ________________________________
	echo '<div  class="outer_div_post_page">';
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
		echo '<div class="meta_box_size" onclick="wp_attnbox_handler_' . $indx . '()"' . $style .  '>' . $options['box_name_' . $indx] . '</div>';
	}
  
	echo '</div>'; 
}
    

function wp_attn_boxes_add_div_carousel() {
	wp_attn_box_enqueue_metabox_styles();
	add_meta_box( 
		'attnbox_sectionid',
		__( 'Your Attention Boxes', 'attnbox_textdomain' ),
		'wp_box_div_carousel',
		'post' 
	);
    
	add_meta_box( 
		'attnbox_sectionid',
		__( 'Your Attention Boxes', 'attnbox_textdomain' ),
		'wp_box_div_carousel',
		'page' 
	);
}

wp_attn_box_run_upgrade_procedure();
   
function attnbox_register_hook() {
	global $wp_version; 
	if (version_compare($wp_version, "2.7", "<")) { 
		deactivate_plugins(basename(__FILE__)); // Deactivate our plugin
		wp_die("This plugin requires WordPress version 2.7 or higher.");
	}
}

function wp_attn_box_run_upgrade_procedure() {
	global $wp_attention_box_version;

	$pre_four_version = array("0.1", "0.2", "0.3", NULL);
	$options = get_option('attnbox_options'); 
	$attn_box_version = get_option('wp_attention_box_version');
 
	if (is_array($options)) {
		if ( (empty($attn_box_version)) || ($attn_box_version != $wp_attention_box_version )) {
			if ((in_array($attn_box_version, $pre_four_version))) {
	    		// first, add default rounded corner widths if they're not already set, but don't actually enable rounded
				// also, add default alignment of center
				foreach ( range(1,4) as $indx ) {
					if (empty( $options['roundsize'.$indx] )) {
						$options['roundsize'.$indx] = "10px";
					}
					if (empty( $options['align'.$indx] )) {
						$options['align'.$indx] = "center";
					}
				}
			// then, make sure user is not using a version of this plugin that using plain integers for border widths
			// if so, add a default "px"
				foreach ( range(1,4) as $indx ) {
					if (is_numeric( $options['bwidth'.$indx] )) {
						$options['bwidth'.$indx] .= "px";
					}
				}
				update_option('attnbox_options', $options);   
			}
			update_option('wp_attention_box_version', $wp_attention_box_version);
		}


	} // if options array exists
	else {
		update_option('wp_attention_box_version', $wp_attention_box_version);
	}
}
   
   

// The Wordpress-preferred method of adding CSS needed by plugin.
// Basically making this plugin's styles.css available to posts   
function wp_attn_box_enqueue_my_styles() {
  $myStyleUrl = WP_PLUGIN_URL . '/wp-attention-boxes/css/styles.css';
    $myStyleFile = WP_PLUGIN_DIR . '/wp-attention-boxes/css/styles.css';
    if ( file_exists($myStyleFile) ) {
        wp_register_style('my_wpattn_box_StyleSheets', $myStyleUrl);
        wp_enqueue_style( 'my_wpattn_box_StyleSheets');
    }
}
   



// ---------------------------------------------------------------------------------------------------------------------------------------------
function wp_attnbox_add_js_insert_handlers() {
	if (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'page.php')) {
		$options = get_option('attnbox_options'); 
		foreach (range(1,4) as $indx) {
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
				styled_div += ">your text</div>\n";
				myValue = styled_div;
				edInsertContent(edCanvas, myValue);
			}
			//]]></script>
<?php	}
	
	} 
}


?>