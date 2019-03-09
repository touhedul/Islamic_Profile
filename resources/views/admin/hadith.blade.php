<div class="col-md-11">
    <h2>Hadith</h2>
    <br><br>
    <table id="hadith-manage-table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <td><strong>SL.</strong></td>
            <td><strong>Hadith Description</strong></td>
            <td><strong>Source</strong></td>
            <td><strong>Posted By</strong></td>
            <td><strong>Posted at</strong></td>
            <td><strong>Status</strong></td>
            <td><strong>Action</strong></td>
            <td><strong>View and Manage</strong></td>
            <td><strong>Delete</strong></td>
        </tr>
        </thead>
        <tbody>
        @foreach($hadiths as $hadith)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td width="250px">{{str_limit($hadith->description,40)}}</td>
                <td>{{$hadith->source}}</td>
                <td>{{$hadith->user->name}}</td>
                <td>{{$hadith->created_at->toFormattedDateString()}}</td>
                <td>

                    @if($hadith->status == "")
                    @elseif($hadith->status == "refuse")
                        Refused
                    @endif

                    @if($hadith->status == "approve")
                        Approved
                    @endif

                </td>
                <td width="13%">
                    <button value="{{$hadith->id}}"
                            @if($hadith->status == "approve") disabled
                            @endif  class="btn btn-primary btn-xs  approve">Approve
                    </button>
                    <button value="{{$hadith->id}}" @if($hadith->status == "refuse") disabled
                            @endif
                            class="btn btn-danger btn-xs refuse">Refuse
                    </button>
                </td>
                <td style="text-align: center;" ><a class="manage" data-value="{{$hadith->id}}" href=""><i  class="fa  fa-cog "></i></a></td>
                <td style="text-align: center"><a class="delete" data-value="{{$hadith->id}}" href=""><i class="fa fa-trash"></i></a></td>

            </tr>
        @endforeach

        </tbody>
    </table>

    {{--Manage Modal--}}
    <div class="modal fade" id="manage-hadith-modal" tabindex="-1" role="dialog" aria-labelledby="add-hadith--modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hadith-modal-label">Manage Hadith</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--Showing Error in modal--}}
                <div class="alert alert-danger" style="display: none;" id="error"></div>

                <div class="modal-body">
                    <form id="manage-hadith-form" action="{{route('moderator.hadith.manage')}}" method="POST">
                        @csrf
                        {{--<div class="form-group">--}}
                            {{--<label for="message-text" class="col-form-label"> Posted By : <span style="color: #0b93d5;" id="posted-by"></span></label>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"> Hadith Description :</label>
                            <textarea rows="8" class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"> Hadith Source :</label>
                            <input class="form-control" type="text" name="source" id="source">
                        </div>
                        <input type="hidden" name="id" id="id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="update" type="submit" class="btn btn-primary">Update
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
        $("#hadith-manage-table").DataTable();
        //approve
        $(".approve").each(function () {
            $(this).click(function () {
                var hadithId = $(this).val();

                $.get("{{route('moderator.hadith.approve')}}", {hadithId: hadithId}, function (data) {
                    swal("Success", "Hadith Approved.", "success");
                    $.loadValue();
                });
            });
        });
        //refuse
        $(".refuse").each(function () {
            $(this).click(function () {
                var hadithId = $(this).val();
                $.get("{{route('moderator.hadith.refuse')}}", {hadithId: hadithId}, function (data) {
                    swal("Success", "Hadith Refused.", "success");
                    $.loadValue();
                });
            });
        });

        //manage

        $(".manage").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                var hadithId = $(this).data();
                $("#manage-hadith-modal").modal('show');
                $.get("{{route('moderator.hadith.get')}}",{hadithId:hadithId},function (data) {
                     $("#description").text(data.description);
                    $("#source").val(data.source);
                    $("#id").val(data.id);
                });
            }) ;
        });
//manage form
        $("#manage-hadith-form").on("submit",function (e) {
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
                        $("#error").hide();
                        $("#manage-hadith-form").trigger('reset');
                        $("#manage-hadith-modal").modal('hide');
                        $.loadValue();
                        swal("Success", "Hadith Updated.", "success");
                    }

                }
            });
        });
        //delete
        $(".delete").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                hadithId = $(this).data();
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
                            $.get("{{route('moderator.hadith.delete')}}", {hadithId: hadithId}, function (data) {
                                $.loadValue();
                                $("#hadith-manage-table").DataTable();
                            });
                            swal("Success", "Delete Successful", "success");
                        } else {
                            swal("Hadith Not Deleted.");
                        }
                    });

            });
        });

        //load the value after add or delete
        $.loadValue = function () {
            $.get("{{route('moderator.hadith.index')}}", function (data) {
                $("#show").html(data);
                $("#hadith-manage-table").DataTable();
            });
        }
    });
</script>

