=== WP Attention Boxes ===
Contributors: pythoPhpSteve
Tags: attention, styled divs, emphasis, snippets, code snippets
Requires at least: 2.7
Tested up to: 3.21
Stable tag: 0.3

A specialized code snippet tool that provides one click access, when editing posts, to 4 different CSS-styled DIVs for custom purposes.


== Description ==

Sometimes you just want to call out attention to a particular important message, or quote, or a collection of links, in a
bright yellow box, or similar, in a Blog post.  And you might do this a lot in your blog entries. 

This plugin keeps a snippet library of these stylized DIV's, and makes them immediately accessible in your edit post page by clicking a button on your html-mode toolbar.



The contact page for this plugin is: <a href="http://stevebailey.biz/blog/wp-attention-boxes" target="_blank">Wp Attention Boxes</a>

Currently the screen shots don't seem to be showing for this plugin, on the page you're looking at, so you can see the screenshots at the site above


== Installation ==

Instructions for installing the WP Attention Boxes Plugin.
  
  [ Note: If you're upgrading, please first de-activate this plugin. ]

1. Download and extract the Plugin zip file.
2. Upload the folder containing the Plugin files to your WordPress Plugins folder (usually ../wp-content/plugins/ folder).
3. Activate the Plugin via the 'Plugins' menu in WordPress.
4. Once activated you go to the Plugin options by clicking the 'Attention Div Boxes' link under the 'Settings' menu.
5. There will be four default DIV's already there which may serve your purpose, however of course change them as you need.

== Frequently Asked Questions ==
= The preview box in the setting page doesn't seem to reflect the change I just made =
Yes, this is how the Javascript onchange event works.. after you change a CSS element, you'll need to tab out of the field - then the preview box will update itself.

= I notice, with this version 0.4, that I now need to specify "px" in the border width =
Yes, this way the more knowledgeable users in CSS can use other measurement units such as "em".   If you do, by chance, enter in just a number by itself, I added a validation routine that automatically tacks on "px".  But you can use px, em, or whatever.
Bottom Line: You shouldn't need to do anything when  you upgrade, install routine should automatically upgrade your current border settings to "1px" (if it was just 1, you get the drift)
    
= What if I use the Visual Editor when creating pages/posts ? =
This plugin only works when in the Html editor - i.e. this is basically for users who prefer the HTML tab of the editor, or at least switch to it for tools like this one.

= Ok, but when I switch to the HTML Editor after doing a lot of work in the Visual Editor, sometimes I lose some formatting =
My advice, to be able to use tools in the Html editor (whether it's this plugin or not) might be to start every brand new blog post with the Html tab active, use the tools you need on that toolbar, and then switch to the Visual Editor where you stay until the post is finished and published. This way you're not going back and forth.

= Does the plugin change the content in the WordPress database? =

 Yes, it adds a single record to the wp_options table. This stores all of the custom DIV's.
No other changes to the database. 

= Do you plan on adding the ability to store snippets for other types of html elements? =
Yes, the next major version will provide the ability to store different styles of your own image-based (or non-imaged based) bullet lists

= Why only 4 =
Good question, a future major version will provide 10



== Screenshots ==

1. Html editor bar after new buttons are added (if the buttons consume too much space, you can disable one or more, or name them as short as you want)
2. This is the options page, used to define the styling of each of the 4 DIV's. 
   NEW on this page: The floating preview div, and the design of this page designs
3. Actual stylized box examples (just as an example of the variation of styles, just the border type alone could be: solid, dotted, dashed, double, groove, ridge, inset, outset )
4. Simply a convenient "display meta-box" that shows up underneath where you do your actual post or page editing, so you don't have to return to the settings to remember what they look like.

== Changelog ==

= 0.3 =
* Added a convenient visual reference section that shows you what your DIV's look like w/o having to save your post and switch to this plugin's Settings page
= 0.2 =
* Bugfix .. there was an extra quote in the generated snippet and added a Tip to this plugin's f.a.q.

== Upgrade Notice ==
= 0.4 =
This upgrade provides a must-have feature that I urge you to upgrade for -- the live previewing of your Attention Div's as you make changes on the Settings page. (also rounded corners)
