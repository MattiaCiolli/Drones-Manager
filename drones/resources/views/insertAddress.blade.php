
@extends('layout.app')

@section('title', 'Address')

@section('content')

<!--

<div class=" address-content-external col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-1 ">
    <div class="testo-top-address ">
        <h3><span>Drone</span> manager</h3>
        <p>Seleziona l'indirizzo di destinazione sulla mappa!</p>
    </div>

    <div class="address-content-internal">
        <div class="row">
            <div id="map"></div>
        </div>
        <div class="testo-down row">
            <div class="text_via">
                <p id="text_via"> </p>
                <span id="spanCheckOk" class="glyphicon glyphicon-ok text-success"></span>
                <span id="spanCheckNo" class="glyphicon glyphicon-remove text-danger"></span>

            </div>
            <a id="insertAddressButton" href="{{ url("/insertProduct") }}" class="btn btn-danger btn-lg btn-address disabled">Avanti</a>

        </div>
    </div>
</div>

-->

<div class="address-content col-md-8 col-md-offset-4 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
    <div class="testo-top-product ">
        <h3><span>Drone</span> manager</h3>
        <p>Scegli l'indirizzo di destinazione della consegna!</p>
        <input id="pac-input" class="controls" type="text" placeholder="Ricerca"></input>
    </div>

    <div id="map"></div>
    <div class="row">
        <p id="text_via" class="col-md-5"> </p>
        <span id="spanCheckOk" class="col-md-1 glyphicon glyphicon-ok text-success"></span>
        <span id="spanCheckNo" class="col-md-1 glyphicon glyphicon-remove text-danger"></span>
        <a id="insertAddressButton" href="{{ url("/insertProduct") }}" class="col-md-2 btn btn-danger btn-lg btn-address disabled">Avanti</a>
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
                                    alert(msg);
                                    document.getElementById("spanCheckOk").style.visibility = "visible";
                                    document.getElementById("insertAddressButton").classList.remove('disabled');
                                },
                                error: function(error)
                                {
                                    alert(error);
                                    document.getElementById("spanCheckNo").style.visibility = "visible";

                                }
                            });

                        } else {
                            testo_via.innerHTML = 'Indirizzo non valido, riprova!';
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

<!--
<script>

    $(document).ready(function() {
        $("#CheckButton").click(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var destinationAddress = {
                coorLat: coorLat,
                coorLng: coorLng,
                indirizzo: indirizzo,
                _token: $('input[name=csrf-token]').attr('content') };


            $.ajax({
                type: "POST",
                url: '/insertAddress',
                data:JSON.stringify(destinationAddress),
                dataType: "html",
                success: function()
                {
                    console.log('cia');
                    document.getElementById("spanCheck").style.visibility = "visible";
                    document.getElementById("insertAddressButton").classList.remove('disabled');
                },
                error: function(error)
                {
                    console.log(error);
                }
            });
        });


    });

</script>
-->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFLEnHdk6JE3dEpmAeipOf8J2lGK211XM&libraries=places&callback=initAutocomplete">

</script>

@endsection