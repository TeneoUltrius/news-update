<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Clients\RSSToArrayConverter;

class RawNews extends Component
{
    public $blocks = [
        [
            'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fringilla velit odio, nec laoreet neque ultricies sit amet. Nulla facilisi. Mauris in suscipit libero.',
            'show_message' => false,
        ],
        [
            'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'message' => 'Duis dapibus nunc at lacus scelerisque, nec lobortis dolor efficitur. Proin auctor euismod turpis, vitae euismod tortor ornare ac. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nulla vitae congue odio.',
            'show_message' => false,
        ],
        [
            'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'message' => 'Suspendisse volutpat velit sit amet metus fermentum tempus. Nullam quis bibendum enim, eu tempus velit. Donec viverra pharetra massa a malesuada. Suspendisse aliquam ipsum vitae tellus malesuada, a suscipit tellus pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'show_message' => false,
        ],
    ];
    public $isMounted = false;
    public $stack;
    public $message;

    public function toggleMessage($index)
    {
        foreach ($this->blocks as $key => $block) {
            if ($key == $index) {
                $this->blocks[$key]['show_message'] = !$this->blocks[$key]['show_message'];
            } else {
                $this->blocks[$key]['show_message'] = false;
            }
        }
    }

//    public function showMessage()
//    {
//        $this->message = 'Component mounted successfully!';
//    }



    public function mount($stack)
    {

      $stack = [
        "step" => 2,
        "selectedType" => "Business",
        "selectedCategory" => "Economy",
        "rssUri" => "https://rss.nytimes.com/services/xml/rss/nyt/Economy.xml",
    ];
        $this->stack = $stack;
//        $this->isMounted = true;
    }

    public function render()
    {
        return view('livewire.raw-news');
    }
}
