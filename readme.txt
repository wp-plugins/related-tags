=== Plugin Name ===
Contributors: sneg55
Donate link: http://sawinyh.com/
Tags: tags, seo, related
Requires at least: 3.0.1
Tested up to: 3.9.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add related tags on tag page, based on posts in this tag. 

== Description ==

Add related tags list(link list, text list, or cloud-style list) on the tag page, based on posts that have this tag. 


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place in your templates
`<?php
if (function_exists('getListRelatedTags')) {
getListRelatedTags();
}
?>`  - if you need plain text list of related tags. 
`<?php
if (function_exists('getListRelatedTags')) {
getListRelatedTags(true);
}
?>` - if you need link list of related tags.

`<?php
if (function_exists('getCloudRelatedTags')) {
getCloudRelatedTags($args);
}
?>` - if you need cloud links-style to realted tags.
$args - the same with  wp_tag_cloud


== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.



== Changelog ==

= 1.0 =
* first version

