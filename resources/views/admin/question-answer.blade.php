<div class="col-md-11">
    <h2>Hadith</h2>
    <br><br>
    <table id="question-answer-manage-table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <td><strong>SL.</strong></td>
            <td><strong>Question Description</strong></td>
            <td><strong>Answer</strong></td>
            <td><strong>Asked By</strong></td>
            <td><strong>Asked at</strong></td>
            <td><strong>View and Manage</strong></td>
            <td><strong>Delete</strong></td>
        </tr>
        </thead>
        <tbody>
        @foreach($questionAnswers as $questionAnswer)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td width="250px">{{str_limit($questionAnswer->question,40)}}</td>
                <td width="250px">{{str_limit($questionAnswer->answer,40)}}</td>
                <td>{{$questionAnswer->user->name}}</td>
                <td>{{$questionAnswer->created_at->toFormattedDateString()}}</td>

                <td style="text-align: center;" ><a class="manage" data-value="{{$questionAnswer->id}}" href=""><i  class="fa  fa-cog "></i></a></td>
                <td style="text-align: center"><a class="delete" data-value="{{$questionAnswer->id}}" href=""><i class="fa fa-trash"></i></a></td>

            </tr>
        @endforeach

        </tbody>
    </table>

    {{--Manage Modal--}}
    <div class="modal fade" id="manage-question-answer-modal" tabindex="-1" role="dialog" aria-labelledby="add-question-answer--modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="question-answer-modal-label">Manage Hadith</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                Showing Error in modal
                <div class="alert alert-danger" style="display: none;" id="error"></div>

                <div class="modal-body">
                    <form id="manage-question-answer-form" action="{{route('moderator.question.answer.manage')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"> Question :</label>
                            <p id="question"></p>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"> Answer :</label>
                            <textarea rows="8" class="form-control" name="answer" id="answer"></textarea>
                        </div>
                        <input type="hidden" name="id" id="id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="update" type="submit" class="btn btn-primary">Submit
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
       $("#question-answer-manage-table").DataTable();

//manage

        $(".manage").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                var questionAnswerId = $(this).data();
                $("#manage-question-answer-modal").modal('show');
                $.get("{{route('moderator.question.answer.get')}}",{questionAnswerId:questionAnswerId},function (data) {
                    $("#question").text(data.question);
                    $("#answer").text(data.answer);
                    $("#id").val(data.id);
                });
            }) ;
        });
//manage form
        $("#manage-question-answer-form").on("submit",function (e) {
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
                        $("#manage-question-answer-form").trigger('reset');
                        $("#manage-question-answer-modal").modal('hide');
                        $.loadValue();
                        swal("Success", "Successful.", "success");
                    }

                }
            });
        });
        //delete
        $(".delete").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                questionAnswerId = $(this).data();
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
                            $.get("{{route('moderator.question.answer.delete')}}", {questionAnswerId: questionAnswerId}, function (data) {
                                $.loadValue();
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
            $.get("{{route('moderator.question.answer.index')}}", function (data) {
                $("#show").html(data);
                $("#question-answer-manage-table").DataTable();
            });
        }
    });
</script>