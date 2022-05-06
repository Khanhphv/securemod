@auth()
    <div id="coin-popup" class="offcanvas offcanvas-start" tabindex="-1" aria-labelledby="coin-popup">
        <div class="offcanvas-body">
            <h3 class="no-margin-bottom">RECHARGING VIA COINPAYMENTS (BTC)</h3>
            <span>
                <?php
                $coinPayment = \App\Option::where('option', 'coinpayment_bonus')->first();
                ?>
                @if(isset($coinPayment) && ($coinPayment->value !== '0'))
                    (Get '  {{ $coinPayment->value }} '% more)
                @endif
            </span>
            <form action="#">
                <div class="row mt-3">
                    <div class="input-field">
                    <label>Choose the amount you want to deposit</label>
                    <select class="browser-default w-100" name="amount" id="amount">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="500">500</option>
                    </select>
                    <span class="helper-text" id="required_message" style="display: none; color: red" data-error="wrong" data-success="right">Please enter amount</span>         
                    </div>
                    <label>Currency</label>
                    <div class="col-12">
                        <select class="browser-default w-100" id="currency">
                        @foreach (config('const.coin_currencies') as $key => $currencies)
                            <option value="{{$currencies['value']}}">{{$currencies['title']}}</option>
                        @endforeach
                        </select>
                    </div>
                    
                    <br>
                    <div class="input-field mt-3 mb-3">
                        <button type="button" class="btn btn-primary"
                            onclick="rechargeCoinPayments()">
                        Recharge now
                    </button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m8">
                        <h4>Tutorial</h4>
                        <p>1，Choose the values and select coin you want recharge</p>
                        <p>2，Payment to order display address</p>
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
            let currency = $('#currency').val();
            let amount = $("#amount").val();
            if (amount !== null && amount !== "") {
                window.open('/create-transaction-coinpayments?amount=' + amount + '&currency=' + currency, '_blank');
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
