@extends('layouts.app')

@section('css')
    <link href="{{asset('css/auth.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="login-container">
  <h2 class="text-center mb-4">Login</h2>
  <form action="{{route('post.register')}}" method="POST" class="login-form">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
      @error('name')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
        @error('email')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Phone</label>
      <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone" required>
        @error('phone')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
        @error('password')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Regiter</button>
    <a href="{{route('login')}}" class="signup-link">Already have an account? Login</a>
  </form>
</div>
@endsection
