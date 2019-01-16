<div class="col-md-8">
    <h2>Moderators</h2>
    <button id="add-new-moderator" data-toggle="modal" data-target="#add-moderator-modal" class="btn btn-info pull-right">Add new Moderator </button>
    <br><br>
    <table id="regular-moderator-table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <td><strong>SL.</strong></td>
            <td><strong>Name</strong></td>
            <td><strong>Email</strong></td>
            <td><strong>Edit</strong></td>
            <td><strong>Delete</strong></td>
            <td><strong>Status</strong></td>
        </tr>
        </thead>
        <tbody>
        @foreach($moderators as $moderator)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$moderator->name}}</td>
                <td>{{$moderator->email}}</td>
                <td><a href="" class="edit" data-value="{{$moderator->id}}"><i class="fa fa-edit"></i></a></td>
                <td><a class="delete" data-value="{{$moderator->id}}" href=""><i class="fa fa-trash"></i></a></td>
                <td>
                    <div>
                        <button value="{{$moderator->id}}" @if($moderator->status == 0) disabled
                                @endif
                                class="btn btn-danger disable">Disable
                        </button>

                        <button value="{{$moderator->id}}"
                                @if($moderator->status == 1) disabled
                                @endif  class="btn btn-primary enable">Enable
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>


    {{--Add Moderaotr modal--}}

    <div class="modal fade" id="add-moderator-modal" tabindex="-1" role="dialog" aria-labelledby="add-moderator--modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="moderator-modal-label">Add Moderaotr</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{--Showing Error in modal--}}
                <div class="alert alert-danger" style="display: none;" id="error"></div>

                <div class="modal-body">
                    <form id="add-moderator-form" action="{{route('moderator.add')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"> Name* :</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"> Email* :</label>
                            <input type="text" id="email" name="email" class="form-control">
                        </div>
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label id="password-label" for="message-text" class="col-form-label"> Password* :</label>
                            <input type="text" id="password" name="password" class="form-control">
                        </div>
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
        $("#add-new-moderator").click(function () {
            $("#name").val('');
            $("#email").val('');
            $("#id").val('');
            $("#password").show();
            $("#password-label").show();
            $("#moderator-modal-label").text("Add moderator");
            $("#add").show();
            $("#update").hide();
        });

   // add moderator
        $("#add").on("click", function () {
            $("#add-moderator-form").submit(function (e) {
                //$('#error').empty();
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
                            $("#add-moderator-form").trigger('reset');
                            $("#add-moderator-modal").modal("hide");
                            $("#error").hide();

                             $.loadValue();
                            swal("Success", "Moderator Added Successful.", "success");
                        }

                    }
                });
            });
        });

        //delete moderator
        $(".delete").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                moderatorId = $(this).data();
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
                            $.get("{{route('moderator.delete')}}", {moderatorId: moderatorId}, function (data) {
                                $.loadValue();
                            });
                            swal("Success", "Delete Successful", "success");
                        } else {
                            swal("Moderator Not Deleted.");
                        }
                    });

            });
        });

        {{--//edit--}}
        $(".edit").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                moderatorId = $(this).data();
                $("#add-moderator-modal").modal('show');
                $.get("{{route('moderator.get')}}", {moderatorId: moderatorId}, function (data) {
                    $("#password").hide();
                    $("#password-label").hide();
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#id").val(data.id);
                    $("#moderator-modal-label").text("Edit Moderator Info");
                    $("#update").show();
                    $("#add").hide();
                });
            });
        });

        {{--//update--}}
        $("#update").on("click", function (e) {
            $("#add-moderator-form").submit(function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                var url = "update";
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
                            $("#add-moderator-form").trigger('reset');
                            $("#add-moderator-modal").modal("hide");
                            $("#error").hide();
                            $.loadValue();
                            swal("Success", "Moderator Update Successful.", "success");
                        }

                    }
                });
            });
        });

        {{--//enable--}}
        $(".enable").each(function () {
            $(this).click(function () {
                var moderatorId = $(this).val();
                $.get("{{route('moderator.enable')}}",{moderatorId:moderatorId},function (data) {
                    swal("Success","Moderator Enable.","success");
                    $.loadValue();
                });
            });
        });
        {{--//disable--}}
        $(".disable").each(function () {
            $(this).click(function () {
                var moderatorId = $(this).val();
                $.get("{{route('moderator.disable')}}", {moderatorId: moderatorId}, function (data) {
                    swal("Success", "Moderator Disable.", "success");
                    $.loadValue();
                });
            });
        });

        //load the value after add or delete
        $.loadValue = function () {
            $.get("{{route('moderator.index')}}", function (data) {
                $("#show").html(data);
            });
        }

    });

