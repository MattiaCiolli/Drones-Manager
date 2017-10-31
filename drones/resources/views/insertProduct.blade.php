@extends('layout.app')

@section('title', 'Insert products')


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
        <div class="ombra" >
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
    </ul>
@endsection


@section('content')

    <div id="page-wrapper" >

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row page-header">
                <div class="col-lg-10 col-md-10">
                    <h3 >
                        Catalogo dei prodotti
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-edit"></i> Seleziona la quantità desiderata di prodotti per procedere con l'ordine
                        </li>

                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="table-responsive" >
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Quantity</th>
                                <th>Size</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                
	                         @foreach ($products[0] as $p)
                                <tr>
                                    <th>
                                        <div>
                                            <input type="hidden" value="{{$p->id}}" class="id-products">
                                            <input type="number" class=" form-control quantity-products"  min="0" value="0" step="1" >
                                        </div>
                                    </th>
                                    <th>{{ $p->size }}</th>
                                    <th>{{ $p->type }}</th>
                                    <th>{{ $p->description }}</th>
                                    <th>{{ $p->price }} {{ $products[1] }}</th>

	                            </tr>
	                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row total">
                <div class="col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3">
                    <h5 class="fa fa-money" id="prezzoOrdine"> Preventivo: 0 </h5>
                </div>
                <div class="col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3">
                    <h5 class="fa fa-calculator" id="totaleProdotti"> Totale prodotti: 0 </h5>
                </div>
                <div id="drone" class="col-lg-offset-1 col-lg-1 col-md-offset-1 col-md-1">
                      <img src="/images/drone-ico2.png" class="img-responsive"  >
                </div>
                <div class=" col-lg-1  col-md-1">
                    <h5 id="numeroCarrier"> </h5>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-offset-lg-8 col-lg-2   col-md-2 col-offset-md-8 col-xs-2 col-offset-xs-8">
                    <a  id="orderConfirmedBtn" href="{{ url("/orderSummary") }}" class=" btn btn-primary bottoneProd">Avanti <span class="glyphicon glyphicon-menu-right"></span> </a>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection


