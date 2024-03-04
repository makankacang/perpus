<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

     <!-- Favicon -->
     <link href="../darkpan/img/favicon.ico" rel="icon">

     <!-- Google Web Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
 
     <!-- Icon Font Stylesheet -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

     <!-- Libraries Stylesheet -->
    <link href="../darkpan/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../darkpan/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../darkpan/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../darkpan/css/style.css" rel="stylesheet">
    
    <link href="{{ asset('../resources/css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body p-5 bg-white shadow rounded">
                    <div class="row">
                        <div class="col-md-7"> <!-- Changed col-md-4 to col-md-7 -->
                            <img src="../img/undraw_Bookshelves_re_lxoy.png" alt="Logo" class="img-fluid cover-image">
                        </div>                        
                        <div class="col-md-5"> <!-- Remaining width will be col-md-5 -->
                            <h2 class="mb-4">{{ __('Register') }}</h2>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                                </div>

                                <div class="mt-3 text-center">
                                    <a href="{{ route('login') }}">Sudah punya akun?</a>        
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
       <!-- JavaScript Libraries -->
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>             
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
       <script src="../darkpan/lib/chart/chart.min.js"></script>
       <script src="../darkpan/lib/easing/easing.min.js"></script>
       <script src="../darkpan/lib/waypoints/waypoints.min.js"></script>
       <script src="../darkpan/lib/owlcarousel/owl.carousel.min.js"></script>
       <script src="../darkpan/lib/tempusdominus/js/moment.min.js"></script>
       <script src="../darkpan/lib/tempusdominus/js/moment-timezone.min.js"></script>
       <script src="../darkpan/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>   
       
       <!-- Template Javascript -->
       <script src="../darkpan/js/main.js"></script>
</body>
