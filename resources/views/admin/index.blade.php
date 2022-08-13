@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 style="display: inline-block;" class="mr-4">Personas</h1>
        <button type="button" class="btn btn-success" id="ingresarPersona">Ingresar Persona</button>
      </div>
      <div class="row">
        <div id="select_edades" class="mt-4 col-4">
        </div>
        <div id="select_sexo" class="mt-4 col-4">
        </div>
      </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped display" id="personas" width="100%">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Celular</th>
                        <th>Sexo</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade text-left" id="modal_persona" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Persona</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formPersona" method="POST">
                        {!! csrf_field() !!}
                        <div class="col-md-12">
                            <label for="nombres" class="form-label">Nombres: </label>
                            <input type="text" class="form-control" name="nombres" id="nombres" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="apellidos" class="form-label">Apellidos: </label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edad" class="form-label">Edad: </label>
                            <input type="text" class="form-control" name="edad" id="edad" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="celular" class="form-label">Celular: </label>
                            <input type="text" class="form-control" name="celular" id="celular" value="">
                        </div>
                        <div class="col-md-12">
                            <label for="nombres" class="form-label">Sexo: </label>
                            <select name="sexo" id="sexo" class="form-control" required>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                        </div>
                        <input type="hidden" value="" id="persona_id" name="persona_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary mr-2 d-none" type="submit" form="formPersona" id="btnCrearPersona">
                        <span class="spinner-border spinner-border-sm loader-crearPersona" style="display:none"></span>Crear
                    </button>
                    <button class="btn btn-primary mr-2 d-none" type="submit" form="formPersona" id="btnEditarPersona">
                        <span class="spinner-border spinner-border-sm loader-editarPersona"
                            style="display:none"></span>Editar
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
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
    <script type="text/javascript">
        var Personas
        $(document).ready(function() {
            Personas = $('#personas').DataTable({
                "dom": "Bfrltip",
                "buttons": [{
                    extend: "excelHtml5",
                    title: "Personas",
                    text: "Exportar Excel",
                    className: "btn btn-warning",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                    },
                }, ],
                "bDestroy": true,
                "bSort": true,
                "searching": true,
                "lengthChange": true,
                "ajax": {
                    "url": "/admin/getPersonas",
                    "type": "GET",
                    "dataType": "json"
                },
                "sAjaxDataProp": "",
                "columns": [{
                        "data": "nombres",
                    },
                    {
                        "data": "apellidos",
                    },
                    {
                        "data": "edad",
                    },
                    {
                        "data": "celular",
                    },
                    {
                        "data": "sexo",
                    },
                    {
                        "data": "tipo_persona",
                    },
                    {
                        "data": "opciones",
                    },
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "initComplete": function() {
                    this.api().columns([5]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value="">Todos los tipos</option></select>'
                            )
                            .appendTo('#select_edades')
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            if (column.search() === '^' + d + '$') {
                                select.append(
                                    '<option value="' + d +
                                    '" selected="selected">' +
                                    d +
                                    '</option>'
                                )
                            } else {
                                select.append('<option value="' + d + '">' + d +
                                    '</option>')
                            }
                        });
                    });

                    this.api().columns([4]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value="">-</option></select>'
                            )
                            .appendTo('#select_sexo')
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            if (column.search() === '^' + d + '$') {
                                select.append(
                                    '<option value="' + d +
                                    '" selected="selected">' +
                                    d +
                                    '</option>'
                                )
                            } else {
                                select.append('<option value="' + d + '">' + d +
                                    '</option>')
                            }
                        });
                    });
                },
            });
        });

        $('#ingresarPersona').click(function() {
            $('#modal_persona').modal('show')
            $('#btnCrearPersona').removeClass('d-none')
            $('#btnEditarPersona').addClass('d-none')
        })

        $('#btnCrearPersona').click(function() {
            $("#formPersona").validate({
                rules: {
                    nombres: "required",
                    apellidos: "required",
                    celular: "required",
                    sexo: "required",
                    edad: "required",
                },
                submitHandler: function() {
                    var datastring = $('#formPersona').serialize()
                    $.ajax({
                        type: "POST",
                        url: "admin/insertPersona",
                        data: datastring,
                        dataType: 'json',
                        beforeSend: function() {
                            $('.loader-crearPersona').show();
                            $("#btnCrearPersona").attr("disabled", true);
                        },
                        success: function(msg) {
                            if (msg.error == 0) {
                                $('.loader-crearPersona').hide();
                                $("#btnCrearPersona").attr("disabled", false);
                                Personas.ajax.reload(null, false);
                                $("#formPersona").trigger("reset");
                                $("#modal_persona").modal("hide");
                                Swal.fire({
                                    type: 'success',
                                    title: 'Bien!',
                                    text: msg.msn,
                                    confirmButtonText: 'Ok'
                                })
                            } else if (msg.error == 1) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: msg.msn,
                                    type: 'error',
                                    confirmButtonText: 'Ok'
                                })

                            }
                        }
                    });

                }
            });

        });

        function eliminarPersona(id) {
            Swal.fire({
                text: '¿Esta Seguro que desea eliminar a la persona?',
                type: "error",
                confirmButtonText: "Eliminar",
                showCancelButton: true,
                customClass: {
                    confirmButton: "btn btn-danger  mr-3",
                    cancelButton: "btn btn-secondary"
                },
                buttonsStyling: false,
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "admin/eliminarPersona",
                        data: {
                            _token: "{{ csrf_token() }}",
                            persona_id: id
                        },
                        dataType: 'json',
                        success: function(msg) {
                            if (msg.error == 0) {
                                Personas.ajax.reload(null, false);
                                Swal.fire({
                                    type: 'success',
                                    title: 'Bien!',
                                    text: msg.msn,
                                    confirmButtonText: 'Ok'
                                })
                            } else if (msg.error == 1) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: msg.msn,
                                    type: 'error',
                                    confirmButtonText: 'Ok'
                                })

                            }
                        }
                    });
                }
            })
        }

        function editarPersona(id) {
            $('#persona_id').val(id)
            $('#btnEditarPersona').removeClass('d-none');
            $('#btnCrearPersona').addClass('d-none');
            $('#modal_persona').modal('show')
            $.ajax({
                type: "GET",
                url: "admin/getDatosPersona",
                data: {
                    persona_id: id
                },
                dataType: 'json',
                success: function(msg) {
                    $('#nombres').val(msg.nombres)
                    $('#apellidos').val(msg.apellidos)
                    $('#edad').val(msg.edad)
                    $('#sexo').val(msg.sexo)
                    $('#celular').val(msg.celular)
                }
            });
        }

        $('#btnEditarPersona').click(function() {
            var datastring = $('#formPersona').serialize()
            $.ajax({
                type: "POST",
                url: "admin/editarPersona",
                data: datastring,
                dataType: 'json',
                beforeSend: function() {
                    $('.loader-editarPersona').show();
                    $("#btnEditarPersona").attr("disabled", true);
                },
                success: function(msg) {
                    if (msg.error == 0) {
                        $('.loader-editarPersona').hide();
                        $("#btnEditarPersona").attr("disabled", false);
                        Personas.ajax.reload(null, false);
                        $("#formPersona").trigger("reset");
                        $("#modal_persona").modal("hide");
                        Swal.fire({
                            type: 'success',
                            title: 'Bien!',
                            text: msg.msn,
                            confirmButtonText: 'Ok'
                        })
                    } else if (msg.error == 1) {
                        Swal.fire({
                            title: 'Error!',
                            text: msg.msn,
                            type: 'error',
                            confirmButtonText: 'Ok'
                        })

                    }
                }
            });
        });
    </script>
@stop
