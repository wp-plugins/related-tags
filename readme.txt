=== Plugin Name ===
Contributors: sneg55
Donate link: http://sawinyh.com/
Tags: tags, seo, related, google, search engine optimization, sidebar, widget
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add related tags list(link list, text list, or cloud-style list) on the tag page, based on posts that have this tag.

== Description ==

Add "related" tags list(link list, plain text list, or my favourite cloud-style list) on the tag page, based on posts that have this tag.

When you open tag page i.e example.com/tag/facebook, plugin checking posts that marked with tag "Facebook", check the other tags in these posts, and put the related tag list back.

 `[youtube http://www.youtube.com/watch?v=ogKhVaVrvzo]`

 
Sometimes related tags more useful for users and for SEO purposes.

== Installation ==


1. Upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place in your tag template
(usually it's archive.php)

- If you need cloud-style links to related tags:

`<?php
if (function_exists('reltags_getCloudRelatedTags')) {
reltags_getCloudRelatedTags($args);
}
?>`


- If you need plain text list of related tags:

`<?php
if (function_exists('reltags_getListRelatedTags')) {
reltags_getListRelatedTags();
}
?>`

- If you need link list of related tags:

`<?php
if (function_exists('reltags_getListRelatedTags')) {
reltags_getListRelatedTags(true);
}
?>`

Also you can use widget in your sidebar (but keep in mind it shows on only on the tag page).


 `[youtube http://www.youtube.com/watch?v=ogKhVaVrvzo]`



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

1. Cloud Style Related tag list
2. Link Related tag list

 `[youtube http://www.youtube.com/watch?v=ogKhVaVrvzo]`

== Changelog ==

= 1.2 =
* add better readme
* add

= 1.1 =
* some fixes

= 1.0 =
* first version


