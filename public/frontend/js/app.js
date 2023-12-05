const csrf = $('meta[name="csrf-token"]').attr('content');
const emptyCart = $("#empty");
const cartsEl = $("#carts");
let dataSuccess = '';

let priceTotal = $("#total-price");

new AutoNumeric('.numeric', {
    currencySymbol: 'Rp ',
    decimalCharacter : ',',
    digitGroupSeparator : '.',
    decimalPlaces: 0
});

function addCart(id) {
    $.post(`${window.location.origin}/addCart/${id}`, {product: id, _token: csrf}, function(response) {
        updateQty(id, response.cart.qty);
        updateCart(response.carts);
        priceTotal.text(response.cart_total['formatted']);
        total = response.cart_total['raw']
    })
    .fail(function(xhr, status, error) {
        console.error('Request failed. Status:', status);
    });
}

function removeCart(id) {
    $.post(`${window.location.origin}/removeCart/${id}`, {product: id, _token: csrf}, function(response) {
        if (typeof response.cart === 'object') {
            updateQty(id, response.cart.qty);
            updateCart(response.carts);
            priceTotal.text(response.cart_total['formatted']);
            total = response.cart_total['raw']
        }
    })
    .fail(function(xhr, status, error) {
        console.error('Request failed. Status:', status);
    });
}

function updateQty(id, qty) {
    $(`h5[qty-id='${id}']`).text(qty)
}

function updateCart(carts) {
    carts.map(cart => {
        let el = $(`div[cart-id='${cart.id}']`);

        if (el.length && cart.qty < 1) {
            el.remove();
        }

        if (!el.length && cart.qty > 0) {
            var addItem = `<div class="cart-items border-bottom" cart-id="${cart.id}">
                                <div class="cart-image">
                                    <img src="${cart.product.image_link}" class="img-fluid blur-up lazyload" alt="${cart.product.name}">
                                </div>
                                <div class="cart-detail">
                                    <h5 class="cart-product-name name fw-bold cursor-default">
                                        ${cart.product.name}
                                    </h5>

                                    <div class="d-flex justify-content-between">
                                        <h5 class="price fw-bold cursor-default" style="color: #2261FF;"><span style="color: #000;">Rp</span> ${cart.product.price_formatted}</h5>

                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-circle-sm btn-removecart" onClick="removeCart(${cart.product.id})"><i class="fa-solid fa-minus"></i></button>
                                            <h5 class="qty fw-bold cursor-default" style="color: ${cart.product.quantity > 0 ? '#000' : '#A7A7A7'};" qty-id="${cart.product.id}">${cart.product.cart}</h5>
                                            <button class="btn btn-circle-sm btn-addcart" onClick="addCart(${cart.product.id})"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

            cartsEl.append(addItem);
        }
    });

    if ($("div[cart-id]").length) {
        emptyCart.addClass("d-none");
    } else {
        emptyCart.removeClass("d-none");
    }
}

$("#bayar").on("click", function() {
    let paid = AutoNumeric.getAutoNumericElement("#paid").getNumericString();
    let customer_name = $("#customer_name").val();
    let note = $("#note").val();

    const cancelBtn = $("#cancel");
    const payBtn = $("#bayar");

    cancelBtn.prop("disabled", true);
    payBtn.prop("disabled", true);

    $.post('transaction', { _token: csrf, paid: paid, customer_name: customer_name, note: note }, function(response) {
        if (response.status == 'success') {
            afterSuccessPay();
            $('#confirmationModal').modal('hide');
            cancelBtn.prop("disabled", false);
            payBtn.prop("disabled", false);

            dataSuccess = response.data;

            $("#success-total").text(number_format(dataSuccess.amount));
            $("#success-paid").text(number_format(dataSuccess.paid));
            $("#success-exchange").text(number_format(dataSuccess.exchange));

            $("#paymentSuccessModal").modal('show');
        }
        notify('success', response.message);
    }).fail(function(response, status, error) {
        $('#confirmationModal').modal('hide');
        notify('danger', response.responseJSON.message);
        cancelBtn.prop("disabled", false);
        payBtn.prop("disabled", false);
    });
});

function afterSuccessPay() {
    $("#carts").html('');
    emptyCart.removeClass("d-none");
    priceTotal.text('0');
    total = 0;

    $("h5[qty-id]").map(function() {
        $(this).text('0');
    });
}

$("#download").on("click", function() {
    window.location.href = `${window.location.origin}/invoice/${dataSuccess.id}`;
});

$("#showBayarModal").on("click", function() {
    let paid = AutoNumeric.getAutoNumericElement("#paid").getNumericString();
    let exchange = paid - total;
    $("#exchange-plain").text(number_format(exchange));
    $("#paid-plain").text(number_format(paid));

    if (paid < 1) {
        alert('Silahkan isi nominal diterima');
        return;
    }

    if (exchange > -1) {
        $('#confirmationModal').modal('show');
    } else {
        alert('Nominal diterima kurang dari total belanja');
    }
});

function number_format(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function notify(status, message) {
    $.notify(`<i class="fas ${status === 'success' ? 'fa-check' : 'fa-xmark'} me-2"></i></i><strong class="text-capitalize">${status == 'success' ? 'Sukses' : 'Gagal'}</strong> ${message}`, {
        type: status,
        allow_dismiss: true,
        delay: 4000,
        showProgressbar: true,
        timer: 300,
        // timer: 555555500,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }
    });
}

$("#search").on("keyup", function() {
    const txt = $(this).val();
    $('.product-item').each(function(){
        if($(this).attr('product-name').toUpperCase().indexOf(txt.toUpperCase()) != -1){
            $(this).show();
        } else {
            $(this).hide();
        }
     });
})
