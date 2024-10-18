<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E_Learning Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Video.js -->
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
    <!-- Custom CSS -->
    @yield('css')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('index')}}">eLearning</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}#courses">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}#contact">Contact</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('my.courses')}}">My Courses</a>
                        </li>
                    @endauth
                </ul>
                @auth
                    <a href="{{route('logout')}}" class="btn btn-primary ms-lg-3">logout</a>
                @else
                    <a href="{{route('login')}}" class="btn btn-primary ms-lg-3">Join Now</a>
                @endauth
            </div>
        </div>
    </nav>


    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // change active class on navbar
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navLinks.forEach(link => link.classList.remove('active'));
                link.classList.add('active');
            });
        });
    </script>
</body>

</html>
