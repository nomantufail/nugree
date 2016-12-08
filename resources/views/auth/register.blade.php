@extends('auth.auth')

@section('content')
<div class="container">
    <div class="login-registarHolder">
        <?php
        if(\Session::has('validationErrors')){
            $validationErrors = \Session::get('validationErrors');
        }
        ?>
            <ul class="tabset">
                <li class="active"><a  href="{{url('/register')}}">become a free member</a></li>
                <li class="last-child"><span>Already have an account ?</span> <a href="{{url('/login')}}">Login</a></li>
            </ul>
        <div class="tab-content">
            <div id="tab2">
                @if(\Session::has('success'))
                    {{\Session::get('success')}}
                @endif
                @if(\Session::has('errors'))
                        <span style="color:red;">
                            @foreach(\Session::get('errors') as $error)
                                {{$error}}<br>
                            @endforeach
                        </span>
                @endif

                <form class="registration-form" method="post" action="{{route('register')}}" enctype="multipart/form-data">
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('fName')) error @endif">
                        <label class="icon-user" for="fName"></label>
                        <input type="text" placeholder="Enter Your First Name" name="fName" id="fName" value="{{old('fName')}}" required>
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('fName')) {{$validationErrors->first('fName')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('lName')) error @endif">
                        <label class="icon-user" for="lName"></label>
                        <input type="text" placeholder="Enter Your Last Name" name="lName" value="{{old('lName')}}" id="lName" required>
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('lName')) {{$validationErrors->first('lName')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('password')) error @endif">
                        <label class="icon-key" for="pass1"></label>
                        <input type="password" placeholder="Enter Your Password" id="pass1"  name="password" required>
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('password')) {{$validationErrors->first('password')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('passwordAgain')) error @endif">
                        <label class="icon-key" for="cpass"></label>
                        <input type="password"  placeholder="Confirm Password" name="passwordAgain" id="cpass" required>
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('passwordAgain')) {{$validationErrors->first('passwordAgain')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                        <label class="icon-envelope" for="email1"></label>
                        <input type="email" placeholder="Enter Your Email Address"  id="email1" value="{{old('email')}}" name="email" required>
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                    </div>
                    <h1>Contact Information</h1>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('phone')) error @endif">
                        <label class="icon-phone" for="phone"></label>
                        <input type="tel" placeholder="Enter Your Phone Number" name="phone" value="{{old('phone')}}" id="phone" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('phone')) {{$validationErrors->first('phone')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('mobile')) error @endif">
                        <label class="icon-phone_iphone" for="cell"></label>
                        <input type="tel" placeholder="Enter Your Cell / Mobile Number" value="{{old('mobile')}}" name="mobile" id="cell" required>
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('mobile')) {{$validationErrors->first('mobile')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('fax')) error @endif">
                        <label class="icon-fax" for="fax"></label>
                        <input type="tel" placeholder="Enter Fax Details" value="{{old('fax')}}" name="fax" id="fax" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('fax')) {{$validationErrors->first('fax')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('address')) error @endif">
                        <label class="icon-directions" for="address"></label>
                        <input type="text" placeholder="Enter Your Address" value="{{old('address')}}" name="address" id="address" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('address')) {{$validationErrors->first('address')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('zipCode')) error @endif">
                        <label class="icon-file-zip" for="zip"></label>
                        <input type="text" placeholder="Enter Zip Code" name="zipCode" value="{{old('zipCode')}}" id="zip">
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('zipCode')) {{$validationErrors->first('zipCode')}} @endif</span>
                    </div>
                    <div class="input-holder">
                        <label for="agent" class="agent-check">
                            <input type="checkbox" class="hidden-checkfield agent-brokerCheckbox" name="agent" @if(old('agent') !="")checked @endif  id="agent">
										<span class="fake-checkbox">
											<span class="fake-button"></span>
										</span>
                            <span class="fake-label">Are you an Agent</span>
                        </label>
                    </div>
                    <div class="input-holder full-width @if(isset($validationErrors) && $validationErrors->has('userRoles')) error @endif">
                        <div class="roles">
                            <a class="role-opener">Other Roles:</a>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('userRoles')) {{$validationErrors->first('userRoles')}} @endif</span>
                            <ul class="role-listing">
                                @foreach($response['roles'] as $role)
                                    <li>
                                        <input type="checkbox" id="role_{{$role->id}}" class="userRole-checkbox @if($role->id == 3) agent-brokerCheckbox @endif;" name="userRoles[]" value="{{$role->id}}" @if(in_array($role->id,(old('userRoles') !=null)?old('userRoles'):[])) checked @endif>
                                        <label for="role_{{$role->id}}">{{$role->name}}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="agent-information">
                        <h1>Agency Information</h1>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('agencyName')) error @endif">
                            <label for="agency-name" class="icon-agency"></label>
                            <input type="text" placeholder="Enter An Agency Name" id="agency-name" name="agencyName" value="{{old('agencyName')}}" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('agencyName')) {{$validationErrors->first('agencyName')}} @endif</span>
                        </div>
                        <div class="input-holder onTop-mobile @if(isset($validationErrors) && $validationErrors->has('companyLogo')) error @endif">
                            <div class="company-logo">
                                <input type="file" name="companyLogo"  onchange="companyLogoUploader(this , '.company-profileP')">
                                <div class="picture-holder"><img src="" class="company-profileP" alt="Company logo"></div>
                                <a class="delete"><span class="icon-bin"></span></a>
                                <span class="name-tag">Add Company Logo</span>
                            </div>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyLogo')) {{$validationErrors->first('companyLogo')}} @endif</span>
                        </div>
                        <div class="input-holder full-width @if(isset($validationErrors) && $validationErrors->has('agencyDescription')) error @endif">
                            <label for="D-services" class="icon-technical-support"></label>
                            <textarea id="D-services" name="agencyDescription" placeholder="Description of Services">{{old('agencyDescription')}}</textarea>
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('agencyDescription')) {{$validationErrors->first('agencyDescription')}} @endif</span>
                        </div>
                        <div class="input-holder full-width no-indent  @if(isset($validationErrors) && $validationErrors->has('societies')) error @endif">
                            <label for="search-society" class="icon-society"></label>
                            <input type="text" placeholder="Select Societies You Deal In:" id="search-society" name="SelectDealSociety">
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('societies')) {{$validationErrors->first('societies')}} @endif</span>
                            <span class="calculatedSocieties"></span>
                        </div>

                        <div class="input-holder full-width">
                            <ul class="societiesBlock-listing">
                                @foreach($response['societies'] as $society)
                                    <li>
                                        <input type="checkbox" id="society{{$society->id}}" class="selectSociety-checkbox" name="societies[]" value="{{$society->id}}"
                                               @if(in_array($society->id,(old('societies') !=null)?old('societies'):[])) checked @endif>
                                        <label for="society{{$society->id}}">{{$society->name}}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <h1> Agency Contact Details</h1>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyPhone')) error @endif">
                            <label for="compny-phone" class="icon-phone"></label>
                            <input type="tel" placeholder="Enter Company Phone Number" name="companyPhone" value="{{old('companyPhone')}}" id="compny-phone" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyPhone')) {{$validationErrors->first('companyPhone')}} @endif</span>
                        </div>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyMobile')) error @endif">
                            <label for="compny-mobile" class="icon-phone_iphone"></label>
                            <input type="tel" placeholder="Enter Company Mobile Number" name="companyMobile" value="{{old('companyMobile')}}" id="compny-mobile" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyMobile')) {{$validationErrors->first('companyMobile')}} @endif</span>
                        </div>
                        <div class="input-holder full-width @if(isset($validationErrors) && $validationErrors->has('companyAddress')) error @endif">
                            <label for="compny-address" class="icon-directions"></label>
                            <input type="text" placeholder="Enter Company Address" name="companyAddress" value="{{old('companyAddress')}}" id="compny-address" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyAddress')) {{$validationErrors->first('companyAddress')}} @endif</span>
                        </div>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyEmail')) error @endif">
                            <label for="compny-email" class="icon-envelope"></label>
                            <input type="email" placeholder="Enter Company Email" name="companyEmail" value="{{old('companyEmail')}}" id="compny-email" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyEmail')) {{$validationErrors->first('companyEmail')}} @endif</span>
                        </div>
                    </div>
                    <div class="input-holder full-width @if(isset($validationErrors) && $validationErrors->has('termsConditions')) error @endif">
                        <ul class="terms-listing">
                            <li>
                                <input type="checkbox" id="terms-Cond" name="termsConditions" value="1" @if(old('termsConditions') !="")checked @endif required>
                                <label for="terms-Cond">I have read and agree to nugree.com <a href="#">Terms and Conditions</a> <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('termsConditions')) {{$validationErrors->first('termsConditions')}} @endif</span></label>
                            </li>
                            <li>
                                <input type="checkbox" id="newslatter" name="wantNotifications" @if(old('wantNotifications') !="")checked @endif >
                                <label for="newslatter">I  want to receive notifications for promotions, newsletters and website updates.</label>
                            </li>
                        </ul>
                    </div>
                    <div class="input-holder full-width">
                        <button type="submit">Sign me up !!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function(){
            $( ".hidden-checkfield" ).trigger( "change" );
        });
    </script>
@endsection