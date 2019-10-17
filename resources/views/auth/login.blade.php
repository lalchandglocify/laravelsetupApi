@extends('easy2inspect.app')

@section('content')
<section class="InnerHeaderContent">
    <div class="container">
        <div class="row">
            <div class="Banner_Text_Inner">
                <h2> Easy2Inspect </h2>
                <ul>
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li><a href="{{ url('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Inner Page Header -->

<!--  Login Page Section  -->
<section class="LoginPageSection">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="LoginForm">
                    <h1 class="text-center login-title">Sign in to continue to Easy2Inspect</h1>
                    <div class="account-wall">
                       <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                            alt="">

                        <form class="form-signin" method="POST" action="{{ url('userLogin') }}">
                             @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">
                                Login
                            </button>
                            <div class="form-group RememberME">
                                <!-- <label class="checkbox pull-left">
                                    <input type="checkbox" value="remember-me">
                                    Remember me
                                </label> -->

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="pull-right need-help"> Forgot Password ? </a><span class="clearfix"></span>

                                @endif
                            </div>

                        </form>
                        <a href="{{ url('register')}}" class="NewAccount">Create an account </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection