@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 style="display: inline-block;" class="mr-4">Canciones</h1>
        <button type="button" class="btn btn-outline-success" id="guardarCancion">Guardar</button>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Datos principales de la canción:</h4>
        </div>
        <div class="card-body">
            <form id="frmDatosPrincipales">
                <div class="form-group">
                    <label for="cancion_titulo">Título de canción:</label>
                    <input type="text" name="cancion_titulo" class="form-control" id="cancion_titulo" placeholder="A Dios el Padre Celestial">
                </div>
                <div class="form-group">
                    <label for="tipo_cancion">Tipo de canción:</label>
                    <select id="tipo_cancion" name="tipo_cancion" class="form-control">
                        <option value="" selected>Selecciona una opción</option>
                        @foreach ($tipos_canciones as $tipo_cancion)
                            <option value="{{ $tipo_cancion->id_tipo_cancion }}">{{ $tipo_cancion->tipo_cancion_nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cancion_nota">Nota principal:</label>
                    <input type="text" class="form-control" name="cancion_nota" id="cancion_nota" placeholder="FA">
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header ">
            <div class="w-100 d-flex justify-content-between">
                <h4 class="card-title">Estrofas:</h4>
                <button class="btn btn-success justify-self-end" id="agregar_estrofa"><i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form class="d-flex" style="flex-wrap: wrap; width: 100%;" id="estrofas_grid">

            </form>
        </div>
    </div>
@stop
@section('js')
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script src="{{ asset('js/canciones_create.js') }}"></script>
@stop
