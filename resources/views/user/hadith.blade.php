@extends('layouts.user')
@section('title')
    Hadith
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-2">
            <button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#hadith-modal">
                Post a Hadith
            </button>
        </div>


        {{--Modal--}}
        <div class="modal fade" id="hadith-modal" tabindex="-1" role="dialog" aria-labelledby="hadith-modalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hadith-modalLabel">Hadith Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{--Showing Error in modal--}}
                    <div class="alert alert-danger" style="display: none;" id="error"></div>

                    <div class="modal-body">
                        <form id="hadith-post-form" action="{{route('hadith.post')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"> Description* :</label>
                                <textarea name="description" class="form-control" rows="8" id="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"> Source* :</label>
                                <input type="text" required class="form-control" maxlength="255" name="source"
                                       id="source">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button id="post" type="submit" class="btn btn-primary">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>

    {{--Showing Hadith--}}
    @foreach($hadiths as $hadith)
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.
                        <p style="text-align: right">Source : {{$hadith->source}}</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
    @endforeach
    <div class="row justify-content-center">
        <div class=" col-md-2">
            {{ $hadiths->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

            // Hadith post
            $("#hadith-post-form").on("submit", function (e) {
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
                            $("#hadith-modal").modal("hide");
                            $("#description").val('');
                            $("#source").val('');
                            $("#error").hide();
                            swal("Success", "Your posted hadith will be moderate first.", "success");

                        }

                    }
                });

            });
        });
    </script>
@endsection