<div class="col-md-8">
    <h2>Users</h2>
    <br><br>
    <table id="user-manage-table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <td><strong>SL.</strong></td>
            <td><strong>Name</strong></td>
            <td><strong>Email</strong></td>
            <td><strong>Joined at</strong></td>
            <td><strong>Delete</strong></td>
            <td><strong>Status</strong></td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at->toFormattedDateString()}}</td>
                <td><a class="delete" data-value="{{$user->id}}" href=""><i class="fa fa-trash"></i></a></td>
                <td>
                    <div>
                        <button value="{{$user->id}}" @if($user->status == 0) disabled
                                @endif
                                class="btn btn-danger disable">Disable
                        </button>

                        <button value="{{$user->id}}"
                                @if($user->status == 1) disabled
                                @endif  class="btn btn-primary enable">Enable
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

</div>
<script type="text/javascript">

    $(document).ready(function () {
        $("#user-manage-table").DataTable();

        //delete user
        $(".delete").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                userId = $(this).data();
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
                            $.get("{{route('manage.user.delete')}}", {userId: userId}, function (data) {
                                $.loadValue();
                                $("#user-manage-table").DataTable();
                            });
                            swal("Success", "Delete Successful", "success");
                        } else {
                            swal("User Not Deleted.");
                        }
                    });

            });
        });

        {{--//enable--}}
        $(".enable").each(function () {
            $(this).click(function () {
                var userId = $(this).val();
                $.get("{{route('manage.user.enable')}}", {userId: userId}, function (data) {
                    swal("Success", "User Enable.", "success");
                    $.loadValue();
                });
            });
        });
        //disable
        $(".disable").each(function () {
            $(this).click(function () {
                var userId = $(this).val();
                $.get("{{route('manage.user.disable')}}", {userId: userId}, function (data) {
                    swal("Success", "User Disable.", "success");
                    $.loadValue();
                });
            });
        });


        //load the value after add or delete
        $.loadValue = function () {
            $.get("{{route('manage.user.index')}}", function (data) {
                $("#show").html(data);
                $("#user-manage-table").DataTable();
            });

        }
    });

</script>
