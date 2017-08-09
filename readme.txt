=== Displet Property Showcase ===
Contributors: displetdev
Author: Displet
Author URI: http://displet.com/
Plugin URI: http://displet.com/wordpress-plugins/displet-property-showcase/
Tags: real estate, single property website, listings, single, property, microsite
Requires at least: 3.2
Tested up to: 3.8.1
Stable tag: 1.1.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to easily create beautiful, responsive single property websites. Showcase your real estate listings effectively.

== Description ==

This plugin allows you to easily create beautiful, responsive single property websites. Showcase your properties' images in as high a resolution as you like, include maps, video walk throughs, school information, & more! Select from multiple color schemes.

We developed this plugin to solve an internal problem. In the past, if we wanted a single property website, we had to launch a new Wordpress installation or a new MU instance for each property. Now, we can manage our single property websites under one Wordpress installation. We purchase a domain & forward/mask the domain to the page, so our print marketing has the easy to remember URL. When forwarding the domain from your registrar, it creates a 301 redirect, so your single property website still gets credit from Googlebot.

== Installation ==

1. Click 'Add New' from your Plugins page in WordPress while logged in as an administrator
2. Enter 'Displet Property Showcase' and click 'Search Plugins'
3. Find Displet Property Showcase from the results and click 'Install Now'

== Frequently Asked Questions ==

= Are there FAQs? =

1. See the Help page under the Properties menu while logged in as an administrator
2. After that, please <a href="http://displet.com/wiki">visit our wiki</a>

== Screenshots ==

1. Easily create a property showcase on your site.

== Changelog ==

= 1.0 =
* Initial release.

= 1.1 =
* Archive page added.

== Child Template Recipe ==

To customize the appearance of any of the templates used by the plugin in a future-proof manner:

1. Copy a template from the /templates/ directory of the plugin and paste the template into the root folder of the active theme.
2. Replace the default style classes from the new template (PHP functions displetps_the_default_styles_class(), displetps_the_color_scheme_class() & displetps_get_default_styles_class()) with a custom CSS class of your choosing
3. Copy the relevant portions of the plugin's stylesheet to the active theme's stylesheet (or another custom stylesheet of your choosing), replacing 'displet-property-showcase-styles' with the custom CSS class added to the template from step 2
4. Edit your custom template or your custom stylesheet as desired (never edit plugin files directly)