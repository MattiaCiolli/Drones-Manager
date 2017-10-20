
@extends('layout.app')

@section('title', 'Address')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4 col-sm-3 col-sm-offset-4 col-xs-3 col-xs-offset-4">
                <div class="address-content">
                    <div class="testo-top-product">
                        <h3><span>Drone</span> manager</h3>
                        <p>Seleziona i prodotti da ordinare!</p>
                    </div>

                    <div id="product-container" class="products-content">
                       <div class="product">
                            <div class="row">
                                <input type="hidden" name="id" value="1" class="id-products">
                                <input type="hidden" name="price" value="1.20" class="price-products">
                                <input type="number" class="form-control col-md-1 quantity-products" name="product" min="0" value="1" step="1" >
                                <label for="product" class="col-md-11 col-md-offset-1">Option</label>
                            </div>
                            <hr>
                        </div>
                        <div class="product">
                            <div class="row">
                                <input type="hidden" name="id" value="2" class="id-products">
                                <input type="hidden" name="price" value="3.00" class="price-products">
                                <input type="number" class="form-control col-md-1 quantity-products" name="product" min="0" value="1" step="1" >
                                <label for="product" class="col-md-11 col-md-offset-1">Option</label>
                            </div>
                            <hr>
                        </div>
                        <div class="product">
                            <div class="row">
                                <input type="hidden" name="id" value="3" class="id-products">
                                <input type="hidden" name="price" value="4.80" class="price-products">
                                <input type="number" class="form-control col-md-1 quantity-products" name="product" min="0" value="1" step="1" >
                                <label for="product" class="col-md-11 col-md-offset-1">Option</label>
                            </div>
                            <hr>
                        </div>

                        {{--

                        @foreach ($products as $p)

                            <div class="product">
                                <div class="row">
                                    <input type="hidden" name="id" value="{{$p->id}}" class="id-products">
                                    <input type="number" class="form-control col-md-1 quantity-products" name="product" min="0" value="0" step="1" >
                                    <label for="product" class="col-md-11 col-md-offset-1 ">{{ $p->description }}</label>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                           --}}
                    </div>
                    <div class="testo-down">
                        <div id="text_via"><p>  </p></div>
                        <a target="_blank" ><button id="insertProductsButton" class="btn btn-danger btn-lg btn-product">Invia ordine</button></a>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

$("#insertProductsButton").click(function() {

    quantità_prodotti = $("div").children( ".quantity-products" ).length;
    var product_list_chiave = [];
    var product_list_descr = [];

    for (i = 0; i < quantità_prodotti; i++) {
        valore = $("div").children(".quantity-products")[i].value;

        if (valore != '0') {
            product_list_chiave.push($("div").children(".id-products")[i].value);
            product_list_descr.push($("div").children(".quantity-products")[i].value);
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: host + '/productAnalysis',
        data: {
            productDescriptionID: product_list_chiave,
            productQuantity: product_list_descr
        },
        dataType: "html",
        success: function(msg)
        {
            console.log(msg);
        },
        error: function()
        {
            alert("Invio ordine fallito, si prega di riprovare...");
        }
    });
});

</script>
@endsection