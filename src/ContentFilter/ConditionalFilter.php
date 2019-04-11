<?php


namespace MakG\PostTeaser\ContentFilter;


use MakG\PostTeaser\BotDetector\BotDetectorInterface;
use MakG\PostTeaser\VisitStorage\VisitStorageInterface;

/**
 * This filter modifies post content only for non-bot users who haven't visited full post page yet.
 */
class ConditionalFilter implements ContentFilterInterface
{
    private $childFilter;
    private $botDetector;
    private $visitStorage;

    public function __construct(
        ContentFilterInterface $childFilter,
        BotDetectorInterface $botDetector,
        VisitStorageInterface $visitStorage
    ) {
        $this->childFilter = $childFilter;
        $this->botDetector = $botDetector;
        $this->visitStorage = $visitStorage;
    }

    /**
     * {@inheritDoc}
     */
    public function filter(\WP_Post $post, string $content): string
    {
        if ($this->botDetector->isBot() || $this->visitStorage->has($post) || get_query_var('more')) {
            return $content;
        }

        return $this->childFilter->filter($post, $content);
    }
}