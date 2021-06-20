@extends('adminlte::page')

@section('title', 'Sumary')


@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Money</a></li>
            <li class=""><a href="#tab_2" id="tab-2" data-toggle="tab" aria-expanded="false">Top Key</a></li>
            <li class="" id="tab-3"><a href="#tab_3" data-toggle="tab" aria-expanded="false">Key</a></li>

        </ul>
        <div class="tab-content" style="display: flex">
                <div  class="tab-pane active" id="tab_1">
                    <div id="tabs">
                        <ul>
                            <li><a href="?type=week">Week</a></li>
                            <li><a href="?type=month">Month</a></li>
                            <li><a href="?type=year">Year</a></li>
                        </ul>
                        <div id="tabs-1">
                            <canvas id="areaChart" style="display: block; width: 1428px; height: 714px;" height="266"
                                    width="846"></canvas>
                        </div>
                    </div>
                </div>
                <div class="tab-pane row col-md-12" id="tab_2">
                    <div class="row">
                        <div class="col-md-3 col-xs-4">
                            <div class="form-group">
                                <label>Filter by </label>
                                <select class="form-control" name="" id="top-key-type" onchange="showType()">
                                    <option value="month">Month</option>
                                    <option value="day">Date</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-4">
                            <div class="form-group selection-day" style="display:none;">
                                <label>Select date: </label>
                                <input type="date" class="form-control" value="{{ now()->format('Y-m-d') }}" onchange="showType()" name="start" style=" margin-left: 10px">
                            </div>
                            <div class="form-group selection-month">
                                <label>Select month </label>
                                <select class="form-control" name="start" onchange="showType()" id="">
                                    @for($i = 1; $i <=12; $i++ )
                                        <option value="{{ now()->year }}-{{$i >= 10 ? $i : '0'. $i}}-01">{{ date('F', mktime(0, 0, 0, $i, 10))  }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
{{--                        <div class="col-md-3 col-xs-4">--}}
{{--                            <button type="button" class="btn btn-warning" onclick="showType()">Thống kê</button>--}}
{{--                        </div>--}}
                    </div>
                    <secction class="content-header">
                        <h2 class="text-center"> Top 5 keys in month</h2>
                    </secction>
                    <div class="row" style="display: flex; justify-content: center; padding-bottom: 25px">
                        <div class="">
                            <div id="canvas-holder">
                                <canvas id="chart-area" style="display: block;" width="600" height="500" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                        <div class="">
                            <table class="top-key table table-striped">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane col-md-12" id="tab_3">
                    <div id="tabs_3" class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Keys overview</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select date: </label>
                                            <input type="date" class="form-control" value="{{ now()->format('Y-m-d') }}" onchange="selectDay(event.target.value)" name="start">
                                            <i></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="table-responsive table-bordered table-striped">
                                    <div class="form-group">
                                        <table id="table-sold-key" class="table no-margin">
                                            <thead>
                                            <tr>
                                                <th>Tool</th>
                                                <th>Group</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            </div>
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
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="">Type</label>
                                                    <select class="form-control" name="type" id="" onchange="summaryKey()">
                                                        <option value="year">year</option>
                                                        <option value="month">month</option>
                                                        <option value="week">week</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tool</label>
                                                    <select class="form-control select2 select2-hidden-accessible" onchange="summaryKey()" name="key" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                        @foreach( $tools as $tool)
                                                            <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-default" id="detail-button" onclick="detail()" data-toggle="modal" style="margin-top: 23px" data-target="#modal-default">
                                                    Overview detail
                                                </button>
                                            </div>
                                </form>
                                    <br>
                                    <div id="tabs-1">
                                        <canvas id="areaChartKey" style="display: block; width: 1428px; height: 714px;" height="266"
                                                width="846"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-6">
                            <select class="form-control" id="key-detail" onchange="detail()">
                                <option value="">--</option>
                                @foreach( $tools as $tool)
                                    <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="startDate" onchange="detail()">
                                    <option value="">--</option>
                                @for($i = 1; $i <=12; $i++ )
                                    <option value="{{ now()->year }}-{{$i >= 10 ? $i : '0'. $i}}-01"> {{ date('F', mktime(0, 0, 0, $i, 10))  }}</option>
                                    @endfor
                            </select>
                        </div>
                        <table class="table table-bordered" id="detail">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Package</th>
                                    <th>Amount</th>
                                    <th>Money</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <h3>Sum: <b id="sum-key"></b></h3>
                        <h3>Money: <b id="sum-money"></b></h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <script>
        function detail() {
            $('#modal-default h4').text('Chi tiết')
            let table =$('#detail tbody');
            $('#sum-key').text(0);
            $('#sum-money').text(0);
            table.empty();
            if (!$('select[name="type"]')[0].value || !$('#key-detail')[0].value) {
                return;
            }
            $.ajax({
                url: "internalapi/summarykey",
                type: "get",
                data: {
                    'type' : $('select[name="type"]')[0].value,
                    'key' : $('#key-detail')[0].value,
                    'startDate' : $('select[name="startDate"]')[0].value,
                    'condition' : 2
                },
                success: function (result, textStatus, request) {
                    let sum = 0;
                    let totalMoney = 0;
                    data = result.data.data;
                    data.sort(function(a,b){
                        return a.package - b.package
                    })
                    data.forEach((e, index) => {
                        let row = document.createElement('tr');
                        sum += e.amount;
                        totalMoney += e.money;
                        row.innerHTML =  '<td>' + index + '<td>' + e.package + '</td>' + '<td>' + e.amount + '</td>' + '<td>' + e.money + '</td>'
                        table.append(row);
                    })
                    $('#sum-key').text(sum);
                    $('#sum-money').text(totalMoney);
                }
            })
        }
    </script>
    <script>
        var lineChartArea = null;
        var pieChartArea = null;
        var chartColor = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };
        var data = {!!json_encode($summary) !!};
        var labelConfig = data.map(e=> {
            if( Number.isInteger(e.data)){
                return 'Tháng' + e.data;
            }
            return  e.data
        });
        var money = data.map(e =>  e.money); // tien nap
        var revenue = data.map(e => e.revenue); // tien lai
        var config = {
            type: 'line',
            data: {
                labels: labelConfig,
                datasets: [{
                    label: 'Income',
                    fill: false,
                    backgroundColor: 'rgb(255, 159, 64)',
                    borderColor: 'rgb(255, 159, 64)',
                    data: money,
                },{
                    label: 'Interest',
                    fill: false,
                    backgroundColor: chartColor.blue,
                    borderColor: chartColor.blue,
                    data: revenue,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Money overview'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: ''
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        };

        window.onload = function () {
            $('.select2').select2();
            selectDay('{{ now()->format('Y-m-d') }}');
            var ctx = document.getElementById('areaChart').getContext('2d');
            window.myLine = new Chart(ctx, config);

            $('#tab-3').click(function () {
                summaryKey()
            })
            $('#tab-2').click(function () {
                showType();
            })
        };

        function showType() {
            let pieChart = document.getElementById('chart-area').getContext('2d');
            let requestData;
            let type = $('#top-key-type')[0].value;
            let table = $('.top-key tbody');
            if (pieChartArea) {
                pieChartArea.destroy()
            }
            table.empty();
            if (type === 'month') {
                $('#tab_2 .selection-month').show();
                $('#tab_2 .selection-day').hide();
                requestData = {
                    'type' : type,
                    'start' : $('#tab_2 .selection-month select')[0].value
                }
            } else {
                $('#tab_2 .selection-month').hide();
                $('#tab_2 .selection-day').show();
                requestData = {
                    'type' : type,
                    'start' : $('#tab_2 .selection-day input')[0].value
                }
            }

            $.ajax({
                url: "internalapi/topkey",
                type: "get",
                data: requestData,
                success: function (data, textStatus, request) {
                    if (data.length == 0) {
                        alert("Không có dữ liệu")
                    }
                    let keyLabel = data.map(e => e.name);
                    let countLabel = data.map(e => e.count);
                    var config = {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: countLabel,
                                backgroundColor: [
                                    '#36a2eb',
                                    '#4bc0c0',
                                    '#ffcd56',
                                    '#ff9f40',
                                    '#ff6384',
                                ],
                                label: 'Top keys in month',
                            }],
                            labels: keyLabel
                        },
                        options: {
                            responsive: false
                        }
                    };
                    pieChartArea = new Chart(pieChart, config);
                    data.forEach(e => {
                        let row = document.createElement('tr');
                        row.innerHTML = '<td>' + e.name + '</td>' + '<td>' + e.count + '</td>'
                        table.append(row);
                    })
                }
            })

        }
        function summaryKey() {
            if ($('select[name="type"]')[0].value !== 'year') {
                $('#detail-button').hide();
            } else {
                $('#detail-button').show();
            }
            if (lineChartArea) {
                lineChartArea.destroy()
            }
            if($('select[name="key"]').val().length === 0) {
                return;
            }
            $.ajax({
                url: "internalapi/summarykey",
                type: "get",
                data: {
                    'type' : $('select[name="type"]')[0].value,
                    'key' : $('select[name="key"]').val().join(','),
                },
                success: function (data, textStatus, request) {
                    let lineChart = document.getElementById('areaChartKey').getContext('2d');
                    let labelConfig = data.data.map(e=> {
                        if( Number.isInteger(e.date)){
                            return 'Tháng' + e.date;
                        }
                        return  e.date
                    });
                    let summaryKey = buildDataForLineChart(data.data.map(e=> e.data));

                    let config = {
                        type: 'line',
                        data: {
                            labels: labelConfig,
                            datasets: summaryKey
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Keys overview'
                            },
                            tooltips: {
                                mode: 'index',
                                intersect: false,
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            },
                            scales: {
                                xAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: ''
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Value'
                                    }
                                }]
                            }
                        }
                    };
                    lineChartArea = new Chart(lineChart, config);
                }
            });

        }
        function buildDataForLineChart(data) {
            let tools = {!!json_encode($tools) !!};
            let arrayData = [];
            data[0].forEach((key, index) => {
                let label = tools.filter(tool => tool.id === key.id)[0].name;
                let color = getRandomColor();
                let tmp = {
                    label: label,
                    fill: false,
                    backgroundColor: color,
                    borderColor: color,
                    data : []
                }
                data.forEach((value) => {
                    tmp.data.push(value[index].count);
                })
                arrayData.push(tmp);
            })
            return arrayData;
        }

        function selectDay(startDate) {
            let listColor = ['#1abc9c', '#8e44ad', '#2c3e50', '#341f97', '#f39c12', '#2ecc71', '#95a5a6'];
            $.ajax({
                url : 'internalapi/solvedKey',
                type : 'get',
                data : {
                    'type' : 'day',
                    'startDate' : startDate
                },
                success : function(data, status, request) {
                    let table = $('#table-sold-key tbody')
                    table.empty();
                    let previousElement;
                    if (data.result === false) {
                        alert('something wrong');
                    } else {
                        data = data.data;
                        let i = 0;
                        if (data.length === 0) {
                            let tr = document.createElement('tr');
                            tr.innerHTML = '<td>' + 'No data' + '<td>';
                            table.append(tr);
                        }
                        data.forEach((element ,index) => {
                            let row = document.createElement('tr');
                            if(previousElement && element.id !== previousElement.id) {
                                i = i + 1;
                            }
                            if (i >= listColor.length) {
                                i = 0;
                            }
                            row.style.backgroundColor = listColor[i];
                            row.style.color = "#fff"
                            row.innerHTML = '<td>' + element.name + '</td>' + '<td>' + element.package + '</td>' + '<td>'
                                + element.soLuong + '</td>' + '<td>' + (element.sum !== null ? element.sum.toFixed(2) : '0') + '</td>'
                            table.append(row);
                            previousElement = {...element};
                        })
                    }
                }
            })
        }
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>


@stop
