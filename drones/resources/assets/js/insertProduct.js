$("#orderConfirmedBtn").click(function() {
    document.location.href = "/orderSummary";
});

$(document).ready(function () {

    $('.quantity-products').change(function () {
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
                var obj = JSON.parse(msg);
                $("#prezzoOrdine").text(obj['totaleOrdine']);
                $("#numeroCarrier").text(obj['numeroCarrier']);
                $("#totaleProdotti").text(obj['totaleProdotti']);
            },
            error: function (msg) {
                console.log(msg);
                alert("Invio ordine fallito, si prega di riprovare...");
            }
        });
    });

});

