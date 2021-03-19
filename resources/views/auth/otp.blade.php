@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 
@endsection



@section('content')
<div class="">
  <div class="container">
       @if (Session::has('error'))
        <div class="alert alert-danger">
          {{session('error')}}
        </div>
      @endif
    <div class="login-page">
      <div class="logo">
        @if ($setting)
          <a href="{{url('/')}}" title="{{$setting->welcome_txt}}"><img src="{{asset('/images/logo/'.$setting->logo)}}" class="img-responsive login-logo" alt="{{$setting->welcome_txt}}"></a>
        @endif
      </div>
      <h3 class="user-register-heading text-center">Verify Otp. Check your email address to get otp</h3>
      <form class="form login-form" method="POST" action="{{url('submit_otp')}}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', 'OTP') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter verification code','name'=>'otp']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        
      
        
        <div class="mr-t-20">
          <button type="submit" class="btn btn-wave">Verify</button>
          <a href="" class="text-center btn-block" title="Already Have Account">Resend Otp ?</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
