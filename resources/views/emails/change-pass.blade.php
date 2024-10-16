

@include('emails.email_header')


     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
    .error{color: red;}
</style>
<table class="es-content" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td class="esd-stripe" align="center">
<table class="es-content-body" style="background-color: transparent;" width="700" cellspacing="0" cellpadding="0" align="center">
    <tbody>
        <tr>
            <td class="esd-structure" align="left" >
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="esd-container-frame" width="600" valign="top" align="center">
                                <table style="border-radius: 3px; border-collapse: separate; background-color: rgb(252, 252, 252); padding: 10px; padding-left: 25px; " width="100%" cellspacing="0" cellpadding="0" bgcolor="#fcfcfc">
                                    <tbody>
                                        <tr>
                                            <tr>
                                            <td class="esd-block-text es-m-txt-l es-p30t es-p20r es-p20l" align="left" style="padding-top: 30px;">
                                                <h2 style="color: #333333;font-size: 26px; font-style: normal; font-weight: normal;">Please reset your password !</h2>
                                            </td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td class="esd-block-text es-p10t es-p20r es-p20l" bgcolor="#fcfcfc" align="left">
                                                    <div class="container">
                                                      <form class="validatedForm" id="commentForm" method="POST" action="{{route('reset.password.post')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group" style="margin-bottom: 20px;">
                                                          <label for="new_password">New Password:</label>
                                                          <input type="hidden"  id="email" name="email" value="{{$email}}">
                                                          <input type="password" class="form-control" id="new_password" placeholder="Enter new password" name="new_password" required="required" maxlength=12 minlength=6>

                                                          <p id="new_password" style="color: red"><?phpif (!empty(Session::get("new_password"))) {  print_r(Session::get("new_password"));
                                                           } ?></p>
                                                          <input type="checkbox" onclick="showNewPass()">Show Password
                                                          
                                                        </div>
                                                        <br>
                                                        <div class="form-group" style="margin-bottom: 20px;">
                                                          <label for="pwd">Confirm Password:</label>
                                                          <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password" name="confirm_password" required="required" data-rule-equalTo="#new_password" maxlength=12 minlength=6>
                                                          <p id="confirm_password_error" style="color: red"><?phpif (!empty(Session::get("confirm_passwordMsgError"))) {  print_r(Session::get("confirm_passwordMsgError"));
                                                           } ?></p>
                                                           
                                                            <input type="checkbox" onclick="showConfPass()">Show Confirm Password
                                                           <p id="new_password_error" style="color: red">{{Session::get("confirm_passwordMsgError")}}
                                                         </p>
                                                        </div>
                                                        <br>
                                                        <div class="form-group" style="margin-bottom: 10px;">
                                                            <button type="submit" class="btn btn-default " >Submit</button>
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
     <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" type="text/javascript"></script>

     <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script type="text/javascript">

jQuery('.validatedForm').validate({
            rules : {
                new_password : {
                    required: true,
                    pwcheck: true,
                    // minlength : 5,
                    // maxLength: 12
                },
                confirm_password : {
                    required: true,
                    // minlength : 5,
                    // maxLength: 12,
                    equalTo : "#new_password"
                }
            },
            messages: {
               confirm_password: {
                   equalTo: "Please enter the same password as above"
               }
            }

        });
$.validator.addMethod("pwcheck",
    function(value, element) {
        return /^[A-Za-z0-9\d=!\-@._*]+$/.test(value);
});



    // function checkFunction() {
    //     $('#new_password_error').replaceWith('<p id="new_password_error" style="color: red"></p>');
    //     $('#confirm_password_error').replaceWith('<p id="confirm_password_error" style="color: red"></p>');
    //     var new_password = $('#new_password').val();
    //     var confirm_password = $('#confirm_password').val();
    //     if (new_password=='') {
    //         var parElement = document.getElementById("new_password_error");
    //         var textToAdd = document.createTextNode("Please Enter New Password");
    //         parElement.appendChild(textToAdd);
    //         return false;
    //     }

    //     if (confirm_password=='') {
    //         var parElement = document.getElementById("confirm_password_error");
    //         var textToAdd = document.createTextNode("Please Enter Confirm Password");
    //         parElement.appendChild(textToAdd);
    //         return false;
    //     }
    // }

    function showNewPass() {
         var x = document.getElementById("new_password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
    }

    function showConfPass() {
         var x = document.getElementById("confirm_password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
    }

</script>
@include('emails.email_footer_web_page')

