@extends('layouts.app')
@section('style')
    <style>
        .login{
            margin-top:15%;
        }
        .login_img{
            margin-top:15%;
            padding-right:40%;

        }
		.user_card {
			height: 525px;
			width: 500px;
			margin-top: auto;
			margin-bottom: auto;
            border:1px solid black;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;


		}
		.brand_logo_container {
			position: absolute;
			height: 180px;
			width: 180px;
			top: -75px;
			border-radius: 50%;
			background: #37b7ff;
			padding: 10px;
            text-align: center;

		}
		.brand_logo {
			height: 160px;
			width: 160px;
			border-radius: 60%;
            border: 2px solid white;
            background: #37b7ff;

		}
		.form_container {
            padding: 0 10px;
		}
		.login_btn {
			width: 100%;
			background: #37B7FF !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #62C8F9 !important;
			color: white !important;
			border: 0 !important;
            border-radius: 0.25rem 0 0 0.25rem !important;
            width: 100%;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
        }
        .input_user,
		.input_pass {
			width: 100%;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
        .login_logo{
            margin-top:80px;
        }
        .links{
            color:black;
        }
        .sign_up{
            color:tomato;
        }
        img{
            -webkit-transition: -webkit-transform .8s ease-in-out;
          transition: transform .8s ease-in-out;
        }
        .brand_logo:hover {
            -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
          }

          .insha{
              margin-top: 30px;
            margin-bottom: 20px;
          }


    </style>
@endsection
@section('content')
<div class="container mb-5 pb-3" >
    <div class="row justify-content-center">
        <div class="col-md-7 login "  >
            <div class="container h-100 mt-0" >
                    <div class="d-flex justify-content-center h-100">
                        <div class="user_card rounded-0" style="background-color:##F0F0F0;">
                            <div class="d-flex justify-content-center">
                                <div class="brand_logo_container">
                                    <img src="{{ asset('image/loginLogo.png')}}" class="brand_logo" alt="Logo">
                                </div>
                                <div class="insha">
                                        <img src="{{ asset('image/naotechIcon.png')}}"  width="100%" alt="Logo">
                                </div>
                            </div>
                        @if (session('warning'))
                            <div class="alert alert-danger rounded-0 text-white font-weight-bold text-center text-uppercase mx-auto" style="box-shadow: 0px 0px 5px red; )">
                                {{ session('warning') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                                @csrf
                            <div class=" justify-content-center form_container ">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input id="email" type="email" class=" form-control input_user form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input id="password" type="password" class="form-control input_pass form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" value = "">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3 login_container">
                                            <button type="submit" class="btn login_btn" >
                                                    {{ __('Login') }}
                                                </button>
                                    </div>
                            </div>
                        </form>

                            <div class="mt-4">
                                <div class="d-flex justify-content-center links">
                                        @if (Route::has('password.request'))
                                        <a class="sign_up text-bold text-dark text-uppercase" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
    </div>
</div>
@endsection
