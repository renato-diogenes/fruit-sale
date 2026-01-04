<?php

namespace App\Livewire;

use App\Models\Fruit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;

class SellFruit extends Component
{
    public int $page = 1;

    public int $perPage = 10;

    public ?bool $fresh = null;

    public function render(): View
    {
        return view('livewire.sell-fruit', [
            'fruits' => Fruit::when(
                isset($this->fresh),
                fn (Builder $query): Builder => $query->where('fresh', $this->fresh)
            )->paginate($this->perPage, page: $this->page),
        ]);
    }
}
