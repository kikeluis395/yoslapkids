var Canciones
$(document).ready(function() {
    Canciones = $('#canciones').DataTable({
        "dom": "Bfrltip",
        "buttons": [{
            extend: "excelHtml5",
            title: "Canciones",
            text: "Exportar Excel",
            className: "btn btn-warning",
            exportOptions: {
                columns: [0, 1, 2, 3, 4],
            },
        }, ],
        "bDestroy": true,
        "bSort": true,
        "searching": true,
        "lengthChange": true,
        "ajax": {
            "url": "/canciones/getCanciones",
            "type": "GET",
            "dataType": "json"
        },
        "sAjaxDataProp": "",
        "columns": [
            {
                "data": "cancion_titulo",
            },
            {
                "data": "tipo_cancion",
            },
            {
                "data": "cancion_nota",
            },
            {
                "data": "numero_estrofas",
            },
            {
                "data": "created_at",
            },
            {
                "data": "acciones",
            },
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
    });
});
