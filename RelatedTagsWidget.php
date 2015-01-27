<?php
class RelatedTagsWidget extends WP_Widget {

    const I18_DOMAIN = 'relatedtags';

    function __construct() {
        parent::__construct(
            'related_tags_widget',
            __('Related Tags Widget', self::I18_DOMAIN),
            [
                'description'   => __('Sidebar widget to display related tags', self::I18_DOMAIN)
            ]
        );
        load_plugin_textdomain(
            self::I18_DOMAIN,
            false,
            dirname(plugin_basename(__FILE__)). '/languages/'
        );
    }

    function widget($args, $instance) {
        if (!is_tag()) return;

        $tags = reltags_getPostTags();
        if (!$tags) return;

        foreach ($tags as $key => $tag) {
            $link = get_tag_link(
                $tag->term_id,
                $tag->taxonomy
            );
            if (is_wp_error($link)) return false;
            $tags[$key]->link = $link;
            $tags[$key]->id = $tag->term_id;

        }

        $return = wp_generate_tag_cloud($tags);
        $return = apply_filters('wp_tag_cloud', $return);

        echo '<aside class="widget widget_related_tags" id="related-tags">';
        echo '<h2 class="widget-title">' . __('Related Tags', self::I18_DOMAIN) . '</h2>';
        echo $return;
        echo "</aside>";
    }

    function form($instance) {

    }

    function update($newInstance, $oldInstance) {

    }

    function display($args, $instance) {

    }

}

function related_tags_load_widget() {
    register_widget('RelatedTagsWidget');
}

add_action(
    'widgets_init',
    'related_tags_load_widget'
);