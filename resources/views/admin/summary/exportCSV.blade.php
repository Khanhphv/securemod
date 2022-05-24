{{--<div class="row">--}}
{{--    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">--}}
{{--        <div class="form-group">--}}
{{--            <label>Select date: </label>--}}
{{--            <input type="date" class="form-control" id="date-for-csv" value="{{ now()->format('Y-m-d') }}"  name="start">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="row">--}}
{{--    <button onclick="exportCSV(type='day')">Export CSV by date</button>--}}
{{--    <button onclick="exportCSV(type='month')">Export CSV by month</button>--}}
{{--    <button onclick="exportCSV(type='year')" type="submit">Export CSV by year</button>--}}
{{--</div>--}}

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Summary</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form action="">
            <div class="row form-group">
                <div class="col-md-3 col-xs-12">
                    <div class="">
                        <label for="">Key</label>
                        @php
                            $tools = \App\Tool::all(['id', 'name']);
                        @endphp
                        <select class="form-control" name="type" id="key-statistic">
                            @foreach($tools as $tool)
                                <option value="{{ $tool["id"] }}">{{$tool["name"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="">
                        <label>Select date: </label>
                        <input type="date" class="form-control" id="date-for-csv" value="{{ now()->format('Y-m-d') }}"  name="start">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <button type="button" class="btn btn-default" onclick="statistic()" >
                        Submit
                    </button>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12" id="statistic-day">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" id="statistic-week">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" id="statistic-month">
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12" id="statistic-year">
                </div>
            </div>
        </form>
        <br>

    </div>
</div>

<script>
    exportCSV = (type) => {
        let date = $('#date-for-csv').val();
        window.open(`internalapi/summary/export-csv?type=${type}&date=${date}`)
    }

    statistic = () => {
        $.ajax({
            url: "internalapi/statistic/key",
            type: 'get',
            data: {
                'key' : $('#key-statistic').val(),
                'date' : $('#date-for-csv').val()
            },
            beforeSend: function () {
                $.LoadingOverlay("show");
            },
            error: function () {

            },
            success: function (data) {
                showData('#statistic-year', data.year)
                showData('#statistic-month', data.month)
                showData('#statistic-week', data.week)
                showData('#statistic-day', data.day)
            },
            complete: function () {
                $.LoadingOverlay("hide");
            }
        })
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        showData = (el, data) => {
            $(el).empty()
            switch (el){
                case '#statistic-year':
                    h1 = 'Year'
                    break
                case '#statistic-month':
                    h1 = 'Month'
                    break
                case '#statistic-week':
                    h1= 'Week'
                    break
                default:
                    h1= "Day"
            }
            $(el).append(`<h3 style="color: ${getRandomColor()}">${h1}</h3>`)

            let table = $("<table class='table table-hover table-bordered table-striped'></table>")
            table.append(`<tr><th>Package</th><th>Amount</th><th>Money($)</th></tr>`)
            table.append('<tbody>')
            if(data.length > 0) {
                let sum = 0
                data.forEach(val => {
                    let el = `<tr><td>${val.package}</td><td>${val.amount}</td><td>${val.money}</td></tr>`
                    table.append(el)
                    sum += val.money
                })
                let el = `<tr><td colspan="2">Total</td><td>${sum}</td></tr>`
                table.append(el)
            } else {
                let el = `<tr><td colspan="3">No data</td></tr>`
                table.append(el)
            }

            table.append('</tbody>')
            $(el).append(table)
        }
    }
</script>
