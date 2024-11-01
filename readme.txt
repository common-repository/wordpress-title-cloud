=== Wordpress Title Cloud ===
Contributors: burtadem, Dreb Bits, Paul Kouwen, Katherine Gamboa
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZVV68CQNM95BG
Tags: title cloud,tag cloud
Requires at least: 3.0
Tested up to: 3.1.2
Stable tag: 1.0.1

Act as a tag cloud but instead of showing tag, it shows the title of pages. 

== Description ==

Act as a tag cloud but instead of showing tag, it shows the title of pages. 

= Donate =

wordpress title cloud ([donate via PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZVV68CQNM95BG))


== Installation ==

1. upload the title cloud folder in `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. You will find 'title cloud' menu in your WordPress admin panel and fill-in the forms to make it work properly.
4. It automatically adds a 'bezoekers' post meta for page frequency. set it to 0 if you want to exclude the page.
5. If title cloud settings was set to manual, you have to make the value of bezoekers to 1 in order to add it in the cloud


== Frequently Asked Questions ==
1. How to add <?php cloud_rs(); ?> to the page?
   - In the admin, go to appearance -> editor , then choose the footer.php if you want to display the title cloud in footer.
== Screenshots ==

1. screenshot-1.png 

2. screenshot-2.png 

== Changelog ==

= 1.0.1 =
*Font color and family fixed
*Added font color for hover style
*Posts visit gets incremented
*Visit increments only for non-logged in users.

= 1.0.0 =
*Separated the pages and posts


= 0.9.9 =
*It is now accomodates both post types
*Checkbox controls in the admin to select pages to display

= 0.9.8 =
*Fixed Bug from 0.9.7

= 0.9.7 =
*Added Manual or Automatic settings.

= 0.9.6 =
*Wordpress 3.05 100% Compatible.

= 0.9.5 =
*Widen excluded pages
*Fix not in array query

= 0.9.4 =
*Compatibility issues

= 0.9.3 =
*Adding Classes
*Lots of revisions

= 0.9.2 =
*Burt made some stupid codes

= 0.9.1 =
*Fix Duplicated entries


= 0.9.0 =
First release

[Releases](http://wordpress.org/extend/plugins/wordpress-title-cloud/download/)

== Upgrade Notice ==

The required WordPress version has been changed and now requires WordPress 3.0 or higher. If you use WordPress 2.8, you will need to upgrade WordPress.