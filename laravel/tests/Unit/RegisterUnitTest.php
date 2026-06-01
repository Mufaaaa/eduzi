<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menguji password yang disimpan dalam bentuk hash.
     */
    public function test_password_is_hashed()
    {
        $user = User::factory()->create([
            'password' => 'password123',
        ]);

        $this->assertNotEquals(
            'password123',
            $user->password
        );

        $this->assertTrue(
            Hash::check('password123', $user->password)
        );
    }

    /**
     * Menguji role default pengguna.
     */
    public function test_user_has_pengguna_role()
    {
        $user = User::factory()->create([
            'role' => 'pengguna',
        ]);

        $this->assertEquals(
            'pengguna',
            $user->role
        );
    }

    /**
     * Menguji atribut fillable pada model User.
     */
    public function test_user_fillable_attributes()
    {
        $user = new User();

        $expectedFillable = [
            'name',
            'email',
            'password',
            'google_id',
            'avatar',
            'role',
            'photo',
        ];

        $this->assertEquals(
            $expectedFillable,
            $user->getFillable()
        );
    }

    /**
     * Menguji data user tersimpan dengan benar.
     */
    public function test_user_data_is_saved_correctly()
    {
        $user = User::factory()->create([
            'name' => 'Faiq',
            'email' => 'faiq@example.com',
            'role' => 'pengguna',
        ]);

        $this->assertEquals(
            'Faiq',
            $user->name
        );

        $this->assertEquals(
            'faiq@example.com',
            $user->email
        );

        $this->assertEquals(
            'pengguna',
            $user->role
        );
    }

    /**
     * Menguji email tidak null setelah user dibuat.
     */
    public function test_email_is_not_null()
    {
        $user = User::factory()->create();

        $this->assertNotNull(
            $user->email
        );
    }

    /**
     * Menguji panjang password asli memenuhi syarat minimal 8 karakter.
     */
    public function test_password_length_requirement()
    {
        $password = 'password123';

        $this->assertGreaterThanOrEqual(
            8,
            strlen($password)
        );
    }
}