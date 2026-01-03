<?php

namespace Tests\Feature\Livewire;

use App\Livewire\SellFruit;
use App\Models\Fruit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SellFruitTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_can_list_fruits(): void
    {
        $fruit = Fruit::factory()->create();

        Livewire::test(SellFruit::class)
            ->assertSee($fruit->name);
    }
}
