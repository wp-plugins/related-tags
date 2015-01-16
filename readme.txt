=== Plugin Name ===
Contributors: sneg55
Donate link: http://sawinyh.com/
Tags: tags, seo, related
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add related tags on tag page, based on posts with this tag.

== Description ==

Add related tags list(link list, text list, or cloud-style list) on the tag page, based on posts that have this tag.

When you open tag page i.e example.com/tag/facebook plugin checks post that have tag "Facebook", count another tags, and put the related list.


== Installation ==

This section describes how to install the plugin and get it working.



1. Upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place in your tag template
(usually it's archive.php)

- if you need plain text list of related tags:

`<?php
if (function_exists('reltags_getListRelatedTags')) {
reltags_getListRelatedTags();
}
?>`

- if you need link list of related tags:

`<?php
if (function_exists('reltags_getListRelatedTags')) {
reltags_getListRelatedTags(true);
}
?>`

- if you need cloud-style links to related tags:

`<?php
if (function_exists('reltags_getCloudRelatedTags')) {
reltags_getCloudRelatedTags($args);
}
?>`

you can customize view with $args - is the same with  wp_tag_cloud
and here is defaults:
`
<?php $args = array(
	'smallest'                  => 8,
	'largest'                   => 22,
	'unit'                      => 'pt',
	'number'                    => 45,
	'format'                    => 'flat',
	'separator'                 => "\n",
	'orderby'                   => 'name',
	'order'                     => 'ASC',
	'exclude'                   => null,
	'include'                   => null,
	'topic_count_text_callback' => default_topic_count_text,
	'link'                      => 'view',
	'taxonomy'                  => 'post_tag',
	'echo'                      => true,
	'child_of'                  => null, // see Note!
); ?>`

== Frequently Asked Questions ==


== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png

== Changelog ==

= 1.0 =
* first version

= 1.1 =
* some fixes
