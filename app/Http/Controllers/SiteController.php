<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Seen;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('welcome', compact('categories'));
    }

    public function category($id)
    {
        $category = Category::find($id);
        $enrolledCourses = [];
        if (auth()->check()) {
            $enrolledCourses = Enrollment::where('user_id', auth()->id())->pluck('course_id')->toArray();
        }
        return view('category', compact('category', 'enrolledCourses'));
    }

    public function enroll($id)
    {
        $course = Course::findOrFail($id);
        $enrollment = Enrollment::firstOrNew([
            'user_id' => auth()->id(),
            'course_id' => $id
        ], [
            'price' => $course->price
        ]);
        $enrollment->save();
        return redirect()->route('course.show', $id);
    }

    public function course($id)
    {
        $last_seen = Seen::where('user_id', auth()->id())->where('course_id', $id)->orderBy('id', 'desc')->first();
        if (!$last_seen)
        {
            $lesson_id = Lesson::where('course_id', $id)->first()->id;
            return redirect()->route('lesson.show', $lesson_id);
        }
        return redirect()->route('lesson.show', $last_seen->lesson_id);
    }

    public function myCourses()
    {
        $enrollments = Enrollment::where('user_id', auth()->id())->get();
        return view('my-courses', compact('enrollments'));
    }

    public function lesson($id)
    {
        $lesson = Lesson::find($id);
        $lessons = Lesson::where('course_id', $lesson->course_id)->get();
        $seens = Seen::where('user_id', auth()->id())
                    ->where('course_id', $lesson->course_id)
                    ->pluck('lesson_id')
                    ->toArray();

        // Corrected line
        $seens[] = Lesson::where('course_id', $lesson->course_id)
                        ->whereNotIn('id', $seens)
                        ->first()
                        ->id ?? null;

        if (!in_array($id, $seens)) {
            return redirect()->route('course.show', $lesson->course_id);
        }

        $seen = Seen::firstOrNew([
            'user_id' => auth()->id(),
            'course_id' => $lesson->course_id,
            'lesson_id' => $id
        ]);
        $seen->save();

        $seens[] = $id;

        // Corrected line
        $seens[] = Lesson::where('course_id', $lesson->course_id)
                        ->whereNotIn('id', $seens)
                        ->first()
                        ->id ?? null;

        return view('lesson', compact('id', 'lesson', 'lessons', 'seens'));
    }
}
