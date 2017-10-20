@extends('layout.app')

@section('title', 'New Order')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-7 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
                <div class="home-content">
                    <div class="testo-top">
                        <h1><span>Drone</span> manager</h1> </br>
                        <p>Fai la tua richiesta e </br>ricevi l'ordinazione a </br> <strong>casa tua! <strong> </p> </br></br>
                    </div>
                    <div class="testo-down">
                        <a target="_blank" href="{{ url("/insertAddress") }}"><button class="btn btn-danger btn-lg">Nuovo ordine</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection