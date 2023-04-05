<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StepsController extends Component
{
    public $currentStep = 1;
    public $stack;

    protected $listeners = ['goToStep'];

    public function goToStep($stack)
    {
        $this->stack = $stack;
        $this->currentStep = $stack['step'];
    }

    public function render()
    {
        return view('livewire.steps-controller');
    }
}
