@extends('frontend.layouts.layout')

@section('content')


<div class="main h-100 overflow-auto">
<div class="container my-5">
    <h4 class="text-white pageTitle">Identity Verification</h4>

  
    <form action="{{route('client.IdentityVerification')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <p class="text-white">Verify your identity for exclusive access to poll projections, election verification, and election
            analytics</p>
        <div class="row">
            <!-- Document Type Checkboxes -->
            <div class="col-md-6">
                <label class="text-white mb-2">Select the document type:</label>
                <div>
                    <input type="radio" id="typeA" name="documentType" value="1" class="form-check-input" checked>
                    <label class="form-check-label text-white" for="typeA">Type A and Type B Documents</label>
                </div>
                <div>
                    <input type="radio" id="typeC" name="documentType" value="2" class="form-check-input">
                    <label class="form-check-label text-white" for="typeC">Type C Documents</label>
                </div>
                <!-- Country of Origin Dropdown -->
                <label for="country" class="form-label text-white mt-3">Country of Origin</label>
                <select id="country" class="form-select themeInput" name="country_id">
                    <option value="null" selected>Choose...</option>
                    @foreach ($country as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                    <!-- Add more countries as needed -->
                </select>
                @if ($errors->has('country_id'))
                <span class="error"
                    style="font-size: 15px; color: red; font-family: 'Graphik';">{{ $errors->first('country_id') }}</span>
            @endif
            <!-- Document Input -->
            <div class="mb-3">
                <label for="documentNumber" class="form-label text-white">Document Number</label>
                <input type="text" id="documentNumber" class="form-control themeInput" placeholder="Document Number">
            </div>
        </div>
        <div class=" col-12 col-md-6">
            <div class="row">
                <div class="firstDiv col-md-6">
                    <div class="mb-3">
                        <div class="wrap">
                            <div class="preview"></div>
                            <label class="file">
                                <input type="file" name="file0" class="themeColor" accept="image/*" aria-label="File browser">
                            </label>
                            @if ($errors->has('file0'))
                    <span class="error"
                        style="font-size: 15px; color: red; font-family: 'Graphik';">{{ $errors->first('file0') }}</span>
                @endif
                        </div>
                    </div>
                </div>
                <div class="secondDiv col-md-6">
                    <div class="mb-3">
                        <div class="wrap">
                            <div class="preview"></div>
                            <label class="file">
                                <input type="file" name="file1" class="themeColor" accept="image/*" aria-label="File browser">
                            </label>
                            @if ($errors->has('file1'))
                    <span class="error"
                        style="font-size: 15px; color: red; font-family: 'Graphik';">{{ $errors->first('file1') }}</span>
                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
        <!-- Checkbox for Authorization -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="authorizationCheck" required>
            <label class="form-check-label text-white" for="authorizationCheck">
                I, {userFullName}, authorize LoveLaceLiberty to use my personal identifiable information along with
                the
                attached documents to verify my identity.
            </label>
        </div>

        <!-- Buttons -->
         <div class="d-flex gap-3">
            <button type="submit" class="theme-btn">Verify</button>
            <button type="button" class="theme-btn">Skip for now</button>
        </div>
    </form>
</div>
</div>
  <script>
   document.addEventListener('DOMContentLoaded', function() {
  debugger;
  const typeA = document.getElementById('typeA');
  const typeC = document.getElementById('typeC');

  // Initial state
  if (typeA.checked) {
      document.querySelector('.secondDiv').classList.remove('d-none');
      document.querySelector('.firstDiv').classList.remove('d-none');
  }

  typeA.addEventListener('change', function() {
      if (typeA.checked) {
          document.querySelector('.firstDiv').classList.remove('d-none');
          document.querySelector('.secondDiv').classList.remove('d-none');
      }
  });

  typeC.addEventListener('change', function() {
      if (typeC.checked) {
          document.querySelector('.secondDiv').classList.add('d-none');
          document.querySelector('.firstDiv').classList.remove('d-none');
      }
  });
});

</script>
@endsection
