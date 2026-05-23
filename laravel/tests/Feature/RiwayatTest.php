<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\DataAnak;
use App\Models\HasilKalkulator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RiwayatTest extends TestCase
{
    use RefreshDatabase;

    public function test_riwayat_page_can_be_accessed()
    {
        $user = User::factory()->create();

        $dataAnak = DataAnak::factory()->create([
            'id_user' => $user->id,
        ]);

        HasilKalkulator::factory()->create([
            'id_anak' => $dataAnak->id,
        ]);

        $response = $this->actingAs($user)
            ->get('/riwayat');

        $response->assertStatus(200);

        $response->assertViewIs('riwayat');

        $response->assertViewHas('riwayat');
    }
}