@extends('layouts.admin.admin')
@section('title')
    Home
@endsection
@section('content')
<div class="row justify-content-center">
    <div id="show">
        <h1>
            Dashboard
        </h1>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
//admin
            $("#admin").click(function () {
               $.get("{{route('admin.regular-admin')}}",function (data) {
                  $("#show").html(data);
               });

            });

//moderator
            $("#moderator").click(function () {
                $.get("{{route('moderator.index')}}",function (data) {
                    $("#show").html(data);
                });
            });
//user
            $("#user").click(function () {
                $.get("{{route('manage.user.index')}}",function (data) {
                    $("#show").html(data);
                });
            });
//change password
            $("#change-password").click(function () {
                $.get("{{route('change.password')}}",function (data) {
                    $("#show").html(data);
                });
            });
//Manage Hadith
            $("#hadith").click(function () {
                $.get("{{route('moderator.hadith.index')}}",function (data) {
                    $("#show").html(data);
                });
            });
//Manage Question Anser
            $("#question-answer").click(function () {
                $.get("{{route('moderator.question.answer.index')}}",function (data) {
                    $("#show").html(data);
                });
            });
//Manage dhikr
            $("#dhikr").click(function () {
                $.get("{{route('moderator.dhikr.index')}}",function (data) {
                    $("#show").html(data);
                });
            });


        });
    </script>
@endsection