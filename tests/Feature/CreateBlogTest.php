<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use Database\Factories\UserFactory;
use App\Models\User;

class CreateBlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_with_editor_permissions_can_crete_blog(): void
    {
        $blogTitle = 'Test Blog';
        $blogContent = 'TestBlogContent';

        $data = [
            'title' => $blogTitle,
            'text' => $blogContent,
        ];

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_editor' => 1,
        ]);

        $this->actingAs($user);

        $response = $this->post('/blog/store', $data);

        $response->assertStatus(200);

         $this->assertDatabaseHas('blogs', [
            'title' => $blogTitle,
            'content' => $blogContent,
            'author_id' => $user->id,
        ]);
    }

    public function test_users_with_without_editor_permissions_can_not_crete_blog(): void
    {
        $blogTitle = 'Test Blog';
        $blogContent = 'TestBlogContent';

        $data = [
            'title' => $blogTitle,
            'text' => $blogContent,
        ];

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->actingAs($user);

        $response = $this->post('/blog/store', $data);

        $response->assertStatus(404);

         $this->assertDatabaseMissing('blogs', [
            'title' => $blogTitle,
            'content' => $blogContent,
            'author_id' => $user->id,
        ]);
    }

    public function test_users_without_accounts_can_not_crete_blog(): void
    {
        $blogTitle = 'Test Blog';
        $blogContent = 'TestBlogContent';

        $data = [
            'title' => $blogTitle,
            'text' => $blogContent,
        ];

        $response = $this->post('/blog/store', $data);

        $response->assertStatus(404);

         $this->assertDatabaseMissing('blogs', [
            'title' => $blogTitle,
            'content' => $blogContent,
        ]);
    }
}