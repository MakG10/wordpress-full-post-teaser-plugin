<?php


namespace MakG\PostTeaser\ContentFilter;

class AppendReadMore implements ContentFilterInterface
{
    /**
     * {@inheritDoc}
     */
    public function filter(\WP_Post $post, string $content): string
    {
        $excerpt = $this->extractExcerpt($post);

        // If excerpt and content are identical, it means that no excerpt was set and there is no need to append "read more".
        if ($excerpt !== $post->post_content) {
            $excerpt .= $this->renderReadMoreButton(
                [
                    'url' => $this->getReadMoreUrl($post),
                ]
            );
        }

        return $excerpt;
    }

    private function extractExcerpt(\WP_Post $post): string
    {
        $extendedContent = get_extended($post->post_content);

        return $extendedContent['main'] ?? $post->post_content;
    }

    private function renderReadMoreButton(array $params)
    {
        $url = $params['url'] ?? '#';
        $label = $params['label'] ?? __('Read more', 'full-post-teaser');

        return <<<RENDER
<span class="mg-read-more">
    <a href="$url">$label</a>
</span>
RENDER;
    }

    private function getReadMoreUrl(\WP_Post $post)
    {
        $url = get_permalink($post);

        return add_query_arg('more', 1, $url);
    }
}