<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_home_loads()
    {
        $response = $this->get('/public');
        $response->assertStatus(200);
    }

    public function test_public_news_index_loads()
    {
        $response = $this->get('/public/news');
        $response->assertStatus(200);
    }

    public function test_public_staff_index_loads()
    {
        $response = $this->get('/public/staff');
        $response->assertStatus(200);
    }

    public function test_public_resources_index_loads()
    {
        $response = $this->get('/public/resources');
        $response->assertStatus(200);
    }

    public function test_public_news_show_loads()
    {
        $news = News::factory()->create([
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/public/news/' . $news->slug);
        $response->assertStatus(200);
    }
}
