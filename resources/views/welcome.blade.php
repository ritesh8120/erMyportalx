<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta2/css/bootstrap.min.css">
    <script src="{{asset('public/assets/js/app.js')}}"></script>
    <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/toastr.min.css') }}">
    <title>{{ __('labels.login') }}</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">{{ __('labels.login') }}</h2>
                <div class="text-center mb-5 text-dark">{{ __('labels.app_name') }}</div>
                <div class="card my-5">
                    <form class="card-body cardbody-color p-lg-5" action="{{ route('auth.login') }}" method="POST"
                        id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" id="email" placeholder="{{ __('labels.enter_your_email') }}">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('labels.enter_password') }}">
                        </div>
                        <div class="text-center"><button type="submit"
                                class="btn btn-color px-5 mb-5 w-100" id="loginBtn">{{ __('labels.login') }}</button>
                        </div>
                    </form>
                    {!! JsValidator::formRequest('App\Http\Requests\loginRequest', '#loginForm') !!}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta2/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/assets/js/login.js') }}"></script>
</body>

</html>
