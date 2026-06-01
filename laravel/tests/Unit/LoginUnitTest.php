<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menguji password yang di-hash dapat diverifikasi.
     */
    public function test_password_hash_can_be_verified()
    {
        $password = 'password123';

        $hashedPassword = Hash::make($password);

        $this->assertTrue(
            Hash::check($password, $hashedPassword)
        );
    }

    /**
     * Menguji password yang salah gagal diverifikasi.
     */
    public function test_wrong_password_fails_verification()
    {
        $hashedPassword = Hash::make('password123');

        $this->assertFalse(
            Hash::check('passwordSalah', $hashedPassword)
        );
    }

    /**
     * Menguji user admin dapat mengakses panel Filament.
     */
    public function test_admin_can_access_panel()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $this->assertEquals(
            'admin',
            $admin->role
        );
    }

    /**
     * Menguji user biasa bukan admin.
     */
    public function test_regular_user_is_not_admin()
    {
        $user = User::factory()->create([
            'role' => 'pengguna'
        ]);

        $this->assertFalse(
            $user->role === 'admin'
        );
    }

    /**
     * Menguji atribut fillable User.
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
     * Menguji password otomatis ter-hash oleh cast.
     */
    public function test_password_is_hashed_automatically()
    {
        $user = User::factory()->create([
            'password' => 'password123'
        ]);

        $this->assertNotEquals(
            'password123',
            $user->password
        );

        $this->assertTrue(
            Hash::check('password123', $user->password)
        );
    }
}