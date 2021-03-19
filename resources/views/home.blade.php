@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
@endsection

@section('top_bar')
  <nav class="navbar navbar-default navbar-static-top">
    <div class="logo-main-block">
      <div class="container">
        @if ($setting)
          <a href="{{ url('/') }}" title="{{$setting->welcome_txt}}">
            <img src="{{asset('/images/logo/'. $setting->logo)}}" class="img-responsive" alt="{{$setting->welcome_txt}}">
          </a>
        @endif
      </div>
    </div>
    <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="navbar-header">
              <!-- Branding Image -->
              @if($setting)
                <a class="tt" title="E-exam Home" href="{{url('/')}}"><h4 class="heading">{{$setting->welcome_txt}}</h4></a>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                  <li><a href="{{ route('login') }}" title="Login">Login</a></li>
                  <li><a href="{{ route('register') }}" title="Register">Register</a></li>
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if ($auth->role == 'A')
                        <li><a href="{{url('/admin')}}" title="Dashboard">Dashboard</a></li>
                      @elseif ($auth->role == 'S')
                        <li><a href="{{url('/student/my_reports')}}" title="Dashboard">Dashboard</a></li>
                      @endif
                      <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                      </li>
                    </ul>
                  </li>
                 
                  <li><a href="{{ route('faq.get') }}">FAQ</a></li>
                @endguest
                  <li><a href="{{url('pages/how-it-works')}}">How it works</a></li>
                  <li><a href="{{url('pages/about-us')}}">About us</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('content')
<div class="container">
  @if ($auth)
    <div class="quiz-main-block">
      <div class="row">
        @if (Session::has('error'))
        <div class="alert alert-danger sessionmodal">
          {{session('error')}}
        </div>
      @endif
          <form action="{{route('search_exam')}} " method="POST" >
            {{ csrf_field() }}
            <div class="col-md-4 offset-md-4" style="left:30%">
              <div class="topic-block">
                <div class="card blue-grey darken-1">
                  <div class="card-content white-text">
                    <span class="card-title">Exam Code</span>
                
                    <div class="row">
                      <div class="col-xs-12 pad-0" style="color:black">
                      
                        <input type="text" name="unique_code">
                      </div>
                 
                    </div>
                  </div>


               <div class="card-action text-center">
                  
                

                   
                      <input type="submit" value="Start Quiz">
                   
                  </div>


               
                </div>
              </div>
            </div>
          </form>
          
       
      </div>
    </div>
  @endif
  @if (!$auth)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="home-main-block">
              @if ($setting)
                <h1 class="main-block-heading text-center">{{$setting->welcome_txt}}</h1>
              @endif
                <blockquote>
                  Please <a href="{{ route('login') }}">Login</a> To Start Exam >>>
                </blockquote>
            </div>
        </div>
    </div>
  @endif
</div>


@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script>
   $( document ).ready(function() {
       $('.sessionmodal').addClass("active");
       setTimeout(function() {
           $('.sessionmodal').removeClass("active");
      }, 4500);
    });
</script>


 @if($setting->right_setting == 1)
  <script type="text/javascript" language="javascript">
   // Right click disable
    $(function() {
    $(this).bind("contextmenu", function(inspect) {
    inspect.preventDefault();
    });
    });
      // End Right click disable
  </script>
@endif

@if($setting->element_setting == 1)
<script type="text/javascript" language="javascript">
//all controller is disable
      $(function() {
      var isCtrl = false;
      document.onkeyup=function(e){
      if(e.which == 17) isCtrl=false;
}

      document.onkeydown=function(e){
       if(e.which == 17) isCtrl=true;
      if(e.which == 85 && isCtrl == true) {
     return false;
    }
 };
      $(document).keydown(function (event) {
       if (event.keyCode == 123) { // Prevent F12
       return false;
  }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
     return false;
   }
 });
});
     // end all controller is disable
 </script>


@endif
@endsection
