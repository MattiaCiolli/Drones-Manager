<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<tbody>
Numero carriers: {{count($order->carrier)}}
@php($i=1)
@php($d="")
@foreach ($order->carrier as $c)
    Prodotti carrier #{{$i++}}:
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
Prezzo: <div>{{$order->price->value}}{{$order->price->currency->currency_symbol}}</div>
Sconti applicati: @if(strpos($order->price->discount, 'P') !== false){{$d.="Sconto lunghezza percorso"}} @elseif(strpos($order->price->discount, 'Q') !== false){{$d.="Sconto quantità"}}@endif
</tbody>
</body>
</html>
