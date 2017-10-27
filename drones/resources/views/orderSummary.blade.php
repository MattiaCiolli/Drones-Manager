<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<tbody>
Numero carriers: {{count($order[0]->carrier)}}
@php($i=1)
@php($rawPrice=0)
@foreach ($order[0]->carrier as $c)
    Prodotti carrier #{{$i++}}:
    <div>
        @foreach ($c->product as $p)
            <th>
                <div>
                    {{$p->description->description}}
                    {{$p->description->price}}
                    @php($rawPrice+=$p->description->price)
                </div>
            </th>
        @endforeach
    </div>
@endforeach
Prezzo originale:
<div>{{$order[0]->price->fullValue}}{{$order[0]->price->currency->currency_symbol}}</div>
Prezzo totale:
<div>{{$order[0]->price->value}}{{$order[0]->price->currency->currency_symbol}}</div>
Prezzo prodotti:
<div>{{$rawPrice}}{{$order[0]->price->currency->currency_symbol}}</div>
Prezzo trasporto:
<div>{{$order[0]->price->value-$rawPrice}}{{$order[0]->price->currency->currency_symbol}}</div>
Sconti applicati:

@foreach ($order[1] as $o)
    <th>
        <div>
            {{$o[0]}}
            {{$o[1]}}
        </div>
    </th>
@endforeach
</tbody>
</body>
</html>
