<?php

namespace Tests\Feature\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class AppServiceProviderTest extends TestCase
{
    public function test_manager_authorization(): void
    {
        $manager = User::factory()->make();
        $seller = User::factory()->seller()->make();

        $this->assertFalse(Gate::allows('manage'));

        $this->actingAs($seller);

        $this->assertFalse(Gate::allows('manage'));

        $this->actingAs($manager);

        $this->assertTrue(Gate::allows('manage'));
    }
}
