<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|min:3|required',
            'description' => 'string|min:10|required'
        ]);
        
        Course::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return Redirect::route('courses.index')->with('message', 'Course Created successfully');
        
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'string|min:3|required',
            'description' => 'string|min:10|required',
        ]);
        
        $course->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return Redirect::route('courses.index')->with('message', 'Course Updated Successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return Redirect::back()->with('message', 'Course deleted successfully');
    }
}
