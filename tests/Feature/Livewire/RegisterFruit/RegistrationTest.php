<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\RegisterFruit;

use App\Livewire\RegisterFruit;
use App\Models\Fruit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_can_register_fruit(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $fruit = Fruit::factory()->make();

        $data = $fruit->only('name', 'classification', 'fresh', 'quantity', 'price');

        Livewire::test(RegisterFruit::class)
            ->fill($data)
            ->call('save')
            ->assertOk();

        $this->assertDatabaseHas(Fruit::class, $data);
    }

    public function test_only_managers_can_register_fruits(): void
    {
        $user = User::factory()->seller()->create();

        $this->actingAs($user);

        $fruit = Fruit::factory()->make();

        $data = $fruit->only('name', 'classification', 'fresh', 'quantity', 'price');

        Livewire::test(RegisterFruit::class)
            ->fill($data)
            ->call('save')
            ->assertForbidden();

        $this->assertDatabaseMissing(Fruit::class, ['name' => $fruit->name]);
    }
}
