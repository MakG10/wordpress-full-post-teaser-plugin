<?php


use MakG\PostTeaser\BotDetector\SearchEngineBotDetector;
use PHPUnit\Framework\TestCase;

class SearchEngineBotDetectorTest extends TestCase
{
    /**
     * @dataProvider botCases
     */
    public function testIsBot($userAgent)
    {
        $botDetector = new SearchEngineBotDetector();

        $this->assertTrue(
            $botDetector->isBot(
                [
                    'HTTP_USER_AGENT' => $userAgent,
                ]
            )
        );
    }

    public function botCases()
    {
        return [
            ['Mediapartners-Google'],
            ['Googlebot-News'],
            ['Mozilla/5.0 (Linux; Android 5.0; SM-G920A) AppleWebKit (KHTML, like Gecko) Chrome Mobile Safari (compatible; AdsBot-Google-Mobile; +http://www.google.com/mobile/adsbot.html)'],
            ['msnbot-media/1.1 (+http://search.msn.com/msnbot.htm)'],
            ['Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534+ (KHTML, like Gecko) BingPreview/1.0b'],
            ['Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 530) like Gecko (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)'],
            ['DuckDuckBot/1.0; (+http://duckduckgo.com/duckduckbot.html)'],
            ['Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)'],
            ['Mozilla/5.0 (compatible; YandexFavicons/1.0; +http://yandex.com/bots)'],
            ['Mozilla/4.0 (compatible; MSIE 8.0; AOL 9.7; AOLBuild 4343.19; Windows NT 5.1; Trident/4.0; GTB7.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)'],
        ];
    }
}
