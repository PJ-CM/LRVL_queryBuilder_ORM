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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

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

        .negrita {
            font-weight: bold;
        }

        a.usuario_activo_si {
            color: green;
        }

        a.usuario_activo_no {
            color: red;
        }
    </style>
  </head>
  <body>
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
        <div class="row flex-center">
            <a href="{{ route('datos_eloq_nuevo') }}" title="Insertar nuevo">Insertar nuevo</a>
        </div>
        <div class="row">
        @if ($vista_tipo == 'listado')

            @isset($accion)
            {{-- Habiendo mensajes de acción :: INI --}}
                @php
                    $accion_datos = explode('_', $accion);
                    switch ($accion_datos[0]) {
                        case 'insertar':
                            $modal_tit = 'Inserto satisfactorio';
                            $modal_msg = 'El usuario con ID ['.$accion_datos[1].'] fue insertado correctamente.';
                            break;

                        case 'editar':
                            $modal_tit = 'Edición satisfactoria';
                            $modal_msg = 'El usuario con ID ['.$accion_datos[1].'] fue editado correctamente.';
                            break;

                        case 'borrar':
                            $modal_tit = 'Borrado satisfactorio';
                            $modal_msg = 'El usuario con ID ['.$accion_datos[1].'] fue borrado correctamente.';
                            break;
                    }
                @endphp
            <!-- Modal-acción -->
            <div class="modal fade" id="accion-modal" tabindex="-1" role="dialog" aria-labelledby="accion-modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-info text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="accion-modalLabel">{{ $modal_tit }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ $modal_msg }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Habiendo mensajes de acción :: INI --}}
            @endisset

            @if ($valoresTOT == 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Comentarios</th>
                        <th>Fecha de Registro</th>
                        <th>Activo</th>
                        <th>:: Opciones ::</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">{{ 'No existen ' . strtoupper($valores_tipo.'s') . ' disponibles en la actualidad. Vuelva en otro momento. Gracias.' }}</td>
                    </tr>
                </tbody>
            </table>
            @else
            <h2>Hay [<strong>{{ $valoresTOT }}</strong>] {{ $valores_tipo }}(s) disponible(s)</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Comentarios</th>
                        <th>Fecha de Registro</th>
                        <th>Activo</th>
                        <th>:: Opciones ::</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //var_dump($valores);
                    $contador = 0; ?>
                    @foreach ($valores as $valor)
                        @php
                            $contador++;
                        @endphp

                    <!-- Modal-confirmación -->
                    <div class="modal fade" id="confirmModal_{{ $valor->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel_{{ $valor->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel_{{ $valor->id }}">Eliminar registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro de eliminar este registro definitivamente?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a href="{{ route('datos_eloq_borrar', ['id' => $valor->id]) }}" class="btn btn-danger" role="button" title="Confirmar borrado">Confirmar</a>
                        </div>
                        </div>
                    </div>
                    </div>

                    <tr>
                        <td>{{ $contador < 10 ? '0'.$contador : $contador }}</td>
                        <td><a href="{{ url('/'.$valores_tipo.'s-eloq/detalle/'.$valor->id) }}" title="Ir al detalle" class="negrita{{ $valor->activo == 0 ? ' usuario_activo_no' : ' usuario_activo_si' }}">{{ $valor->nombre }}</a></td>
                        <td>{{ $valor->comentarios }}</td>
                        <td>{{ $valor->register_at }}</td>
                        @php
                            $valor_activo_tit = '';
                            $valor_activo_nuevo = '';
                            if($valor->activo == 0) {
                                $valor_activo_tit = 'Clic para activar';
                                $valor_activo_nuevo = 1;
                            } else {
                                $valor_activo_tit = 'Clic para desactivar';
                                $valor_activo_nuevo = 0;
                            }
                        @endphp
                        <td><form action="{{ route('datos_eloq_editar_campo', ['id' => $valor->id, 'campo' => 'activo', 'valor' => $valor_activo_nuevo]) }}" method="get"><input type="checkbox"{{ $valor->activo == 1 ? ' checked' : '' }} onchange="this.form.submit();" title="{{ $valor_activo_tit }}"></form></td>
                        <td><a href="{{ route('datos_eloq_detalle', ['id' => $valor->id]) }}" class="text-primary" title="Editar este registro"><i class="fas fa-pencil-alt"></i></a> <a href="#" class="text-danger" title="Borrar este registro" data-toggle="modal" data-target="#confirmModal_{{ $valor->id }}"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        @else
            <div class="container flex-center">
                    <form action="{{ route('datos_eloq_editar') }}" method="post" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="nombre">Nombre:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="text" name="nombre" id="nombre" placeholder="" value="{{ $valor->nombre }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="contrasenia">Contraseña:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="text" name="contrasenia" id="contrasenia" placeholder="" value="{{ $valor->contrasenia }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="edad">Edad:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="text" name="edad" id="edad" placeholder="" value="{{ $valor->edad }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="saldo">Saldo:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="text" name="saldo" id="saldo" placeholder="" value="{{ $valor->saldo }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="saldo">Comentarios:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <textarea name="comentarios" id="comentarios" cols="30" rows="10">{{ $valor->comentarios }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="register_at">Fecha de Registro:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <input type="text" name="register_at" id="register_at" placeholder="" value="{{ $valor->register_at }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            <label for="activo">Activo:</label>
                        </div>
                        <div class="col-xs|sm|md|lg|xl-1-6">
                            {{--<input type="text" name="activo" id="activo" placeholder="" value="{{ $valor->activo }}">--}}
                            <select name="activo" id="activo">
                                <option value="1"{{ $valor->activo == 1 ? ' selected' : '' }}>Si</option>
                                <option value="0"{{ $valor->activo == 0 ? ' selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <input type="hidden" name="id" value="{{ $valor->id }}">
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <!--<a href="#" class="btn btn-danger" role="button" title="Eliminar registro">Borrar</a>-->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" title="Eliminar registro">
                              Borrar
                            </button>

                            <!-- Modal-confirmación -->
                            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Eliminar registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    ¿Está seguro de eliminar este registro definitivamente?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <a href="{{ route('datos_eloq_borrar', ['id' => $valor->id]) }}" class="btn btn-danger" role="button" title="Confirmar borrado">Confirmar</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="volver_listado col-xs|sm|md|lg|xl-12" style="clear: both; display: block;"><a href="{{ route('datos_eloq_lista') }}" title="Volver al listado">Volver al listado (Eloquent)</a></div>
        @endif
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

    @isset($accion)
    <!--Mostrando MODAL de acción en la carga de la página-->
    <script type="text/javascript">
        $(window).on('load', function(){
            $('#accion-modal').modal('show');
        });
    </script>
    @endisset
  </body>
</html>
