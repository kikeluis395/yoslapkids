@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <section class="section page-heading">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="page-title mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Exportar Canciones</h3>
                            <p class="text-subtitle text-muted mb-0">Exporta canciones en pptx</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@stop

@section('content')
    <section class="section">
        {{-- buscador --}}
        {{-- grid --}}
        <div class="cards" id="cards">
            {{-- <?php $key = 0; ?>
            @foreach ($canciones as $cancion)
                <?php $key < 5 ? $key++ : ($key = 1); ?>
                <div class="card_main card-{{ $key }}">
                    <div class="card__icon"><i class="fa fa-asterisk"></i>&nbsp; {{ $cancion->tip }}</div>
                    <h2 class="card__title">{{ $cancion->cancion_titulo }}</h2>
                    <div class="card__description">
                        <div>
                            <i class="fa fa-music"></i>&nbsp; {{ $cancion->cancion_nota }}
                        </div>
                        <div>
                            <i class="fa fa-clock"></i>&nbsp; 4/4
                        </div>
                        <div>
                            <i class="fa fa-hashtag"></i>&nbsp; {{ count($cancion->estrofas) }}
                        </div>
                    </div>
                    <p class="card__apply">
                        <a class="card__link" href="#">Agregar <i class="fas fa-arrow-right"></i></a>
                    </p>
                </div>
            @endforeach --}}
        </div>
    </section>
@stop
@section('right-sidebar')
    <section class="section p-4">
        <div class="p-2 text-center">
            <h2>Canciones agregadas</h2>
        </div>
        <div class="cards_added" id="cards_added">
        </div>
        <form action="/exportarCanciones/download" method="POST">
            @csrf
            <input type="hidden" name="array_songs" id="array_songs">
            <button type="submit" id="exportDocument" class="btn btn-success mt-3 w-100" role="button">
                Exportar
            </button>
        </form>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    {{-- CARDS Y GRID --}}
    <style>
        /* HEADING */

        .heading {
            text-align: center;
        }

        .heading__title {
            font-weight: 600;
        }

        .heading__credits {
            margin: 10px 0px;
            color: #888888;
            font-size: 25px;
            transition: all 0.5s;
        }

        .heading__link {
            text-decoration: none;
        }

        .heading__credits .heading__link {
            color: inherit;
        }

        /* CARDS */

        .cards {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica,
                Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            display: grid;
            gap: 1rem;
            grid-auto-rows: 20rem;
            grid-template-columns: repeat(auto-fill, minmax(min(100%, 16rem), 1fr));
        }

        .card_main {
            padding: 20px;
            display: grid;
            grid-template-rows: 20px 50px 1fr 50px;
            border-radius: 10px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
            transition: all 0.2s;
        }

        .card_main:hover {
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
            transform: scale(1.01);
        }

        .card__link,
        .card__exit,
        .card__icon,
        .card__description {
            position: relative;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.9);
        }

        .card__link::after {
            position: absolute;
            top: 25px;
            left: 0;
            content: "";
            width: 0%;
            height: 3px;
            background-color: rgba(255, 255, 255, 0.6);
            transition: all 0.5s;
        }

        .card__link:hover::after {
            width: 100%;
        }

        .card__exit {
            grid-row: 1/2;
            justify-self: end;
        }

        .card__icon {
            grid-row: 2/3;
            font-size: 20px;
        }

        .card__title {
            grid-row: 3/4;
            font-weight: 400;
            color: #ffffff;
        }

        .card__description {
            grid-row: 4/5;
            font-size: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card__apply {
            grid-row: 5/6;
            align-self: center;
        }

        .card__link.delete_song {
            color: var(--danger) !important;
        }

        /* CARD BACKGROUNDS */

        .card-1 {
            background: radial-gradient(#1fe4f5, #3fbafe);
        }

        .card-2 {
            background: radial-gradient(#fbc1cc, #fa99b2);
        }

        .card-3 {
            background: radial-gradient(#76b2fe, #b69efe);
        }

        .card-4 {
            background: radial-gradient(#60efbc, #58d5c9);
        }

        .card-5 {
            background: radial-gradient(#f588d8, #c0a3e5);
        }

        /* RESPONSIVE */

        @media (max-width: 1600px) {
            .cards {
                justify-content: center;
            }
        }
    </style>
    <style>
        .cards_added {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 10px;
            max-height: 70vh;
            overflow-y: scroll;
        }

        .control-sidebar {
            height: 100%;
            width: 350px !important;
        }
        .control-sidebar::before {
            width: 350px !important;
        }


        .sidebar_right {
            position: absolute;
            right: 30;
            min-width: 300px;
            width: 300px;
            background: #76b2fe;
            height: 100vh;
        }
    </style>
    @parent
@stop
@section('js')
    <script src="{{ asset('js/exportarCanciones.js') }}"></script>
@stop
