<?php

namespace Tests\Feature\Livewire\SellFruit;

use App\Livewire\SellFruit;
use App\Models\Fruit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_fruit_list_can_be_filtered_by_the_fresh_attribute(): void
    {
        $fruit1 = Fruit::factory()->state(['fresh' => false])->create();
        $fruit2 = Fruit::factory()->state(['fresh' => true])->create();

        Livewire::test(SellFruit::class)
            ->assertSet('fresh', null)
            ->assertSee([$fruit1->name, $fruit2->name])
            ->set('fresh', true)
            ->assertDontSee($fruit1->name)
            ->assertSee($fruit2->name)
            ->set('fresh', false)
            ->assertSee($fruit1->name)
            ->assertDontSee($fruit2->name);
    }
}
