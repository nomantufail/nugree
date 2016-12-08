@extends('frontend.v2.frontend')
@section('content')
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/v2/css/register-now.css">
    <div class="registerNow container">
        <?php
        if(\Session::has('validationErrors')){
            $validationErrors = \Session::get('validationErrors');
        }
        ?>
        <form class="registration-form" method="post" action="{{route('register')}}" enctype="multipart/form-data">
            <h1>Register <span>Now</span></h1>
            <div class="layout">
                <div class="layout-holder">
                    <label class="required-field" for="f-name">First Name</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('fName')) error @endif">
                        <input type="text" placeholder="Enter Your First Name" name="fName" id="fName" value="{{old('fName')}}" required>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('fName')) {{$validationErrors->first('fName')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label class="required-field" for="l-name">Last Name</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('lName')) error @endif">
                        <input type="text" placeholder="Enter Your Last Name" name="lName" value="{{old('lName')}}" id="lName" required>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('lName')) {{$validationErrors->first('lName')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label class="required-field" for="email">Email</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                        <input type="email" placeholder="Enter Your Email Address"  id="email1" value="{{old('email')}}" name="email" required>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                    </div>
                </div>
            </div>
            <div class="layout">
                <div class="layout-holder">
                    <label class="required-field" for="pass">Password</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('password')) error @endif">
                        <input type="password" placeholder="Enter Your Password" id="pass1"  name="password" required>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('password')) {{$validationErrors->first('password')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label class="required-field" for="re-pass">Re-Enter Password</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('passwordAgain')) error @endif">
                        <input type="password"  placeholder="Confirm Password" name="passwordAgain" id="cpass" required>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('passwordAgain')) {{$validationErrors->first('passwordAgain')}} @endif</span>
                    </div>
                </div>
            </div>
            <strong class="registerNow-heading"><span>Contact Information</span></strong>
            <div class="layout two">
                <div class="layout-holder">
                    <label for="address">Address</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('address')) error @endif">
                        <input type="text" placeholder="Enter Your Address" value="{{old('address')}}" name="address" id="address" >
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('address')) {{$validationErrors->first('address')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label  for="m-number">Mobile Number</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('mobile')) error @endif">
                        <input type="tel" placeholder="Enter Your Cell / Mobile Number" value="{{old('mobile')}}" name="mobile" id="cell" required>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('mobile')) {{$validationErrors->first('mobile')}} @endif</span>
                    </div>
                </div>
            </div>
            <div class="layout two">
                <div class="layout-holder phone-num">
                    <label class="required-field" for="p-number">Phone Number</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('phone')) error @endif">
                        <input type="tel" placeholder="Enter Your Phone Number" name="phone" value="{{old('phone')}}" id="p-number" >
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('phone')) {{$validationErrors->first('phone')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder otherRole">
                    <label for="address">Other Roles</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('userRoles')) error @endif">
                        <a class="role-opener">0 Selected</a>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('userRoles')) {{$validationErrors->first('userRoles')}} @endif</span>
                    </div>
                </div>
            </div>
            <ul class="role-listing">
                @foreach($response['roles'] as $role)
                    <li>
                        <label for="role_{{$role->id}}" class="customCheckbox">
                            <input type="checkbox" id="role_{{$role->id}}" class="userRole-checkbox @if($role->id == 3) agent-brokerCheckbox @endif;" name="userRoles[]" value="{{$role->id}}" @if(in_array($role->id,(old('userRoles') !=null)?old('userRoles'):[])) checked @endif>
                            <span class="fake-checkbox"></span>
                            <span class="fake-label">{{$role->name}}</span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <strong class="registerNow-heading smaller">
            <span>
                Are you an Agent ? <b>No</b>
                <label for="agentCheck-field" class="agent-check">
                    <input type="checkbox" class="hidden-checkfield agent-brokerCheckbox" name="agent" @if(old('agent') !="")checked @endif  id="agentCheck-field">
                    <span class="fake-checkbox">
                        <span class="fake-button"></span>
                    </span>
                </label>
                <b>Yes</b>
            </span>
            </strong>
            <div class="agent-information">
                <strong class="registerNow-heading">Agent Information</strong>
                <div class="layout two first-small">
                    <div class="layout-holder">
                        <div class="company-logo">
                            <input type="file" name="companyLogo"  onchange="companyLogoUploader(this , '.company-profileP')" id="c-logo">
                            <span class="name-tag">Add Company Logo</span>
                            <div class="logo-holder">
                                <label for="c-logo"><span class="icon-plus-square"></span></label>
                                <div class="picture-holder">
                                    <img src="" class="company-profileP" alt="Company logo">
                                    <a class="company-logo-delete"><span class="icon-cross"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layout-holder">
                        <div class="full-width">
                            <label class="required-field" for="agencyName">Agency Name</label>
                            <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('agencyName')) error @endif">
                                <input type="text" placeholder="Enter An Agency Name" id="agency-name" name="agencyName" value="{{old('agencyName')}}" required>
                                <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('agencyName')) {{$validationErrors->first('agencyName')}} @endif</span>
                            </div>
                        </div>
                        <div class="full-width">
                            <label for="D-services">Agency Description</label>
                            <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('agencyDescription')) error @endif">
                                <textarea id="D-services" name="agencyDescription" placeholder="Description of Services">{{old('agencyDescription')}}</textarea>
                                <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('agencyDescription')) {{$validationErrors->first('agencyDescription')}} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layout two first-small">
                    <div class="layout-holder">
                        <label for="selectSociety">Filter Societies You Deal In</label>
                        <div class="input-holder  @if(isset($validationErrors) && $validationErrors->has('societies')) error @endif">
                            <input type="text" placeholder="Filter Societies You Deal In:" id="search-society" name="SelectDealSociety">
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('societies')) {{$validationErrors->first('societies')}} @endif</span>
                        </div>
                    </div>
                    <div class="layout-holder">
                        <ul class="packetData-list">

                        </ul>
                    </div>
                </div>
                <div class="input-holder full-width">
                    <ul class="societiesBlock-listing">
                        @foreach($response['societies'] as $society)
                            <li>
                                <label for="society{{$society->id}}" class="customCheckbox">
                                    <input type="checkbox" id="society{{$society->id}}" class="selectSociety-checkbox" name="societies[]" value="{{$society->id}}"
                                           @if(in_array($society->id,(old('societies') !=null)?old('societies'):[])) checked @endif>
                                    <span class="fake-checkbox"></span>
                                    <span class="fake-label">{{$society->name}}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <strong class="registerNow-heading">Agency Contact Details</strong>
                <div class="layout">
                    <div class="layout-holder">
                        <label for="companyPhone">Phone Number</label>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyPhone')) error @endif">
                            <input type="tel" placeholder="Enter Your Phone Number" name="companyPhone" value="{{old('phone')}}" id="phone" >
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyPhone')) {{$validationErrors->first('companyPhone')}} @endif</span>
                        </div>
                    </div>
                    <div class="layout-holder">
                        <label class="required-field" for="company-mobile">Mobile Number</label>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyMobile')) error @endif">
                            <input type="tel" placeholder="Enter Company Mobile Number" name="companyMobile" value="{{old('companyMobile')}}" id="company-mobile" >
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyMobile')) {{$validationErrors->first('companyMobile')}} @endif</span>
                        </div>
                    </div>
                    <div class="layout-holder">
                        <label class="required-field" for="compny-email">Company E-mail</label>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyEmail')) error @endif">
                            <input type="email" placeholder="Enter Company Email" name="companyEmail" value="{{old('companyEmail')}}" id="compny-email" required >
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyEmail')) {{$validationErrors->first('companyEmail')}} @endif</span>
                        </div>
                    </div>
                </div>
                <div class="layout two">
                    <div class="layout-holder">
                        <label for="compny-address">Company Address</label>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyAddress')) error @endif">
                            <input type="text" placeholder="Enter Company Address" name="companyAddress" value="{{old('companyAddress')}}" id="compny-address"  >
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyAddress')) {{$validationErrors->first('companyAddress')}} @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layout two">
                <div class="layout-holder">
                    <ul class="agree-with-terms">

                        <li class="input-holder @if(isset($validationErrors) && $validationErrors->has('termsConditions')) error @endif">
                            <label class="customCheckbox @if(isset($validationErrors) && $validationErrors->has('termsConditions')) error @endif">
                                <input type="checkbox" name="termsConditions" value="1" @if(old('termsConditions') !="")checked @endif>
                                <span class="fake-checkbox "></span>
                                <span>I have read and agree to nugree.com <a href="#terms-of-user" class="termsOfUse lightbox">Terms and Conditions</a></span>
                                <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('termsConditions')) {{$validationErrors->first('termsConditions')}} @endif</span>
                            </label>
                        </li>
                        <li>
                            <label class="customCheckbox" for="newslatter" class="customCheckbox">
                                <input type="checkbox" id="newslatter" name="wantNotifications" @if(old('wantNotifications') !="")checked @endif >
                                <span class="fake-checkbox"></span>
                                <span class="fake-label">I want to receive notifications for promotions, newsletters and website updates.</span>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="layout-holder">
                    <input type="submit" value="SIGN ME UP">
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $( ".hidden-checkfield" ).trigger( "change" );
            $(".selectSociety-checkbox").trigger("change");
        });
    </script>
@endsection