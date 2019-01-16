<div id="show" class="col-md-8">
    <h3>Admins</h3>
    <button id="add-new-admin" data-toggle="modal" data-target="#add-admin-modal" class="btn btn-info pull-right">Add
        new admin
    </button>
    <br><br>
    <table id="regular-admin-table" class="table table-bordered table-striped">
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
        @foreach($regularAdmins as $regularAdmin)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$regularAdmin->name}}</td>
                <td>{{$regularAdmin->email}}</td>
                <td><a href="" class="edit" data-value="{{$regularAdmin->id}}"><i class="fa fa-edit"></i></a></td>
                <td><a class="delete" data-value="{{$regularAdmin->id}}" href=""><i class="fa fa-trash"></i></a></td>
                <td>
                    <div>
                        <button value="{{$regularAdmin->id}}" @if($regularAdmin->status == 0) disabled
                                @endif
                                class="btn btn-danger disable">Disable
                        </button>

                        <button value="{{$regularAdmin->id}}"
                                @if($regularAdmin->status == 1) disabled
                                @endif  class="btn btn-primary enable">Enable
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{--Add admin modal--}}

    <div class="modal fade" id="add-admin-modal" tabindex="-1" role="dialog" aria-labelledby="add-admin--modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="admin-modal-label">Add Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{--Showing Error in modal--}}
                <div class="alert alert-danger" style="display: none;" id="error"></div>

                <div class="modal-body">
                    <form id="add-admin-form" action="{{route('add.admin')}}" method="POST">
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
        $("#add-new-admin").click(function () {
            $("#name").val('');
            $("#email").val('');
            $("#id").val('');
            $("#password").show();
            $("#password-label").show();
            $("#admin-modal-label").text("Add admin");
            $("#add").show();
            $("#update").hide();
        });
        // add admin
        $("#add").on("click", function () {
            $("#add-admin-form").submit(function (e) {
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
                            $("#add-admin-form").trigger('reset');
                            $("#add-admin-modal").modal("hide");
                            $("#error").hide();

                            {{--$('#regular-admin-table').load("{{route('admin.regular-admin')}}" + ' #regular-admin-table');--}}
                            //load the value
                            $.loadValue();
                            swal("Success", "Admin Added Successful.", "success");
                        }

                    }
                });
            });
        });

        //delete admin
        $(".delete").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                adminId = $(this).data();
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
                            $.get("{{route('admin.delete')}}", {adminId: adminId}, function (data) {
                                $.loadValue();
                            });
                            swal("Success", "Delete Successful", "success");
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });

            });
        });

        //edit
        $(".edit").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                adminId = $(this).data();
                $("#add-admin-modal").modal('show');
                $.get("{{route('admin.getadmin')}}", {adminId: adminId}, function (data) {
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#id").val(data.id);
                    $("#password").hide();
                    $("#password-label").hide();
                    $("#admin-modal-label").text("Edit Admin Info");
                    $("#update").show();
                    $("#add").hide();
                });

            });
        });

        //update
        $("#update").on("click", function (e) {
            $("#add-admin-form").submit(function (e) {
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
                            $("#add-admin-form").trigger('reset');
                            $("#add-admin-modal").modal("hide");
                            $("#error").hide();
                            $.loadValue();
                            swal("Success", "Admin Update Successful.", "success");
                        }

                    }
                });
            });
        });

        //enable
        $(".enable").each(function () {
            $(this).click(function () {
                var adminId = $(this).val();
                $.get("{{route('admin.enable')}}",{adminId:adminId},function (data) {
                    swal("Success","Admin Enable.","success");
                    $.loadValue();
                });
            });
        });
    //disable
        $(".disable").each(function () {
            $(this).click(function () {
                var adminId = $(this).val();
                $.get("{{route('admin.disable')}}", {adminId: adminId}, function (data) {
                    swal("Success", "Admin Disable.", "success");
                    $.loadValue();
                });
            });
        });

        //load the value after add or delete
        $.loadValue = function () {
            $.get("{{route('admin.regular-admin')}}", function (data) {
                $("#show").html(data);
            });
        }

    });

</script>