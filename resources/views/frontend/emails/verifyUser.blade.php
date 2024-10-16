{{-- <!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the Behere {{ $full_name }}</h2>
<br/>
Your registered email-id is {{ $email }} , Please click on the below link to verify your email account.
<br/><br/>

</body>

</html> --}}




@include('emails.email_header')
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
                                                {{-- <h2 style="color: #333333;font-size: 26px; font-style: normal; font-weight: normal;">Please reset your password </h2> --}}
                                            </td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td class="esd-block-text es-p10t es-p20r es-p20l" bgcolor="#fcfcfc" align="left">
                                                <p style= "font-size: 14px; font-family: helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height: 150%;">Hi {{ ucfirst($full_name) }},<br> Please click on verify link button.</p>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td class="esd-block-text es-p10t es-p20r es-p20l" bgcolor="#fcfcfc" align="left">
                                                <button><a href="{{route('business.verifyUser',$email_verified_at)}}">Verify Email</a></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="esd-block-text es-p10t es-p20r es-p20l" bgcolor="#fcfcfc"
                                                align="left">
                                                <p style="font-size: 14px; font-family: helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height: 150%;">
                                                    Regards,<br>
                                                    Team BeHere
                                                </p>
                                            </td>
                                        </tr>
                                        <br>
                                        
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
        </tr>
    </tbody>
</table>
</td>
</tr>
</tbody>
</table>

<br />
@include('emails.email_footer')

