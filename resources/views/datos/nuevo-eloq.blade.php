<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>{{ ucfirst($valores_tipo.'s') }} :: {{ $vista_tit }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .volver_listado {
            margin: 0 auto 20px auto;
            font-weight: bold;
        }

        .volver_listado a {
            color: #000;
        }
    </style>
  </head>
  <body>

    <div class="row flex-center">
        <div class="col-xs|sm|md|lg|xl-1-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
    <div class="container-fluid content">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
        <h1 class="title m-b-md">Laravel :: {{ ucfirst($valores_tipo.'s') }} - {{ $vista_tit }}</h1>
        <div class="row">
            <div class="container flex-center">
                    <form action="{{ route('datos_eloq_insertar') }}" method="post" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="nombre">Nombre:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="text" name="nombre" id="nombre" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="contrasenia">Contraseña:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="text" name="contrasenia" id="contrasenia" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="edad">Edad:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="text" name="edad" id="edad" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="saldo">Saldo:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="text" name="saldo" id="saldo" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="saldo">Comentarios:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <textarea name="comentarios" id="comentarios" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="register_at">Fecha de Registro:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                                {{-- @php$fecha_hora_actual=now();@endphp --}}
                            <input type="text" name="register_at" id="register_at" value="{{ now() }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="activo">Activo:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="radio" name="activo" id="activo_si" value="1" placeholder="">
                            <label for="activo_si">
                                Si
                            </label>
                            <input type="radio" name="activo" id="activo_no" value="0" placeholder="" checked>
                            <label for="activo_no">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Insertar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="volver_listado col-xs|sm|md|lg|xl-12" style="clear: both; display: block;"><a href="{{ route('datos_eloq_lista') }}" title="Volver al listado">Volver al listado (Eloquent)</a></div>
        </div>
        <div class="links">
            <a href="https://laravel.com/docs">Documentation</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://nova.laravel.com">Nova</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>
