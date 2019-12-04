@extends('layouts.app')
@section('style')

@endsection
@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
                <form method="POST" action="{{ route('login') }}"  class="login100-form">
                        @csrf
                @if (session('warning'))
                    <div class="alert alert-danger rounded-0 text-white font-weight-bold text-center text-uppercase mx-auto" style="box-shadow: 0px 0px 5px red; )">
                        {{ session('warning') }}
                    </div>
                @endif
                <span class="login100-form-title p-b-30">
                    Login to continue
                </span>

             
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                     
                    <input id="email" type="email" class="input100 input_user form-control @error('email') is-invalid @enderror" name="email"  value="" required >
                    <span class="focus-input100"></span>
                    <span class="label-input100"> Email</span>
                   
                </div>
                
          
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input id="password" type="password" class="input100 input_pass form-control @error('password') is-invalid @enderror" name="password" required  value = "">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Password</span>
                </div>

                <div class="form-group w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                            <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                    </div>

                    
                </div>
        
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
                
               
            </form>

            <div class="login100-more" style="background-image: url('image/loginBg.jpg');">
            </div>
        </div>
    </div>
</div>

{{-- <div class="container mb-5 pb-3" >
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
</div> --}}
@endsection
