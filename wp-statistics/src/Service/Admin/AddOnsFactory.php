<?php

namespace WP_Statistics\Service\Admin;

class AddOnsFactory
{
    private static $optionMap = [
        'wp-statistics-advanced-reporting' => 'wpstatistics_advanced_reporting_settings',
        'wp-statistics-customization'      => 'wpstatistics_customization_settings',
        'wp-statistics-widgets'            => 'wpstatistics_widgets_settings',
        'wp-statistics-realtime-stats'     => 'wpstatistics_realtime_stats_settings',
        'wp-statistics-mini-chart'         => 'wpstatistics_mini_chart_settings',
        'wp-statistics-rest-api'           => 'wpstatistics_rest_api_settings',
        'wp-statistics-data-plus'          => 'wpstatistics_data_plus_settings',
    ];

    public static $addOnUtm = [
        'add-ons-bundle'                   => 'utm_source=wp-statistics&utm_medium=link&utm_campaign=bundle',
        'wp-statistics-advanced-reporting' => 'utm_source=wp-statistics&utm_medium=link&utm_campaign=adv-report',
        'wp-statistics-customization'      => 'utm_source=wp-statistics&utm_medium=link&utm_campaign=customization',
        'wp-statistics-widgets'            => 'utm_source=wp-statistics&utm_medium=link&utm_campaign=adv-widgets',
        'wp-statistics-realtime-stats'     => 'utm_source=wp-statistics&utm_medium=link&utm_campaign=realtime',
        'wp-statistics-mini-chart'         => 'utm_source=wp-statistics&utm_medium=link&utm_campaign=mini-chart',
        'wp-statistics-rest-api'           => 'utm_source=wp-statistics&utm_medium=link&utm_campaign=rest-api',
        'wp-statistics-data-plus'          => 'utm_source=wp-statistics&utm_medium=link&utm_campaign=dp',
    ];

    public static function get()
    {
        $licenseDecorator = [];

        foreach (self::getFromRemote() as $addOn) {
            $licenseDecorator[] = new AddOnDecorator($addOn);
        }

        return $licenseDecorator;
    }

    private static function getFromRemote()
    {
        // Define a unique transient key
        $transientKey = 'wp_statistics_addons';

        // Try to get the cached data
        $cachedData = get_transient($transientKey);

        // If the cached data is found, return it
        if ($cachedData !== false) {
            return $cachedData;
        }

        // If not found, fetch the data from the remote source
        $addOnsRemoteUrl = WP_STATISTICS_SITE_URL . '/wp-json/plugin/addons';
        $response        = wp_remote_get($addOnsRemoteUrl, ['timeout' => 35]);

        if (is_wp_error($response)) {
            return [];
        }

        if (200 != wp_remote_retrieve_response_code($response)) {
            return [];
        }

        $response = json_decode($response['body']);

        if (isset($response->items)) {
            // Cache the data for 1 week
            set_transient($transientKey, $response->items, WEEK_IN_SECONDS);

            return $response->items;
        }

        return [];
    }

    public static function getSettingNameByKey($key)
    {
        if (self::$optionMap[$key]) {
            return self::$optionMap[$key];
        }
    }

    public static function getLicenseTransientKey($key)
    {
        return $key . '_license_response';
    }

    public static function getDownloadTransientKey($key)
    {
        return $key . '_download_info';
    }
}