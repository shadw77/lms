<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;

class EnrollmentController extends Controller
{
    public function enroll($course_id)
    {
        $enrollment_exist = Enrollment::where('user_id', Auth::id())->where('course_id', $course_id)->exists();
    
        if($enrollment_exist) {
            return Redirect::route('courses.index')->with('message', 'You are already enrolled in this course');
        } else {
            Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course_id
            ]);

            return Redirect::route('courses.index')->with('message', 'Enrollment Done');
        }
    }
}
