<?php


namespace MakG\PostTeaser\BotDetector;

interface BotDetectorInterface
{
    public function isBot(array $env = []): bool;
}
