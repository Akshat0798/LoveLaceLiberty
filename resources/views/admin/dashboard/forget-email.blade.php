

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
      <br>

      @if ($errors->has('success'))
      <span class="alert alert-success">Reset password link is sent to your email address. Please check your email</span>
  @endif
  @if (Session::has('errMsg'))
                        <span class="alert alert-danger">This email address is not registered</span>
                    @endif


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
                                                <h2 style="color: #333333;font-size: 26px; font-style: normal; font-weight: normal;"></h2>
                                            </td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td class="esd-block-text es-p10t es-p20r es-p20l" bgcolor="#fcfcfc" align="left">
                                                    <div class="container">
                                                      <form class="validatedForm" id="commentForm" method="POST" action="{{route('resetPassLinkSentAdmin')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group" style="margin-bottom: 20px;">
                                                          <label for="new_password">Email:</label>
                                                        
                                                          <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" value="{{ old('email') }}">

                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @endif
                                                    
                                                        </div>
                                           
                                                        <div class="form-group" style="margin-bottom: 10px;">
                                                            <button type="submit" class="btn btn-info " >Submit</button>
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
@include('emails.email_footer_web_page')

