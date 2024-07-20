<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Fruit;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterFruit extends Component
{
    #[Validate('required|min:3')]
    public string $name;

    public string $classification;

    public bool $fresh;

    public int $quantity;

    public float $price;

    public function save(): void
    {
        $this->validate();

        $fruit = new Fruit();

        $fruit->name = $this->name;
        $fruit->classification = $this->classification;
        $fruit->fresh = $this->fresh;
        $fruit->quantity = $this->quantity;
        $fruit->price = $this->price;

        $fruit->save();
    }

    public function render(): View
    {
        return view('livewire.register-fruit');
    }
}
