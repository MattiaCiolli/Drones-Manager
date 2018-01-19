@extends('layout.app')

@section('title', 'New Order')


@section('sidebar')
    @parent
    <!--the sidebar section is utilizing the @parent directive to append (rather than overwriting) content to the layout's sidebar. The @parent directive will be replaced by the content of the layout when the view is rendered.  ???????   -->
    <ul class="nav navbar-nav side-nav menu">
        <div class=" primo-li ">
            <li>
                <p><i class="fa fa-fw fa-plus"></i> New order</p>
            </li>
        </div>
        <div >
            <li id=>
                <span class="glyphicon glyphicon-arrow-down btn-lg"></span>
                <p><i class="fa fa-fw fa-map-marker"></i> Address</p>
            </li>
        </div>
        <div >
            <li>
                <span class="glyphicon glyphicon-arrow-down btn-lg"></span>
                <p><i class="fa fa-fw fa-home"></i> Products</p>
            </li>
        </div>
        <div >
            <li>
                <span class="glyphicon glyphicon-arrow-down btn-lg"></span>
                <p><i class="fa fa-fw fa-usd"></i> Summary </p>
            </li>
        </div>
        <div>
            <div class="ombra">
                <span class="glyphicon glyphicon-arrow-down btn-lg"></span>
                <p><i class="fa fa-fw fa-check"></i> Confirm </p>
            </li>
        </div>
    </ul>
@endsection

@section('content')
    <div id="page-wrapper" class="sfondo">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-lg-12">
                    <h3 class="page-header">New order </h3>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-codepen"></i> Drones manager
                        </li>
                        <li class="active">
                            <i class="fa fa-question-circle-o"></i> Conferma il tuo ordine
                        </li>
                    </ol>
                </div>
            </div>


            <div class="row ">
                <div class="col-lg-8 col-lg-offset-1">
                    @if(count($timeDelivery) == 0)
                        <h3 class="continued">Il suo ordine non può essere spedito in giornata.</h3>
                    @elseif(count($timeDelivery) == 1)
                        <h3 class="continued">Il suo ordine arriverà alle ore {{$timeDelivery[0]}}</h3>
                    @else
                        <h3 class="continued">Il suo ordine arriverà nei seguenti orari:</h3>
                        <ol>
                            @for ($i = 0; $i < count($timeDelivery); $i++)
                                <h3>Drone {{$i+1}}:  {{$timeDelivery[$i]}}</h3>
                            @endfor
                        </ol>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row ">
                <div class="col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-4 col-xs-offset-1 botton-order">
                    <a href="{{ url("/confirmation") }}"><button class="btn btn-success btn-lg btn-confirm ">Conferma</button></a>
                    <a href="{{ url("/newOrder") }}"><button class="btn btn-danger btn-lg btn-confirm">Annulla</button></a>
                </div>
            </div>


        </div>
    </div>
    </div>


@endsection
