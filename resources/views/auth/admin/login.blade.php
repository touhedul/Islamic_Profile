<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset('admin/stylelogin.css')}}" media="screen"/>
</head>
<body>
<div class="container">
    <section id="content">
        <form action="{{ route('admin.login') }}" method="post">
            @csrf

            <h1>Admin Login</h1>
            <div>
                <input id="email"  type="text" placeholder="Email" required="" name="email"/>
                @if ($errors->has('email'))
                    <span style="color: red"> <strong>{{ $errors->first('email') }}</strong>
                    </span><br><br>
                @endif

            </div>
            {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}


            <div>
                <input id="password" type="password" placeholder="Password" required="" name="password"/>
                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div>
                <input type="submit" value="Log in"/>
            </div>
        </form><!-- form -->
            @if (Route::has('admin.password.request'))
                <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        <br><br>
        <div class="button">
            <a href="#">Light of Islam</a>
        </div><!-- button -->
    </section><!-- content -->
</div><!-- container -->
</body>
</html>