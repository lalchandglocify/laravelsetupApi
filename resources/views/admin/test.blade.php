@include('admin.include.innerHeader')
<section class="InnerHeaderContent">
	<div class="container">
		<div class="row">
			<div class="Banner_Text_Inner">
				<h2> Easy2Inspect Admin Login</h2>
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
			               
			                <form class="form-signin" method="POST" action="{{ route('login') }}">
                       			 @csrf
			                	<div class="form-group">
					                 	<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

		                                @error('email')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
						                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
					                 @if (Route::has('password.request'))
	                                    <a class="btn btn-link" href="{{ route('password.request') }}">
	                                        {{ __('Forgot Your Password?') }}
	                                    </a>
	                                @endif
				            	</div>
				                
			                </form>
			               
			            </div>		            
			        </div>
		        </div>
			</div>
		</div>
	</section>