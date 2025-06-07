<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_is_a_manager(): void
    {
        $manager = User::factory()->make();
        $seller = User::factory()->seller()->make();

        $this->assertTrue($manager->isManager());
        $this->assertFalse($seller->isManager());
    }
}
