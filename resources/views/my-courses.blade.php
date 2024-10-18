@extends('layouts.app')
@section('css')
    <link href="{{asset('css/home.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Content -->
    <div class="content">

        <!-- Courses Section -->
        <section id="courses" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="course-title">My Courses</h2>
                    <p class="lead">Explore our diverse range of courses to enhance your skills.</p>
                </div>
                <div class="row">
                    @foreach ($enrollments as $enrollment)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card course-card">
                                <img src="{{asset('storage/'.$enrollment->course->image)}}"
                                 class="card-img-top" alt="Course Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{$enrollment->course->name}}</h5>
                                    <p class="card-text">{{$enrollment->course->description}}</p>
                                    <div style="width: 100%; height: 20px; background-color: #f1f1f1; border-radius: 5px;">
                                        <div style="width: {{calculateCourseSeenPercentage($enrollment->course)}}%; height: 25px; background-color: #007bff; color:white; text-align:center; border-radius: 5px;">{{calculateCourseSeenPercentage($enrollment->course)}}%</div>
                                    </div><br>
                                    <a href="{{route('course.show', $enrollment->course->id)}}" class="btn btn-primary">Go To Course</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
@endsection
