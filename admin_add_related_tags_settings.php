<?php
/**
 * Add plugin setting: count posts to scan tags
 */

/**
 * Add plugin admin settings
 */
function related_tags_admin_init()
{
    register_setting('count_posts_to_group', 'count_posts_to');
}

/**
 * Add item to the menu
 */
function add_count_posts_to_group_plugins_option_menu()
{
    add_options_page('Count posts to scan related tags', 'Related tags settings', 'manage_options', 'count_posts_related_tags', 'add_count_posts_to_group_plugins_options');
}

/**
 * show admin settings page
 */
function add_count_posts_to_group_plugins_options()
{
    ?>
    <div class="wrap">
        <h2>Related tags settings</h2>
        <form action="options.php" method="post">
            <?php settings_fields('count_posts_to_group'); ?>
            <?php @do_settings_fields('count_posts_to', 'count_posts_to_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="count_posts_to"><?php echo __('Count posts to scan related tags', RelatedTagsWidget::I18_DOMAIN); ?></label></th>
                    <td>
                        <input type="text" name="count_posts_to" id="count_posts_to" value="<?php echo get_option('count_posts_to'); ?>" />
                        <br/><small></small>
                    </td>
                </tr>
            </table> <?php @submit_button(); ?>
        </form>
    </div>
<?php
}