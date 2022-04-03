@auth()
    <div class="offcanvas offcanvas-start" tabindex="-1" id="seller-payment" aria-labelledby="seller-payment">
        <div class="offcanvas-body">
            <h4 class="no-margin-bottom">RECHARGING VIA SELLER:</h4>
            <span>Please contact to sellers in list, they will support you!</span>

            <div class="mt-3">
                @foreach ($list_seller as $seller)
                 <div class="row mb-3">
                    <div class="card-custom w-100 pt-2 pb-2">
                        <div class="card-content">
                            <span class="card-title text-success" style="font-style: italic">{{$seller->seller_name}}</span>
                            <p>Discord: {{ $seller->discord }}</p>
                            <p>Payment options such as: {{ $seller->payment_options }}</p>
                            <a target="_blank" href="{{$seller->more_infomation}}">More Information</a>
                        </div>
                    </div>
                 </div>
                @endforeach
      </div>
    </form>
  </div>
        </div>
    </div>
    <script !src="">

    </script>
@endauth
