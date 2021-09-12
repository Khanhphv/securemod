@auth()
<div id="paypal-popup" class="modal bottom-sheet">
    <div class="modal-content" style="padding-bottom: 0">
        <h3>RECHARGING VIA PAYPAL</h3>
        <form action="#">
            <div class="row">
                <div class="col s12 blue-text text-darken-2">
                    100 + 2.5% <br>
                    200 + 5% <br>
                    500 + 7.5% <br>
                </div>
                <div class="col s12 m6">
                    <p style="display: grid; grid-template-columns: auto auto auto">
                        <label>
                            <input name="paypal_amount" class="paypal_amount" type="radio" value="5" checked />
                            <span>$5</span>
                        </label>
                        <label>
                            <input name="paypal_amount" class="paypal_amount" type="radio" value="10"/>
                            <span>$10</span>
                        </label>
                        <label>
                            <input name="paypal_amount" class="paypal_amount" type="radio" value="20" />
                            <span>$20</span>
                        </label>
                        <label>
                            <input name="paypal_amount" class="paypal_amount" type="radio" value="50" />
                            <span>$50</span>
                        </label>
                        <label>
                            <input name="paypal_amount" class="paypal_amount" type="radio" value="100"/>
                            <span>$100</span>
                        </label>
                        <label>
                            <input name="paypal_amount" class="paypal_amount" type="radio" value="200"/>
                            <span>$200</span>
                        </label>
                        <label>
                            <input name="paypal_amount" class="paypal_amount" type="radio" value="500"/>
                            <span>$500</span>
                        </label>
                    </p>
                    <span class="helper-text" id="required_message" style="color: red;display: none" data-error="wrong" data-success="right">Please choose package</span>

                </div>
            </div>

            <div class="input-field col s12 m6" style="margin: 0;padding: 0">
                    <div id="paypal-button-container"></div>
            </div>
        </form>
    </div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo App\Option::where('option', 'paypal_id')->join('paypal', 'paypal.id', 'options.value')->get()->first()->client_id ?>&locale=en_US">
</script>
<script !src="">
    let priceArray = [5,10,20,50,100,200,500];
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: $("input[name='paypal_amount']:checked").val()
                    }
                }]
            });
        },
        onInit: function (data, actions) {
            // document.getElementsByClassName("paypal-button-text")[1].style["color"] = "white";
            document.querySelector('.paypal_amount')
                .addEventListener('change', function (event) {
                    if ($("input[name='paypal_amount']:checked").val() > 0) {
                        actions.enable();
                    }
                });
        },
        onClick: function () {
            let price = Number($("input[name='paypal_amount']:checked").val());
            if (price > 0 && priceArray.includes(price)) {
                    $("#required_message").hide();

            } else {
                $("#required_message").show();
            }
        },
        onCancel: function () {
            // $('#processing').hide();
        },
        onError: function () {
            // $('#paypal-button-container').show();
            // $('#processing').hide();
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                $('#paypal-button-container').hide();
                $('#processing').show();
                window.location.href = "/check_order_paypal/" + data.orderID;
            });
        },
        style: {
            layout: 'horizontal'
        },
        locale: 'en_US'
    }).render('#paypal-button-container');

</script>
@endauth
