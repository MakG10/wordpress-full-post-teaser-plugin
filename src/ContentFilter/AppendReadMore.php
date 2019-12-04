<?php


namespace MakG\PostTeaser\ContentFilter;

class AppendReadMore implements ContentFilterInterface
{
    /**
     * {@inheritDoc}
     */
    public function filter(\WP_Post $post, string $content): string
    {
        $excerpt = $this->extractExcerpt($post, $content);

        // If excerpt and content are identical, it means that no excerpt was set and there is no need to append "read more".
        if ($excerpt !== $content) {
            $excerpt .= $this->renderReadMoreButton(
                [
                    'url' => $this->getReadMoreUrl($post),
                ]
            );
        }

        return $excerpt;
    }

    /**
     * Extracts excerpt from the post. If there is no excerpt, then return $defaultContent.
     * It is important that $defaultContent is returned and not $post->post_content,
     * because content passed to the filter may be just a part of paginated post.
     *
     * @param \WP_Post $post
     * @param $defaultContent
     * @return string
     */
    private function extractExcerpt(\WP_Post $post, $defaultContent): string
    {
        $extendedContent = get_extended($post->post_content);

        return !empty($extendedContent['extended']) ? $extendedContent['main'] : $defaultContent;
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
