@extends('layout.app')

@section('title', 'New Order')

@section('sidebar')
    @parent
    <!--the sidebar section is utilizing the @parent directive to append (rather than overwriting) content to the layout's sidebar. The @parent directive will be replaced by the content of the layout when the view is rendered.  ???????   -->
    <ul class="nav navbar-nav side-nav menu">
        <div class=" primo-li ombra">
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
                <div class="col-lg-12">
                    <h3 class="page-header">New order </h3>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-codepen"></i> Drones manager
                        </li>
                        <li class="active">
                            <i class="fa fa-plus"></i> Clicca sul bottone per iniziare un nuovo ordine
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-3 col-xs-4 col-xs-offset-3">
                    <a href="{{ url("/insertAddress") }}"><button class="btn btn-primary btnOrder">Nuovo ordine</button></a>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection