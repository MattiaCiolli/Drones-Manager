@extends('layout.app')

@section('title', 'Order summary')

@section('sidebar')
    @parent
    <!--the sidebar section is utilizing the @parent directive to append (rather than overwriting) content to the layout's sidebar. The @parent directive will be replaced by the content of the layout when the view is rendered.  ???????   -->
    <ul class="nav navbar-nav side-nav menu">
        <div class=" primo-li ">
            <li>
                <p><i class="fa fa-fw fa-plus"></i> New order</p>
            </li>
        </div>
        <div  >
            <li>
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
        <div class="ombra">
            <li>
                <span class="glyphicon glyphicon-arrow-down btn-lg"></span>
                <p><i class="fa fa-fw fa-usd"></i> Summary </p>
            </li>
        </div>
        <div>
            <li>
                <span class="glyphicon glyphicon-arrow-down btn-lg"></span>
                <p><i class="fa fa-fw fa-check"></i> Confirm </p>
            </li>
        </div>
    </ul>
@endsection

@section('content')

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row page-header">
                <div class="col-lg-10 col-md-10">
                    <h3 >
                        Order summary
                    </h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12  col-xs-12 ">
                @php($i=1)
                @php($rawPrice=0)
                @foreach ($order[0]->carrier as $c)

                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="/images/drone-ico2.png" class="img-responsive" >
                                </div>
                                <div class="col-md-4 col-md-offset-1"> <strong>Descrizione prodotto</strong></div>
                                <div class="col-md-4"> <strong>Prezzo</strong></div>
                            </div>
                        </div>
                        <div class="panel-body ">

                        @php($j=1)
                        @foreach ($c->product as $p)
                            <div class="row">
                                <div class="col-md-1 col-md-offset-1">{{$j}}</div>
                                <div class="col-md-4">{{$p->description->description}}</div>
                                <div class="col-md-4">{{$p->description->price}} {{$order[0]->price->currency->currency_symbol}}</div>
                                @php($rawPrice+=$p->description->price)
                            </div>
                        @php($j++)
                        @endforeach
                        </div>
                    </div>
                @endforeach

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2"> <strong>Droni utilizzati: </strong></div>
                                <div class="col-md-4"> {{count($order[0]->carrier)}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"> <strong>Prezzo originale:</strong></div>
                                <div class="col-md-4">{{$order[0]->price->fullValue}} {{$order[0]->price->currency->currency_symbol}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"> <strong>Prezzo prodotti:</strong></div>
                                <div class="col-md-4">{{$rawPrice}} {{$order[0]->price->currency->currency_symbol}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"> <strong>Prezzo trasporto:</strong></div>
                                <div class="col-md-4">{{$order[0]->price->value-$rawPrice}} {{$order[0]->price->currency->currency_symbol}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"> <strong>Sconti/sovrapprezzi applicati:</strong></div>
                                <div class="col-md-4">
                                    @foreach ($order[1] as $o)
                                        <th>
                                            <div>
                                                {{$o[0]}}
                                                {{$o[1]}}
                                            </div>
                                        </th>
                                    @endforeach</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-2"> <strong>Prezzo totale:</strong></div>
                                <div class="col-md-4">{{$order[0]->price->value}} {{$order[0]->price->currency->currency_symbol}}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-offset-lg-8  col-md-2 col-offset-md-8 col-xs-2 col-offset-xs-8">
                    <h3><a id="orderSummaryButton" href="{{ url("/confirm") }}" class="btn btn-primary">Avanti <span class="glyphicon glyphicon-menu-right"></span> </a> </h3>
                </div>
            </div>
        </div>
    </div>



@endsection




