@extends('layouts.user')
@section('title')
    {{ Auth::user()->name }}
@endsection


@section('content')

{{--Fajr--}}
@if($salat->fajr == "")
    <div class="alert alert-danger" id="fajr-div">

        <form action="" id="fajr-form" method="POST">
            @csrf
            <div class="form-row">
                <div class="col-3">
                    <h4>Fajr</h4>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dz" type="submit"
                            class="btn btn-success float-right fajr">Done in time with
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right:1px " name="salat" value="dwz" type="submit"
                            class="btn btn-info fajr">Done in
                        time without
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dk" type="submit"
                            class="btn btn-dark fajr">Done in
                        kaza
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="nd" type="submit"
                            class="btn btn-danger fajr">Not
                        Done
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif
{{--Zohr--}}
@if($salat->zuhr == "")
    <div class="alert alert-danger" id="zuhr-div">
        <form action="" method="POST" id="zuhr-form">
            @csrf
            <div class="form-row">
                <div class="col-3">
                    <h4>Zuhr</h4>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dz" type="submit"
                            class="btn btn-success float-right zuhr">Done in
                        time with
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right:1px " name="salat" value="dwz" type="submit"
                            class="btn btn-info zuhr">Done in
                        time without
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dk" type="submit"
                            class="btn btn-dark zuhr">Done in
                        kaza
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="nd" type="submit"
                            class="btn btn-danger  zuhr">Not
                        Done
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif
{{--Asr--}}
@if($salat->asr == "")
    <div class="alert alert-danger" id="asr-div">
        <form action="" method="POST" id="asr-form">
            @csrf
            <div class="form-row">
                <div class="col-3">
                    <h4>Asr</h4>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dz" type="submit"
                            class="btn btn-success float-right asr">Done in
                        time with
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right:1px " name="salat" value="dwz" type="submit"
                            class="btn btn-info asr">Done in
                        time without
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dk" type="submit"
                            class="btn btn-dark asr">Done in
                        kaza
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="nd" type="submit"
                            class="btn btn-danger  asr">Not
                        Done
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif
{{--Maghrib--}}
@if($salat->maghrib == "")
    <div class="alert alert-danger" id="maghrib-div">
        <form action="" method="POST" id="maghrib-form">
            @csrf
            <div class="form-row">
                <div class="col-3">
                    <h4>Maghrib</h4>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dz" type="submit"
                            class="btn btn-success float-right maghrib">Done in
                        time with
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right:1px " name="salat" value="dwz" type="submit"
                            class="btn btn-info maghrib">Done in
                        time without
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dk" type="submit"
                            class="btn btn-dark maghrib">Done in
                        kaza
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="nd" type="submit"
                            class="btn btn-danger  maghrib">Not
                        Done
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif
{{--Isha--}}
@if($salat->isha == "")
    <div class="alert alert-danger" id="isha-div">
        <form action="" method="POST" id="isha-form">
            @csrf
            <div class="form-row">
                <div class="col-3">
                    <h4>Isha</h4>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dz" type="submit"
                            class="btn btn-success float-right isha">Done in
                        time with
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right:1px " name="salat" value="dwz" type="submit"
                            class="btn btn-info isha">Done in
                        time without
                        zamat
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="dk" type="submit"
                            class="btn btn-dark isha">Done in
                        kaza
                    </button>
                </div>
                <div class="col">
                    <button style="margin-right: 1px" name="salat" value="nd" type="submit"
                            class="btn btn-danger  isha">Not
                        Done
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif
{{--Witr--}}
@if($salat->witr == "")
    <div class="alert alert-danger" id="witr-div">
        <form action="" method="POST" id="witr-form">
            @csrf
            <div class="form-row">
                <div class="col-3">
                    <h4>Witr</h4>
                </div>
                <div class="col">
                    <button style="margin-right:1px " name="salat" value="dt" type="submit"
                            class="btn btn-success witr">Done in
                        time
                    </button>

                </div>
                <div class="col"></div>
                <div class="col">
                    <button style="margin-left: 7px" name="salat" value="dk" type="submit"
                            class="btn btn-dark witr">Done in
                        kaza
                    </button>
                </div>
                <div class="col">
                    <button style="margin-left: 7px" name="salat" value="nd" type="submit"
                            class="btn btn-danger  witr">Not
                        Done
                    </button>
                </div>

            </div>
        </form>
    </div>
@endif
<br>
{{--Overall salat Performance--}}
<div class="row justify-content-center">

    <div class="col-md-10">
        <h1 style="text-align: center">Your Overall Salat Performance.</h1><br>
        <div id="chartContainer" style="height: 400px; width: 100%;"></div>
    </div>

</div>

@endsection

@section('script')
{{--PieChart--}}
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        // button
        $(".fajr").click(function () {
            $("#fajr-div").fadeOut();
        });
        $(".zuhr").click(function () {
            $("#zuhr-div").fadeOut();
        });
        $(".asr").click(function () {
            $("#asr-div").fadeOut();
        });
        $(".maghrib").click(function () {
            $("#maghrib-div").fadeOut();
        });
        $(".isha").click(function () {
            $("#isha-div").fadeOut();
        });
        $(".witr").click(function () {
            $("#witr-div").fadeOut();
        });

        // Form Submit
        $("#fajr-form").on("click", ":submit", function (e) {
            e.preventDefault();
            var data = $(this).val();
            $.post('fajr', {'data': data, '_token': $('input[name=_token]').val()},
                function (data) {
                    console.log(data);
                });
            $.pieChartCall();
        });
        $("#zuhr-form").on("click", ":submit", function (e) {
            e.preventDefault();
            var data = $(this).val();
            $.post('zuhr', {'data': data, '_token': $('input[name=_token]').val()},
                function (data) {
                    console.log(data);
                });
            $.pieChartCall();
        });
        $("#asr-form").on("click", ":submit", function (e) {
            e.preventDefault();
            var data = $(this).val();
            $.post('asr', {'data': data, '_token': $('input[name=_token]').val()},
                function (data) {
                    console.log(data);
                });
            $.pieChartCall();
        });
        $("#maghrib-form").on("click", ":submit", function (e) {
            e.preventDefault();
            var data = $(this).val();
            $.post('maghrib', {'data': data, '_token': $('input[name=_token]').val()},
                function (data) {
                    console.log(data);
                });
            $.pieChartCall();
        });
        $("#isha-form").on("click", ":submit", function (e) {
            e.preventDefault();
            var data = $(this).val();
            $.post('isha', {'data': data, '_token': $('input[name=_token]').val()},
                function (data) {
                    console.log(data);
                });
            $.pieChartCall();
        });
        $("#witr-form").on("click", ":submit", function (e) {
            e.preventDefault();
            var data = $(this).val();
            $.post('witr', {'data': data, '_token': $('input[name=_token]').val()},
                function (data) {
                    console.log(data);
                });
            $.pieChartCall();
        });
        // call the pie chart for first time load than update it by click button event
        $.get("overall-salat-count", function (data) {
            $.pieChart(data);
        });

        $.pieChartCall = function(){
            $.get("overall-salat-count", function (data) {
                $.pieChart(data);
            });
        }

        $.pieChart = function(data) {
            var options = {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Not Performed Salat"
                },
                legend:{
                    horizontalAlign: "right",
                    verticalAlign: "center"
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    toolTipContent: "<b>{name}</b>: Number Of Salat-{y} (#percent%) Not done.",
                    indexLabel: "{name}",
                    legendText: "{name} (#percent%)",
                    indexLabelPlacement: "inside",
                    dataPoints: [
                        { y: data.fajr, name: "Fajr" },
                        { y: data.zuhr, name: "Zuhr" },
                        { y: data.asr, name: "Asr" },
                        { y: data.maghrib, name: "Maghrib" },
                        { y: data.isha, name: "Isha" },
                        { y: data.witr, name: "Witr" },
                    ]
                }]
            };
            $("#chartContainer").CanvasJSChart(options);

        }
    });

</script>
@endsection