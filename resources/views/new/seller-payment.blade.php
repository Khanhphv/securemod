@auth()
    <style>
        .card-content {
            min-height: 170px
        }
    </style>
    <div id="seller-payment" class="modal bottom-sheet">
        <div class="modal-content">
            <h3 class="no-margin-bottom">RECHARGING VIA SELLER:<h3>
            <div class="row">
                Please contact to sellers in list, they will support you!
            </div>

            <div>
            <div class="row">
                @foreach ($list_seller as $seller)
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                        <span class="card-title" style="font-style: italic">{{$seller->seller_name}}</span>
                        <p>Discord: {{ $seller->discord }}</p>
                        <p>Payment options such as: {{ $seller->payment_options }}</p>
                        <a href="{{$seller->more_infomation}}">More Information</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
      </div>
    </form>
  </div>
        </div>
    </div>
    <script !src="">

    </script>
@endauth
