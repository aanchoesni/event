<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Inseo">
    <meta name="keyword" content="EVENT UNESA, event, Unesa, Universitas Negeri Surabaya, lomba">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Login | Event Unesa</title>

    <!-- Bootstrap core CSS -->
    <link href="{!!asset('admin/css/bootstrap.min.css')!!}" rel="stylesheet">
    <link href="{!!asset('admin/css/bootstrap-reset.css')!!}" rel="stylesheet">
    <!--external css-->
    <link href="{!!asset('admin/assets/font-awesome/css/font-awesome.css')!!}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{!!asset('admin/css/style.css')!!}" rel="stylesheet">
    <link href="{!!asset('admin/css/style-responsive.css')!!}" rel="stylesheet">
    <link href="{!!asset('admin/sw/dist/sweetalert.css')!!}" rel="stylesheet">
    @yield('style')
</head>

  <body class="login-body">
    <div class="container">
      @yield('content')
    </div>

    @yield('script')
    <script type="text/javascript" src="{!!asset('admin/sw/dist/sweetalert.min.js') !!}"></script>
    @include('sweet::alert')
  </body>
</html>
