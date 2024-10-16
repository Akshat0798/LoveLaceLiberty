@include('emails.email_header')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<style>
    .error {
        color: red;
    }

    /* .form-group.form-floating-label {
    position: relative;
} */
    .input-eye {
        position: relative;
    }

    .input-eye i {
        position: absolute;
        top: 10px;
        right: 20px;
    }
</style>
<table class="es-content" cellspacing="0" cellpadding="0" align="center">
    <tbody>
        <tr>
            <td class="esd-stripe" align="center">
                <table class="es-content-body" style="background-color: transparent;" width="700" cellspacing="0"
                    cellpadding="0" align="center">
                    <tbody>

                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif

                        @if (\Session::has('errMsg'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{!! \Session::get('errMsg') !!}</li>
                                </ul>
                            </div>
                        @endif

                        <tr>
                            <td class="esd-structure" align="left">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td class="esd-container-frame" width="600" valign="top"
                                                align="center">
                                                <table
                                                    style="border-radius: 3px; border-collapse: separate; background-color: rgb(252, 252, 252); padding: 10px; padding-left: 25px; "
                                                    width="100%" cellspacing="0" cellpadding="0" bgcolor="#fcfcfc">
                                                    <tbody>
                                                        <tr>
                                                        <tr>
                                                            <td class="esd-block-text es-m-txt-l es-p30t es-p20r es-p20l"
                                                                align="left" style="padding-top: 30px;">
                                                                <h2
                                                                    style="color: #333333;font-size: 26px; font-style: normal; font-weight: normal;">
                                                                    Please reset your password !</h2>
                                                            </td>
                                                        </tr>
                                        </tr>
                                        <tr>
                                            <td class="esd-block-text es-p10t es-p20r es-p20l" bgcolor="#fcfcfc"
                                                align="left">
                                                <div class="container">
                                                    <form class="validatedForm" id="commentForm" method="POST"
                                                        action="{{ route('adminSetPassWord') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group" style="margin-bottom: 20px;">
                                                            <label for="new_password">New Password:</label>
                                                            <input type="hidden" id="email" name="email"
                                                                value="{{ $email }}">
                                                            <div class="input-eye">
                                                                <input type="password" class="form-control"
                                                                    id="new_password" placeholder="Enter new password"
                                                                    name="new_password" maxlength=12 minlength=6
                                                                    style="display: inline; width: 98.8%; padding-right:10px; position: relative; ">

                                                                <i class="fa fa-eye-slash fa-fw" id="new_togglePassword"
                                                                    style="margin-left: -30px; cursor: pointer;"></i>
                                                            </div>

                                                            @error('new_password')
                                                                <span class="text-danger">{{ $message }}</span><br><br>
                                                                @endif



                                                            </div>
                                                            <br>
                                                            <div class="form-group" style="margin-bottom: 20px;">
                                                                <label for="pwd">Confirm Password:</label>
                                                                <div class="input-eye">
                                                                    <input type="password" class="form-control"
                                                                        id="confirm_password"
                                                                        placeholder="Enter confirm password"
                                                                        name="confirm_password"
                                                                        data-rule-equalTo="#new_password" maxlength=12
                                                                        minlength=6
                                                                        style="display: inline; width: 98.8%; padding-right:10px;">

                                                                    <i class="fa fa-eye-slash fa-fw"
                                                                        id="confirm_togglePassword"
                                                                        style="margin-left: -30px; cursor: pointer;"></i>
                                                                </div>
                                                                @error('confirm_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    <br><br>
                                                                    @endif

                                                                </div>
                                                                <br>
                                                                <div class="form-group" style="margin-bottom: 10px;">
                                                                    <button type="submit" class="btn btn-info ">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>

        <br />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" type="text/javascript">
        </script>

        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        <script type="text/javascript">
            const new_togglePassword = document.querySelector('#new_togglePassword');
            const new_password = document.querySelector('#new_password');

            new_togglePassword.addEventListener('click', function(e) {
                if (new_password.type == 'password') {
                    new_password.setAttribute('type', 'text');
                    new_togglePassword.classList.add('fa-eye');
                    new_togglePassword.classList.remove('fa-eye-slash');
                } else {
                    new_togglePassword.classList.add('fa-eye-slash');
                    new_togglePassword.classList.remove('fa-eye');
                    new_password.setAttribute('type', 'password');
                }


            });

            const confirm_togglePassword = document.querySelector('#confirm_togglePassword');
            const confirm_password = document.querySelector('#confirm_password');

            confirm_togglePassword.addEventListener('click', function(e) {
                if (confirm_password.type == 'password') {
                    confirm_password.setAttribute('type', 'text');
                    confirm_togglePassword.classList.add('fa-eye');
                    confirm_togglePassword.classList.remove('fa-eye-slash');
                } else {
                    confirm_togglePassword.classList.add('fa-eye-slash');
                    confirm_togglePassword.classList.remove('fa-eye');
                    confirm_password.setAttribute('type', 'password');
                }


            });
        </script>
        @include('emails.email_footer_web_page')
