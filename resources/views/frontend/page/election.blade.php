@extends('frontend.layouts.layout')


@section('content')

@include('frontend.includes.sidebar')
<div class="main h-100 overflow-auto pt-3 pt-md-5">
<div class="container h-100">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5">
            <h4 class="text-white pageTitle mb-4">Electoral Votes (Internal)</h4>
            <a href="javascript:;" class="theme-btn mt-3">Participate in the internal election!</a>

            <div  class="text-white mb-3 mt-2">Who did you vote for?</div>
            <div id="selected-state" class="text-white">Which state is that? <span></span></div>
            <div id="map" class="mt-3"></div>
        </div>

        <div class="col-12 col-md-5">
            <div class="mfacard w-100 p-3 p-md-4">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-white pageTitle">Cast your vote</h4>
                        <form action="electionAuditing.html" class="mt-4 row">
                            <div class="col-12">
                                <select class="form-select themeInput">
                                    <option selected>Election Type</option>
                                    <option>Type One</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <select class="form-select themeInput">
                                    <option selected>Presidential Election</option>
                                    <option>Type One</option>
                                </select>
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
            <div class="col-12 mt-3">
                <select class="form-select themeInput">
                    <option selected>Election Type</option>
                    <option>Type One</option>
                </select>
            </div>
            <div class="col-12 mt-2">
                <div class="candidateResult px-3 py-2 w-100 mfacard d-flex align-items-center justify-content-between">
                    <ul class="d-flex gap-3 list-unstyled align-items-center mb-0">
                        <li>
                            <div class="color bg-danger p-1"></div>
                        </li>
                        <li>
                            <div class="candidateImg">
                                <img src="images/user.svg" alt="candidateImg">
                            </div>
                        </li>
                        <li>
                            <p class="candidate1 text-white mb-0">Candidate1</p>
                        </li>
                    </ul>
                    <h6 class="voteCount themeColor mb-0">nn Votes</h6>
                </div>
                <div class="candidateResult mt-3 px-3 py-2 w-100 mfacard d-flex align-items-center justify-content-between">
                    <ul class="d-flex gap-3 list-unstyled align-items-center mb-0">
                        <li>
                            <div class="color bg-primary p-1"></div>
                        </li>
                        <li>
                            <div class="candidateImg">
                                <img src="images/user.svg" alt="candidateImg">
                            </div>
                        </li>
                        <li>
                            <p class="candidate1 text-white mb-0">Candidate2</p>
                        </li>
                    </ul>
                    <h6 class="voteCount themeColor mb-0">nn Votes</h6>
                </div>
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