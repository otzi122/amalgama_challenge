<?php

/**
 * Provide a admin area view for the plugin.
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.linkedin.com/in/ljpinto/
 * @since      1.0.0
 */
?>

<?php settings_errors(); ?>
<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" style="padding-top: 20px" >

        <div id="form-container">
            <div class="field-group <?php echo $this->is_field_valid(self::FIELD_TITLES_EXTENSION) ? '' : 'invalid' ?>">
                <div class="label">
                    <?php _e(self::LABEL_TITLES_EXTENSION, $this->plugin_name); ?>*
                </div>
                <div class="input">
                    <input type="text" name="<?php echo self::FIELD_TITLES_EXTENSION; ?>" id="<?php echo self::FIELD_TITLES_EXTENSION; ?>" value="<?php echo get_option(self::FIELD_TITLES_EXTENSION, ''); ?>">
                </div>
            </div>
            <input type="submit" value="<?php _e(self::LABEL_SAVE, $this->plugin_name); ?>">
        </div>
    </form>
</div> 