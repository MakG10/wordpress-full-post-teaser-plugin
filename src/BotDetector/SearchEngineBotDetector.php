<?php


namespace MakG\PostTeaser\BotDetector;

class SearchEngineBotDetector implements BotDetectorInterface
{
    public function isBot(array $env = []): bool
    {
        if (empty($env)) {
            $env = $_SERVER;
        }

        $userAgent = $env['HTTP_USER_AGENT'] ?? '';

        return preg_match('/bot|crawl|slurp|spider|mediapartners|Bing|AOL/i', $userAgent);
    }
}
