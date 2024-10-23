<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Score;
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
        $lesson = Lesson::findOrFail($id);
        $lessons = Lesson::where('course_id', $lesson->course_id)->get();
        $last_lesson = $lessons->last()->id;
        $quiz = Quiz::where('course_id', $lesson->course_id)->where('after_lesson', $id)->first();
        $seens = Seen::where('user_id', auth()->id())
                    ->where('course_id', $lesson->course_id)
                    ->pluck('lesson_id')
                    ->toArray();
        $courseName = $lesson->course->name;

        // Corrected line
        $next_lesson = Lesson::where('course_id', $lesson->course_id)
                        ->whereNotIn('id', $seens)
                        ->first()
                        ->id ?? null;
        $prev_lesson = Lesson::where('course_id', $lesson->course_id)
                        ->where('id', '<', $id)
                        ->orderBy('id', 'desc')
                        ->first()
                        ->id ?? null;
        //check if prev_lesson is not has quiz or it's quiz is already taken
        if ($prev_lesson) {
            $prev_quiz = Quiz::where('course_id', $lesson->course_id)
                        ->where('after_lesson', $prev_lesson)
                        ->first();

            if($prev_quiz){
                $prev_quiz_score = $prev_quiz->scores()
                            ->where('user_id', auth()->id())
                            ->first();

                if ($prev_quiz_score) {
                    $prev_lesson = null;
                }else{
                    return redirect()->route('course.show', $lesson->course_id);
                }
            }
        }

        if (!in_array($id, $seens) && $id != $next_lesson) {
            return redirect()->route('course.show', $lesson->course_id);
        }

        $seen = Seen::firstOrNew([
            'user_id' => auth()->id(),
            'course_id' => $lesson->course_id,
            'lesson_id' => $id
        ]);
        $seen->save();

        $seens[] = $id;
        //removed duplicate seens array with the same order exist
        $seens = array_unique($seens);

        // Corrected line
        if($id == end($seens))
        {
            $next_lesson = Lesson::where('course_id', $lesson->course_id)
                        ->whereNotIn('id', $seens)
                        ->first()
                        ->id ?? null;
        }
        $lastSeenDate = Seen::where('user_id', auth()->id())
                        ->where('course_id', $lesson->course_id)
                        ->orderBy('id', 'desc')
                        ->first()
                        ->created_at ?? null;

        return view('lesson', compact('id', 'lesson', 'lessons', 'seens', 'next_lesson', 'quiz', 'last_lesson', 'courseName', 'lastSeenDate'));
    }

    public function quiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $lessonSeen = Seen::where('lesson_id', $quiz->after_lesson)
                    ->where('user_id', auth()->id())
                    ->first();
        if(!$lessonSeen){
            return redirect()->route('course.show', $quiz->course_id);
        }
        $questions = $quiz->questions;
        return view('quiz', compact('quiz', 'questions'));
    }

    public function quizSubmit(Request $request, $id)
    {
        // Retrieve all submitted answers
        // Retrieve all submitted answers
        $quiz = Quiz::findOrFail($id);
        $submittedAnswers = $request->except('_token');

        // Fetch all questions and their correct answers for the given quiz
        $questions = Question::where('quiz_id', $id)->get();

        $correctAnswers = 0;
        $totalQuestions = $questions->count();

        // Compare submitted answers with correct answers
        foreach ($questions as $question) {
            if (isset($submittedAnswers[$question->id]) && $submittedAnswers[$question->id] == $question->answer) {
                $correctAnswers++;
            }
        }

        // Calculate the score as a percentage
        $score = ($correctAnswers / $totalQuestions) * 100;
        // Record the score (optional, if you want to save it to the database)
        if($score < 50){
            return view('score', compact('score', 'quiz'));
        }
        Score::create([
            'user_id' => auth()->id(),
            'quiz_id' => $id,
            'score' => $score,
        ]);

        // Return the score
        return view('score', compact('score', 'quiz'));
    }

}
