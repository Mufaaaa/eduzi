<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Komunitas;
use App\Models\KomentarKomunitas;
use App\Models\LikeKomunitas;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KomunitasTest extends TestCase
{
    use RefreshDatabase;

    public function test_komunitas_page_can_be_accessed()
    {
        $response = $this->get('/komunitas');

        $response->assertStatus(200);
    }

    public function test_user_can_create_postingan()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/komunitas', [
                'postingan' => 'Postingan komunitas test'
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('komunitas', [
            'isi' => 'Postingan komunitas test',
            'user_id' => $user->id,
        ]);
    }

    public function test_guest_can_only_post_3_times()
    {
        for ($i = 1; $i <= 3; $i++) {
            $this->post('/komunitas', [
                'postingan' => 'Postingan ' . $i
            ]);
        }

        $response = $this->post('/komunitas', [
            'postingan' => 'Postingan ke 4'
        ]);

        $response->assertSessionHas('error');

        $this->assertDatabaseMissing('komunitas', [
            'isi' => 'Postingan ke 4'
        ]);
    }

    public function test_user_can_comment()
    {
        $user = User::factory()->create();

        $komunitas = Komunitas::factory()->create();

        $response = $this->actingAs($user)
            ->post('/komunitas/komentar', [
                'komunitas_id' => $komunitas->id,
                'isi' => 'Komentar test',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('komentar_komunitas', [
            'isi' => 'Komentar test',
            'komunitas_id' => $komunitas->id,
        ]);
    }

    public function test_user_can_like_postingan()
    {
        $user = User::factory()->create();

        $komunitas = Komunitas::factory()->create();

        $response = $this->actingAs($user)
            ->post('/like', [
                'komunitas_id' => $komunitas->id,
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('like_komunitas', [
            'komunitas_id' => $komunitas->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_unlike_postingan()
    {
        $user = User::factory()->create();

        $komunitas = Komunitas::factory()->create();

        LikeKomunitas::create([
            'user_id' => $user->id,
            'komunitas_id' => $komunitas->id,
        ]);

        $response = $this->actingAs($user)
            ->post('/like', [
                'komunitas_id' => $komunitas->id,
            ]);

        $response->assertRedirect();

        $this->assertDatabaseMissing('like_komunitas', [
            'komunitas_id' => $komunitas->id,
            'user_id' => $user->id,
        ]);
    }
}