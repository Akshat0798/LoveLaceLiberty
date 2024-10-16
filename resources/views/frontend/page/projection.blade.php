@extends('frontend.layouts.layout')


@section('content')

@include('frontend.includes.sidebar')
<div class="main h-100 overflow-auto pt-3 pt-md-5">
    <div class="container h-100">
        <div class="row justify-content-center">
            <div class="col-12">
                <h4 class="text-white pageTitle mb-4 text-center">Who are you planning to vote for?</h4>

            </div>
            <div class="col-12 col-md-3">
                <a href="IdentityVerification.html" class="theme-btn mt-3">Verify to Participate</a>

               
            </div>

            <div class="col-12 col-md-5">
                <div class="mfacard w-100 p-3 p-md-4">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="text-white pageTitle">Poll Form</h4>
                            <form action="electionAuditing.html" class="mt-4 row">
                                <div class="col-12">
                                    <label for="" class="mb-2">Election Type</label>
                                    <select class="form-select themeInput" id="selectDivs">
                                        <option selected>Federal</option>
                                        <option>State</option>
                                        <option>Local</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="selectA">
                                        <label for="" class="mb-2">Federal all elected</label>

                                        <select class="form-select themeInput">
                                            <option selected>Presidential</option>
                                            <option> US Senate</option>
                                            <option> US House</option>
                                        </select>
                                    </div>
                                    <div class="selectB d-none">
                                        <label for="" class="mb-2"> Varies state by state</label>

                                        <select class="form-select themeInput">
                                            <option selected>Governor</option>
                                            <option> State Senate</option>
                                            <option> State House</option>
                                            <option> Attorney General (Elected in most states)</option>
                                            <option> Secretary of State (Elected in most states)</option>
                                            <option> State Treasurer (Elected in some states)</option>
                                            <option> Lieutenant Governor (Elected in some states)</option>
                                            <option> State Judges (Elected in some states)</option>
                                        </select>
                                    </div>
                                    <div class="selectC d-none">
                                        <label for="" class="mb-2">  Some positions are appointeds</label>

                                        <select class="form-select themeInput">
                                            <option selected>Mayor</option>
                                            <option> City/Town/County Council</option>
                                            <option> County Commissioners</option>
                                            <option> Sheriff (County Level) - (Elected in some areas)</option>
                                            <option> District Attorney (Elected in some areas)</option>
                                            <option>  School Board Members</option>
                                            <option> Judges (Local level) - (Elected in some areas)</option>
                                            <option>  City Clerk (Elected in some areas)</option>
                                            <option>   Tax Assessor (Elected in some areas)</option>
                                        </select>
                                    </div>
                                   
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex gap-2 align-items-start">
                                    <input type="radio" class="mt-2" name="Candidate1" id="Candidate1">
                                    <label for="Candidate1" >Candidate1 <br> <small>Party A</small></label>
                                </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex gap-2 align-items-start">
                                        <input type="radio" class="mt-2" name="Candidate1" id="Candidate2">
                                        <label for="Candidate2" >Candidate2 <br> <small>Party B</small></label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <button type="submit" class="theme-btn mt-3">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
               <div class="mfacard w-100 px-3 py-2 mt-3 d-flex justify-content-between">
                <ul class="d-flex gap-3 list-unstyled align-items-center mb-0">
                    <li>
                        <p class="candidate1  mb-0 text-white">Projected Election Winner </p>
                    </li>
                </ul>
                <h6 class="voteCount themeColor mb-0">Candidate 1</h6>
               </div>
            </div>
        </div>
       
    </div>
</div>
   @section('script')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
   <script src="https://rawgit.com/NewSignature/us-map/master/jquery.usmap.js"></script>
   <script src="https://rawgit.com/NewSignature/us-map/master/example/color.jquery.js"></script>
   @endsection
</div>
@endsection