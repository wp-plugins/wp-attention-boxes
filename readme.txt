=== WP Attention Boxes ===
Contributors: pythoPhpSteve
Tags: attention, styled divs, emphasis, snippets, code snippets, summary box
Requires at least: 2.7
Tested up to: 4.1.1
Stable tag: 1.0.0

A specialized code snippet tool that provides one click access, when editing posts, to 10 different CSS-styled DIVs for custom purposes.

== Description ==

 
Sometimes you just want to call out attention to a particular important message, or quote, or a collection of links, in a
bright yellow box, or similar, in a Blog post.  And you might do this a lot in your blog entries. 

This plugin keeps a snippet library of these stylized DIV's, and makes them immediately accessible in your edit post page by clicking one of your DIV's that is lined up underneath your editor.

The contact page for this plugin is: <a href="http://stevebailey.biz/blog/wp-attention-boxes" target="_blank">Wp Attention Boxes</a>

( A major Thank you to the creator of the jQuery Smooth Div Scroll Plugin http://www.smoothdivscroll.com/, which I have put to use in this plugin. )
                       
== Installation ==

1.) The Most Slick, Updated way is to Simply go to your Admin / Plugins / Add New page

2.) You can use Zip-uploader feature if your version of Wordpress has it
- Download the Plugin as Zip file, but DON'T extract the Zip File
- In your Admin, Go to Plugins/ Add New / and then click Upload from the choices .. browse for the Zip that you downloaded
- Click Activate

Once activated you go to the Plugin options by clicking the 'Attention Div Boxes' link under the 'Settings' menu.

If you're brand new to this plugin, all 10 of the DIV settings will be blank waiting for your CSS creativity, or you could click a button of the page, and it will pre-fill your settings with some samples that I created.

== Frequently Asked Questions ==
= How do I override things such as height and width of the boxes =
A.) To override the default width and height, for a specific box, you can do this: 
  Right after you insert the box (by the usual clicking on the meta-box slider), go directly to the html code in the editor, and right after 
     style=", you insert: 'height:1111px;width:1111px;', without those single quotes,  so it will look like:
           
         style="height:1111px;width:1111px; border:5px solid gray; etc....  
        (obviously replacing 1111 with your desired height/width)

  <strong> ( Note: </strong> If you add a "height" property, either in this solution, or in "B.)" just below, and you want to maintain your <em>vertical</em> centering, you'll need to also add "line-height" and set it to the same value of "height"  )

B.) To change the *default* width and height, so that the attention div's will be your desired width/height, without having to make the change above, every time you want to change it.. Just go on your Server, where you have your blog installed, and go into the wp-attention-boxes/css directory, and just edit the styles.css file, specifically, the .custom_attn_box CSS class, and change the width from 70% to your desired width (in px or em), and add a height that you desire.

So either of the above will do it. 

 ( <strong> Note: </strong> Keep in mind, if you customize it per B.), you'll lose the change when you upgrade this plugin. So you might want to just create an additional .custom_attn_box declaration in one of the core Wordpress CSS files, and overriding the height style in there, also adding !important to the style - for info on how !important works, please use google  )


= When I click on one of my custom DIV's on my Post/Page Editor Page, there seems to be no response - the snippet is not added. =
Please make sure that you click at least once directly inside your editor (preferably, exactly at the point where you want the DIV to be inserted), before you click on the DIV in the "Your Attention Boxes" Meta Box.


== Screenshots ==

1. This "display meta-box" underneath the Editor is where you choose which snippet to add to your post, via simply clicking on the DIV you want.
2. This is the options page, used to define the styling of each of the 10 DIV's. 
3. Actual stylized box examples (just as an example of the variation of styles, just the border type alone could be: solid, dotted, dashed, double, groove, ridge, inset, outset )


== Changelog ==
= 1.0.0 =
  Finally, ** You can insert the Attention Boxes in the Visual Editor ! **
= 0.6.6 =
  Fixed a css style that was creating a blue background on a table cell in Wordpress's settings pages
= 0.6.5 =
  Finally made the modifications that should have been done from the start, to enable internationalization of the User Directions on Admin Settings page

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
Finally, ** You can insert the Attention Boxes in the Visual Editor ! **