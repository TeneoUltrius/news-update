<?php declare(strict_types=1, encoding='UTF-8');

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Clients\RSSToArrayConverter;
use App\Http\Clients\OpenAIClient;

class NewsController extends Component
{
    // Settings
    private string $rssBaseUrl = 'https://rss.nytimes.com/services/xml/rss/nyt/';
    private string $rssExt = '.xml';
    private string $rssTypesPath = '/config/rsstypes.php';
    private array $instructions = [
        'title' => 'Rewrite the news title, but keep its meaning.',
        'description' => 'Rewrite the news description, but keep its meaning.',
    ];

    public string $selectedType = '';
    public string $selectedCategory = '';

    public array $rssTypes = []; // mounted value
    public array $rssResponse = [];
    public int $rssAmount = 10;

    public array $texts = [];
//        = [
//        'title' => [
//            'initial' => 'Inside One of the World’s Biggest Green Hydrogen Projects',
//            'updated' => 'World’s Biggest Green Hydrogen Project - One of the Biggest One',
//        ],
//        'description' => [
//            'initial' => 'Hundreds of billions of dollars are being invested in a high-tech gamble to make hydrogen clean, cheap and widely available. In Australia’s Outback, that starts with 10 million new solar panels.',
//            'updated' => 'The renewable energy developer Neoen said in March that it would build this, billed as the world’s largest solar-powered battery, using Tesla Powerpack batteries.',
//        ]
//    ];


    public function mount(): void {
        $this->rssTypes = require base_path() . $this->rssTypesPath;
    }

    public function resetAll(): void {
        $this->reset(['selectedType', 'selectedCategory', 'rssResponse']);
    }

    public function convert(): void {

        if(!empty($this->rssResponse)) {
            $this->rssResponse = [];
        }

        $rssName = $this->rssTypes[$this->selectedType][$this->selectedCategory];
        if($rssName == '') {
            $rssName = $this->selectedCategory;
        }
        $rssUri = $this->rssBaseUrl . $rssName . $this->rssExt;
        $this->rssResponse = $this->rssClient($rssUri);
    }

    public function toggleMessage(int $index, bool $isRewrite): void
    {
        if($isRewrite) {
            $this->texts = $this->rewriteAll($index);
        } else {
            $this->texts = [];
        }

        foreach ($this->rssResponse as $key => $block) {
            if ($key == $index) {
                $this->rssResponse[$key]['show_message'] = !$this->rssResponse[$key]['show_message'];
            } else {
                $this->rssResponse[$key]['show_message'] = false;
            }
        }
    }


    private function rssClient(string $uri): array {
        $rssArray = [];
        try {
            $rssArray = RSSToArrayConverter::fromUri($uri)->convert();
        } catch (\Exception $e) {
            dd('Error: ' . $e->getMessage());
        }
        return $rssArray;
    }

    private function rewriteOne(string $input, string $instruction): string {
        // using Edits API config settings
        $client = new OpenAIClient(
            config('services.openai.token'),
            config('services.openai_edits'));
        try {
            $responseJson = $client->requestEdits($input, $instruction);
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage() .
            " \n The input was: ". $input;
        }
        $responseArray = json_decode($responseJson, true);
        // Output string
        if($responseArray['choices'][0]['text'] ?? false) {
            return $responseArray['choices'][0]['text'];
        }
        // OpenAI error
        if ($responseArray['error'] ?? false) {
            return 'Error: Type - ' . $responseArray['error']['type'] .
                ' Message - ' . $responseArray['error']['message'];
        }
        return '';
    }

    private function rewriteAll(int $i): array {
        $texts = [];
        foreach ($this->instructions as $type => $instruction) {
            $input = $this->rssResponse[$i][$type];
            $output = $this->rewriteOne($input, $instruction);
            $texts[$type]['initial'] = $input;
            $texts[$type]['updated'] = $output;
        }
        return $texts;
    }

//    public function next(): void
//    {
//        // Go to the next step
//        $this->emit('goToStep', [
//            'step' => 2,
//            'selectedType' => $this->selectedType,
//            'selectedCategory' => $this->selectedCategory,
//        ]);
//    }

    public function render(): object
    {
        return view('livewire.news-controller');
    }
}
