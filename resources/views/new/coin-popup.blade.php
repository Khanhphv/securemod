@auth()
    <div id="coin-popup" class="modal bottom-sheet">
        <div class="modal-content">
            <h3 class="no-margin-bottom">RECHARGING VIA COINPAYMENTS (BTC)
                <?php echo (\App\Option::where('option', 'coinpayment_bonus')->first() && \App\Option::where('option', 'coinpayment_bonus')->first()->value === '0') ?
                    '' : (' - Get ' . \App\Option::where('option', 'coinpayment_bonus')->first()->value . '% more') ?></h3>
            <form action="#">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="number" class="validate" type="number" name="amount" id="amount">
                        <label for="amount">Amount</label>
                        <span class="helper-text" id="required_message" style="display: none; color: red" data-error="wrong" data-success="right">Please enter amount</span>
                    </div>
                    <div class="input-field col s12">
                        <button type="button" class="waves-effect waves-light btn"
                                onclick="rechargeCoinPayments()">
                            Recharge now
                        </button>
                    </div>
                    <div class="col s12">
                        <h4>Tutorial</h4>
                        <p>1，Input the values you want recharge</p>
                        <p>2，Payment to order display btc address</p>
                        <p>3，Waiting for payment confirmation BTC will take time, depends on your
                            bitcoin wallet.</p>
                        <p>4，Please calculate the handling fee required for the transfer (the
                            exchange
                            will charge a fee)！</p>
                        <p>5，You need to make sure the actual arrival amount is equal to or greater
                            than
                            the order amount.</p>
                    </div>
                </div>
            </form>


        </div>
    </div>
    <script !src="">
        function rechargeCoinPayments() {
            let amount = $("#amount").val();
            if (amount !== null && amount !== "") {
                window.open('/create-transaction-coinpayments/' + amount, '_blank');
            } else {
                Swal.fire({
                    allowEscapeKey: true,
                    icon : 'error',
                    text: 'Please enter amount'
                });
            }
        }
    </script>
@endauth