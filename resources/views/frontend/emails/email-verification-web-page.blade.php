

@include('emails.email_header')


     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<table class="es-content" cellspacing="0" cellpadding="0" align="center" >
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
                                                
                                            </td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td class="esd-block-text es-p10t es-p20r es-p20l" bgcolor="#fcfcfc" align="left">
                                                   <center> <div class="container">
                                                     <h4>{{$msg}}</h4>
                                                    </div> </center>

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
<script type="text/javascript">
    function checkFunction() {
        $('#new_password_error').replaceWith('<p id="new_password_error" style="color: red"></p>');
        $('#confirm_password_error').replaceWith('<p id="confirm_password_error" style="color: red"></p>');
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();
        if (new_password=='') {
            var parElement = document.getElementById("new_password_error");
            var textToAdd = document.createTextNode("Please Enter New Password");
            parElement.appendChild(textToAdd);
            return false;
        }

        if (confirm_password=='') {
            var parElement = document.getElementById("confirm_password_error");
            var textToAdd = document.createTextNode("Please Enter Confirm Password");
            parElement.appendChild(textToAdd);
            return false;
        }
    }

</script>


@include('emails.email_footer_web_page')