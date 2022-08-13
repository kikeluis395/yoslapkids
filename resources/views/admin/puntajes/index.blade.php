<style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        width: 100vw;
        height: 100vh;
        color: white;
        font-family: Verdana, Geneva, Tahoma, sans-serif;

    }

    main {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        background: url({{ asset('./images/versus.jpg') }}) no-repeat;
        background-size: cover;
    }

    .container_team {
        width: 50%;
        padding: 40px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .container_team h2 {
        font-size: 70px;
        margin: 5px;
    }

    .puntaje {
        all: unset;
        font-size: 150px;
        font-weight: bold;
        width: 100%;
    }

    /* .container_team--blue {
        background: #0000ff;
    }

    .container_team--red {
        background: #ff0000;
    } */

    .control_buttons .btn_controls {
        all: unset;
        font-size: 40px;
        margin: 0px 30px;
    }
</style>

<body>
    <main>
        <div class="container_team container_team--blue">
            <h2>EQUIPO AZUL</h2>
            <div class="input-group">
                <input class="puntaje" type="text" id="input_azul" data-color="azul" value="0" disabled>
                <div class="control_buttons">
                    <select class="select_puntaje select_puntaje--blue" id="select_puntaje--blue">
                        <option value="50">50</option>
                        <option value="100" selected>100</option>
                        <option value="200">200</option>
                    </select>
                    <button class="btn_controls btn_controls_add">+</button>
                    <button class="btn_controls btn_controls_menos">-</button>
                </div>
            </div>
        </div>
        <div class="container_team container_team--red">
            <h2>EQUIPO ROJO</h2>
            <div class="input-group">
                <input class="puntaje" type="text" id="input_rojo" data-color="rojo" value="0" disabled>
                <div class="control_buttons">
                    <select class="select_puntaje select_puntaje--red" id="select_puntaje--red">
                        <option value="50">50</option>
                        <option value="100" selected>100</option>
                        <option value="200">200</option>
                    </select>
                    <button class="btn_controls btn_controls_add">+</button>
                    <button class="btn_controls btn_controls_menos">-</button>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    buttons_add = document.querySelectorAll('.btn_controls_add');
    buttons_menos = document.querySelectorAll('.btn_controls_menos');
    input_rojo = document.getElementById('input_rojo');
    input_azul = document.getElementById('input_azul');
    input_azul = document.getElementById('input_azul');
    puntaje_red = document.getElementById('select_puntaje--red');
    puntaje_blue = document.getElementById('select_puntaje--blue');


    buttons_add.forEach(element => {
        element.addEventListener('click', (e) => {
            let puntaje = e.target.parentElement.querySelector('.select_puntaje')
            editPuntaje(puntaje.value, e.target.parentElement.previousElementSibling);
        })
    });
    buttons_menos.forEach(element => {
        element.addEventListener('click', (e) => {
            let puntaje = e.target.parentElement.querySelector('.select_puntaje')
            editPuntaje(-puntaje.value, e.target.parentElement.previousElementSibling);
        })
    });

    function editPuntaje(puntos, input) {
        input.value = parseInt(input.value) + parseInt(puntos)
    }
</script>
