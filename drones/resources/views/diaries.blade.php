@extends('layout.app2')

@section('title', 'Diaries')

@section('content')
        <div class="tables">

			<table class="table table-bordered">
				<thead class="thead-light">
					<tr>
					<th scope="col">Orario</th>
					@foreach($drones as $drone)
						<th scope="col">Drone {{$drone->diary->id}}</th>
					@endforeach
					@foreach($pilots as $pilot)
						<th scope="col">Pilota {{$pilot->diary->id}}</th>
					@endforeach
					@foreach($technicians as $tech)
						<th scope="col">Tecnico {{$tech->diary->id}}</th>
					@endforeach
					</tr>
				</thead>
				<tbody>

				@for ($i = 0; $i < 96; $i++)
					<tr>
						<th scope="row">
							@php
								$minTot = $i * config('slot.size');
								$hour = floor($minTot / 60);
								$min = $minTot % 60;
								if($hour<10){
								$hour = "0".$hour;
								}
								if($min<10){
								$min = "0".$min;
								}
								$arrivalTime = "$hour:$min";
							@endphp
							{{$arrivalTime}}
						</th>
						@foreach($drones as $drone)
							@if($drone->diary->slots[$i]->state == "reserved")
								<th class="warning " id="droneId{{$drone->diary->id}}{{$i}}" >{{$drone->diary->slots[$i]->state}}</th>
							@elseif($drone->diary->slots[$i]->state == "busy")
								<th class="danger " id="droneId{{$drone->diary->id}}{{$i}}">{{$drone->diary->slots[$i]->state}}</th>
							@else
								<th class="success " id="droneId{{$drone->diary->id}}{{$i}}">{{$drone->diary->slots[$i]->state}}</th>
							@endif

						@endforeach

						@foreach($pilots as $pilot)

							@if($pilot->diary->slots[$i]->state == "reserved")
								<th class="warning " id="pilotId{{$pilot->diary->id}}{{$i}}">{{$pilot->diary->slots[$i]->state}}</th>
							@elseif($pilot->diary->slots[$i]->state == "busy")
								<th class="danger " id="pilotId{{$pilot->diary->id}}{{$i}}">{{$pilot->diary->slots[$i]->state}}</th>
							@else
								<th class="success " id="pilotId{{$pilot->diary->id}}{{$i}}">{{$pilot->diary->slots[$i]->state}}</th>
							@endif

						@endforeach
						@foreach($technicians as $tech)

							@if($tech->diary->slots[$i]->state == "reserved")
								<th class="warning" id="technicianId{{$tech->diary->id}}{{$i}}">{{$tech->diary->slots[$i]->state}}</th>
							@elseif($tech->diary->slots[$i]->state == "busy")
								<th class="danger " id="technicianId{{$tech->diary->id}}{{$i}}">{{$tech->diary->slots[$i]->state}}</th>
							@else
								<th class="success " id="technicianId{{$tech->diary->id}}{{$i}}">{{$tech->diary->slots[$i]->state}}</th>
							@endif

						@endforeach
					</tr>
				@endfor

				</tbody>
			</table>
        </div>

@endsection

	<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

	<script>
		    // Enable pusher logging - don't include this in production
		    Pusher.logToConsole = true;

		    var pusher = new Pusher('ff7f1ded2e6e8d88da43', {
		    	cluster: 'eu',
		    	encrypted: true
		    });

	    	var channel = pusher.subscribe('my-channel');

			channel.bind("App\\Events\\ResourcesReserved", function(data) {
				data.drones.forEach(function(drone){
					for (var i = drone.slot; i < drone.slot + drone.consecutive; i++) {
						var droneSearch = "#droneId" + drone.droneId + "" + i;
                        $(droneSearch).addClass("danger");
						$(droneSearch).html("busy");
					}
				});

				data.pilots.forEach(function(pilot){
					for (var i = pilot.slot; i < pilot.slot + pilot.consecutive; i++) {
						var pilotSearch = "#pilotId" + pilot.pilotId + "" + i;
						$(pilotSearch).addClass("danger");
                        $(pilotSearch).html("busy");
					}
				});

				data.technicians.forEach(function(technician){
					for (var i = technician.slot; i < technician.slot + technician.consecutive; i++) {
						var techSearch = "#technicianId" + technician.technicianId + "" + i;
						$(techSearch).addClass("danger");
                        $(techSearch).html("busy");
					}
				});

	    	});

  	</script>

<script>

    oreMin = new Array();

    for(i=0; i<96; i++){
        minTot = i * 15;
        ore = Math.round(minTot / 60);
        minuti = minTot%60;
        oreMin[i] = ore+":"+minuti;
	}

</script>
