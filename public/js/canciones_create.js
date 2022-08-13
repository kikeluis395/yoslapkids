var array_estrofas = [
    {
        id: 1,
        contenido: "",
    },
];

$(document).ready(function () {
    drawEstrofas();
});

$("#agregar_estrofa").click(function () {
    addEstrofa();
});

function templateEstrofa(contenido, id) {
    return ` <div class="mr-2" id="estrofa_${id}" draggable=true>
  <textarea name="estrofas[]" class="estrofa" id="estrofa_contenido_${id}" cols="30" rows="10">${contenido}</textarea>
  <button type="button" class="btn btn-danger d-block w-100 btn-delete"><i class="fa fa-trash"></i></button>
</div>`;
}

function addEstrofa() {
    array_estrofas.push({
        id: array_estrofas.length + 1,
        contenido: "",
    });
    drawEstrofas();
}

function drawEstrofas() {
    let container_estrofas = document.getElementById("estrofas_grid");
    let estrofas = array_estrofas
        .map((estrofa) => templateEstrofa(estrofa.contenido, estrofa.id))
        .join("", ",");
    container_estrofas.innerHTML = estrofas;

    $(".btn-delete").click(function () {
        let id_container = $(this).parent()[0].id;
        let id_eliminado = id_container.split("_")[1];
        array_estrofas = array_estrofas.filter(
            (estrofa) => estrofa.id != id_eliminado
        );
        document.getElementById(id_container).outerHTML = "";
    });
    $(".estrofa").keyup(function () {
        let id_container = $(this)[0].id;
        let id_actual = id_container.split("_")[2];
        console.log(id_actual);
        array_estrofas[id_actual - 1].contenido = $(this).val();
    });
}

$("#guardarCancion").click(function () {
    let dataString = $('#frmDatosPrincipales').serialize() + '&' + $('#estrofas_grid').serialize();
    $.ajax({
        url: rootURL + "/canciones/store",
        type: "POST",
        data: dataString,
        dataType: "json",
        success: function (msg) {
          if (msg.error == 0) {
            Swal.fire({
                type: 'success',
                title: 'Bien!',
                text: msg.message,
                confirmButtonText: 'Ok'
            })
        } else if (msg.error == 1) {
            Swal.fire({
                title: 'Error!',
                text: msg.message,
                type: 'error',
                confirmButtonText: 'Ok'
            })

        }
        },
    });
});
