<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="inseo">
    <meta name="keyword" content="Event, Unesa">
    <link rel="shortcut icon" href="img/fav.png">

    <title>Event Unesa</title>

    <!-- Bootstrap core CSS -->
    {{Html::style("front/css/bootstrap.min.css")}}
    {{Html::style("front/css/theme.css")}}
    {{Html::style("front/css/bootstrap-reset.css")}}
    <!--external css-->
    {{Html::style("front/assets/font-awesome/css/font-awesome.css")}}
    {{Html::style("front/css/flexslider.css")}}
    {{Html::style("front/assets/bxslider/jquery.bxslider.css")}}

    <!-- Custom styles for this template -->
    {{Html::style("front/css/style.css")}}
    {{Html::style("front/css/style-responsive.css")}}

    {{Html::style("admin/sw/dist/sweetalert.css")}}
  </head>

  <body>
     <!--header start-->
    <header class="header-frontend">
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="fa fa-bar"></span>
                        <span class="fa fa-bar"></span>
                        <span class="fa fa-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{!! url('/') !!}">Event<span>Unesa</span></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="{!! url('/') !!}">Home</a></li>
                        @guest
                        <li><a href="{!! url('login') !!}">Login</a></li>
                        {{-- <li><a href="{!! url('register') !!}">Register</a></li> --}}
                        @else
                        @if (Auth::user()->role != 'umum')
                        <li><a href="{!! url('admin/events') !!}">Manage Event</a></li>
                        @endif
                        <li><a href="{!! url('history') !!}">History</a></li>
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
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!--header end-->

    <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1>@yield('title')</h1>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->

    <!--container start-->
    <div class="container">
        <div class="row">
            @yield('content')
        </div>

    </div>
    <!--container end-->

     <!--footer start-->
     <footer class="footer">
         <div class="text-center">
              2018 @if(Date('Y') != '2018') - {!! Date('Y') !!} @endif &copy; Cyber Campus Unesa - inseo. ALL Rights Reserved.
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
     </footer>
     <!--footer end-->

    <!-- js placed at the end of the document so the pages load faster -->
    {{Html::script('front/js/jquery.js')}}
    {{Html::script('front/js/bootstrap.min.js')}}
    {{Html::script('front/js/hover-dropdown.js')}}
    {{Html::script('front/js/jquery.flexslider.js')}}
    {{Html::script('front/assets/bxslider/jquery.bxslider.js')}}

    {{Html::script('front/js/jquery.easing.min.js')}}
    {{Html::script('front/js/link-hover.js')}}

    <!--common script for all pages-->
    {{Html::script('front/js/common-scripts.js')}}

    {{Html::script('admin/sw/dist/sweetalert.min.js')}}
    @include('sweet::alert')
  </body>
</html>
