<?php

namespace Tests\Unit;

use Tests\TestCase;

class PanduanUnitTest extends TestCase
{
    public function test_panduan_page_can_be_accessed()
    {
        $response = $this->get('/panduan');

        $response->assertStatus(200);

        $response->assertViewIs('panduan');
    }
}