<?php

namespace Tests\Feature\Livewire;

use App\Livewire\SellFruit;
use App\Models\Fruit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SellFruitTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_can_list_fruits(): void
    {
        $fruits = Fruit::factory()->count(25)->create();

        $fruits1 = $fruits->forPage(1, 10)->pluck('name');
        $fruits2 = $fruits->forPage(2, 10)->pluck('name');
        $fruits3 = $fruits->forPage(3, 10)->pluck('name');

        Livewire::test(SellFruit::class)
            ->assertSet('page', 1)
            ->assertSee($fruits1->toArray())
            ->assertDontSee($fruits2->toArray())
            ->assertDontSee($fruits3->toArray())
            ->set('page', 2)
            ->assertDontSee($fruits1->toArray())
            ->assertSee($fruits2->toArray())
            ->assertDontSee($fruits3->toArray())
            ->set('page', 3)
            ->assertDontSee($fruits1->toArray())
            ->assertDontSee($fruits2->toArray())
            ->assertSee($fruits3->toArray());
    }

    public function test_the_amount_of_fruits_shown_per_page_can_be_changed(): void
    {
        $fruits = Fruit::factory()->count(25)->create();

        $fruits1 = $fruits->forPage(1, 20)->pluck('name');
        $fruits2 = $fruits->forPage(2, 20)->pluck('name');

        Livewire::test(SellFruit::class)
            ->assertSet('perPage', 10)
            ->set('perPage', 20)
            ->assertSee($fruits1->toArray())
            ->assertDontSee($fruits2->toArray())
            ->set('page', 2)
            ->assertDontSee($fruits1->toArray())
            ->assertSee($fruits2->toArray());
    }
}
