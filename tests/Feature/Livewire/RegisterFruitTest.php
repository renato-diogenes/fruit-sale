<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Livewire\RegisterFruit;
use App\Models\Fruit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterFruitTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_can_register_fruit(): void
    {
        /** @var Fruit $fruit */
        $fruit = Fruit::factory()->make();

        $data = $fruit->only('name', 'classification', 'fresh', 'quantity', 'price');

        Livewire::test(RegisterFruit::class)
            ->fill($data)
            ->call('save');

        $this->assertDatabaseHas(Fruit::class, $data);
    }
}
