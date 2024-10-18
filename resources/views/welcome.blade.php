@extends('layouts.app')

@section('css')
    <link href="{{asset('css/home.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Header with Join Now Button -->
    <header class="header">

    </header>

    <!-- Content -->
    <div class="content">

        <!-- Courses Section -->
        <section id="courses" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="course-title">Available Categories</h2>
                    <p class="lead">Explore our diverse range of courses to enhance your skills.</p>
                </div>
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card course-card">
                                <img src="{{asset('storage/'.$category->image)}}"
                                 class="card-img-top" alt="Course Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{$category->name}}</h5>
                                    <a href="{{route('category', $category->id)}}" class="btn btn-primary">View Courses</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about-section text-center">
            <div class="container">
                <h2 class="mb-4">About Us</h2>
                <p class="lead">We are an online learning platform dedicated to providing the best educational resources.
                    Our goal is to empower individuals through high-quality, accessible courses across various fields, from
                    web development to data science.</p>
                <p>With expert instructors and a global community, we help learners achieve their educational and career
                    goals.</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Contact Us</h2>
                        <p>If you have any questions or need further information, feel free to reach out to us. We're here
                            to help!</p>
                        <ul class="list-unstyled">
                            <li><strong>Email:</strong> support@elearning.com</li>
                            <li><strong>Phone:</strong> +1 234 567 890</li>
                            <li><strong>Address:</strong> 1234 Learning St., New York, NY 10001</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Your Message</label>
                                <textarea class="form-control" id="message" rows="4" placeholder="Enter your message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- Footer -->
    <footer class="bg-light">
        <div class="container">
            <p class="mb-0">© 2024 eLearning Platform. All rights reserved.</p>
        </div>
    </footer>
@endsection
