<?php
/*
Plugin Name: WP Attention Boxes
Plugin URI: http://stevebailey.biz/blog/apps/
Description: Instantly add four of your most commonly used CSS-styled DIV's for different purposes, such as bringing attention to an important update, or just bringing visual focus to a quote..
Version: 0.2
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

include "attn_boxes_admin_menu.php";

new Attention_Box;  # looks weird, but don't need to assign the instantiated object to a variable. 
                    # The functions are merely being collected into classes in order to remove the possibility of 
                    # duplicate function call conflicts with other plugins

class Attention_Box {

    function __construct() {
        new Attention_Box_Options;    // starts necessary options Initialization hooks located in Options page's class, via its own __construct
        add_action( 'wp_print_styles', array( &$this,'enqueue_my_styles') );
        register_activation_hook(__FILE__, array( &$this,'attnbox_add_defaults' ));
        add_filter('admin_footer', 'wp_attnbox_add_quicktag');
    }
   
    function attnbox_delete_plugin_options() {
	    delete_option('wpcf_options');
    }
   
    function attnbox_add_defaults() {
        $ar = get_option('attnbox_options');
        if (!is_array($ar)) {
            $temp_arr = array("box_name_1" => "Yellow Update", "box_name_2" => "DownloadDiv", 
                              "box_name_3" => "Quote Div", "box_name_4" => "Summary Box",
                              "enable_div1" => "1", "enable_div2" => "1", "enable_div3" => "1", "enable_div4" => "1",
                              "color1" => "black", "backcolor1" => "yellow", "bstyle1" => "solid", "bwidth1" => "2","bcolor1" => "red",
                              "color2" => "black", "backcolor2" => "#FFFACD", "bstyle2" => "dashed", "bwidth2" => "2","bcolor2" => "black",
                              "color3" => "black", "backcolor3" => "#FFFFFF", "bstyle3" => "ridge", "bwidth3" => "4","bcolor3" => "black",
                              "color4" => "black", "backcolor4" => "#EEEEEE", "bstyle4" => "solid", "bwidth4" => "1","bcolor4" => "#BBBBBB"
                              );
            update_option('attnbox_options', $temp_arr);
        }
	}

   // The Wordpress-preferred method of adding CSS needed by plugin.
   // Basically making this plugin's styles.css available to posts   
   function enqueue_my_styles() {
      $myStyleUrl = WP_PLUGIN_URL . '/wp-attention-boxes/css/styles.css';
        $myStyleFile = WP_PLUGIN_DIR . '/wp-attention-boxes/css/styles.css';
        if ( file_exists($myStyleFile) ) {
            wp_register_style('myStyleSheets', $myStyleUrl);
            wp_enqueue_style( 'myStyleSheets');
        }
   }
   

} // end of class

// This hairy looking function which opens and closes php tags over and over, is what generates the necessary javascript that adds the buttons
// to the edit post page.
// ---------------------------------------------------------------------------------------------------------------------------------------------
function wp_attnbox_add_quicktag() {
	if (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'page.php')) {
?>
<script type="text/javascript">//<![CDATA[
	var toolbar = document.getElementById("ed_toolbar");
<?php
    $options = get_option('attnbox_options'); 
    if (isset($options['enable_div1']))
    	edit_wpattnbox_insert_button($options['box_name_1'], "wp_attnbox1_handler", "Attn Box 1");
    if (isset($options['enable_div2']))
    	edit_wpattnbox_insert_button($options['box_name_2'], "wp_attnbox2_handler", "Attn Box 2");
    if (isset($options['enable_div3']))
    	edit_wpattnbox_insert_button($options['box_name_3'], "wp_attnbox3_handler", "Attn Box 3");
    if (isset($options['enable_div4']))
    	edit_wpattnbox_insert_button($options['box_name_4'], "wp_attnbox4_handler", "Attn Box 4");    	    	    	
	
?>
	var state_my_button = true;


function wp_attnbox1_handler() {
    
    textcolor = "<?php echo $options['color1']; ?>";
    backcolor = "<?php echo $options['backcolor1']; ?>";
    border_width = "<?php echo  $options['bwidth1']; ?>";
    border_color = "<?php echo $options['bcolor1']; ?>";
    border_style = "<?php echo $options['bstyle1']; ?>";
    
    styled_div = '\n<div class="custom_attn_box" style="border: ';
    styled_div += border_width;
    styled_div += "px";
    styled_div += ' ' + border_style;
    styled_div += ' ' + border_color + ';';
    styled_div += ' color: ' + textcolor + ';"';
    styled_div += ' background-color: ' + backcolor + ';"';
    styled_div += ">your text</div>\n";
    myValue = styled_div;
	edInsertContent(edCanvas, myValue);
}

function wp_attnbox2_handler() {
    
    textcolor = "<?php echo $options['color1']; ?>";
    backcolor = "<?php echo $options['backcolor1']; ?>";
    border_width = "<?php echo  $options['bwidth2']; ?>";
    border_color = "<?php echo $options['bcolor2']; ?>";
    border_style = "<?php echo $options['bstyle2']; ?>";
    
    styled_div = '\n<div class="custom_attn_box" style="border: ';
    styled_div += border_width;
    styled_div += "px";
    styled_div += ' ' + border_style;
    styled_div += ' ' + border_color + ';';
    styled_div += ' color: ' + textcolor + ';"';
    styled_div += ' background-color: ' + backcolor + ';"';
    styled_div += ">your text</div>\n";
    myValue = styled_div;
	edInsertContent(edCanvas, myValue);
}

function wp_attnbox3_handler() {
    
    textcolor = "<?php echo $options['color1']; ?>";
    backcolor = "<?php echo $options['backcolor1']; ?>";
    border_width = "<?php echo  $options['bwidth3']; ?>";
    border_color = "<?php echo $options['bcolor3']; ?>";
    border_style = "<?php echo $options['bstyle3']; ?>";
    
    styled_div = '\n<div class="custom_attn_box" style="border: ';
    styled_div += border_width;
    styled_div += "px";
    styled_div += ' ' + border_style;
    styled_div += ' ' + border_color + ';';
    styled_div += ' color: ' + textcolor + ';"';
    styled_div += ' background-color: ' + backcolor + ';"';
    styled_div += ">your text</div>\n";
    myValue = styled_div;
	edInsertContent(edCanvas, myValue);
}

function wp_attnbox4_handler() {
    
    textcolor = "<?php echo $options['color1']; ?>";
    backcolor = "<?php echo $options['backcolor1']; ?>";
    border_width = "<?php echo  $options['bwidth4']; ?>";
    border_color = "<?php echo $options['bcolor4']; ?>";
    border_style = "<?php echo $options['bstyle4']; ?>";
    
    styled_div = '\n<div class="custom_attn_box" style="border: ';
    styled_div += border_width;
    styled_div += "px";
    styled_div += ' ' + border_style;
    styled_div += ' ' + border_color + ';';
    styled_div += ' color: ' + textcolor + ';';
    styled_div += ' background-color: ' + backcolor + ';"';
    styled_div += ">your text</div>\n";
    myValue = styled_div;
	edInsertContent(edCanvas, myValue);
}

//]]></script>

<?php }
  }  // end of wp_attnbox_add_quicktag
 function edit_wpattnbox_insert_button($caption, $js_onclick, $title = '') {
	?> if (toolbar) {
		var theButton = document.createElement('input');
		theButton.type = 'button';
		theButton.value = '<?php echo $caption; ?>';
		theButton.onclick = <?php echo $js_onclick; ?>;
		theButton.className = 'ed_button';
		theButton.title = "<?php echo $title; ?>";
		theButton.id = "<?php echo "ed_{$caption}"; ?>";
		toolbar.appendChild(theButton);
	} 
<?php 
   } // end of edit_insert_button
?>