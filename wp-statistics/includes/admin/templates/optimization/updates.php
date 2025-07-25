<?php

use WP_Statistics\Service\Database\Managers\SchemaMaintainer;

$schemaCheckResult = SchemaMaintainer::check();
$databaseStatus    = $schemaCheckResult['status'] ?? null;
?>
<div class="wrap wps-wrap wps-wrap__setting-form js-updatesForm">
    <h2 class="wps-settings-box__title">
        <span><?php esc_html_e('Plugin Maintenance', 'wp-statistics'); ?></span>
        <a href="<?php echo esc_url(WP_STATISTICS_SITE_URL . '/resources/optimization-plugin-maintenance/?utm_source=wp-statistics&utm_medium=link&utm_campaign=optimization') ?>" target="_blank"><?php esc_html_e('View Guide', 'wp-statistics'); ?></a>
    </h2>
    <div class="postbox">
        <form class="wps-submit-agree" data-agree="<?php echo esc_html_e('Are you sure you want to refresh country data?', 'wp-statistics'); ?>"
              action="<?php echo esc_url(admin_url('admin.php?page=wps_optimization_page&tab=updates')); ?>" method="post">
            <?php wp_nonce_field('wps_optimization_nonce'); ?>
            <table class="form-table">
                <tbody>
                <tr class="wps-settings-box_head">
                    <th scope="row" colspan="2">
                        <h3><?php esc_html_e('GeoLocation Settings', 'wp-statistics'); ?></h3>
                    </th>
                </tr>

                <tr data-id="update_country_data_tr">
                    <th scope="row">
                        <span class="wps-setting-label"><?php esc_html_e('Update Country Data', 'wp-statistics'); ?></span>
                    </th>

                    <td>
                        <input type="hidden" id="populate-submit" name="update_location_action" value="1"/>
                        <button id="populate-submit-button" class="wps-button wps-button--danger-outline js-openModal-setting-confirmation wps-mt-0" type="button" value="1" name="populate-submit"><?php esc_html_e('Refresh Country Data', 'wp-statistics'); ?></button>
                        <p class="description"><?php esc_html_e('This action updates and corrects any unidentified or missing country data in the database. Please be patient, as the process might take some time, depending on the amount of data.', 'wp-statistics'); ?></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<div class="wrap wps-wrap wps-wrap__setting-form">
    <div class="postbox">
        <form class="wps-submit-agree" data-agree="<?php echo esc_html_e('Are you sure you want to update and correct any unidentified source channels in the database?', 'wp-statistics'); ?>"
              action="<?php echo esc_url(admin_url('admin.php?page=wps_optimization_page&tab=updates')); ?>" method="post">
            <?php wp_nonce_field('wps_optimization_nonce'); ?>
            <table class="form-table">
                <tbody>
                <tr class="wps-settings-box_head">
                    <th scope="row" colspan="2">
                        <h3><?php esc_html_e('Referrals Settings', 'wp-statistics'); ?></h3>
                    </th>
                </tr>

                <tr data-id="update_source_channel_data_tr">
                    <th scope="row">
                        <label for="populate-source-channel-submit"><?php esc_html_e('Update Source Channel Data', 'wp-statistics'); ?></label>
                    </th>

                    <td>
                        <input id="populate-source-channel-submit" type="hidden" name="update_source_channels_action" value="1"/>
                        <button class="wps-button wps-button--danger-outline js-openModal-setting-confirmation wps-mt-0" type="button" value="1" name="populate-source-channel-submit"><?php esc_html_e('Update Source Channel', 'wp-statistics'); ?></button>
                        <p class="description"><?php _e('This action updates and corrects any unidentified source channels in the database. Please be patient, as this process might take some time depending on the amount of data. <br> <i>Note: The accuracy of the results may be affected as we only retain whitelisted query parameters.</i>', 'wp-statistics'); ?></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<div class="wrap wps-wrap wps-wrap__setting-form">
    <div class="postbox">
        <form class="wps-submit-agree" data-agree="<?php echo esc_html_e('This will replace all IP addresses in the database with hash values and cannot be undone, are you sure?', 'wp-statistics'); ?>"
              action="<?php echo esc_url(admin_url('admin.php?page=wps_optimization_page&tab=updates')); ?>" method="post">
            <?php wp_nonce_field('wps_optimization_nonce'); ?>
            <table class="form-table">
                <tbody>
                <tr class="wps-settings-box_head">
                    <th scope="row" colspan="2">
                        <h3><?php esc_html_e('IP Address Management', 'wp-statistics'); ?></h3>
                    </th>
                </tr>

                <tr data-id="convert_ip_addresses_to_hash_tr">
                    <th scope="row">
                        <label for="hash-ips-submit"><?php esc_html_e('Convert IP Addresses to Hash', 'wp-statistics'); ?></label>
                    </th>

                    <td>
                        <input id="hash-ips-submit" type="hidden" name="update_ips_action" value="1"/>
                        <button class="wps-button wps-button--danger-outline js-openModal-setting-confirmation wps-mt-0" type="button" value="1" name="hash-ips-submit"><?php esc_html_e('Initiate Conversion', 'wp-statistics'); ?></button>
                        <p class="description"><?php esc_html_e('This function will transform all stored IP addresses into hashed values. Please note that after hashing, original IP addresses cannot be retrieved. The hashing process ensures user privacy while still allowing the system to generate accurate location-based insights. This operation might be time-consuming, so we recommend performing it during off-peak hours.', 'wp-statistics'); ?></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<div class="wrap wps-wrap wps-wrap__setting-form">
    <div class="postbox">
        <form class="wps-submit-agree" data-agree="<?php esc_html_e('Are you sure you want to repair the schema issues?', 'wp-statistics'); ?>" action="<?php echo esc_url(admin_url('admin.php?page=wps_optimization_page&tab=updates')) ?>" id="wps_database_schema_form" method="post">
            <?php wp_nonce_field('wps_optimization_nonce'); ?>
            <table class="form-table">
                <tbody>
                <tr class="wps-settings-box_head">
                    <th scope="row" colspan="2"><h3><?php esc_html_e('Database Schema', 'wp-statistics'); ?></h3></th>
                </tr>

                <tr data-id="wps_database_schema_form">
                    <th scope="row">
                        <span class="wps-setting-label"><?php esc_html_e('Check & Repair Database Schema', 'wp-statistics'); ?></span>
                    </th>
                    <td>
                        <?php if ($databaseStatus === 'success'): ?>
                            <div class="wps-alert wps-alert__success wps-mt-0">
                                <?php esc_html_e('Database schema is healthy.', 'wp-statistics'); ?>
                            </div>
                        <?php else: ?>
                            <input type="hidden" id="repair-schema-submit" name="repair_schema_action" value="1"/>
                            <button id="repair-schema-submit-button" class="wps-button wps-button--danger-outline js-openModal-setting-confirmation wps-mt-0" type="button" name="database-schema-issues-submit"><?php esc_html_e('Repair Schema Issues', 'wp-statistics'); ?></button>
                            <p class="description"><?php esc_html_e('Checks the integrity of the WP Statistics database tables and automatically applies any required fixes to keep your analytics accurate.', 'wp-statistics'); ?></p>
                            <div class="wps-alert wps-alert__danger">
                                <div class="wps-g-0">
                                    <b><?php esc_html_e('Detected Schema Issues', 'wp-statistics'); ?></b>
                                    <p class="description"><?php echo wp_kses(__('We’ve found the following inconsistencies. Click <b>Repair Schema Issues</b> to fix them automatically.', 'wp-statistics'), ['b' => []]); ?></p>
                                    <ul class="wps-alert-list">
                                        <?php
                                        if (!empty($schemaCheckResult['issues']) && is_array($schemaCheckResult['issues'])) {
                                            foreach ($schemaCheckResult['issues'] as $issue) {
                                                if ($issue['type'] === 'missing_column') {
                                                    $message = sprintf(
                                                        '%1$s.%2$s — %3$s',
                                                        esc_html($issue['table']),
                                                        esc_html($issue['column']),
                                                        __('Missing column', 'wp-statistics')
                                                    );
                                                    echo '<li>' . esc_html($message) . '</li>';
                                                }
                                            }
                                        }

                                        if (!empty($schemaCheckResult['issues']) && is_array($schemaCheckResult['issues'])) {
                                            foreach ($schemaCheckResult['issues'] as $issue) {
                                                if ($issue['type'] === 'table_missing') {
                                                    $message = sprintf(
                                                        '%1$s — %2$s',
                                                        esc_html($issue['table']),
                                                        __('Missing table', 'wp-statistics')
                                                    );
                                                    echo '<li>' . esc_html($message) . '</li>';
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                        <?php endif; ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

