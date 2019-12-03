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
                     
                    <input id="email" type="email" class="input100 input_user form-control @error('email') is-invalid @enderror" name="email"  value="" required autocomplete="email" autofocus>
                    <span class="focus-input100"></span>
                    <span class="label-input100"> Email</span>
                   
                </div>
                
          
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input id="password" type="password" class="input100 input_pass form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" value = "">
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
@endsection
