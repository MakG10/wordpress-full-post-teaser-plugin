<?php
/*
Plugin Name: Full Post Teaser
Description: Post Teaser plugin for Wordpress. It shows excerpts on the first visit to full post page and reveals content after clicking "read more" and page reload. Useful for increasing page views and ads revenue.
Text Domain: full-post-teaser
Version: 1.0
Author: MakG
Author URI: https://makg.eu
*/

require_once 'BotDetector/BotDetectorInterface.php';
require_once 'BotDetector/SearchEngineBotDetector.php';

require_once 'ContentFilter/ContentFilterInterface.php';
require_once 'ContentFilter/AppendReadMore.php';
require_once 'ContentFilter/ConditionalFilter.php';

require_once 'VisitStorage/VisitStorageInterface.php';
require_once 'VisitStorage/SessionVisitStorage.php';

use MakG\PostTeaser\BotDetector\SearchEngineBotDetector;
use MakG\PostTeaser\ContentFilter\AppendReadMore;
use MakG\PostTeaser\ContentFilter\ConditionalFilter;
use MakG\PostTeaser\VisitStorage\SessionVisitStorage;

if (!defined('ABSPATH')) {
    die();
}


add_filter(
    'the_content',
    function ($content) {
        global $post;

        $appendReadMoreFilter = new AppendReadMore();
        $botDetector = new SearchEngineBotDetector();
        $visitStorage = new SessionVisitStorage();

        $filter = new ConditionalFilter($appendReadMoreFilter, $botDetector, $visitStorage);

        return $filter->filter($post, $content);
    },
    0
);
