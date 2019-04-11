<?php


namespace MakG\PostTeaser\ContentFilter;

interface ContentFilterInterface
{
    /**
     * Filters post content.
     */
    public function filter(\WP_Post $post, string $content): string;
}