<div class="postbox-container" id="wps-big-postbox">
    <div class="metabox-holder">
        <div class="meta-box-sortables">
            <div class="postbox" id="<?php echo esc_attr(\WP_STATISTICS\Meta_Box::getMetaBoxKey('pages-chart')); ?>">
                <div class="postbox-header postbox-toggle">
                    <button class="handlediv" type="button" aria-expanded="true">
                        <span class="screen-reader-text"><?php printf(__('Toggle panel: %s', 'wp-statistics'), __('Tag Statistics Chart', 'wp-statistics')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <span class="toggle-indicator" aria-hidden="true"></span>
                    </button>
                    <h2 class="hndle wps-d-inline-block"><span><?php esc_html_e('Tag Statistics Chart', 'wp-statistics'); ?></span></h2>
                </div>
                <div class="inside">
                    <!-- Do Js -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="postbox-container wps-postbox-full">
    <div class="metabox-holder">
        <div class="meta-box-sortables">
            <div class="postbox">
                <div class="postbox-header postbox-toggle">
                    <button class="handlediv" type="button" aria-expanded="true">
                        <span class="screen-reader-text"><?php printf(__('Toggle panel: %s', 'wp-statistics'), __('Tag Statistics Summary', 'wp-statistics')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped	 ?></span>
                        <span class="toggle-indicator" aria-hidden="true"></span>
                    </button>
                    <h2 class="hndle wps-d-inline-block"><span><?php esc_html_e('Tag Statistics Summary', 'wp-statistics'); ?></span></h2>
                </div>
                <div class="inside">
                    <table class="widefat table-stats wps-summary-stats" id="summary-stats">
                        <tbody>
                        <tr>
                            <th></th>
                            <th class="th-center"><?php esc_html_e('Count', 'wp-statistics'); ?></th>
                        </tr>

                        <?php
                        if (isset($number_post_in_tag)) {
                            ?>
                            <tr>
                                <th><?php esc_html_e('Number of posts in tag', 'wp-statistics'); ?>:</th>
                                <th class="th-center">
                                    <span><?php echo esc_html(number_format_i18n($number_post_in_tag)); ?></span></th>
                            </tr>
                            <?php
                        }
                        ?>

                        <tr>
                            <th><?php esc_html_e('Total Views', 'wp-statistics'); ?>:</th>
                            <th class="th-center"><span id="number-total-chart-visits"></span></th>
                        </tr>

                        <tr>
                            <th><?php esc_html_e('All Time Views', 'wp-statistics'); ?>:</th>
                            <th class="th-center"><span id="number-total-visits"></span></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (count($top_list) > 0) { ?>
    <div class="postbox-container wps-postbox-full">
        <div class="metabox-holder">
            <div class="meta-box-sortables">
                <div class="postbox">
                    <div class="postbox-header postbox-toggle">
                        <button class="handlediv" type="button" aria-expanded="true">
                            <span class="screen-reader-text"><?php printf(__('Toggle panel: %s', 'wp-statistics'), esc_attr($top_title)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped	 ?></span>
                            <span class="toggle-indicator" aria-hidden="true"></span>
                        </button>
                        <h2 class="hndle wps-d-inline-block"><span><?php echo esc_attr($top_title); ?></span></h2>
                    </div>
                    <div class="inside">
                        <table class="widefat table-stats wps-summary-stats" id="summary-stats">
                            <tbody>
                            <tr>
                                <th></th>
                                <th class="th-center"><?php esc_html_e('Count', 'wp-statistics'); ?></th>
                            </tr>
                            <?php
                            foreach ($top_list as $item) {
                                ?>
                                <tr>
                                    <th>
                                        <a href="<?php echo esc_url($item['link']); ?>" title="<?php echo esc_attr($item['name']); ?>"><?php echo esc_attr($item['name']); ?></a>
                                    </th>
                                    <th class="th-center">
                                        <span><?php echo esc_html(number_format_i18n($item['count_visit'])); ?></span></th>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>