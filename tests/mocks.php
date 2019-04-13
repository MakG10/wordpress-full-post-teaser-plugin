<?php
/*
 * Mocks of global Wordpress functions and classes used by the plugin.
 */

class WP_Post
{
    public $ID;
    public $post_content;
    public $post_excerpt;
}

function get_extended($text)
{
    return [
        'main' => substr($text, 0, strpos($text, '<!--more->') ?: null),
    ];
}

function __($text)
{
    return $text;
}

function get_permalink($post)
{
    return 'http://example.org';
}

function add_query_arg($arg, $value, $url)
{
    return sprintf('%s?%s=%s', $url, $arg, $value);
}
