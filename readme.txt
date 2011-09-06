=== WP Attention Boxes ===
Contributors: pythoPhpSteve
Tags: attention, styled divs, emphasis, snippets, code snippets
Requires at least: 2.7
Tested up to: 3.01
Stable tag: 0.2

A specialized code snippet tool that provides one click acess, when editing posts, to 4 different CSS-styled DIVs for custom purposes.


== Description ==

Sometimes you just want to call out attention to a particular important message, or quote, or a collection of links, in a
bright yellow box, or similar, in a Blog post.  And you might do this a lot in your blog entries. 

This plugin keeps a snippet library of these stylized DIV's, and makes them immediately accessible in your edit post page by clicking a button on your html-mode toolbar.

If after the default activation of your plugin, you find these buttons too space-consuming on your toolbar, you can:
   1. rename them on the Settings/Options page for this plugin, to smaller names
   2. Simply Disable any of them that you don't need.
   
   ( a future version really does call for just one button, and them some kind of prompt that asks you which of the DIV's you want to insert - the wp api has probably been improved to make this easy, but f/t work takes me away from this )

See my <a href="http://stevebailey.biz/blog/apps" target="_blank">Blog</a> for more information.

== Installation ==

Instructions for installing the WP Attention Boxes Plugin.

1. Download and extract the Plugin zip file.
2. Upload the folder containing the Plugin files to your WordPress Plugins folder (usually ../wp-content/plugins/ folder).
3. Activate the Plugin via the 'Plugins' menu in WordPress.
4. Once activated you go to the Plugin options by clicking the 'Attention Div Boxes' link under the 'Settings' menu.
5. There will be four default DIV's already there which may serve your purpose, however of course change them as you need.

== Frequently Asked Questions ==

= I notice that when I click the toolbar button to insert the DIV html in the post, inline CSS is included in the html.  Isn't that not recommended as a standard way to code html and css? =
 
 I don't see an easy way with the current WP API to dynamically change an external CSS file, when you make updates to your custom DIV's.
 Right now, this is the best solution.

= Does the plugin change the content in the WordPress database? =

 Yes, it adds a single record to the wp_options table, which stores all of the custom DIV's.

= I notice the class="custom_attn_box" that is generated with every snippet and thus all of the div snippets will share =

This is a set of common styles that will make every DIV centered, and with some arbitrary padding, margin and width settings that I chose.  Feel free to customize this if you want all of your attention box DIV's with a different set of these styles.   Just edit the styles.css that is in this plugin's css directory.  
*Note* - I don't want to confuse anyone into thinking to use this plugin, you must get into css code to this degree .. again, going into the css/style.css file is *only* if you want to change anything other than the color, background color, and border style of which I provided the user-friendly admin settings page for.

= Why does the filename have 1.0.1 when the wordpress page has 0.2 =
My apologies for the confusion, I'll get that straightened out in the next minor update

== Screenshots ==

1. Html editor bar after new buttons are added (if the buttons consume too much space, you can disable one or more, or name them as short as you want)
2. This is the options page, used to define the styling of each of the 4 DIV's.

== Changelog ==

0.1 - original commit of this plugin
0.2 - fix bug .. there was an extra quote in the generated snippet and added a Tip to this plugin's f.a.q.

== Upgrade Notice ==
There is no upgrade, just a bug fix 