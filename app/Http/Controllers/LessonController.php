<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $query = Lesson::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }
        $lessons = $query->paginate(10)->withQueryString();
        
        return view('lessons.index', compact('lessons'));
    }

    public function create()
    {
        $courses = Course::get();
        return view('lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'content' => 'required|string|min:10',
            'course_id' => 'required|exists:courses,id'
        ]);
        
        Lesson::create([
            'title' => $request->title,
            'content' => $request->content,
            'course_id' => $request->course_id
        ]);

        return Redirect::route('lessons.index')->with('message', 'Lesson Created Successfully');
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::get();

        return view('lessons.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'content' => 'required|string|min:10',
            'course_id' => 'required|exists:courses,id'
        ]);
        
        $lesson->update([
            'title' => $request->title,
            'content' => $request->content,
            'course_id' => $request->course_id
        ]);

        return Redirect::route('lessons.index')->with('message', 'Lesson Updated Successfully');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return Redirect::back()->with('message', 'Lesson deleted successfully');
    }
}
