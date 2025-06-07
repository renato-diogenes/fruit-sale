<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\RegisterFruit;

use App\Livewire\RegisterFruit;
use App\Models\Fruit;
use Illuminate\Validation\Rules\Enum;
use Livewire\Livewire;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    /**
     * @dataProvider invalidFruitData
     */
    public function test_validation_in_fruit_attributes($attribute, $value, $rule): void
    {
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

            'price required' => ['price', null, 'required'],
            'price min' => ['price', -1, 'min'],
            'price max' => ['price', 1000, 'max'],
        ];
    }
}
