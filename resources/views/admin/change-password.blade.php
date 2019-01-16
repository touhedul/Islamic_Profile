<div class="col-md-6">

    <div class="card">
        <div class="card-header"><h3>{{ __('Change Password') }}</h3></div><br><br>
        <div class="card-body">
            <div class="alert alert-danger" id="error" style="display: none"></div>
            <form method="POST" id="change-password-form" action="{{ route('admin.password.change') }}">
                @csrf


                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                    <div class="col-md-6">
                        <input id="oldpassword" type="password" name="oldpassword" required>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" name="password" required>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" name="password_confirmation" required>

                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Change Password') }}
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#change-password-form").on("submit",function (e) {
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
                    console.log(data);
                    if (!data.success) {
                        $('#error').show();
                         $('#error').empty();
                        $('#error').append('<p>' + data.errors + '</p>');

                    } else {
                        $("#error").hide();
                        $("#change-password-form").trigger('reset');
                        swal("Success", "Change Password Successful.", "success");
                    }

                }
            });
        });
    });
</script>