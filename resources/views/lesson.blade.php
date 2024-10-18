@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/course.css') }}">
@endsection

@section('content')

<!-- Toggle Sidebar Button -->
<button class="toggle-sidebar-btn"><i class="fas fa-bars"></i> Lessons</button>

<!-- Lesson Page Layout -->
<div class="container-fluid lesson-container">
  <div class="row">

    <!-- Main Lesson Content -->
    <div class="col-md-9 lesson-content">
      <h1>{{$lesson->name}}</h1>
      <video
            id="my-video"
            class="video-js"
            controls
            preload="auto"
            style="width: 100%; height: auto;"
            data-setup="{}"
        >
            <source src="{{asset('storage/'.$lesson->video)}}" />
            <p class="vjs-no-js">
            To view this video please enable JavaScript, and consider upgrading to a
            web browser that
            <a href="https://videojs.com/html5-video-support/" target="_blank"
                >supports HTML5 video</a
            >
            </p>
        </video>
      <p>{{$lesson->description}}</p>
    </div>

    <!-- Sidebar for Lessons (Right-Aligned) - Default Open -->
    <div class="col-md-3 lesson-sidebar" style="marign-top:30px">
      <h4>Lessons</h4>
      @foreach ($lessons as $lesson)
        @if(in_array($lesson->id, $seens))
            <a href="{{route('lesson.show', $lesson->id)}}" @if($lesson->id == $id)class="active"@endif><i class="fas fa-play-circle"></i> {{$lesson->name}}</a>
        @else
            <a><i class="fas fa-lock"></i> {{$lesson->name}}</a>
        @endif
      @endforeach
    </div>

  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS for Sidebar Toggle -->
<script>
  document.querySelector('.toggle-sidebar-btn').addEventListener('click', function() {
    const sidebar = document.querySelector('.lesson-sidebar');
    sidebar.classList.toggle('closed');
    sidebar.classList.contains('closed') ? this.innerHTML = '<i class="fas fa-bars"></i> Lessons' : this.innerHTML = '<i class="fas fa-times"></i> Close';
    sidebar.classList.contains('closed') ? this.style.right = '10px' : this.style.right = '260px';
  });
  <script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
</script>
@endsection
