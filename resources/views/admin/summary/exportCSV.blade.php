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
        <h3 class="box-title">Chart</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form action="">
            <div class="col-md-3 col-xs-12">
                <div class="form-group">
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
                <div class="form-group">
                    <label>Select date: </label>
                    <input type="date" class="form-control" id="date-for-csv" value="{{ now()->format('Y-m-d') }}"  name="start">
                </div>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-default" onclick="statistic()"  style="margin-top: 23px" >
                    Submit
                </button>
            </div>
            <div class="row" id="statistic-day">

            </div>
            <div class="row" id="statistic-week">

            </div>
            <div class="row" id="statistic-month">

            </div>
            <div class="row" id="statistic-year">

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
            error: function () {

            },
            success: function (data) {
                console.log(data);
                let table = $("<table class='table-bordered table-striped'></table>")
                table.append(<tr><td>Package}</td><td>amout</td><td>Money($)</td></tr>)
                data.year.forEach(val => {
                    let el = `<tr><td>${val.package}</td><td>${val.package}</td><td>${val.package}</td></tr>`
                    table.append(el)
                })
                $('#statistic-year').append(table)
            },


        })
    }
</script>
