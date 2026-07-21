<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RiwayatUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_riwayat_page_can_be_accessed()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/riwayat');

        $response->assertStatus(200);

        $response->assertViewIs('riwayat');
    }
}