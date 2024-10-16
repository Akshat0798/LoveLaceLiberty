@extends('frontend.layouts.layout')


@section('content')
   
       
        <div class="main h-100 w-100 overflow-auto pt-3 pt-md-4">
            <div class="container">
                <div class="row mt-3 g-3">
                    <div class="col-12 col-md-12">
                        <h4 class="text-white pageTitle mb-4 text-center">Subscription Options</h4>
                        <div class="row g-2 mb-3 justify-content-center">
                            <div class="col-12 col-md-3">
                                <div class="subscription-card">
                                    <div class="subscription-card-title position-relative">
                                        <img src="{{ asset('public\assetss\images\titleHolder.svg')}}" class="w-100 " alt="">
                                        <div class="text-white textHolder">
                                            Features
                                        </div>
                                    </div>
                                    <div class="subscription-card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li>Representative Insights</li>
                                            <li class="border-top-0">Representative Search</li>
                                            <li class="border-top-0">Ad Free</li>
                                            <li class="border-top-0">Polling Participation<br>
                                                (Who will you vote for?)</li>
                                            <li class="border-top-0">Internal Voting<br>
                                                (Who did you vote for?)</li>

                                            <li class="border-top-0">Election Auditing</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="subscription-card differentDiv">
                                    <div class="subscription-card-title position-relative">
                                        <img src="{{ asset('public\assetss\images\titleHolderB.svg')}}" class="w-100 mx-auto d-flex" alt="">
                                        <div class="text-white textHolder">
                                            No subscription
                                        </div>
                                    </div>
                                    <div class="subscription-card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li><img class="yes-mark" src="{{ asset('public\assetss\images\yes.svg')}}" alt="yes-mark"></li>
                                            <li><img class="yes-mark" src="{{ asset('public\assetss\images\yes.svg')}}" alt="yes-mark"></li>
                                            <li class="border-top-0"><img class="no-mark" src="{{ asset('public\assetss\images\no.svg')}}" alt="no-mark"></li>
                                            <li class="border-top-0"><img class="no-mark" src="{{ asset('public\assetss\images\no.svg')}}" alt="no-mark"></li>
                                            <li class="border-top-0"><img class="no-mark" src="{{ asset('public\assetss\images\no.svg')}}" alt="no-mark"></li>
                                            <li class="border-top-0"><img class="no-mark" src="{{ asset('public\assetss\images\no.svg')}}" alt="no-mark"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="subscription-card">
                                    <div class="subscription-card-title position-relative">
                                        <img src="{{ asset('public\assetss\images\titleHolderC.svg')}}" class="w-100 " alt="">
                                        <div class="text-white textHolder">
                                            Elite Subscription
                                        </div>
                                    </div>
                                    <div class="subscription-card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li><img class="yes-mark" src="{{ asset('public\assetss\images\yes.svg')}}" alt="yes-mark"></li>
                                            <li class="border-top-0"><img class="yes-mark" src="{{ asset('public\assetss\images\yes.svg')}}" alt="yes-mark"></li>
                                            <li class="border-top-0"><img class="yes-mark" src="{{ asset('public\assetss\images\yes.svg')}}" alt="yes-mark"></li>
                                            <li class="border-top-0"><img class="yes-mark" src="{{ asset('public\assetss\images\yes.svg')}}" alt="yes-mark"></li>
                                            <li class="border-top-0"><img class="yes-mark" src="{{ asset('public\assetss\images\yes.svg')}}" alt="yes-mark"></li>
                                            <li class="border-top-0"><img class="yes-mark" src="{{ asset('public\assetss\images\yes.svg')}}" alt="yes-mark"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-9 mt-3">
                                <p class="themeColor">Provisioned accounts available: <strong>132</strong></p>
                            </div>
                        </div>
                        
                      
                        <form action="{{ route('client.subscribe')}}" method="POST">
                            @csrf
                        <div class="mfacard p-3 p-md-4">
                            <div class="row">
                                
                                <!-- Subscription Option Selected -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label text-white">Subscription Option Selected</label>

                                    <div class="row">
                                        <div class="col-12">
                                            <input type="radio" name="subscription_type" id="freeAds" value="1" {{ auth()->user()->subscription_type == 1  ? 'checked' : '' }}  onclick="toggleProvisionOthers()">
                                            <label for="freeAds">No Subscription</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex gap-2 align-items-start"> 
                                                <input type="radio" class="mt-1" name="subscription_type" id="freeProvisioned" value="2" {{ auth()->user()->subscription_type == 2  ? 'checked' : '' }}  onclick="toggleProvisionOthers()">
                                                <label for="freeProvisioned mb-3">Provisioned</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input type="radio" name="subscription_type" id="twoPerMonth" value="3" {{ auth()->user()->subscription_type == 3  ? 'checked' : '' }}  onclick="toggleProvisionOthers()">
                                            <label for="twoPerMonth">$2 per month</label>
                                        </div>
            
                                        <!-- Provision accounts for others -->
                                        
                                        <div class="mb-3 col-12">
                                            <div class="form-check"  style="display:{{ (auth()->user()->subscription_type == 1 || auth()->user()->subscription_type == 3)  ? 'block' : 'none' }};" id="provisionOthers">
                                                <input class="form-check-input" type="checkbox" id="provisionForOthers" name="provisionOthers" {{ auth()->user()->provision_others == '1'  ? 'checked' : '' }}  onclick="ProvisionOthers()">
                                                <label class="form-check-label" for="provisionForOthers">
                                                    Provision accounts for others
                                                </label>
                                            </div>
                                        </div>
            
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                               
                                <!-- Provision Type -->
                                <div class="mb-3 col-12" style="display:{{ auth()->user()->provision_others == 1  ? 'block' : 'none' }};" id="Provision1">
                                    <label class="form-label text-white">Provision Type</label>
                                    <select class="form-select themeInput">
                                        <option selected>Monthly provision</option>
                                        <option>One-time Provision</option>
                                    </select>
                                </div>
    
                                <!-- Number of accounts -->
                                <div class="mb-2 col-12" style="display:{{ auth()->user()->provision_others == 1   ? 'block' : 'none' }};" id="Provision2">
                                    <label class="form-label text-white">How many accounts would you like to provision?</label>
                                    <input type="number" class="form-control themeInput" min="1"
                                        placeholder="How many accounts">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="mfacard p-3 p-md-4">
                            <h4 class="text-white pageTitle mb-3">Billing Details</h4>
                            <div class="row">
                                <div class="mb-3 col-md-6 col-12">
                                    <label for="cardName" class="form-label text-white">Name on Card</label>
                                    <input type="text" class="form-control themeInput" id="cardName">
                                </div>
                                <div class="mb-3 col-md-6 col-12">
                                    <label for="cardNumber" class="form-label text-white">Card Number</label>
                                    <input type="text" class="form-control themeInput" id="cardNumber">
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <label for="expiration" class="form-label text-white">Expiration MM/YY</label>
                                    <input type="text" class="form-control themeInput" id="expiration">
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <label for="cvv" class="form-label text-white">CVV</label>
                                    <input type="text" class="form-control themeInput" id="cvv">
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="billingName" class="form-label text-white">Billing Name</label>
                                    <input type="text" class="form-control themeInput" id="billingName">
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="billingAddress" class="form-label text-white">Billing Address</label>
                                    <input type="text" class="form-control themeInput" id="billingAddress">
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <label for="state" class="form-label text-white">State</label>
                                    <input type="text" class="form-control themeInput" id="state">
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <label for="zipCode" class="form-label text-white">Zip Code</label>
                                    <input type="text" class="form-control themeInput" id="zipCode">
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-white d-flex justify-content-between">Today's charge: <strong class="themeColor">$2</strong></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-white d-flex justify-content-between">Recurring charge: <strong class="themeColor">$2 charged monthly</strong></p>
                                </div>
                                <div class="mb-3 col-12">
                                  
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="recurringCharge" checked>
                                        <label class="form-check-label" for="recurringCharge">
                                            I authorize to be charged $2 monthly on the nth day of the month to the card on file ending in xxxx.
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3 col-12">
                
                                <!-- Submit Button -->
                                <button type="submit" class="theme-btn">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
              
            </div>
        </div>
    </div>
   
   </section>
   @section('script')

   <script type="text/javascript">
function toggleProvisionOthers() {
   const provisionOthersDiv = document.getElementById('provisionOthers');
   const selectedValue = document.querySelector('input[name="subscription_type"]:checked');
   const provisionCheckbox = document.getElementById('provisionForOthers');

   if (selectedValue) {
       const value = selectedValue.value;
       if (value === "1" || value === "3") {
           provisionOthersDiv.style.display = 'block';
       } else {
           provisionOthersDiv.style.display = 'none';
           provisionCheckbox.checked = false;
       }
   }
}

function ProvisionOthers() {
    const provisionOthersDiv1 = document.getElementById('Provision1');
    const provisionOthersDiv2 = document.getElementById('Provision2');
    const selectedCheckbox = document.querySelector('input[name="provisionOthers"]'); 
    
    if (selectedCheckbox.checked) {
        provisionOthersDiv1.style.display = 'block';
        provisionOthersDiv2.style.display = 'block';
    } else {
        provisionOthersDiv1.style.display = 'none';
        provisionOthersDiv2.style.display = 'none';
    }
}
   </script>
@endsection
@endsection