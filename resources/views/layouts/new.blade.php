<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Intur-Hotel</title>
    <!-- Styles -->
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('css/material-dashboard.css?v=1.2.0') }}" rel="stylesheet"/>
    <!-- Fonts and icons-->

    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons"/>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>

<div id="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-active-color="rose" data-background-color="white"> <!--DIV DE BARRA LATERAL-->
        <div class="logo"> <!--DIV PARA ACOMODAR LOGO EN LATERAL-->
            <a href="{{ url('/') }}"> <!--REDIRECCION A HOME-->
                <img src="{{asset('images/Logo.jpg') }}" class="img-responsive" alt="">
            </a> <!--CIERRE DE REDIRECCION A HOME-->
        </div> <!--CIERRE DIV PARA ACOMODAR LOGO EN LATERAL-->

        <div class="sidebar-wrapper"> <!--DIV DE MENU LATERAL-->
            <ul class="nav"> <!--LISTA DESORDENADA-->
                <li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' ||Route::currentRouteName() == 'home2' ? 'active' : ''  }}">
                    <a href="{{ url('/home') }}">
                        <i class="material-icons">home</i>
                        <p>Inicio</p>
                    </a>
                </li>
                @can('book')
                    <li class="{{ Route::currentRouteName() == 'book' ? 'active' : '' }}">
                        <a href="{{ url('/book') }}">
                            <i class="material-icons">library_books</i>
                            <p>Libros</p>
                        </a>
                    </li>
                @endcan
                @can('reportes')
                    <li class="{{ Route::currentRouteName() == 'reports' ? 'active' : '' ||Route::currentRouteName() == 'reporte' ? 'active' : '' }}">
                        <a href="{{ url('/reports') }}">
                            <i class="material-icons">insert_chart</i>
                            <p>Reportes</p>
                        </a>
                    </li>
                @endcan
                @role('Hotel')
                <li class="{{ Route::currentRouteName() == 'anulados' ? 'active' : '' }}">
                    <a href="{{ url('/anulados') }}">
                        <i class="material-icons">archive</i>
                        <p>Anulados</p>
                    </a>
                </li>
                @endrole
                @role('administrador')
                <li class="{{ Route::currentRouteName() == 'listado' ? 'active' : '' }}">
                                <a href="/listado_usuarios">
                                    <i class="material-icons">people</i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'rol' ? 'active' : '' }}">
                                <a href="/roles">
                                    <i class="material-icons">verified_user</i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'bitacora' ? 'active' : '' }}">
                                <a href="/bitacora">
                                    <i class="material-icons">track_changes</i>
                                    <p>Bitacora</p>
                                </a>
                            </li>
                @endrole
                <li class="{{ Route::currentRouteName() == 'acerca' ? 'active' : '' }}">
                    <a href="{{ url('/acerca') }}">
                        <i class="material-icons">info_outline</i>
                        <p>Acerca de</p>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'ayuda' ? 'active' : '' }}">
                    <a href="{{ url('/ayuda') }}">
                        <i class="material-icons">help</i>
                        <p>Ayuda</p>
                    </a>
                </li>
            </ul> <!--CIERRE DE LISTA DESORDENADA-->
        </div> <!--CIERRE DE DIV DE MENU LATERAL-->
    </div> <!--CIERRE DE DIV DE BARRA LATERAL-->

    <div class="main-panel"> <!--Panel Central-->
        <!--Navbar-->
        <nav class="navbar navbar-rose navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                        <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                        <i class="material-icons visible-on-sidebar-mini">view_list</i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }}
                                <i class="material-icons">person</i>
                            </a>
                            <ul class="dropdown-menu navbar-danger" role="menu">
                                <li>
                                    <a href="/user"><i class="fa fa-user-circle fa-xl"></i> <span
                                                class="collapse in hidden-xs">Mi cuenta</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


    @yield('content')



    <!--Footer-->
        <footer class="footer ">
            <div class="container-fluid">
                <p class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>
                    Desarrollado por
                    <a href="#">
                        UNI Monografia 2018
                    </a>
                </p>
            </div>
        </footer>

    </div>
</div>


</body>


<!-- Then include bootstrap js -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/arrive.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/es6-promise-auto.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/chartist.min.js') }}"></script>
<script src="{{ asset('js/jquery.bootstrap-wizard.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('js/jquery-jvectormap.js') }}"></script>
<script src="{{ asset('js/nouislider.min.js') }}"></script>
<script src="{{ asset('js/jquery.select-bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.datatables.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/jquery.tagsinput.js') }}"></script>

<script src="{{ asset('js/material-dashboard.js') }}"></script>

<script src="{{ asset('js/ern.js') }}"></script>

<script src="{{asset('js/highcharts.js') }}"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        //    Activate bootstrap-select

        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            order: [[0, "desc"]],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "BUSQUEDA",
                lengthMenu: "_MENU_ por pagina",
                zeroRecords: "NO EXISTE EL REGISTRO SOLICITADO",
                info: "pagina _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros",
                infoFiltered: "(filtrado de _MAX_ total)",
                paginate: {
                    first: "Primero",
                    previous: "Ant.",
                    next: "Sig.",
                    last: "Ultimo"
                }
            }
        });
        $('#datatables2').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "BUSQUEDA",
                lengthMenu: "_MENU_ por pagina",
                zeroRecords: "NO EXISTE EL REGISTRO SOLICITADO",
                info: "pagina _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros",
                infoFiltered: "(filtrado de _MAX_ total)",
                paginate: {
                    first: "Primero",
                    previous: "Ant.",
                    next: "Sig.",
                    last: "Ultimo"
                }
            }
        });
        $('#datatables3').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "BUSQUEDA",
                lengthMenu: " _MENU_  por pagina",
                zeroRecords: "NO EXISTE EL REGISTRO SOLICITADO",
                info: "pagina _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros",
                infoFiltered: "(filtrado de _MAX_ total)",
                paginate: {
                    first: "Primero",
                    previous: "Ant.",
                    next: "Sig.",
                    last: "Ultimo"
                }
            }
        });


        $('.card .material-datatables label .pagination').addClass('form-group');
    });
</script>


<script>
    $("#anio").on('change', function (e) {
        //console.log(e);
        var id = e.target.value;
        //ajax
        $.get('/ajax-submes?id=' + id, function (data) {
            //success data
            $("#mes").empty();
            $.each(data, function (index, subcatObj) {
                $("#mes").append('<option value="' + subcatObj.id + '">' + subcatObj.mes + '</option>');
            });
        });
    });
</script>

<script>
    $("#departamento").on('change', function (e) {
        //console.log(e);
        var cat_id = e.target.value;
        //ajax
        $.get('/ajax-subcat?cat_id=' + cat_id, function (data) {
            //success data
            $("#municipio").empty();
            $.each(data, function (index, subcatObj) {
                $("#municipio").append('<option value="' + subcatObj.id + '">' + subcatObj.municipio + '</option>');
            });
        });
    });

    $("#tipo-usuario").on('change', function (e) {
        //console.log(e);
        var id = e.target.options[e.target.selectedIndex].text;
        if (id == 'Hotel' || id == 'hotel') {
            document.getElementById('text-departamento').style.visibility = 'visible';
            document.getElementById('text-direc').style.visibility = 'visible';
            document.getElementById('text-municipio').style.visibility = 'visible';
            document.getElementById('text-categoria').style.visibility = 'visible';
            document.getElementById('text-actividad').style.visibility = 'visible';
            document.getElementById('text-nombre').style.visibility = 'visible';
            document.getElementById('text-telefono').style.visibility = 'visible';
            $('#departamento').prop("required", true);
            $('#direccion').prop("required", true);
            $('#municipio').prop("required", true);
            $('#categoria').prop("required", true);
            $('#actividad').prop("required", true);
            $('#nombre-hotel').prop("required", true);
            $('#telefono').prop("required", true);
        }
        else {
            document.getElementById('text-departamento').style.visibility = 'hidden';
            document.getElementById('text-direc').style.visibility = 'hidden';
            document.getElementById('text-municipio').style.visibility = 'hidden';
            document.getElementById('text-categoria').style.visibility = 'hidden';
            document.getElementById('text-actividad').style.visibility = 'hidden';
            document.getElementById('text-nombre').style.visibility = 'hidden';
            document.getElementById('text-telefono').style.visibility = 'hidden';
            $('#departamento').removeAttr("required");
            $('#direccion').removeAttr("required");
            $('#municipio').removeAttr("required");
            $('#categoria').removeAttr("required");
            $('#actividad').removeAttr("required");
            $('#nombre-hotel').removeAttr("required");
            $('#telefono').removeAttr("required");
        }
    });
</script>

<script>

    @if(Session::has('success'))
    $.notify({
        icon: "add_alert",
        message: "{{ Session::get('success') }}"
    }, {
        type: 'success',
        timer: 4000,
    });
    @php
        Session::forget('success');
    @endphp
    @endif

    @if(Session::has('info'))
    $.notify({
        icon: "add_alert",
        message: "{{ Session::get('info') }}"
    }, {
        type: 'info',
        timer: 4000,
    });
    @php
        Session::forget('info');
    @endphp
    @endif

    @if(Session::has('warning'))
    $.notify({
        icon: "add_alert",
        message: "{{ Session::get('warning') }}"
    }, {
        type: 'warning',
        timer: 4000,
    });
    @php
        Session::forget('warning');
    @endphp
    @endif

    @if(Session::has('error'))
    $.notify({
        icon: "add_alert",
        message: "Revisar errores, click aca para visualizarlos",
        url: "/errores",
        target: "_blank"
    }, {
        type: 'danger',
        timer: 4000,
    });
    @php
        Session::forget('error');
    @endphp
    @endif

</script>


</html>