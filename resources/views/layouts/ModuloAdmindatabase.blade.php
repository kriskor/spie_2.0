<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>SPIE - Modulo de AdminDataBase</title>
    <!-- Bootstrap Core CSS -->
    <link href="/assets_admin_three/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- page CSS -->
    <link href="/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <!---link href="/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="/plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" /-->

    <!-- Animation CSS -->
    <link href="/assets_admin_three/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets_admin_three/css/style.css" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (blue.css) for this starter
          page. However, you can choose any other skin from folder css / colors .
-->
    <link href="/assets_admin_three/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
      .navbar-static-top{
        z-index: 1000;
      }

    </style>
    @yield('header')
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body class="fix-sidebar fix-header">
    <!-- Preloader -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="wrapper">
        <!-- Top Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <!-- Logo -->
                <div class="top-left-part">
                    <a class="logo" href="index.html">
                        <!-- Logo icon image, you can use font-icon also -->
                        <b><i class="fa fa-database"></i></b>
                        <!-- Logo text image you can use text also -->
                        <span class="hidden-xs">DataBase <b>ADM</b></span> </a>
                </div>
                <!-- /Logo -->
                <!-- This is for mobile view search and menu icon -->
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Buscar en sitio..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>
                <!-- This is the message dropdown -->
                <ul class="nav navbar-top-links navbar-right pull-right">


                    <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">


                    <li class="nav-small-cap m-t-10">--- Clasificadores</li>
                    <li> <a href="index.html" class="waves-effect"><i class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw" ></i> <span class="hide-menu"> Tipo Clasificadores <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="{{ url('/admindatabase/entidades') }}">Entidades</a> </li>
                            <li> <a href="{{ url('/admindatabase/regiones') }}">Regiones</a> </li>
                            <li> <a href="{{ url('/admindatabase/otros') }}">Otros</a> </li>
                        </ul>
                    </li>
                    <li> <a href="{{ url('/admindatabase/crearvalidadores') }}" class="waves-effect"><i class="ti-menu-alt fa-fw"></i> <span class="hide-menu">Crear Validadores</span></a> </li>

                    <li class="nav-small-cap m-t-10">--- Variables</li>
                    <li> <a href="index.html" class="waves-effect"><i class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw" ></i> <span class="hide-menu"> Variables <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="{{ url('/admindatabase/validarvariables') }}">Validar datos</a> </li>

                        </ul>
                    </li>




                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            @yield('content')

            <!-- .right-sidebar -->
            <div class="right-sidebar">
                <div class="slimscrollright">
                    <div class="rpanel-title"> {{ Auth::user()->name }} <span><i class="ti-close right-side-toggle"></i></span> </div>
                    <div class="r-panel-body">
                        <ul>
                            <li><b>Opciones</b></li>
                        </ul>
                        <ul class="">
                            <li><a href="#"><i class="ti-user"></i> Mi perfil</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> Cambiar contraseña</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('/home') }}"><i class="fa icon-logout"></i> Salir a menu </a></li>
                            <li>
                              <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Cerrar Sesión </a>
                              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                              </form>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <!-- /.right-sidebar -->
            <footer class="footer text-center"> 2017 &copy; Modulo-AdminBaseEstadistica </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/assets_admin_three/bootstrap/dist/js/tether.min.js"></script>
    <script src="/assets_admin_three/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="/assets_admin_three/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="/assets_admin_three/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/assets_admin_three/js/custom.min.js"></script>
    <script src="/assets_admin_three/js/validator.js"></script>
    <script src="/assets_admin_three/js/mask.js"></script>
    <!--Style Switcher -->
    <script src="/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>


    <!-- Custom Theme JavaScript -->


    <script src="/plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
    <!--script src="/plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/plugins/bower_components/multiselect/js/jquery.multi-select.js"></script-->

    @stack('script-head')


</body>

</html>
