
    <div id="stripe-popup"style="max-height: unset" class="modal bottom-sheet">
        <div class="modal-content" style="padding-bottom: 0">
            <h3>RECHARGING VIA STRIPE</h3>
            <form id="stripe-form" action="/stripe-payment" method="get">
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
                        <button type="button" onclick="submitForm()" class="waves-effect waves-light btn">
                            Recharge now
                        </button>
                    </div>
                    <div class="input-field col s12 m6">
                        <div class="input-filed">
                            <label for="autocomplete-input">Name</label>
                            <input id="name" name="name" id="autocomplete-input"
                                   type="text" class="autocomplete validate" required>
                        </div>
                        <div class="input-filed">
                            <label>Country</label>
                            <select onchange="validateSelectbox(event)" required name="country" class="browser-default" id="country" name ="country">

                            </select>
                        </div>
                        <br>
                        <div class="input-filed">
                            <label for="autocomplete-input">State</label>
                            <select onchange="validateSelectbox(event)" required name="state" class="browser-default" id="state" >
                            </select>
                        </div>
                        <br>
                        <div class="input-filed">
                            <label for="autocomplete-input">Post Code</label>
                            <input name="post-code" id="post-code" type="text"
                                   class="autocomplete validate" required>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <script>
        window.onload = function () {
            $.ajax({
                url : "/getCountry",
                dataType : "JSON",
                method: "GET",
                contentType: "application/json; charset=utf-8",
                success : function (response){
                    let country_arr = response.data;
                    let countryElement = document.getElementById("country");
                    countryElement.length = 0;
                    countryElement.options[0] = new Option('Select Country', '-1');
                    countryElement.selectedIndex = 0;
                    for (let i = 0; i < country_arr.length; i++) {
                        countryElement.options[countryElement.length] = new Option(country_arr[i].value, country_arr[i].key);
                    }

                    countryElement.onchange = function () {
                        getStateByCountry($( "#country option:selected" ).text());
                    }

                }
            })
            // populateCountries("", "state");
        }

        function getStateByCountry(country){
            console.log(country);
            $("#country").css("disabled", "disabled");
            $.ajax({
                url : "/getState",
                contentType: "application/json; charset=utf-8",
                data : { 'country': country },
                dataType: "JSON",
                method : "GET",
                success : function (response) {
                    $("#country").css("disabled", false);
                    let stateList = response.data;
                    let stateElem = document.getElementById("state");
                    stateElem.length = 0;
                    stateElem.options[0] = new Option('Select Country', '-1');
                    stateElem.selectedIndex = 0;
                    for (let i = 0; i < stateList.length; i++) {
                        console.log(stateList[i].value)
                        stateElem.options[stateElem.length] = new Option(stateList[i].value, stateList[i].key);
                    }
                }
            })
        }

        function validateSelectbox(e){
            let element = $(e.target)
            element.css("border", "none")
        }
        function submitForm()
        {
            let isOk = true;
            let country = $("#country").val();
            let state = $("#state").val();
            let name = $("#name").val();
            let postCode = $("#post-code").val();

            if (state <= 0) {
                isOk = false;
            }

            if (country <= 0) {
                isOk = false;
            }

            if (postCode <= 0) {
                isOk = false
            }

            if (name <= 0) {
                isOk = false
                $("#name").addClass("invalid")
            }

            if (isOk == false)
            {
                return;
            }

            $("#state").css("border","1px solid red")

            $("#stripe-form").submit();
        }

    </script>

