let array_songs = [];
let canciones_group = [];
$(document).ready(function () {
    getSongs();
    //GET LOCALSTORAGE
    array_songs = JSON.parse(localStorage.getItem("canciones"))
        ? JSON.parse(localStorage.getItem("canciones"))
        : [];
    drawSongs(array_songs, $("#cards_added"), 1);
     //ELIMINAR CANCION
     $(document).on("click", ".delete_song", function () {
      removeSong($(this).data("id"));
    });

    if (array_songs.length > 0) {
      document.querySelector("[data-widget='control-sidebar']").click();
    }
});
function openSidebar() {
    if (array_songs.length == 1) {
        document.querySelector("[data-widget='control-sidebar']").click();
    }
}

function getSongs() {
    $.ajax({
        url: rootURL + "/exportarCanciones/getSongs",
        type: "GET",
        dataType: "json",
        success: function (data) {
            canciones_group = data;
            drawSongs(data, $("#cards"));
            //AGREGAR CANCION
            $(document).on("click", ".add_song", function () {
              addSong($(this).data("id"));
            });
        },
    });
}

function templateSong(index, cancion, is_delete = 0) {
    return `<div class="card_main card-${index}">
                <div class="card__icon"><i class="fa fa-asterisk"></i>&nbsp; ${cancion.tipo_js}</div>
                  <h2 class="card__title">${cancion.cancion_titulo}</h2>
                <div class="card__description">
                  <div>
                      <i class="fa fa-music"></i>&nbsp; ${cancion.cancion_nota}
                  </div>
                  <div>
                      <i class="fa fa-clock"></i>&nbsp; 4/4
                  </div>
                  <div>
                      <i class="fa fa-hashtag"></i>&nbsp; ${cancion.numero_estrofas}
                  </div>
                </div>
                ${is_delete ? `<p class="card__apply">
                          <a type="button" class="card__link delete_song" data-id="${cancion.id_cancion}">Eliminar <i class="fas fa-trash"></i></a>
                        </p>`
                        :
                        `<p class="card__apply">
                          <a type="button" class="card__link add_song" data-id="${cancion.id_cancion}">Agregar <i class="fas fa-arrow-right"></i></a>
                        </p>`}
              </div>
              `;
}

function addSong(id) {
    let cancion_agregada = canciones_group.filter(
        (cancion) => cancion.id_cancion === id
    );
    array_songs.push(cancion_agregada[0]);
    localStorage.setItem("canciones", JSON.stringify(array_songs));
    drawSongs(array_songs, $("#cards_added"), 1);
     //ELIMINAR CANCION
     $(document).on("click", ".delete_song", function () {
      removeSong($(this).data("id"));
    });
    openSidebar();
    console.log(cancion_agregada)
}

function removeSong(id) {
    // ELIMINAR CANCION DEL LOCALSTORAGE
    array_songs = array_songs.filter(
        (cancion) => cancion.id_cancion !== id
    );
    localStorage.setItem("canciones", JSON.stringify(array_songs));
    drawSongs(array_songs, $("#cards_added"), 1);
     //ELIMINAR CANCION
     $(document).on("click", ".delete_song", function () {
      removeSong($(this).data("id"));
    });
}

function drawSongs(canciones, container, is_delete) {
    container.html("");
    let index = 0;
    let canciones_add_group = canciones.map((cancion) => {
        index < 5 ? index++ : (index = 1);
        return templateSong(index, cancion, is_delete);
    });
    container.append(canciones_add_group);
    array_songs_ids = array_songs.map((cancion) => (cancion.id_cancion))
    $('#array_songs').val(JSON.stringify(array_songs_ids));
}

// function exportDocument() {
//   $.ajax({
//     url: rootURL + "/exportarCanciones/download",
//     type: "POST",
//     data: {
//       array_songs : array_songs
//     },
//     dataType: "json",
//     success: function (data) {
//         console.log('todo ok pe kike')
//     },
//   });
// }

// $(document).on("click", "#exportDocument", function () {
//   exportDocument()
// });

