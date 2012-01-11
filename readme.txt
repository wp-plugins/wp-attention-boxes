=== WP Attention Boxes ===
Contributors: pythoPhpSteve
Tags: attention, styled divs, emphasis, snippets, code snippets
Requires at least: 2.7
Tested up to: 3.3.1
Stable tag: 0.6.0

A specialized code snippet tool that provides one click access, when editing posts, to 4 different CSS-styled DIVs for custom purposes.

== Description ==

Sometimes you just want to call out attention to a particular important message, or quote, or a collection of links, in a
bright yellow box, or similar, in a Blog post.  And you might do this a lot in your blog entries. 

This plugin keeps a snippet library of these stylized DIV's, and makes them immediately accessible in your edit post page by clicking one of your DIV's that is lined up underneath your editor.

The contact page for this plugin is: <a href="http://stevebailey.biz/blog/wp-attention-boxes" target="_blank">Wp Attention Boxes</a>

== Installation ==

* You can use Zip-uploader feature if your version of Wordpress has it
1. Download the Plugin as Zip file, but DON'T extract the Zip File
2. In your Admin, Go to Plugins/ Add New / and then click Upload from the choices .. browse for the Zip that you downloaded
3. Click Activate

* OR do it the manual way:

1. Download and extract the Plugin zip file.
2. Upload the folder containing the Plugin files to your WordPress Plugins folder (usually ../wp-content/plugins/ folder).
3. Activate the Plugin via the 'Plugins' menu in WordPress.
4. Once activated you go to the Plugin options by clicking the 'Attention Div Boxes' link under the 'Settings' menu.
5. There will be four default DIV's already there which may serve your purpose, however of course change them as you need.

== Frequently Asked Questions ==
= When I click on one the DIV's on my Editor Page, there seems to be no response - the snippet is not added. =
Plesae make sure that you click once directly inside your editor (preferable exactly at the point where you want the DIV to be inserted) before you click on the DIV in the "Your Attention Boxes" Meta Box.

= The Newly designed Settings Page doesn't look like the one in the screenshot =
Please click the browser refresh button (f5 if you're on Windows), and if that doesn't do it, clear your Browser Cache, so that the new CSS styles will overwrite the ones that are still cached by your browser.

= The preview box in the new 0.4 setting page doesn't seem to reflect the change I just made =
Yes, this is how the Javascript onchange event works.. after you change a CSS element, you'll need to tab out of the field - then the preview box will update itself.

= I notice, with this version 0.4, that I now need to specify "px" in the border width =
Yes, this way the more knowledgeable users in CSS can use other measurement units such as "em".  
 If you do, by chance, enter in just a number by itself, I added a validation routine that automatically tacks on "px".  But you can use px, em, or whatever.
Bottom Line: You won't need to do anything when you upgrade to 0.4 - the install routine should automatically upgrade your current border settings to "1px" (if it was just 1, you get the drift)
    
= What if I use the Visual Editor when creating pages/posts ? =
This plugin only works when in the Html editor - i.e. this is basically for users who prefer the HTML tab of the editor, or at least switch to it for tools like this one.

= Ok, but when I switch to the HTML Editor after doing a lot of work in the Visual Editor, sometimes I lose some formatting =
My advice, to be able to use tools in the Html editor (whether it's this plugin or not) might be to start every brand new blog post with the Html tab active, use the tools you need on that toolbar, and then switch to the Visual Editor where you stay until the post is finished and published. This way you're not going back and forth.

= Does the plugin change the content in the WordPress database? =

Yes, it adds 2 record to the wp_options table. One of them stores all of the custom DIV's.
 The other simple stores the version number of this plugin.


= Do you plan on adding the ability to store snippets for other types of html elements? =
Yes, the next major version will provide the ability to store different styles of your own image-based (or non-imaged based) bullet lists


== Screenshots ==

1. This "display meta-box" underneath the Editor is where you choose which snippet to add to your post, via simply clicking on the DIV you want.
2. This is the options page, used to define the styling of each of the 4 DIV's. 
3. Actual stylized box examples (just as an example of the variation of styles, just the border type alone could be: solid, dotted, dashed, double, groove, ridge, inset, outset )


== Changelog ==
= 0.6.0 =
  Increased number of DIV snippets to 10

= 0.5.0 =
  Removed the buttons from the Post/Page edit toolbar .. the DIV snippets are now added to your post via simply clicking on your chosen DIV directly from the Meta-Box below the Editor

= 0.4.2 =
  Internal variable changes to ensure that the javascript handler names don't conflict with other plugins, and some other minor changes

= 0.4.1 =
Fixed a bug in the CSS code that is generated when rounded corners are enabled for any of the DIV's.. Specifically, removed an extra quote in the style that might prevent the rounded corner from working.

= 0.4 =
* Added support for Rounded Corners
* A Preview Box so that you know what your DIVs look like before leaving the Settings page

= 0.3 =
* Added a convenient visual reference section that shows you what your DIV's look like w/o having to save your post and switch to this plugin's Settings page

= 0.2 =
* Bugfix .. there was an extra quote in the generated snippet and added a Tip to this plugin's f.a.q.

== Upgrade Notice ==
= 0.5.0 =
This is not an optional upgrade if you have upgraded to Wordpress version 3.3. On V 3.3, the toolbar buttons are missing, thus breaking this plugin's functionality.
Regardless of the WP version you're using, I'd recommend the upgrade - even below V 3.3, your HTML toolbar will be uncluttered by the buttons and this makes it easier for a future version to have many more DIV snippets.