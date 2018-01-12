@extends('layout.app')

@section('title', 'Insert address')

@section('sidebar')
    @parent
    <!--the sidebar section is utilizing the @parent directive to append (rather than overwriting) content to the layout's sidebar. The @parent directive will be replaced by the content of the layout when the view is rendered.  ???????   -->
    <ul class="nav navbar-nav side-nav menu">
        <div class=" primo-li ">
            <li>
                <p><i class="fa fa-fw fa-plus"></i> New order</p>
            </li>
        </div>
        <div class="ombra" >
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

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row page-header">
                <div class="col-lg-9 col-md-9">
                    <h3 >
                        Destination address
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-codepen"></i> Address
                        </li>
                        <li class="active">
                            <i class="fa fa-map-marker"></i> Scegli l'indirizzo di destinazione della consegna
                        </li>
                        <li class="active " id="text_via" class="">
                            <i class="fa fa-home"></i>
                        </li>
                        <li>
                            <span id="spanCheckOk" class=" glyphicon glyphicon-ok text-success"> Indirizzo valido!</span>
                            <span id="spanCheckNo" class="glyphicon glyphicon-remove text-danger"> Indirizzo non valido! Riprovare! </span>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12 col-sm-12  col-xs-12 ">
                    <input id="pac-input" class="controls" type="text" placeholder="Ricerca"></input>
                    <div id="map"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-offset-lg-8  col-md-2 col-offset-md-8 col-xs-2 col-offset-xs-8">
                    <a id="insertAddressButton" href="{{ url("/insertProduct") }}" class="btn btn-primary bottone">Avanti <span class="glyphicon glyphicon-menu-right"></span> </a>
                </div>
            </div>
        </div>
    </div>


    <script>

        var indirizzo="";
        var coorLng=0;
        var coorLat=0;

        function initAutocomplete() {
            var uluru = {lat: 42.367, lng: 13.351};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: uluru,
                zoom: 17,
                mapTypeId: 'roadmap'
            });

            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }

                    var input = String(place.geometry.location);
                    var geocoder = new google.maps.Geocoder;
                    var infowindow = new google.maps.InfoWindow;
                    var coordinate= input.substring(1, input.length-2);
                    var latlngStr = coordinate.split(',',2);
                    var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
                    var testo_via = document.getElementById("text_via");
                    geocoder.geocode({'location': latlng}, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                testo_via.innerHTML = results[0].formatted_address;
                                indirizzo=results[0].formatted_address;
                                coorLng=parseFloat(latlngStr[1]);
                                coorLat=parseFloat(latlngStr[0]);

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });


                                var destinationAddress = {
                                    coorLat: coorLat,
                                    coorLng: coorLng,
                                    indirizzo: indirizzo,
                                    _token: $('input[name=csrf-token]').attr('content')
                                };

                                console.log(destinationAddress);
                                $.ajax({
                                    type: "POST",
                                    url: '/insertAddress',
                                    //data:JSON.stringify(destinationAddress),
                                    data:{
                                        address: JSON.stringify(destinationAddress)
                                    },
                                    dataType: "html",
                                    success: function(msg)
                                    {
                                        var data = jQuery.parseJSON(msg);
                                       if ( data.addressIsValid == true){
                                           document.getElementById("spanCheckOk").style.visibility = "visible";
                                           document.getElementById("spanCheckNo").style.visibility = "hidden";
                                           document.getElementById("insertAddressButton").style.visibility = "visible";
                                       }else{
                                           document.getElementById("spanCheckNo").style.visibility = "visible";
                                           document.getElementById("spanCheckOk").style.visibility = "hidden";
                                           document.getElementById("insertAddressButton").style.visibility = "hidden";
                                       }
                                    },
                                    error: function(error)
                                    {
                                        alert(error);
                                        document.getElementById("spanCheckNo").style.visibility = "visible";
                                        document.getElementById("spanCheckOk").style.visibility = "hidden";
                                        document.getElementById("insertAddressButton").style.visibility = "hidden";
                                    }
                                });

                            } else {
                                testo_via.innerHTML = 'Indirizzo non valido, riprova!';
                                document.getElementById("spanCheckNo").style.visibility = "visible";
                                document.getElementById("insertAddressButton").style.visibility = "hidden";
                            }
                        } else {
                            testo_via.innerHTML = 'Geocoder failed due to: ' + status;
                        }
                    });
                });
                map.fitBounds(bounds);
            });
        }

    </script>


    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFLEnHdk6JE3dEpmAeipOf8J2lGK211XM&libraries=places&callback=initAutocomplete">

    </script>

@endsection