<?php

namespace WP_Statistics\Async;

use WP_Statistics\Models\VisitorsModel;
use WP_STATISTICS\Option;
use WP_Statistics\Service\Admin\Posts\WordCountService;
use WP_Statistics\Service\Geolocation\GeolocationFactory;

class BackgroundProcessFactory
{
    /**
     * Process word count for posts.
     *
     * @return void
     */
    public static function processWordCountForPosts()
    {
        $calculatePostWordsCount = WP_Statistics()->getBackgroundProcess('calculate_post_words_count');
        $wordCount               = new WordCountService();
        $postsWithoutWordCount   = $wordCount->getPostsWithoutWordCountMeta();

        $batchSize = 100;
        $batches   = array_chunk($postsWithoutWordCount, $batchSize);

        foreach ($batches as $batch) {
            $calculatePostWordsCount->push_to_queue(['posts' => $batch]);
        }

        // Mark as processed
        Option::saveOptionGroup('word_count_process_started', true, 'jobs');

        $calculatePostWordsCount->save()->dispatch();
    }

    /**
     * Batch update incomplete GeoIP info for visitors.
     *
     * @return void
     */
    public static function batchUpdateIncompleteGeoIpForVisitors()
    {
        $visitorModel                      = new VisitorsModel();
        $visitorsWithIncompleteLocation    = $visitorModel->getVisitorsWithIncompleteLocation();
        $updateIncompleteVisitorsLocations = WP_Statistics()->getBackgroundProcess('update_unknown_visitor_geoip');

        $visitorsWithIncompleteLocation    = wp_list_pluck($visitorsWithIncompleteLocation, 'ID');

        // Define the batch size
        $batchSize = 100;
        $batches   = array_chunk($visitorsWithIncompleteLocation, $batchSize);

        // Push each batch to the queue
        foreach ($batches as $batch) {
            $updateIncompleteVisitorsLocations->push_to_queue(['visitors' => $batch]);
        }

        // Mark the process as completed
        Option::saveOptionGroup('update_unknown_visitor_geoip_started', true, 'jobs');

        // Save the queue and dispatch it
        $updateIncompleteVisitorsLocations->save()->dispatch();
    }

    /**
     * Download/Update geolocation database using.
     *
     * @return void
     */
    public static function downloadGeolocationDatabase()
    {
        $provider        = GeolocationFactory::getProviderInstance();
        $downloadProcess = WP_Statistics()->getBackgroundProcess('geolocation_database_download');

        // Queue download process
        $downloadProcess->push_to_queue(['provider' => $provider]);
        $downloadProcess->save()->dispatch();
    }

    /**
     * Batch update incomplete Source Channel info for visitors.
     *
     * @return void
     */
    public static function batchUpdateSourceChannelForVisitors()
    {
        @ini_set('memory_limit', '256M');

        $visitorModel                           = new VisitorsModel();
        $visitorsWithIncompleteSourceChannel    = $visitorModel->getVisitorsWithIncompleteSourceChannel();
        $updateIncompleteVisitorsSourceChannels = WP_Statistics()->getBackgroundProcess('update_visitors_source_channel');

        $visitorsWithIncompleteSourceChannel    = wp_list_pluck($visitorsWithIncompleteSourceChannel, 'ID');

        // Define the batch size
        $batchSize = 100;
        $batches   = array_chunk($visitorsWithIncompleteSourceChannel, $batchSize);

        // Push each batch to the queue
        foreach ($batches as $batch) {
            $updateIncompleteVisitorsSourceChannels->push_to_queue(['visitors' => $batch]);
        }

        // Initiate the process
        Option::saveOptionGroup('update_source_channel_process_initiated', true, 'jobs');

        // Save the queue and dispatch it
        $updateIncompleteVisitorsSourceChannels->save()->dispatch();
    }

    // Add other static methods for different background processes as needed
}
