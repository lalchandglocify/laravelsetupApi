@extends('easy2inspect.app')

@section('content')

<section class="InnerHeaderContent">
    <div class="container">
        <div class="row">
            <div class="Banner_Text_Inner">
                <h2> Easy2Inspect </h2>
                <ul>
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li><a href="{{ url('password/reset') }}">Forgot Password</a></li>
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
                    <h1 class="text-center login-title">Enter email to get password reset link.</h1>
                    <div class="account-wall">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                            alt="">
                        <form class="form-signin"  method="POST" action="{{ route('password.email') }}">
                        @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email">  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">
                                Send Password Reset Link
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
