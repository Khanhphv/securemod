@auth()
<div id="lexholding-popup" class="modal bottom-sheet">
    <div class="modal-content" style="padding-bottom: 0">
        <h3>RECHARGING </h3>
        <form action="/charge-via-lexholding" method="post">
            {{csrf_field()}}
            {{-- @csrf <!-- {{ csrf_field() }} --> --}}
            <div class="row">
                <div class="col s12 m6">
                    <p style="display: grid; grid-template-columns: auto auto auto">
                        <label>
                            <input name="amount" class="amount" type="radio" value="5" checked />
                            <span>$5</span>
                        </label>
                        <label>
                            <input name="amount" class="amount" type="radio" value="10"/>
                            <span>$10</span>
                        </label>
                        <label>
                            <input name="amount" class="amount" type="radio" value="20" />
                            <span>$20</span>
                        </label>
                        <label>
                            <input name="amount" class="amount" type="radio" value="50" />
                            <span>$50</span>
                        </label>
                        <label>
                            <input name="amount" class="amount" type="radio" value="100"/>
                            <span>$100</span>
                        </label>
                        <label>
                            <input name="amount" class="amount" type="radio" value="200"/>
                            <span>$200</span>
                        </label>
                        <label>
                            <input name="amount" class="amount" type="radio" value="500"/>
                            <span>$500</span>
                        </label>
                    </p>
                    <span class="helper-text" id="required_message" style="color: red;display: none" data-error="wrong" data-success="right">Please choose package</span>
                    
                </div>
                <button type="submit" class="waves-effect waves-light btn">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    
</script>
@endauth
