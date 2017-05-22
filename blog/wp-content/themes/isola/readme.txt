=== Isola ===
Contributors: automattic
Donate link:
Tags: blog, lifestream, photography, clean, white, light, one-column, custom-background, custom-colors, custom-header, custom-menu, rtl-language-support, translation-ready, journal, photoblogging, simple, featured-images, post-formats, infinite-scroll, fixed-layout, responsive-layout
Tested up to: 3.9
Stable tag: 3.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Isola is a fresh, clean slate for your best works, perfect for showcasing your writing, photographs, or videos in a bold way. Its primary menu and widget area are tucked behind a handy button, giving your content plenty of room to breathe, and Isola looks beautiful regardless of the device or screen size.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= Where is my custom menu? =

Isola's primary menu is tucked behind the menu icon (three horizontal lines) in the header. Click the open menu icon to see it.

= Where can I add widgets? =

Isola includes a widget area underneath the main menu, which is tucked behind the menu icon (three horizontal lines) in the header

Configure these areas by going to Appearance → Widgets in your Dashboard.

= Does Isola support post formats? =

Isola supports Aside, Image, Video, Quote, Link, and Gallery Post Formats, with unique styles for each.

Posts with the Image format will display the Featured Image on the blog, archives, and single post views. If no Featured Image is set on an Image-formatted post, the theme will attempt to grab the first image from the content.

= Does Isola use featured images? =

If a Featured Image at least 1200px wide is set for a post, it will display above the post on the blog index and archives. Featured Images will also appear on single post view for Image formatted posts.

= Quick Specs (all measurements in pixels) =

1. The main column width is 650.
2. Featured Images are 1200 by unlimited height
3. The Primary Sidebar is 30% of the window width.

== Changelog ==

= 13 April 2016 =
* Fix CSS header format.
* Ensure we escape $content on output.
* Refactor how to strip first gallery from the content.

= 26 October 2015 =
* Fixing z-index issues that caused gravatar hoovercards to be hidden behind the sliding sidebar; Fixes #3462;

= 20 August 2015 =
* Add text domain and/or remove domain path. (E-I)

= 31 July 2015 =
* Remove `.screen-reader-text:hover` and `.screen-reader-text:active` style rules.

= 16 July 2015 =
* Always use https when loading Google Fonts. See #3221;

= 6 May 2015 =
* Fully remove example.html from Genericons folders.
* Remove index.html file from Genericions.

= 23 January 2015 =
* Adjust CSS to show header image.

= 22 January 2015 =
* Stop clicks on image gallery images from jumping to the top of the page.

= 19 August 2014 =
* Add style for reblogger.

= 4 August 2014 =
* Force font to match the rest of the theme on WP.com;

= 2 August 2014 =
* Move header image to appropriate area in Custom Header admin
* Fixes for jetpack-video-wrapper bottom margins, rate this font sizes
* Minor

= 30 July 2014 =
* Don't display post date for sticky posts
* Add some margins on page titles
* Fix line height for comments title, comments reply title, and page titles
* Fix page header alignment on large screens

= 24 July 2014 =
* change theme/author URIs and footer links to `wordpress.com/themes`.

= 15 July 2014 =
* Regex for Image post format not working on self-hosted installs; compromising by regexing all images from Image post format when the first image is pulled from the_content; works on both .com and self-hosted, though users will not be able to add multiple images to Image formatted posts. This is OK because Image formatted posts are designed to display one image; anything else should use a Gallery anyway
* Remove unnecessary $content definition for video post format
* Update version number and readme to reflect change in behavior for Image-formatted posts
* If a post has the Image format, and no Featured Image is set, attempt to get an image from the_content() to display large above the content, and remove the image from the content so it's not duplicated.

= 14 July 2014 =
* Remove conditional code that will never be true.
* Display missing galleries on single view.

= 10 July 2014 =
* UPdate version number, fix bug with Customizer/menu toggle button where button would be displayed under the site title, preventing it from being clicked.
* Add readme.txt
* Add POT file

= 9 July 2014 =
* Add white tag to style.css
* Only display menu close button if viewing on large screens
* Fix padding/spacing for large screens
* Tighten up spacing in the mobile header/widget area

= 8 July 2014 =
* Allow search icon to be adjusted using Custom Colors by removing it as a background image and using an inline SVG; also adjust RTL styles to compensate
* Changes to tags links display on mobile
* Add jetpack-responsive-video wrapper to video formatted posts such that videos on those posts are responsive

= 3 July 2014 =
* Minor tweaks to description; add RTL styles
* Update description and fix screenshot
* New screenshot
* Set new custom header default height; ensure custom header DIV does not show unless a custom header is assigned
* Add tags to style.css
* Move .site height declaration to media query for larger screens
* Only set percentage height on header image when body and html tags are set to 100%; otherwise use a fixed height of 150px
* Declare body height for large screens
* Remove height declaration on BODY in attempt to fix infinite footer; display: none on #wpstats and move from style.css to style-wpcom.css
* Move HTML height declarations for large screens
* Ensure height calculation works in Firefox as well
* Ensure mobile device custom headers aren't as tall; revert last change, as it didn't
* Only apply HTML height when viewing on a larger screen to prevent infinite footer from covering content on mobile devices
* Props to @joen for fixing the fixed menu/toggle sidebar

= 2 July 2014 =
* Unsuccessful attempts to fix conflicts between fixed header and fixed toggle menu
* Ensure main window does not scroll when the sidebar is open and reaches the bottom
* Remove unnecessary graphics; add left-aligned slide-out menu with adjustments to styling and drop-shadow; replace SVGs; add close button to menu

= 1 July 2014 =
* Sharpen menu icon by aligning to grid
* Style custom headers in admin;
* Position sidebar based on presence of admin bar
* Add custom header image support with sticky header for large screens
* Add hover state to search icon
* Begin implementing slide-out toggle menu with combination navigation and widgets
* Add padding to icons

= 27 June 2014 =
* Many changes:
* Improvements to widget styles and decrease comment author avatar margin
* Add border radius to toggle buttons
* Improvements to menu toggle appearance
* Improvements to widget area styling
* Begin adding support for optional toggle widget area
* Add bottom margin to gallery post format; add bottom margin to comments link
* Attempts to get inline SVG working in IE

= 26 June 2014 =
* Change method of embedding inline SVGs to use a combined included graphic with SVG/USE; style custom header admin
* Add bottom margin to aside post format
* Add support for gallery post format; tweaks to aside post format; improvements to JS for toggle menus

= 23 June 2014 =
* Fixes/improvements to navigation menus and overlays, disallowing the background area to scroll when a navigation area is active; increase decorative border widths
* First pass at adding more advanced menu toggle positioning
* Tweaks to entry format links; add aside post format content template; tweaks to display of header/navigation

= 21 June 2014 =
* Tweak to menu navigation icon in header; fix infinite scroll support; removed unnecessary CSS
* Improvements to menu navigation for mobile devices, bug fix for menu display on large screens, add close button to menu and search panels

= 20 June 2014 =
* Embed SVGs such that they can be changed with Custom Design, using SVG icons rather than genericons
* Add floating overlay toggle menu instead of relative positioned menu
* Add SVG graphics for menu buttons; positioning fixed such that they float over the content
* Delete unnecessary style-wpcom.css file; add updated one to inc directory; minor tweaks to comments layout
* Rotate quote icon for blockquote decoration
* Update description, tags, and add hover styles to main navigation
* Initial commit to /pub
