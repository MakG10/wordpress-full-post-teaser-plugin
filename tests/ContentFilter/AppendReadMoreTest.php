<?php

require_once __DIR__.'/../mocks.php';

use MakG\PostTeaser\ContentFilter\AppendReadMore;
use PHPUnit\Framework\TestCase;

class AppendReadMoreTest extends TestCase
{
    public function testFilter()
    {
        $content = 'excerpt of the post <!--more-> more content';

        $post = new WP_Post();
        $post->ID = 1;
        $post->post_content = $content;
        $post->post_excerpt = 'excerpt of the post';

        $contentFilter = new AppendReadMore();

        $filteredContent = $contentFilter->filter($post, $content);

        $this->assertStringContainsString($post->post_excerpt, $filteredContent);
        $this->assertStringContainsString('Read more', $filteredContent);
    }
}
