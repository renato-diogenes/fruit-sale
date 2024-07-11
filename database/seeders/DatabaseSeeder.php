<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->count(2)
            ->sequence(
                [
                    'email' => 'manager@email.com',
                    'role' => Role::MANAGER,
                ],
                [
                    'email' => 'seller@email.com',
                    'role' => Role::SELLER,
                ],
            )
            ->create();
    }
}
