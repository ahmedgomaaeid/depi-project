
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quiz.css') }}">
@endsection

@section('content')


<div class="quiz-container">
  <div class="quiz-header">
    <h1>Quiz: {{$quiz->name}}</h1>
  </div>

  <form action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
    <!-- Question 1 -->
    @csrf
    @foreach ($questions as $question)
        <div class="quiz-question">
        {{$question->question}}
        </div>
        <div class="quiz-choices">
        <input type="radio" id="{{$question->id}}-1" name="{{$question->id}}" value="1">
        <label for="{{$question->id}}-1">{{$question->option1}}</label>

        <input type="radio" id="{{$question->id}}-2" name="{{$question->id}}" value="2">
        <label for="{{$question->id}}-2">{{$question->option2}}</label>

        <input type="radio" id="{{$question->id}}-3" name="{{$question->id}}" value="3">
        <label for="{{$question->id}}-3">{{$question->option3}}</label>

        <input type="radio" id="{{$question->id}}-4" name="{{$question->id}}" value="4">
        <label for="{{$question->id}}-4">{{$question->option4}}</label>
        </div>
    @endforeach



    <!-- Submit Button -->
    <div class="quiz-footer">
      <button type="submit">Submit Answers</button>
    </div>
  </form>
</div>

@endsection
