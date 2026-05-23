<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_can_be_accessed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/profile');

        $response->assertStatus(200);
    }

    public function test_user_can_update_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/profile', [
                'name' => 'Faiq Updated',
                'email' => 'updated@example.com',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Faiq Updated',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_user_can_upload_profile_photo()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->actingAs($user)
            ->post('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'photo' => $file,
            ]);

        $response->assertRedirect();

        $user->refresh();

        $this->assertNotNull($user->photo);

        Storage::disk('public')->assertExists($user->photo);
    }
}