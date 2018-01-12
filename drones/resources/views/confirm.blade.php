@extends('layout.app')

@section('title', 'New Order')

@section('sidebar')
    @parent
    <!--the sidebar section is utilizing the @parent directive to append (rather than overwriting) content to the layout's sidebar. The @parent directive will be replaced by the content of the layout when the view is rendered.  ???????   -->
    <ul class="nav navbar-nav side-nav menu">
        <div class=" primo-li">
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
        <div class="ombra">
            <li>
                <span class="glyphicon glyphicon-arrow-down btn-lg"></span>
                <p><i class="fa fa-fw fa-usd"></i> Confirm </p>
            </li>
        </div>
    </ul>
@endsection

@section('content')
    <div id="page-wrapper" class="sfondo">
        <div class="container-fluid ">
            <div class="row ">
                <br class="col-lg-8 col-lg-offset-2">
                    <h1 class="continued">Il suo ordine arriverà alle ore:</h1></br>
                    <h1>{{$timeDelivery}}</h1>
                </div>
            </div>
        </div>
    </div>


@endsection