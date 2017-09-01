<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets_home/assets/img/iconos/icono_pdes.png">
    <title>MODULO-PDES</title>
    <!-- Bootstrap Core CSS -->
    <link href="/assets_admin_four/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="/assets_admin_four/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets_admin_four/css/style.css" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <link href="/assets_admin_four/css/colors/green.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script src="http://www.w3schools.com/lib/w3data.js"></script>

    @yield('header')
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body class="fix-header">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Top Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="index.html"><b><img src="/assets_home/assets/img/iconos/icono_pdes.png" alt=">" class="m-b-5" /></b><span class="hidden-xs"></span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    {{-- <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Buscar..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li> --}}
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">

                    <!-- /.Megamenu -->
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
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    {{-- <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Buscar...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li> --}}
                    <li> <a href="{{url ('/modulopdes/dashboard')}} " class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">DASHBOARD</span></a> </li>

                    <li> <a href="{{url ('/modulopdes/tableroindicadores') }}" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> INDICADORES <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="{{url ('/modulopdes/tableroindicadores') }}">TABLERO</a> </li>
                            <li> <a href="javascript:void(0)">AGREGAR AVANCE</a> </li>
                        </ul>
                    </li>




                    {{-- <li> <a href="{{url ('/modulopdes/tableropdes') }}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Tablero PDES</span></a> </li>
                    <li> <a href="index.html" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Herramientas <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="javascript:void(0)" class="waves-effect">Filtros<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a id="filtro_pdes" href="javascript:void(0)">PDES (F4)</a></li>
                                    <li> <a href="javascript:void(0)">Resultados Priorizados</a></li>
                                    <li> <a href="javascript:void(0)">Tipo de Resultado</a></li>
                                </ul>
                            </li>
                            <li> <a href="javascript:void(0)">Borrar Filtros</a> </li>
                        </ul>
                    </li> --}}


                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid p-10">


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
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ministerio de Planificacion del Desarrollo </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/assets_admin_four/bootstrap/dist/js/tether.min.js"></script>
    <script src="/assets_admin_four/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="/assets_admin_four/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="/assets_admin_four/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/assets_admin_four/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

    @stack('script-head')
</body>

</html>
