<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

class EnrolllmentTest extends TestCase
{
    public function test_user_can_enroll_in_course()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['_token' => 'test_token'])
            ->post(route('courses.enroll', $course->id), [
                '_token' => 'test_token',
            ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('enrollments', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);
    }
    
    public function test_guest_cannot_enroll_in_course()
    {
        $course = Course::factory()->create();

        $response = $this->withSession(['_token' => 'test_token'])->post(route('courses.enroll', $course->id),[
            '_token' => 'test_token',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('enrollments', [
            'course_id' => $course->id,
        ]);
    }
    
    public function test_user_cannot_enroll_twice_in_same_course()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        $response = $this->actingAs($user)->withSession(['_token' => 'test_token'])->post(route('courses.enroll', $course->id),[
            '_token' => 'test_token',
        ]);

        $response->assertSessionHas('message', 'You are already enrolled in this course');
        $this->assertCount(1, Enrollment::where('user_id', $user->id)->where('course_id', $course->id)->get());
    }
}
