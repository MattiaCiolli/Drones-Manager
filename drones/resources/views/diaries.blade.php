<!doctype html>
<html lang="en">
    <head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <title>Drones Manager - @yield('title')</title>

	    <meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="stylesheet" href="/css/bootstrap.css">
		<link rel="stylesheet" href="/css/app.css">

		<script src="/js/app.js"></script>

		<style>
			table, th, td {
			border: 1px solid black;
			}
			body {
			    margin-top: 0px;
			    background-color: #FFFFFF;
			}
		</style>
    </head>

    <body>
        <div class="container-fluid">
			@foreach ($drones as $drone)
				<div class="row">
					<div class="col-md-12">
						<h4>Drone {{$drone->diary->id}}</h4>
					</div>
				</div>
				<div class="row">
				   <div class="col-md-12">
					   <table id="drone{{$drone->diary->id}}">
						   <tr>
							   @for($i = 0; $i < 96; $i++)
								   <th>{{$i}}</th>
							   @endfor
						   </tr>
						   <tr>
								@foreach($drone->diary->slots->sortBy('index') as $i => $slot)
									@if($slot->state == "reserved")
										<td bgcolor="#ffff00" id="{{$i}}">{{$slot->state}}</td>
									@elseif($slot->state == "busy")
										<td bgcolor="#ff0000" id="{{$i}}">{{$slot->state}}</td>
									@else
										<td bgcolor="#ffffff" id="{{$i}}">{{$slot->state}}</td>
									@endif
								@endforeach
						   </tr>
					   </table>
				   </div>
			   </div>
			   <br>
			@endforeach

			@foreach ($pilots as $pilot)
				<div class="row">
					<div class="col-md-12">
						<h4>Pilota {{$pilot->diary->id}}</h4>
					</div>
				</div>
				<div class="row">
				   <div class="col-md-12">
					   <table id="pilot{{$pilot->diary->id}}">
						   <tr>
							   @for ($i = 0; $i < 96; $i++)
								   <th>{{$i}}</th>
							   @endfor
						   </tr>
						   <tr>
								@foreach($pilot->diary->slots->sortBy('index') as $j => $slot)
									@if($slot->state == "reserved")
										<td bgcolor="#ffff00" id="{{$j}}">{{$slot->state}}</td>
									@elseif($slot->state == "busy")
										<td bgcolor="#ff0000" id="{{$j}}">{{$slot->state}}</td>
									@else
										<td bgcolor="#ffffff" id="{{$j}}">{{$slot->state}}</td>
									@endif
								@endforeach
						   </tr>
					   </table>
				   </div>
			   </div>
			   <br>
			@endforeach

			@foreach ($technicians as $technician)
				<div class="row">
					<div class="col-md-12">
						<h4>Addetti al drone {{$technician->diary->id}}</h4>
					</div>
				</div>
				<div class="row">
				   <div class="col-md-12">
					   <table id="technician{{$technician->diary->id}}">
						   <tr>
							   @for ($i = 0; $i < 96; $i++)
								   <th>&nbsp{{$i}}</th>
							   @endfor
						   </tr>
						   <tr>
								@foreach($technician->diary->slots->sortBy('index') as $p => $slot)
									@if($slot->state == "reserved")
										<td bgcolor="#ffff00" id="{{$p}}">{{$slot->state}}</td>
									@elseif($slot->state == "busy")
										<td bgcolor="#ff0000" id="{{$p}}">{{$slot->state}}</td>
									@else
										<td bgcolor="#ffffff" id="{{$p}}">{{$slot->state}}</td>
									@endif
								@endforeach
						   </tr>
					   </table>
				   </div>
			   </div>
			   <br>
			@endforeach
        </div>
    </body>

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
						var droneSearch = "#drone" + drone.droneId + " td[id='" + i + "']";
						$(droneSearch).css("background-color", "red");
					}
				});

				data.pilots.forEach(function(pilot){
					for (var i = pilot.slot; i < pilot.slot + pilot.consecutive; i++) {
						var droneSearch = "#pilot" + pilot.pilotId + " td[id='" + i + "']";
						$(droneSearch).css("background-color", "red");
					}
				});

				data.technicians.forEach(function(technician){
					for (var i = technician.slot; i < technician.slot + technician.consecutive; i++) {
						var droneSearch = "#technician" + technician.technicianId + " td[id='" + i + "']";
						$(droneSearch).css("background-color", "red");
					}
				});

	    	});

  	</script>
</html>
