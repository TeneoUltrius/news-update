<?php declare(strict_types=1, encoding='UTF-8');

namespace App\Http\Clients;
use Carbon\Carbon;
use JetBrains\PhpStorm\Pure;

class RSSToArrayConverter
{
    private string $rssUri;

    private function __construct($rssUri) {
        $this->rssUri = $rssUri;
    }

    #[Pure] public static function fromUri($rssUri): RSSToArrayConverter {
        return new self($rssUri);
    }

    public function convert(): array {
        $rssArray = array();
        try {
            $rss = \simplexml_load_file($this->rssUri);
        } catch (\Exception $e) {
            throw new \Exception('Unable to load RSS feed: ' . $e->getMessage());
        }
        foreach ($rss->channel->item as $item) {
            $rssArray[] = array(
                'title' => (string) $item->title,
                'description' => (string) $item->description,
                'link' => (string) $item->link,
                'pubDate' => Carbon::createFromFormat('D, d M Y H:i:s O', $item->pubDate),
                'show_message' => false,
            );
        }
        return $rssArray;
    }
}
