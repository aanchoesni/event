<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="inseo">
    <meta name="keyword" content="Atletik, Unesa">
    <link rel="shortcut icon" href="img/fav.png">

    <title>@yield('title') | Atletik Unesa</title>

    <!-- Bootstrap core CSS -->
    {{Html::style("admin/css/bootstrap.min.css")}}
    {{Html::style("admin/css/bootstrap-reset.css")}}
    <!--external css-->
    {{Html::style("admin/assets/font-awesome/css/font-awesome.css")}}
    <!--<link href="css/navbar-fixed-top.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    {{Html::style("admin/css/style.css")}}
    {{Html::style("admin/css/style-responsive.css")}}
    {{Html::style("admin/sw/dist/sweetalert.css")}}
    @yield('asset')
  </head>

  <body class="full-width">
  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="fa fa-bar"></span>
                  <span class="fa fa-bar"></span>
                  <span class="fa fa-bar"></span>
              </button>

              <!--logo start-->
              <a href="{{ URL::to('dashboard') }}" class="logo" >Atletik <span>Unesa</span></a>
              <!--logo end-->
              <div class="horizontal-menu navbar-collapse collapse ">
                <ul class="nav navbar-nav">
                  @include('layouts.menu.participant')
                </ul>
              </div>
              <div class="top-nav ">
                  <ul class="nav pull-right top-menu">
                      <li>
                          <input type="text" class="form-control search" placeholder=" Search">
                      </li>
                      <!-- user login dropdown start-->
                      <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="username">{{ Auth::user()->name }} </span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();" class="btn btn-success btn-lg">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                      </li>
                      <!-- user login dropdown end -->
                  </ul>
              </div>

          </div>

      </header>
      <!--header end-->
      <!--sidebar start-->

      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              @include('layouts.partials.alert')
              @include('layouts.partials.validation')
              <!-- page start-->
              @yield('content')
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015-{!! Date('Y') !!} &copy; Cyber Campus Unesa - inseo. ALL Rights Reserved.
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
    <!-- js placed at the end of the document so the pages load faster -->
    {{Html::script('admin/js/jquery.js')}}
    {{Html::script('admin/js/hover-dropdown.js')}}
    {{Html::script('admin/js/bootstrap.min.js')}}
    {{Html::script('admin/js/jquery.dcjqaccordion.2.7.js', array('class'=>'include', 'type'=>'text/javascript'))}}
    {{Html::script('admin/js/jquery.scrollTo.min.js')}}
    {{Html::script('admin/js/jquery.nicescroll.js', array('class'=>'text/javascript'))}}
    {{Html::script('admin/js/respond.min.js')}}

    <!--common script for all pages-->
    {{Html::script('admin/js/common-scripts.js')}}
    {{Html::script('admin/sw/dist/sweetalert.min.js')}}
    {{Html::script('admin/packages/toastr/toastr.min.js')}}
    @include('sweet::alert')
    @yield('script')

  </body>
</html>
