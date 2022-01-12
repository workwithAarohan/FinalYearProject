<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{ asset('js/app.js') }}"></script>
    <title>Welcome</title>

    <style>
        .image
        {
            height: 100vh;
            width: 100vw;
            margin: 0;
            position: relative;
)
            background: url('/images/background_image.jpg') no-repeat center  center / cover;
        }

        .admission
        {
            position: absolute;
            top: 100px;
        }
    </style>
</head>
<body>

    <div class="image">
        <h5>hasdfsf</h5>
    </div>

    <div class="container admission">

        @if ($admissionWindows->count>1)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                Admission Open For
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                    @foreach ($admissionWindows as $admissionWindow)
                        <li><a class="dropdown-item" href="{{ route('admission.form', $admissionWindow->id) }}">{{ $admissionWindow->course->courseDetails->slug }}</a></li>
                    @endforeach
                </ul>
            </div>
        @else
            @foreach ($admissionWindows as $admissionWindow)
                <a href="{{ route('admission.form', $admissionWindow->id) }}" class="btn btn-primary">
                    Admission Open for {{ $admissionWindow->course->courseDetails->slug }}
                </a>
            @endforeach
        @endif
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
    </nav>

    <div class="card" style="width:18rem;">
      <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-2 text-muted ">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        b5
      </div>
    </div>
</body>
</html>
