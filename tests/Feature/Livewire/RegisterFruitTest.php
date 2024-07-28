<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Livewire\RegisterFruit;
use App\Models\Fruit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\Rules\Enum;
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

    /**
     * @dataProvider invalidFruitData
     */
    public function test_validation_in_fruit_attributes($attribute, $value, $rule): void
    {
        /** @var Fruit $fruit */
        $fruit = Fruit::factory()->make();

        $data = $fruit->only('name', 'classification', 'fresh', 'quantity', 'price');

        Livewire::test(RegisterFruit::class)
            ->fill($data)
            ->set($attribute, $value)
            ->assertHasErrors([$attribute => [$rule]]);
    }

    public static function invalidFruitData(): array
    {
        return [
            'Name required' => ['name', '', 'required'],
            'Name min' => ['name', 'ab', 'min'],
            'Name max' => ['name', str_repeat('a', 31), 'max'],

            'classification enum' => ['classification', 'Exotic', Enum::class],

            'fresh required' => ['fresh', null, 'required'],

            'quantity required' => ['quantity', null, 'required'],
            'quantity min' => ['quantity', 0, 'min'],
            'quantity max' => ['quantity', 65536, 'max'],
        ];
    }
}
