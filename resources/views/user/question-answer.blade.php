@extends('layouts.user')
@section('title')
    Question Answer
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-2">
            <button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#QA-modal">
                Ask A Question
            </button>
        </div>


        {{--Modal--}}
        <div class="modal fade" id="QA-modal" tabindex="-1" role="dialog" aria-labelledby="QA-modalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="QA-modalLabel">Question Ask</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{--Showing Error in modal--}}
                    <div class="alert alert-danger" style="display: none;" id="error"></div>

                    <div class="modal-body">
                        <form id="QA-post-form" action="{{route('qa.ask')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"> Question* :</label>
                                <textarea required name="question" class="form-control" rows="6" id="question"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button id="post" type="submit" class="btn btn-primary">Ask</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>

    {{--Showing Hadith--}}
    @foreach($QAs as $QA)
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-primary" >
                       <h3>Question : </h3> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                    </div>
                    <div class="card-body">
                        <h4>Answer : </h4>
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.
                    </div>
                </div>
            </div>
        </div>
        <br>
    @endforeach
    <div class="row justify-content-center">
        <div class=" col-md-2">
            {{ $QAs->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

            // Question ask
            $("#QA-post-form").on("submit", function (e) {
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
                            $('#error').append('<p>' + data.errors + '</p>');

                        } else {
                            //hide the modal and set the field value to empty
                            $("#QA-modal").modal("hide");
                            $("#question").val('');
                            $("#error").hide();
                            swal("Success", "Your Question will be answerd by the moderator.", "success");

                        }

                    }
                });

            });
        });
    </script>
@endsection