

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
                                                <h2 style="color: #333333;font-size: 26px; font-style: normal; font-weight: normal;">Please reset your password </h2>
                                            </td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td class="esd-block-text es-p10t es-p20r es-p20l" bgcolor="#fcfcfc" align="left">
                                                <p style= "font-size: 14px; font-family: helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height: 150%;">Hi {{ucfirst($preferred_name)}},<br> Please click on reset password link.</p>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td class="esd-block-text es-p10t es-p20r es-p20l" bgcolor="#fcfcfc" align="left">
                                                <h4><a href="{{$link}}"> Click Here </a> </h4><br>
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
<!--        <td class="esd-structure es-p30t es-p20r es-p20l" style="    background-color:  rgb(252, 252, 252);" esd-custom-block-id="15791" bgcolor="#fcfcfc" align="left">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                    <td class="esd-container-frame" width="560" valign="top" align="center">
                        <table style="border-color: rgb(239, 239, 239); padding: 45px; padding-top: 0px; border-style: solid; border-width: 1px; border-radius: 3px; border-collapse: separate; background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                            <tbody>
                            <tr>
                                <td class="esd-block-text es-p20t es-p15b" align="center">
                                    <img src="profile_pic" style="    width: 100px;border-radius: 65px;margin: 15px;">
                                </td>
                            </tr>
                            <tr>
                                <td class="esd-block-text es-p20t es-p15b" align="center">
                                    <h3 style="color: #333333;">Thank you for contacting us</h3>
                                </td>
                            </tr>
                            <tr>
                                <td class="esd-block-text" align="center">
                                   
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
        </td>-->
        </tr>
    </tbody>
</table>
</td>
</tr>
</tbody>
</table>

<br />
@include('emails.email_footer')

