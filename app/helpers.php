<?php

use App\Models\Seen;

function calculateCourseSeenPercentage($course)
{
    $lessons = $course->lessons->count();
    $seen = Seen::where('course_id', $course->id)->where('user_id', auth()->id())->count();
    //return percentage with 2 decimal points
    return number_format(($seen / $lessons) * 100, 0);
}
