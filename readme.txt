=== WP Attention Boxes ===
Contributors: pythoPhpSteve
Tags: attention, styled divs, emphasis, snippets, code snippets
Requires at least: 2.7
Tested up to: 3.21
Stable tag: 0.3

A specialized code snippet tool that provides one click acess, when editing posts, to 4 different CSS-styled DIVs for custom purposes.


== Description ==

Sometimes you just want to call out attention to a particular important message, or quote, or a collection of links, in a
bright yellow box, or similar, in a Blog post.  And you might do this a lot in your blog entries. 

This plugin keeps a snippet library of these stylized DIV's, and makes them immediately accessible in your edit post page by clicking a button on your html-mode toolbar.


The contact page for this plugin is: <a href="http://stevebailey.biz/blog1/apps" target="_blank">Blog</a>, however this plugin page on wordpress that you're looking at, has all the info  you need.

== Installation ==

Instructions for installing the WP Attention Boxes Plugin.

1. Download and extract the Plugin zip file.
2. Upload the folder containing the Plugin files to your WordPress Plugins folder (usually ../wp-content/plugins/ folder).
3. Activate the Plugin via the 'Plugins' menu in WordPress.
4. Once activated you go to the Plugin options by clicking the 'Attention Div Boxes' link under the 'Settings' menu.
5. There will be four default DIV's already there which may serve your purpose, however of course change them as you need.

== Frequently Asked Questions ==
= What if I use the Visual Editor when creating pages/posts ? =
This plugin only works when in the Html editor - i.e. this is basically for users who prefer the HTML tab of the editor, or at least switch to it for tools like this one.

= Does the plugin change the content in the WordPress database? =

 Yes, it adds a single record to the wp_options table. This stores all of the custom DIV's.
No other changes to the database. 

= Do you plan on adding the ability to store snippets for other types of html elements? =
Yes, the next major version will provide the ability to store different styles of your own image-based (or non-imaged based) bullet lists

= why only 4 =
Good question, the next major version will provide 10

== Screenshots ==

1. Html editor bar after new buttons are added (if the buttons consume too much space, you can disable one or more, or name them as short as you want)
2. This is the options page, used to define the styling of each of the 4 DIV's.
3. Actual stylized box examples (just as an example of the variation of styles, just the border type alone could be: solid, dotted, dashed, double, groove, ridge, inset, outset )
4. This new feature was a non-brainer to add, and makes this plugin twice as useful IMO - not sure why I didn't add this to the initial 0.1 version .. it was very easy code-wise

== Changelog ==

0.1 - original commit of this plugin
0.2 - fix bug .. there was an extra quote in the generated snippet and added a Tip to this plugin's f.a.q.
0.2 - bug fix
0.3 - added a convenient visual reference section that shows you what your DIV's look like w/o having to save your post and switch to this plugin's Settings page


== Upgrade Notice ==
There is no upgrade, just a bug fix 
Added meta-box to post/page editing page to display the custom div's