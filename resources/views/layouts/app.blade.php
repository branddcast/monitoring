<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" defer>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- JQuery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}" defer></script>

    <!-- Sweetlert -->
    <script src="{{ asset('js/sweetalert.min.js') }}" defer></script>

    <!-- Chart JS -->
    <script src="https://code.highcharts.com/highcharts.js" defer></script>
    <script src="https://code.highcharts.com/highcharts-more.js" defer></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js" defer></script>
    <script src="https://code.highcharts.com/modules/exporting.js" defer></script>
    <script src="https://code.highcharts.com/modules/export-data.js" defer></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/popper.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @Auth
                • <span style="margin-left: 15px;">{{ Auth::user()->name }}</span>
                @endAuth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="#" onclick="javascript:registrar_huella();" class="nav-link">Registrar <i class="fas fa-fingerprint text-success"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('monitoreo') }}">Monitoreo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('bitacora') }}">Bitácora</a>
                            </li>
                            <li style="padding-top: 8px">•</li>
                            <li class="nav-item">
                                <script>
                                        //Global Vars

                                        let id_user = '{{ Auth::user()->id }}';
                                        let base_url = '{{ url("/") }}';
                                        let token =  '{{ csrf_token() }}';
                                </script>

                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Salir') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- MAIN JS -->
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- UserAuth Form Modal -->
    <div class="modal fade" id="user_auth" tabindex="-1" role="dialog" aria-labelledby="user_authTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="user_authTitle">Credenciales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <small>Escriba su contraseña para confirmar operación: </small>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <input id="user_auth_password" class="form-control form-control-sm" type="password" placeholder="Contraseña de Administrador" required>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
            <button id="user_auth_submit" type="button" class="btn btn-primary btn-sm">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Make FingerPrint Modal -->
    <div class="modal fade" id="fingerPrint" data-id="0" tabindex="-1" role="dialog" aria-labelledby="fingerPrintTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="fingerPrintTitle">Registrar nueva huella</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="fingerPrint_loading" style="position: absolute; left:0; z-index: 9999; background: #fff; width: 100%; height: 100%; justify-content: center; display: flex; align-items: center;">
              <div class="spinner-grow text-success" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>

            <div class="container">
                <div class="row border-bottom pb-3">
                    <div class="col-md-10">
                        <small>Escriba el correo electrónico del usuario a registrar la huella</small>
                        <input type="text" id="fingerPrint_usuario" class="form-control form-control-sm" placeholder="Email">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <small>Nombre: </small>
                        <input type="text" id="fingerPrint_nombre" class="form-control" disabled></input>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small>Email: </small>
                        <input type="text" id="fingerPrint_email" class="form-control" disabled></input>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small>Rol: </small>
                        <input type="text" id="fingerPrint_rol" class="form-control" disabled></input>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small>Estatus de Huella: </small>
                        <input type="text" id="fingerPrint_huella" class="form-control" disabled> <i id="eliminar_huella" class="fas fa-times" data-toggle="tooltip" data-placement="top" title="Eliminar huella" style="position: absolute; top:35px; right: 30px; display: none;"></i></input>
                        <input type="hidden" id="usuario_id">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
            <button id="registrar_huella_btn" style="display: none;" data-process="save" type="button" class="btn btn-primary btn-sm" onclick="javascript:startFingerPrintProcess()">Registrar</button>
          </div>
        </div>
      </div>
    </div>

</body>
</html>
