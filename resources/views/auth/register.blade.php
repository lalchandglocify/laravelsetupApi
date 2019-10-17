@extends('easy2inspect.app')

@section('content')
<section class="InnerHeaderContent">
    <div class="container">
        <div class="row">
            <div class="Banner_Text_Inner">
                <h2> Easy2Inspect </h2>
                <ul>
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li><a href="{{ url('register') }}">Create Account</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="LoginPageSection">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="LoginForm">
                    <div class="account-wall">  
                        <h2 class="createaccount">Create A New Account</h2>                    
                        <form class="form-signin" method="POST" action="{{ route('register') }}">
                        @csrf
                            <div class="form-group">

                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required  placeholder="First Name" >

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required  placeholder="Last Name" >

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror



                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required  placeholder="Re-type password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                            </div>
                           <div class="form-group">    
                                <label class="checkbox">
                                    <input type="checkbox" value="remember-me" name="agree" required="required" >
                                   I agree with your  <a href="#"> Terms & Conditions </a>
                                </label>

                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">
                                Register
                            </button>
                        </form>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
