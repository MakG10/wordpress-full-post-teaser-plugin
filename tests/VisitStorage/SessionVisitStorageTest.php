<?php

require_once __DIR__.'/../mocks.php';

use MakG\PostTeaser\VisitStorage\SessionVisitStorage;
use PHPUnit\Framework\TestCase;

class SessionVisitStorageTest extends TestCase
{

    public function testSave()
    {
        $post = new WP_Post();
        $post->ID = 1;

        $visitStorage = new SessionVisitStorage();
        $visitStorage->save($post);

        $sessionValue = $_SESSION['makg-post-teaser-visits'];

        $this->assertIsArray($sessionValue);
        $this->assertContains(1, $sessionValue);
    }

    public function testHas()
    {
        $_SESSION['makg-post-teaser-visits'] = [2, 1, 4];

        $visitedPost = new WP_Post();
        $visitedPost->ID = 4;

        $notVisitedPost = new WP_Post();
        $notVisitedPost->ID = 3;

        $visitStorage = new SessionVisitStorage();

        $this->assertTrue($visitStorage->has($visitedPost));
        $this->assertFalse($visitStorage->has($notVisitedPost));
    }
}
