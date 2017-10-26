
@extends('layout.app')

@section('title', 'Products')

@section('content')



<div class="products-content-external col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-1 ">
    <div class="testo-top-product ">
        <h3><span>Drone</span> manager</h3>
        <p>Seleziona i prodotti da ordinare!</p>
    </div>

    <div id="products-content-internal row" >
        <table class="table table-inverse ">
            <thead>
                <tr>
                    <th><strong>Quantity</strong></th>
                    <th><strong>Size</strong></th>
                    <th><strong>Type</strong></th>
                    <th><strong>Description</strong></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                <tr>
                    <div>
                        <th>
                            <div>
                                <input type="hidden" value="{{$p->id}}" class="id-products">
                                <input type="number" class=" form-control quantity-products"  min="0" value="0" step="1" onchange="getOrderPrice()">
                            </div>
                        </th>
                        <th>{{ $p->size }}</th>
                        <th>{{ $p->type }}</th>
                        <th>{{ $p->description }}</th>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <a href="#"><button id="orderConfirmedBtn" class="btn btn-danger btn-lg btn-product">Conferma ordine</button></a>
    </div>
</div>



<script>

$("#orderConfirmedBtn").click(function() {
    document.location.href = "/orderSummary";
});
    function getOrderPrice() {
        var quantità_prodotti = $("div").children(".quantity-products").length;
        var product_list_chiave = [];
        var product_list_descr = [];

        for (i = 0; i < quantità_prodotti; i++) {
            valore = $("div").children(".quantity-products")[i].value;

            if (valore != '0') {
                product_list_chiave.push(parseInt($("div").children(".id-products")[i].value));
                product_list_descr.push(parseInt($("div").children(".quantity-products")[i].value));
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var dati = {
            productDescriptionID: product_list_chiave,
            productQuantity: product_list_descr,
            _token: $('input[name=csrf-token]').attr('content')
        };

        console.log(JSON.stringify(dati));
        console.log(product_list_chiave);

        $.ajax({
            type: "POST",
            url: '/insertProduct',
            data: {
                products: JSON.stringify(dati)
            },
            dataType: "html",
            success: function (msg) {
                console.log(msg);
                document.location.href = "/orderSummary";
            },
            error: function (msg) {
                console.log(msg);
                alert("Invio ordine fallito, si prega di riprovare...");
            }
        });
    }

</script>
@endsection