<?php


namespace MakG\PostTeaser\VisitStorage;

interface VisitStorageInterface
{
    /**
     * Saves the visit of the given post. Only the fact that the full post has been viewed is stored
     * without any additional information about the visit.
     */
    public function save(\WP_Post $post): void;

    /**
     * Returns true if the user has already visited full version of the given post.
     */
    public function has(\WP_Post $post): bool;
}