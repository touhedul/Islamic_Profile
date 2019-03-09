<div id="show" class="col-md-8">
    <h3>Dhikr</h3>
    <button id="add-new-dhikr" data-toggle="modal" data-target="#add-dhikr-modal" class="btn btn-info pull-right">Add
        new Dhirk
    </button>
    <br><br>
    <table id="dhikr-table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <td><strong>SL.</strong></td>
            <td><strong>Dhikr</strong></td>
            <td><strong>Edit</strong></td>
            <td><strong>Delete</strong></td>
        </tr>
        </thead>
        <tbody>
        @foreach($dhikrs as $dhikr)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$dhikr->name}}</td>
                <td><a href="" class="edit" data-value="{{$dhikr->id}}"><i class="fa fa-edit"></i></a></td>
                <td><a class="delete" data-value="{{$dhikr->id}}" href=""><i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{--Add dhikr modal--}}

    <div class="modal fade" id="add-dhikr-modal" tabindex="-1" role="dialog" aria-labelledby="add-dhikr--modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dhikr-modal-label">Add Dhikr</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{--Showing Error in modal--}}
                <div class="alert alert-danger" style="display: none;" id="error"></div>

                <div class="modal-body">
                    <form id="add-dhikr-form" action="{{route('moderator.dhikr.add')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"> Name* :</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <input type="hidden" name="id" id="id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="add" type="submit" class="btn btn-primary">Add</button>
                            <button style="display: none" id="update" type="submit" class="btn btn-primary">Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {

        //reset the form value after edit
        $("#add-new-dhikr").click(function () {
            $("#error").hide();
            $("#name").val('');
            $("#id").val('');
            $("#dhikr-modal-label").text("Add dhikr");
            $("#add").show();
            $("#update").hide();
        });
        // add dhikr
        $("#add").on("click", function () {
            $("#add-dhikr-form").submit(function (e) {
                $('#error').hide();
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var type = $(this).attr('method');

                $.ajax({
                    type: type,
                    url: url,
                    data: data,
                    dataTy: 'json',
                    success: function (data) {
                        if (!data.success) {
                            $('#error').show();
                            $('#error').empty();
                            $('#error').append('<p>' + data.errors + '</p>');

                        } else {
                            //hide the modal and set the field value to empty
                            $("#add-dhikr-form").trigger('reset');
                            $("#add-dhikr-modal").modal("hide");
                            $("#error").hide();

                            $.loadValue();
                            swal("Success", "Admin Added Successful.", "success");
                        }

                    }
                });
            });
        });

        //delete dhikr
        $(".delete").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                dhikrId = $(this).data();
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            //request to surver for delete
                            $.get("{{route('moderator.dhikr.delete')}}", {dhikrId: dhikrId}, function (data) {
                                $.loadValue();
                            });
                            swal("Success", "Delete Successful", "success");
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });

            });
        });

        {{--//edit--}}
        $(".edit").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                $("#error").hide();
                dhikrId = $(this).data();
                $("#add-dhikr-modal").modal('show');
                $.get("{{route('moderator.dhikr.get')}}", {dhikrId: dhikrId}, function (data) {
                    $("#name").val(data.name);
                    $("#id").val(data.id);
                    $("#dhikr-modal-label").text("Edit Dhikr");
                    $("#update").show();
                    $("#add").hide();
                });

            });
        });

        {{--//update--}}
        $("#update").on("click", function (e) {
            $("#add-dhikr-form").submit(function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                var url = "{{route('moderator.dhikr.update')}}";
                var type = "POST";
                $.ajax({
                    type: type,
                    url: url,
                    data: data,
                    dataTy: 'json',
                    success: function (data) {
                        if (!data.success) {
                            $('#error').show();
                            $('#error').empty();
                            $('#error').append('<p>' + data.errors + '</p>');

                        } else {
                            //hide the modal and set the field value to empty
                            $("#add-dhikr-form").trigger('reset');
                            $("#add-dhikr-modal").modal("hide");
                            $("#error").hide();
                            $.loadValue();
                            swal("Success", "Dhikr Update Successful.", "success");
                        }

                    }
                });
            });
        });


        //load the value after add or delete
        $.loadValue = function () {
            $.get("{{route('moderator.dhikr.index')}}", function (data) {
                $("#show").html(data);
            });
        }

    });

</script>