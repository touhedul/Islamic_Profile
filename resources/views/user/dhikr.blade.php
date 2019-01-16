@extends('layouts.user')
@section('title')
    Dhikr
@endsection


@section('content')
    <h3 id="message" style="display:none">Use the key board up and down key to increase and decreas the count number.
        Thank You.</h3>
    <div class="row">
        <div class="col-md-3">
            {{--Showing Dhikr--}}
            <select id="dhikr-select" class="form-control">
                <option value="">--Select a Dhikr--</option>
                @foreach($dhikrs as $dhikr)
                    <option value="{{$dhikr->id}}">{{$dhikr->name}}</option>
                @endforeach
            </select>
        </div>
        {{--Dhikr Manage : count , save--}}
        <div id="dhikr-manage" class="col-md-3">
            <button class="btn btn-info" style="display: none" id="dhikr-start">Start</button>
            <br><br>
            <button style="display: none" id="click">Click Here Or press Up key</button>
            <br><br>
            <h3 style="display: none" id="count">Count Started : <span id="number-of-count"></span></h3>
            <button id="reset" style="display: none" class="btn btn-danger">Reset</button>
            <button id="save" style="display: none" class="btn btn-success">Save</button>
        </div>

        {{--Showing User Dhikr--}}
        <div class="col-md-6">
            <h1 style="text-align: center">Your Dhikr</h1>
            <table id="dhikr" class="table table-striped">
                <thead>
                <tr>
                    <td>Dhikr</td>
                    <td>Number of Dhikr</td>
                </tr>
                </thead>
                {{--Dhikr Count increase or add row--}}
                @if($userDhikrs->count()>0)
                <tbody id="dhikr-table-body">
                    @foreach($userDhikrs as $userDhikr)
                        <tr>
                            <td>{{$userDhikr->dhikrs($userDhikr->dhikr_id)->name}}</td>
                            <td id="dhikr-count{{$userDhikr->dhikr_id}}">{{$userDhikr->dhikr_count}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h3>No Data Found.</h3>
            @endif
        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            //selecting the dhikr
            $("#dhikr-select").each(function () {
                $(this).change(function () {
                    var value = $(this).val();
                    if (value != "") {

                        $("#dhikr-start").show();
                    } else {
                        $("#dhikr-start").hide();
                    }
                });
            });
            numberOfCount = 0;
            //showing the count number
            $("#dhikr-start").click(function () {
                //disable the select field and start button
                $(this).prop("disabled", true);
                $("#dhikr-select").prop("disabled", true);

                //showing the buttons and count number
                $("#count").show();
                $("#number-of-count").text(numberOfCount);
                $("#reset").show();
                $("#save").show();
                $("#click").show();
                //showing the message how to increase the dhikr count
                $("#message").slideDown(function () {
                    setTimeout(function () {
                        $("#message").slideUp();
                    }, 2000);
                });
            });
            //Reset Button work
            $("#reset").click(function () {
                swal({
                    title: "Are you sure?",
                    text: "Once reset, you will not be able to recover!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.resetFunction();
                            $("#number-of-count").text(numberOfCount);
                            swal("Reset Successful.", {
                                icon: "success",
                            });
                        } else {
                            swal("Not Reseted.");
                        }
                    });
            });
            //keypress check
            $('#click').keyup(function (e) {
                switch (e.which) {
                    // case 37: // left
                    //     alert('sf');
                    //     break;

                    case 38: // up
                        numberOfCount++;
                        $("#number-of-count").text(numberOfCount);
                        break;

                    // case 39: // right
                    //     alert('sf');
                    //     break;

                    case 40: // down
                        numberOfCount--;
                        $("#number-of-count").text(numberOfCount);
                        break;

                    default:
                        return; // exit this handler for other keys
                }
            });
            //click button work
            $("#click").click(function () {
                numberOfCount++;
                $("#number-of-count").text(numberOfCount);
            });

            //save the dhikr
            $("#save").click(function () {
                var dhikrId = $("#dhikr-select").val();
                $.get("dhikr/save", {dhikrId: dhikrId, numberOfCount: numberOfCount}, function (check) {
                    swal("Successful", "Dhikr Added Successful.", "success");
                    $.get("dhikr/user-dhikr", {dhikr_id: dhikrId}, function (data) {
                        if (check == "update") {
                            //update the number count value
                            $("#dhikr-count" + dhikrId).text(data.dhikrCount);
                        } else if (check == "create") {
                            //insert a row
                            var tableRow = "<tr><td>" + data.dhikrName + "</td><td>" + data.dhikrCount + "</td></tr>";
                            $("#dhikr-table-body").append(tableRow);
                        }
                    });

                    //get the new dhikr count for table
                    $.resetFunction();


                });
            });
            //reset button work
            $.resetFunction = function () {
                numberOfCount = 0;
                $("#dhikr-select").prop("disabled", false);
                $("#dhikr-start").prop("disabled", false);
                $("#click").hide();
                $("#reset").hide();
                $("#save").hide();
                $("#count").hide();
            }

        });
    </script>

@endsection