@extends('easy2inspect.app')

@section('content')

<section class="ContactPageSec">
	<div class="container">
		<div class="row">
			<div class="Banner_Text_Inner">
				<h2> Easy2Inspect </h2>
				<ul>
					<li><a href="{{ url('') }}">Home</a></li>
					<li><a href="{{ url('contact') }}">Contact Us</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>


<section class="ContactPageSection">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="LoginForm ContactForm">
		            <h2 class="">SEND MESSAGE</h2>
		            <div class="account-wall">
		                <form class="form-signin"  method="POST">
		                	@csrf
		                	<div class="form-group">
				                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" name="name" required="required" value="{{old('name')}}">
				                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

				                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" required="required" value="{{old('email')}}">
				                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number" name="phone_number" required="required" value="{{old('phone_number')}}" maxlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" >
				                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

				                <input type="text" class="form-control @error('subject') is-invalid @enderror " placeholder="Subject" name="subject" required="required" value="{{old('subject')}}">
				                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

				                <textarea placeholder="Message" class="form-control @error('message') is-invalid @enderror" name="message" required="required" value="{{old('message')}}" ></textarea>
				                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
				            </div>
			                <button class="btn btn-lg btn-primary btn-block" type="submit">
			                    Send Message
			                </button>
		                </form>
		            </div>
		        </div>
	        </div>
	        <div class="col-md-6">
				<div class="LoginForm ContactDetail">
					<div class="account-wall">
			            <h2 class="">
			            	PLEASE GET IN TOUCH
			            </h2>
		            	<p>We offer 24/7 support, our dedicated support team work remotely in different parts of the world and are able to assist. Should you have any queries or support related issues please fill out the form below and one of our support technicians will be in touch!</p>
		            	<div class="ConnectDetail">
		            		<!-- <p><i class="fa fa-map-marker contacticon" aria-hidden="true"></i> Address : 98838 W Bellseview Ave Denver, CsO 805123</p> -->
		            		<!-- <p><i class="fa fa-phone-square contacticon" aria-hidden="true"></i> Phone : 900-736-5678<br> (001) 900-736-5678</p> -->
		            		<p><i class="fa fa-envelope contacticon" aria-hidden="true"></i> Email:<br> support@easy2inspect.co.uk<br><span class="altEmail">info@easy2inspect.co.uk</span></p>

		            		<!-- <p><i class="fa fa-clock-o contacticon" aria-hidden="true"></i> Opening Hours : 8 am - 9'30 pm, except Sunday</p> -->
		            	</div>
		            </div>
		        </div>
	        </div>
		</div>
	</div>
</section>
























@endsection


