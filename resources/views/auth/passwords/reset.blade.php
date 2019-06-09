<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ config('blog.meta.keywords') }}">
    <meta name="description" content="{{ config('blog.meta.description') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ config('blog.default_icon') }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset(mix('css/home.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/themes/' . config('blog.color_theme') . '.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/forgot-pass.css')) }}">
    <!-- Scripts -->
    <script>
        window.Language = '{{ config('app.locale') }}';
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>
    <div id="app">
        <div class="reset_password_form">
            <form class="form" role="form" method="POST" action="{{ url('/password/reset') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form_title">
                    <a href="/"><img src="{{ asset('/images/logo-blue.png') }}" alt="Logo"></a>
                    <h3>Forgot Password?</h3>
                </div>
                <div class="message message_success">
                    <span>We just sent a code to example@example.com</span>
                </div>
                <div class="form-group">
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" type="email" placeholder="Email" value="{{ $email or old('email') }}" name="email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div> 
                <div class="form-group">
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" type="password" placeholder="New Password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default form_btn">{{ lang('Reset Password') }}</button>
                <div class="back_link">
                    <a href="#">Reset code expired? Get new reset code here</a>
                    <div class="lockscreen-footer text-center">
                        Copyright &copy; 2018 <b><a href="/" class="text-black">FS-Focus</a></b><br> All rights reserved
                    </div>
                </div>
            </form>
        </div>
        
    </div>
    <!-- Scripts -->
    <script src="{{ asset(mix('js/home.js')) }}"></script>
    @if(config('blog.google.open'))
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o);
                m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', '{{ config('blog.google.id') }}', 'auto');
            ga('send', 'pageview');
        </script>
    @endif
</body>

</html>
