<?php


namespace MakG\PostTeaser\VisitStorage;


class SessionVisitStorage implements VisitStorageInterface
{
    private const SESSION_KEY = 'makg-post-teaser-visits';

    /**
     * {@inheritDoc}
     */
    public function save(\WP_Post $post): void
    {
        $this->startSession();

        $visitedPosts = $_SESSION[self::SESSION_KEY] ?? [];
        $visitedPosts = array_merge($visitedPosts, [$post->ID]);

        $_SESSION[self::SESSION_KEY] = $visitedPosts;
    }

    /**
     * {@inheritDoc}
     */
    public function has(\WP_Post $post): bool
    {
        $this->startSession();

        return in_array($post->ID, $_SESSION[self::SESSION_KEY] ?? [], false);
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}