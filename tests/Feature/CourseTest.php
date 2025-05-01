<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CourseTest extends TestCase
{
    public function test_create_course_with_auth()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->withSession(['_token' => 'test_token'])->post(route('courses.store'), [
            'title' => 'New Course',
            'description' => 'This is a test course',
            '_token' => csrf_token(),
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('courses', [
            'title' => 'New Course',
            'description' => 'This is a test course',
        ]);
    }

    public function test_create_course_without_data(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->withSession(['_token' => 'test_token'])->post(route('courses.store'), [
            '_token' => csrf_token(),
        ]);

        $response->assertSessionHasErrors(['title', 'description']);
    }
}
