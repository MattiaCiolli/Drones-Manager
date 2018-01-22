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
		</style>
    </head>

    <body>
		<div id="page-wrapper">
	        <div class="container-fluid">
				@foreach ($drones as $drone)
					<div class="row">
					   <h4>Drone {{$drone->diary->id}}</h4>
					   <div class="col-md-12">
						   <table id="drone{{$drone->diary->id}}">
							   <tr>
								   @for($i = 0; $i < 96; $i++)
									   <th>Slot{{$i}}</th>
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
					   <h4>Pilota {{$pilot->diary->id}}</h4>
					   <div class="col-md-12">
						   <table id="pilot1">
							   <tr>
								   @for ($i = 0; $i < 96; $i++)
									   <th>Slot{{$i}}</th>
								   @endfor
							   </tr>
							   <tr>
									@foreach($pilot->diary->slots->sortBy('index') as $slot)
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

				@foreach ($technicians as $technician)
					<div class="row">
					   <h4>Addetti al drone {{$technician->diary->id}}</h4>
					   <div class="col-md-12">
						   <table id="technician1">
							   <tr>
								   @for ($i = 0; $i < 96; $i++)
									   <th>Slot{{$i}}</th>
								   @endfor
							   </tr>
							   <tr>
									@foreach($technician->diary->slots->sortBy('index') as $slot)
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
	        </div>
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
				console.log(data);
				for (var i = data.drones.slot; i < data.drones.slot + data.drones.consecutive; i++) {
					var droneSearch = "#drone" + data.drones.droneId + " td[id='" + i + "']";
					$(droneSearch).css("background-color", "red");
				}
	    	});

  	</script>
</html>
