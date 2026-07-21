<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Artikel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtikelVideoTest extends TestCase
{
    use RefreshDatabase;

    public function test_artikel_video_page_can_be_accessed()
    {
        $response = $this->get('/artikel-video');

        $response->assertStatus(200);

        $response->assertViewIs('artikelvideo');
    }

    public function test_search_artikel_video()
    {
        Artikel::factory()->create([
            'judul' => 'Laravel Testing'
        ]);

        Artikel::factory()->create([
            'judul' => 'Machine Learning'
        ]);

        $response = $this->get('/artikel-video?search=Laravel');

        $response->assertStatus(200);

        $response->assertSee('Laravel Testing');

        $response->assertDontSee('Machine Learning');
    }

    public function test_detail_artikel_can_be_accessed()
    {
        $artikel = Artikel::factory()->create([
            'judul' => 'Detail Artikel'
        ]);

        Artikel::factory()->count(5)->create();

        $response = $this->get('/artikel/' . $artikel->id);

        $response->assertStatus(200);

        $response->assertSee('Detail Artikel');

        $response->assertViewHas('artikel');

        $response->assertViewHas('latest');

        $response->assertViewHas('sidebarArtikel');
    }

    public function test_detail_artikel_returns_404_if_not_found()
    {
        $response = $this->get('/artikel/999');

        $response->assertStatus(404);
    }
}