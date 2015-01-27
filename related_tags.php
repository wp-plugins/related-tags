<?php
/**
 * Plugin Name: Related tags
 * Plugin URI: http://sawinyh.ru
 * Description: Output related tags
 * Version: 1.0
 * Author: Nikita Sawinyh
 * Author URI: http://sawinyh.ru
 * License: GPL2
 */

require_once('admin_add_related_tags_settings.php');
require_once('RelatedTagsWidget.php');

//add admin settings
add_action('admin_init', 'related_tags_admin_init');
add_action('admin_menu', 'add_count_posts_to_group_plugins_option_menu');

/**
 * Get array of tags for count either from db setting called "count_posts_to" or take 30 last posts
 * @return null|array of StdClass
 */
function reltags_getPostTags()
{
    if (!is_tag()) {
        return null;
    }

    if (!$postsCount = get_option('count_posts_to')) {
        $postsCount = 30;
    }

    /** @var $wpdb wpdb */
    global $wpdb;

    // Get current tag
    $tagID = $GLOBALS['tag_id'];

    // Get last 30 posts with current tag
    $args = array(
        'posts_per_page' => (int)$postsCount,
        'order' => 'DESC',
        'orderby' => 'date',
        'tag_id' => $tagID
    );
    $wp_query = new WP_Query($args);

    $result = array();
    if ($wp_query->have_posts()) {
        $result = $wp_query->get_posts();
    }

    // Get last 30 post's ids
    $postID = array();
    foreach ($result as $post) {
        $postID[] = $post->ID;
    }

    $prefix = $wpdb->get_blog_prefix();

    // Get tags by post's ids
    $sql =
        "SELECT DISTINCT
            t.term_id,
            t.term_group,
            tt.term_taxonomy_id,
            tt.taxonomy,
            tt.description,
            tt.parent,
            tt.count,
            t.`name`,
            t.slug
        FROM
            {$prefix}terms AS t,
            {$prefix}posts AS p,
            {$prefix}term_relationships AS tr,
            {$prefix}term_taxonomy AS tt
        WHERE
            p.ID IN (" . implode(',', $postID) . ")

        AND tr.term_taxonomy_id = t.term_id
        AND t.term_id = tt.term_id
        AND tt.taxonomy = 'post_tag'
        AND p.ID = tr.object_id";
    $tags = $wpdb->get_results($sql);


    return $tags ? : null;
}

/**
 * Get list of tags
 * @param bool $url Either generate link or just text
 */
function reltags_getListRelatedTags($url = false)
{
    $tags = reltags_getPostTags();

    if (!$tags) {
        return;
    }
    $result = '';
    if ($url) {
        foreach ($tags as $tag) {
            $result .= '<a href="' . get_tag_link((int)$tag->term_id) . '">' . $tag->name . ', ';
        }
    } else {
        foreach ($tags as $tag) {
            $result .= $tag->name . ', ';
        }
    }

    echo rtrim($result, ', ');
}

/**
 * Create and render tags cloud
 * @param string $args
 * @return bool|mixed|string|void
 */
function reltags_getCloudRelatedTags($args = '')
{
    $defaults = array(
        'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 45,
        'format' => 'flat', 'separator' => "\n", 'orderby' => 'name', 'order' => 'ASC',
        'exclude' => '', 'include' => '', 'link' => 'view', 'taxonomy' => 'post_tag', 'echo' => true
    );
    $args = wp_parse_args($args, $defaults);

    $tags = reltags_getPostTags();

    if (!$tags) {
        return;
    }

    foreach ($tags as $key => $tag) {
        if ('edit' == $args['link']) {
            $link = get_edit_tag_link($tag->term_id, $tag->taxonomy);
        } else {
            $link = get_term_link(intval($tag->term_id), $tag->taxonomy);
        }
        if (is_wp_error($link)) {
            return false;
        }

        $tags[$key]->link = $link;
        $tags[$key]->id = $tag->term_id;
    }

    $return = wp_generate_tag_cloud($tags, $args); // Here's where those top tags get sorted according to $args

    $return = apply_filters('wp_tag_cloud', $return, $args);

    if ('array' == $args['format'] || empty($args['echo'])) {
        return $return;
    }

    echo $return;
}
