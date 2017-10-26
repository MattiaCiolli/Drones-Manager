<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
brau
<tbody>
Numero carriers: {{count($order->carrier)}}
@foreach ($order->carrier as $c)
        <div>
            @foreach ($c->product as $p)
            <th>
                <div>
                {{$p->description->description}}
                {{$p->description->price}}
                </div>
            </th>
            @endforeach
        </div>
@endforeach
<div>{{$order->price->value}}</div>
</tbody>
</body>
</html>
