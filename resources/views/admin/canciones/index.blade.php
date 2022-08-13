@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 style="display: inline-block;" class="mr-4">Canciones</h1>
        <a href="/canciones/create" class="btn btn-success">Añadir canción</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped display" id="canciones" width="100%">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Tipo de canción</th>
                        <th>Nota</th>
                        <th>Numero de estrofas</th>
                        <th>Fecha de creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('js/canciones.js') }}"></script>
@stop
