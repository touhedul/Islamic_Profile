@extends('layouts.user')
@section('title')
    Salat
@endsection


@section('content')
{{--Salat Table--}}
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table id="salat-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Fajr</th>
                    <th>Zuhr</th>
                    <th>Asr</th>
                    <th>Maghrib</th>
                    <th>Isha</th>
                    <th>Witr</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userSalat as $us)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{\App\Helpers\UserHelper::salatPerform($us->fajr)}}</td>
                        <td>{{\App\Helpers\UserHelper::salatPerform($us->zuhr)}}</td>
                        <td>{{\App\Helpers\UserHelper::salatPerform($us->asr)}}</td>
                        <td>{{\App\Helpers\UserHelper::salatPerform($us->maghrib)}}</td>
                        <td>{{\App\Helpers\UserHelper::salatPerform($us->isha)}}</td>
                        <td>{{\App\Helpers\UserHelper::salatPerform($us->witr)}}</td>
                        <td>{{date('d-m-Y', strtotime($us->created))}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <br><br><br>
        </div>
    </div>
    {{--Single Salat button--}}
    <div class="row">
        <div class="col-md-2">
            <button id="fajr" value="fajr" class="btn btn-block btn-primary">Fajr</button>
        </div>
        <div class="col-md-2">
            <button id="zuhr" value="zuhr" class="btn btn-block btn-primary">Zuhr</button>
        </div>
        <div class="col-md-2">
            <button id="asr" value="asr" class="btn btn-block btn-primary">Asr</button>
        </div>
        <div class="col-md-2">
            <button id="maghrib" value="maghrib" class="btn btn-block btn-primary">Maghrib</button>
        </div>
        <div class="col-md-2">
            <button id="isha" value="isha" class="btn btn-block btn-primary">Isha</button>
        </div>
        <div class="col-md-2">
            <button id="witr" value="witr" class="btn btn-block btn-primary">Witr</button>
        </div>
    </div>
    <br>
    {{--Pie Chart--}}
    <div id="chartContainer" style="height: 400px; width: 100%;"></div>
    <br>
    {{--Single Salat Table--}}
    <div style="display: none" id="single-salat-div" class="row justify-content-center">
        <div class="col-md-6">
            <table class="table table-bordered table-info table-striped " id="single-salat-table"
                   style="width:100%">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th id="salat-name"></th>
                    <th>Date</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody id="show">
                </tbody>
            </table>
            <br>
            <button id="hide-single-salat" class="btn btn-dark">Hide Table</button>
        </div>
        {{--Single Salat Change Performance--}}
        <div class="col-md-3">
            <br><br>
            <form style="display: none" id="salat-change" action="{{route('salat.performe.change')}}" method="POST">
                @csrf
                <select name="salat-performe">
                    <option value="dz">Done with Zamat</option>
                    <option value="dwz">Done witrout Zamat</option>
                    <option value="dk">Done Kaza</option>
                    <option value="nd">Not Done</option>
                </select>
                <input type="hidden" name="salat-change-id" id="salat-change-id" value=""/>
                <input type="hidden" name="salat-change-name" id="salat-change-name" value=""/>
                <button type="submit" class="btn btn-info">Save</button>
            </form>
            {{--Single witr Salat Change Performance--}}
            <form style="display: none" id="witr-salat-change" action="{{route('salat.performe.change')}}"
                  method="POST">
                @csrf
                <select id="witr-salat" name="salat-performe">
                    <option value="dt">Done in Time</option>
                    <option style="display: none"
                    </option>
                    <option value="dk">Done Kaza</option>
                    <option value="nd">Not Done</option>
                </select>
                <input type="hidden" name="salat-change-id" id="witr-salat-change-id" value=""/>
                <input type="hidden" name="salat-change-name" id="witr-salat-change-name" value=""/>
                <button type="submit" class="btn btn-info">Save</button>
            </form>
        </div>
    </div>

@endsection
@section('script')
    {{--DataTable--}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    {{--PieChart--}}
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>


    <script type="text/javascript">

        $(document).ready(function () {
            $("#salat-table").DataTable();

            // Single Salat Button
            $("#fajr").click(function (data) {
                var salat = $("#fajr").val();
                $.getValue(salat);
                //hide the salat change form
                $("#salat-change").hide();
                $("#witr-salat-change").hide();
            });
            $("#zuhr").click(function (data) {
                var salat = $("#zuhr").val();
                $.getValue(salat);
                $("#salat-change").hide();
                $("#witr-salat-change").hide();
            });
            $("#asr").click(function (data) {
                var salat = $("#asr").val();
                $.getValue(salat);
                $("#salat-change").hide();
                $("#witr-salat-change").hide();
            });
            $("#maghrib").click(function (data) {
                var salat = $("#maghrib").val();
                $.getValue(salat);
                $("#salat-change").hide();
                $("#witr-salat-change").hide();
            });
            $("#isha").click(function (data) {
                var salat = $("#isha").val();
                $.getValue(salat);
                $("#salat-change").hide();
                $("#witr-salat-change").hide();
            });
            $("#witr").click(function (data) {
                var salat = $("#witr").val();
                $.getValue(salat);
                $("#salat-change").hide();
                $("#witr-salat-change").hide();
            });
            // Hide Single Table
            $("#hide-single-salat").click(function (data) {
                $("#single-salat-div").hide();
            });

            //get the salat value to show in table
            $.getValue = function (salat) {
                $("#single-salat-div").show();
                $("#salat-name").text(salat.toUpperCase());
                $.get("/single-salat/" + salat, {salat: salat}, function (data) {
                    $('#show').html(data);
                    $("#single-salat-table").DataTable();
                    //Pie Chart call
                    $.get("salat/count", {salat: salat}, function (data) {
                        $.pieChart(data, salat);
                    });

                    // salat performe change button
                    $(".salat-change-btn").each(function () {
                        $(this).click(function (e) {
                            e.preventDefault();
                            var salat_id = $(this).val();
                            //get the performe of salata
                            $.get("{{route('salat.performe')}}", {
                                'salat_id': salat_id,
                                'salat': salat
                            }, function (data) {
                                //set the selection according to data
                                if (salat == "witr") {
                                    $("#witr-salat-change").show();
                                } else {
                                    $("#salat-change").show();
                                }
                                if (data == "dz" || data == "dt") {
                                    $('select').prop('selectedIndex', 0);
                                } else if (data == "dwz") {
                                    $('select').prop('selectedIndex', 1);
                                } else if (data == "dk") {
                                    $('select').prop('selectedIndex', 2);
                                } else if (data == "nd") {
                                    $('select').prop('selectedIndex', 3);
                                }
                            });
                            $("#salat-change-id").val(salat_id);
                            $("#salat-change-name").val(salat);
                            $("#witr-salat-change-id").val(salat_id);
                            $("#witr-salat-change-name").val(salat);
                        });
                    });


                });
            }
            // Change Salat Performe
            $("#salat-change").on('submit', function (e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.ajax({
                    type: post,
                    url: url,
                    data: data,
                    dataTy: 'json',
                    success: function (salatName) {
                        $.getValue(salatName);
                        swal("Successful", "Change Successful", "success");
                    }
                });
            });
            //witr salat change performe
            $("#witr-salat-change").on('submit', function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.ajax({
                    type: post,
                    url: url,
                    data: data,
                    dataTy: 'json',
                    success: function (salatName) {
                        $.getValue(salatName);
                        swal("Successful", "Change Successful", "success");
                    }
                });
            });
            //Pie Chart
            $.pieChart = function (data, salat) {
                var doneZamat = data.dz;
                var doneWithoutZamat = data.dwz;
                var donekaza = data.dk;
                var doneInTime = data.dt;
                var notDone = data.nd;

                if (salat == "witr") {
                    var options = {
                        exportEnabled: true,
                        animationEnabled: true,
                        title: {
                            text: "Your Salat PerFormance"
                        },
                        legend: {
                            horizontalAlign: "right",
                            verticalAlign: "center"
                        },
                        data: [{
                            type: "pie",
                            showInLegend: true,
                            toolTipContent: "<b>{name}</b>: (#percent%)",
                            indexLabel: "{name}",
                            legendText: "{name} (#percent%)",
                            indexLabelPlacement: "inside",
                            dataPoints: [
                                {y: notDone, name: "Not Done"},
                                {y: donekaza, name: "Done In Kaza"},
                                {y: doneInTime, name: "Done In Time"},
                            ]
                        }

                        ]
                    };

                    $("#chartContainer").CanvasJSChart(options);

                } else {
                    var options = {
                        exportEnabled: true,
                        animationEnabled: true,
                        title: {
                            text: "Your Salat PerFormance"
                        },
                        legend: {
                            horizontalAlign: "right",
                            verticalAlign: "center"
                        },
                        data: [{
                            type: "pie",
                            showInLegend: true,
                            toolTipContent: "<b>{name}</b>: {y} (#percent%)",
                            indexLabel: "{name}",
                            legendText: "{name} (#percent%)",
                            indexLabelPlacement: "inside",
                            dataPoints: [
                                {y: doneWithoutZamat, name: "Done Without Zamat"},
                                {y: notDone, name: "Not Done", color:"red"},
                                {y: donekaza, name: "Done In Kaza"},
                                {y: doneZamat, name: "Done In Zamat", color:"green"},
                            ]
                        }]
                    };
                    $("#chartContainer").CanvasJSChart(options);
                }
            }






        });
    </script>
@endsection