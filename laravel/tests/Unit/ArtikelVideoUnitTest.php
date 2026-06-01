<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Artikel;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtikelVideoUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menguji relasi Artikel dengan User
     */
    public function test_artikel_belongs_to_user()
    {
        $user = User::factory()->create();

        $artikel = Artikel::create([
            'id_user' => $user->id,
            'kategori' => 'Teknologi',
            'judul' => 'Laravel Testing',
            'isi' => 'Isi artikel',
            'gambar' => 'gambar.jpg',
        ]);

        $this->assertInstanceOf(User::class, $artikel->user);
        $this->assertEquals($user->id, $artikel->user->id);
    }

    /**
     * Menguji relasi Video dengan User
     */
    public function test_video_belongs_to_user()
    {
        $user = User::factory()->create();

        $video = Video::create([
            'id_user' => $user->id,
            'judul' => 'Tutorial Laravel',
            'url_video' => 'https://youtube.com/test',
            'deskripsi' => 'Video pembelajaran',
        ]);

        $this->assertInstanceOf(User::class, $video->user);
        $this->assertEquals($user->id, $video->user->id);
    }

    /**
     * Menguji atribut fillable pada model Artikel
     */
    public function test_artikel_fillable_attributes()
    {
        $artikel = new Artikel();

        $fillable = [
            'id_user',
            'kategori',
            'judul',
            'isi',
            'gambar',
        ];

        $this->assertEquals($fillable, $artikel->getFillable());
    }

    /**
     * Menguji atribut fillable pada model Video
     */
    public function test_video_fillable_attributes()
    {
        $video = new Video();

        $fillable = [
            'id_user',
            'judul',
            'url_video',
            'deskripsi',
        ];

        $this->assertEquals($fillable, $video->getFillable());
    }
}