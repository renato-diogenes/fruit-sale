<?php

namespace App\Livewire;

use App\Models\Fruit;
use Illuminate\View\View;
use Livewire\Component;

class SellFruit extends Component
{
    public int $page = 1;

    public function render(): View
    {
        return view('livewire.sell-fruit', [
            'fruits' => Fruit::paginate(10, page: $this->page),
        ]);
    }
}
