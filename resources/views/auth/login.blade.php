<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PFMS') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;600&display=swap" rel="stylesheet" />

    {{-- Bootstrap CDN --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />

    {{-- Font-awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    {{-- Styles --}}
    @yield('style')
    <link href="{{ asset('css/dev.min.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="login-card">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-sign-in text-primary mr-2"></i>
                <strong>{{ __('Login') }}</strong>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}" id="logIn">
                    @csrf

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-envelope @error('email') text-danger @else text-success @enderror"></i>
                            </div>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email"
                            autofocus />

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-key @error('password') text-danger @else text-success @enderror"></i>
                            </div>
                        </div>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="off" placeholder="Passcode" tabindex="0" />

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group justify-content-center mb-2">
                        <button type="submit" class="btn btn-primary custom-rounded" tabindex="1">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="input-group text-center">

                        @if (Route::has('password.request'))
                        <a class="text-6" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="card-footer bg-white">
                <button type="button" id="dLogin" class="btn btn-info custom-rounded">{{ __('Default Login') }}</button>
            </div>
        </div>
    </div>
    <div id="snow-effect"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendor/js/particles.min.js') }}"></script>
    <script src="{{ asset('vendor/js/particles.settings.js') }}"></script>
    <script>
        $(function(){
        $('#dLogin').on('click', function(){
            $('#email').val('info@jondoe.com');
            $('#password').val('jondoe');
            $('#logIn').submit();
        });
    });
    </script>
</body>

</html>