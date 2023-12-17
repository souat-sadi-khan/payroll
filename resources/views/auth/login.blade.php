@extends('layouts.auth', ['title' => _lang('Login'), 'modal' => 'lg'])
@section('auth')

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form action="{{ route('login') }}" method="POST" id="login" class="login100-form validate-form">

                <div class="text-center mb-5">
                    @if(get_option('logo'))
                        @if (get_option('host') == 1)
                            <img class="w-50" src="{{asset('storage/logo')}}/{{get_option('logo')}}" alt="">
                        @else
                            <img class="w-50" src="{{asset('uploads')}}/{{get_option('logo')}}" alt="">
                        @endif
                    @else 
                        <img style="width:300px;" src="{{asset('logo.png')}}" alt="Company Logo">
                    @endif
                </div>

                <h4 class="text-center mb-3 login100-form-title">{{get_option('site_title')?get_option('site_title'):'Payroll Management System'}}</h4>

                <div style="position: absolute;top: 55%;left: 48%;z-index:100; display: none;" id="loader">
                    <img src="{{asset('img/loading.gif')}}" alt="">
                </div>

                <span class="login100-form-title p-b-43">
                    Login to continue
                </span>
              
              
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" value="admin@admin.com" autocomplete="off">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Email</span>
                </div>
              
              
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" value="123456">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Password</span>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div>
                        <a href="#" class="txt1">
                            Forgot Password?
                        </a>
                    </div>
                </div>
      

                <div class="container-login100-form-btn">
                    <button id="submit" type="submit" class="login100-form-btn">
                        Login
                    </button>

                    <button style="display: none;" id="submiting" type="button" disabled class="login100-form-btn1">
                        Processing. Please Wait ...
                    </button>
              </div>
          </form>

          <div class="login100-more" style="background-image: url('login_assets/images/bg-01.jpg');">
          </div>
      </div>
  </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/auth/login.js') }}"></script>
@endpush