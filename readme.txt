=== WP Attention Boxes ===
Contributors: pythoPhpSteve
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HFF8WFES28C7Y
Tags: attention, styled divs, emphasis, snippets, code snippets
Requires at least: 2.7
Tested up to: 3.01
Stable tag: 1.0

A specialized code snippet tool that provides one click acess, when editing posts, to 4 different CSS-styled DIVs for custom purposes.


== Description ==

Sometimes you just want to call out attention to a particular important message, or quote, or a collection of links, in a
bright yellow box, or similar, in a Blog post.  And you might do this a lot in your blog entries. 

This plugin keeps a snippet library of these stylized DIV's, and makes them immediately accessible in your edit post page by clicking
a button on your html toolbar.

If after the default activation of your plugin, you find these buttons too space-consuming on your toolbar, you can:
   1. rename them on the Settings/Options page for this plugin, to smaller names
   2. Disable any of them that you don't need.
   
   ( a future version really does call for just one button, and them some kind of prompt that asks you which of the DIV's you want to insert )

See my <a href="http://stevebailey.biz/blog/apps" target="_blank">Blog</a> for more information.

== Installation ==

Instructions for installing the WP Attention Boxes Plugin.

1. Download and extract the Plugin zip file.
2. Upload the folder containing the Plugin files to your WordPress Plugins folder (usually ../wp-content/plugins/ folder).
3. Activate the Plugin via the 'Plugins' menu in WordPress.
4. Once activated you go to the Plugin options by clicking the 'Attention Div Boxes' link under the 'Settings' menu.
5. There will be four default DIV's already there which may serve your purpose, however of course change them as you need.

== Frequently Asked Questions ==

= I notice that when I click the toolbar button to insert the DIV html in the post, inline CSS is included in the html. 
 Isn't that not recommended as a standard way to code html and css?  =
 
 I don't see an easy way with the current WP API to dynamically change an external CSS file, when you make updates to your custom DIV's.
 Right now, this is the best solution.

= Does the plugin change the content in the WordPress database? =

 Yes, it adds a single record to the wp_options table, which stores all of the custom DIV's.

== Screenshots ==

1. The html editor bar after the new buttons are added to it, for this plugin.
2. This is the options page, used to define the styling of each of the 4 DIV's.

== Changelog ==

currently at 1.0

