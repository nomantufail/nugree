<?php
require_once(resource_path('/views/frontend/partials/upper-content.php'));
?>
    <script type='text/javascript' >
        var appName = 'addPropertyWithAuth';
        var appResources = JSON.parse(<?= (json_encode(json_encode($response['data']['resources']))) ?>);
    </script>
    <!--    <link media="all" rel="stylesheet" href="--><?//= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?><!--/css/addPropertyForm.css">-->
    <!--    <link media="all" rel="stylesheet" href="--><?//= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?><!--/css/propertyListings.css">-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/css/select2.css">
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/css/addPropertyNgSelect.css">
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/css/selectize.default.css">
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/css/add-property-form.css">
    <link rel="stylesheet" href="<?= url('/') ?>/javascripts/ui-select/select.min.css">

    <!-- Angularjs Libs -->
    <script src="<?= url('/') ?>/assets/js/env.js"></script>
    <script src="<?= url('/') ?>/javascripts/angular/angular.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/angular-sanitize.js"></script>
    <script src="<?= url('/') ?>/javascripts/ui-select/select.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/angularfire.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/ng-file-upload/ng-file-upload-all.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/angular-route/angular-route.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/ui-router/angular-ui-router.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/checklist-model.js"></script>

    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/app.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/models/Model.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/directives/appDirectives.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/services/AuthService.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/services/CustomHttpService.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/services/ErrorResponseHandler.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/services/RouteHelper.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/services/ResourceLoader.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/controllers/ParentController.js"></script>
    <!--        Custoemrs Controllers       -->
    <script src="<?= \App\Libs\Helpers\AppHelper::path('AddPropertyWithAuth', $response['version']) ?>/controllers/property/AddPropertyController.js"></script>


    <div id="content" ng-app="addPropertyWithAuth">
        <div class="container loading_content_class" ng-controller="ParentController">
            <div class="pages-holder {{loading_content_class}}" ng-controller="AddPropertyController" ng-init="initialize()">
                <div class="addProperty-form container {{please_wait_class}}"  ng-init="initialize()">
                    <div class="add-form-holder please-wait"  ng-show="propertySaved == false">
                        <div class="main-form">
                            <h1>Add <span>Property</span></h1>
                            <ul class="error">
                                <li data-ng-repeat="error in errors"><span>{{error[0]}}</span></li>
                            </ul>
                            <form class="property-add" ng-submit="submitProperty()">
                                <ul class="radio-checks-holder">
                                    <li class="wanted-holder pull-right">
                                        <label for="add-prop-wanted" class="customCheckbox">
                                            <input name="pro-want" id="add-prop-wanted" type="checkbox" value="1" ng-model="form.data.wanted">
                                            <span class="fake-radio"></span>
                                            <span class="fake-label">Wanted Property</span>
                                        </label>
                                        <div class="img"><img src="<?= url('/').'/web-apps/frontend/assets/images/z.png'?>" alt="Zaroorat property"></div>
                                    </li>
                                </ul>
<!--                                <ul class="radio-checks-holder fore-type">-->
<!--                                    <li>-->
<!--                                        <label for="add-property" class="customRadio">-->
<!--                                            <input type="radio" name="pro-want" id="add-property" checked>-->
<!--                                            <span class="fake-label">Add property</span>-->
<!--                                        </label>-->
<!--                                    </li>-->
<!--                                    <li>-->
<!--                                        <label for="wanted" class="customRadio">-->
<!--                                            <input type="radio" name="pro-want" id="wanted" value="1" ng-model="form.data.wanted">-->
<!--                                            <span class="fake-label">Wanted property</span>-->
<!--                                        </label>-->
<!--                                    </li>-->
<!--                                </ul>-->
                               <strong class="add-pro-heading"><span>property for</span></strong>
                                <ul class="radio-checks-holder fore-type">
                                    <li>
                                        <label for="for-sale" class="customRadio">
                                            <input type="radio" name="add-for" id="for-sale" value="1" ng-model="form.data.propertyPurpose">
                                            <span class="fake-label">For Sale</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="for-rent" class="customRadio">
                                            <input type="radio" name="add-for" id="for-rent" value="2" ng-model="form.data.propertyPurpose">
                                            <span class="fake-label">For Rent</span>
                                        </label>
                                    </li>
                                </ul>
                                <strong class="add-pro-heading"><span>Property Type</span></strong>
                                <ul class="radio-checks-holder fore-type">
                                    <li data-ng-repeat="type in types">
                                        <label for="{{type.name}}" class="customRadio">
                                            <input type="radio" name="propertyType" ng-model="$parent.form.data.propertyType" value="{{type.id}}" id="{{type.name}}" class="addPro-type">
                                            <span class="fake-label">{{type.name}}</span>
                                        </label>
                                    </li>
                                </ul>
                                <ul class="radio-checks-holder subtype-links hidden">
                                    <li data-ng-repeat="subType in subTypes | filter:{propertyTypeId : form.data.propertyType}">
                                        <label for="{{subType.name}}" class="customRadio">
                                            <input type="radio" ng-change="propertySubTypeChanged()" name="propertySubType" ng-model="$parent.form.data.propertySubType" id="{{subType.name}}" value="{{subType.id}}">
                                            <span class="fake-radio"></span>
                                            <span class="fake-label">{{subType.name}}</span>
                                        </label>
                                    </li>
                                </ul>
                                <strong class="add-pro-heading"><span>Property Location</span></strong>
                                <div class="layout clearfix">
                                    <div class="layout-holder">
                                        <label class="required-field">City</label>
                                        <div class="input-holder">
                            <span class="fake-select">
                                <select ng-model="cityId" required>
                                    <option ng-repeat="city in resources.cities" value="{{city.id}}">{{city.name}}</option>
                                </select>
                            </span>
                                        </div>
                                    </div>

                                    <div class="layout-holder">
                                        <label class="required-field">Location</label>
                                        <div class="input-holder">
                                            <ui-select ng-model="temp.location" theme="select2" ng-change="locationChanged()" ng-disabled="ctrl.disabled" title="Choose a Location" required >
                                                <ui-select-match placeholder="select a society...">{{$select.selected.location}}</ui-select-match>
                                                <ui-select-choices refresh="searchLocations($select)" refresh-delay="300" repeat="location in locations">
                                                    <div ng-bind-html="location.location"></div>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="layout-holder">
                                        <label for="property-title">Property Title</label>
                                        <div class="input-holder">
                                            <input type="text" name="propertyTitle" placeholder="Please add property title" ng-model="form.data.propertyTitle" id="property-title"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="layout-holder">
                                        <label class="required-field" for="land-area">Area</label>
                                        <div class="input-holder">
                                            <input type="number" step="any" placeholder="Area of Property" ng-model="form.data.landArea" min="1" id="land-area" required >
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <label class="required-field" for="land-unit">Unit</label>
                                        <div class="input-holder">
                            <span class="fake-select">
                                <select name="land_unit" ng-model="form.data.landUnit" id="land-unit" required>
                                    <option value="" selected disabled >Please Choose...</option>
                                    <option data-ng-repeat="unit in resources.landUnits" value="{{unit.id}}" >{{unit.name}}</option>
                                </select>
                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="layout-holder">
                                        <label class="required-field" for="property-price">Price</label>
                                        <div class="input-holder">
                                            <input type="number" min="1" class="PriceField" placeholder="Please enter the price" name="price" ng-model="form.data.price" id="property-price" required >
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <span class="calculatedPrice">Price must contain numbers only</span>
                                    </div>
                                </div>
                                <div class="layout full-width">
                                    <div class="layout-holder">
                                        <label for="description">Description</label>
                                        <div class="input-holder">
                                            <textarea name="propertyDescription" placeholder="Please write about your property" ng-model="form.data.propertyDescription" required id="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="layout-holder" ng-repeat="feature in highPriorityFeatures">
                                        <label>{{feature.name}}:</label>
                                        <div class="input-holder">
                                            <span my-directive my-text="helo" htmlStructure="{{feature.htmlStructure.html}}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout full-width">
                                    <div class="input-holder">
                                        <a class="extra-features">Extra Feature</a>
                                    </div>
                                </div>
                                <div class="list-extraFeatures">
                                    <div class="col" data-ng-repeat="featureSection in subTypeAssignedFeatures">
                                        <span class="feature-heading">{{featureSection.sectionName}}</span>
                                        <div class="layout">
                                            <div class="layout-holder" ng-repeat="feature in featureSection.features">
                                                <label>{{feature.name}}</label>
                                                <div class="input-holder">
                                                    <span my-directive my-text="helo" htmlStructure="{{feature.htmlStructure.html}}"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden-for-wanted">
                                    <strong class="add-pro-heading"><span>Attachments</span></strong>
                                    <ul class="image-uploading-area">
                                        <li>
                                            <div class="file-uploader">
                                                <input type="file" ngf-select ng-model="form.data.files.mainFile.file" onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
                                                <div class="image-holder">
                                                    <img src="#" class="img-thumb1" alt="image Description">
                                                    <span class="propertyDocumentCloseBtn" ng-click="cancelFile(0)"><span class="icon-cross"></span></span>
                                                </div>
                                            </div>
                                            <input type="text" ng-model="form.data.files.mainFile.title" class="picture-name disableInput" placeholder="Title">
                                        </li>
                                        <li>
                                            <div class="file-uploader">
                                                <input type="file" ngf-select ng-model="form.data.files.twoFile.file" onchange="previewAddPropertyImg(this , '.img-thumb2')" class="upload-img">
                                                <div class="image-holder">
                                                    <img src="#" class="img-thumb2" alt="image Description">
                                                    <span class="propertyDocumentCloseBtn" ng-click="cancelFile(1)"><span class="icon-cross"></span></span>
                                                </div>
                                            </div>
                                            <input type="text" ng-model="form.data.files.twoFile.title" class="picture-name disableInput" placeholder="Title">
                                        </li>
                                        <li>
                                            <div class="file-uploader">
                                                <input type="file" ngf-select ng-model="form.data.files.threeFile.file" onchange="previewAddPropertyImg(this , '.img-thumb3')" class="upload-img">
                                                <div class="image-holder">
                                                    <img src="#" class="img-thumb3" alt="image Description">
                                                    <span class="propertyDocumentCloseBtn" ng-click="cancelFile(2)"><span class="icon-cross"></span></span>
                                                </div>
                                            </div>
                                            <input type="text" ng-model="form.data.files.threeFile.title" class="picture-name disableInput" placeholder="Title">
                                        </li>
                                        <li>
                                            <div class="file-uploader">
                                                <input type="file" ngf-select ng-model="form.data.files.fourFile.file" onchange="previewAddPropertyImg(this , '.img-thumb4')" class="upload-img">
                                                <div class="image-holder">
                                                    <img src="#" class="img-thumb4" alt="image Description">
                                                    <span class="propertyDocumentCloseBtn" ng-click="cancelFile(3)"><span class="icon-cross"></span></span>
                                                </div>
                                            </div>
                                            <input type="text" ng-model="form.data.files.fourFile.title" class="picture-name disableInput" placeholder="Title">
                                        </li>
                                        <li>
                                            <div class="file-uploader">
                                                <input type="file" ngf-select ng-model="form.data.files.fiveFile.file" onchange="previewAddPropertyImg(this , '.img-thumb5')" class="upload-img">
                                                <div class="image-holder">
                                                    <img src="#" class="img-thumb5" alt="image Description">
                                                    <span class="propertyDocumentCloseBtn" ng-click="cancelFile(4)"><span class="icon-cross"></span></span>
                                                </div>
                                            </div>
                                            <input type="text" ng-model="form.data.files.fiveFile.title" class="picture-name disableInput" placeholder="Title">
                                        </li>
                                        <li>
                                            <div class="file-uploader">
                                                <input type="file" ngf-select ng-model="form.data.files.sixFile.file" onchange="previewAddPropertyImg(this , '.img-thumb6')" class="upload-img">
                                                <div class="image-holder">
                                                    <img src="#" class="img-thumb6" alt="image Description">
                                                    <span class="propertyDocumentCloseBtn" ng-click="cancelFile(5)"><span class="icon-cross"></span></span>
                                                </div>
                                            </div>
                                            <input type="text" ng-model="form.data.files.sixFile.title" class="picture-name disableInput" placeholder="Title">
                                        </li>
                                    </ul>
                                </div>
                                <strong class="add-pro-heading"><span>User Details</span></strong>
                                <ul class="existingOrNew-member">
                                    <li>
                                        <input type="radio" ng-model="form.data.memberType" value="1" name="radio" id="existing-member" checked>
                                        <label for="existing-member">Existing Member</label>
                                        <div class="slide">
                                            <div class="layout">
                                                <label for="email" class="required-field">E-mail ID</label>
                                                <div class="input-holder">
                                                    <input type="text" name="login_email" placeholder="Email" ng-model="form.data.loginDetails.email">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="password" class="required-field">Password</label>
                                                <div class="input-holder">
                                                    <input type="password" ng-model="form.data.loginDetails.password" id="password" placeholder="Please enter the Password">
                                                </div>
                                            </div>
                                            <a href="#forgot-pass" class="forgot-pass lightbox">Forgot Password ?</a>
                                        </div>
                                    </li>
                                    <li>
                                        <input type="radio" ng-model="form.data.memberType" value="0" name="radio" id="new-member">
                                        <label for="new-member">New Member (Free)</label>
                                        <div class="slide">
                                            <div class="layout">
                                                <label for="f-name">First Name</label>
                                                <div class="input-holder">
                                                    <input type="text" name="newMember_fName" placeholder="First Name" ng-model="form.data.newMemberDetails.fName">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="l-name">Last name</label>
                                                <div class="input-holder">
                                                    <input type="text" name="newMember_email" placeholder="Last Name" ng-model="form.data.newMemberDetails.lName">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="new-email">Email</label>
                                                <div class="input-holder">
                                                    <input type="email" name="newMember_email" placeholder="Email" ng-model="form.data.newMemberDetails.email">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="new-phone">Phone</label>
                                                <div class="input-holder">
                                                    <input type="tel" name="newMember_phone" placeholder="Phone" ng-model="form.data.newMemberDetails.cell">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="new-password">Password</label>
                                                <div class="input-holder">
                                                    <input type="password" name="newMember_password" placeholder="Password" ng-model="form.data.newMemberDetails.password">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <input type="submit" value="SUBMIT PROPERTY">
                            </form>
                        </div>
                    </div>
                    <div class="thankYou-message" ng-show="propertySaved == true">
                        <h1>Safe <span>successfully</span></h1>
                        <div class="layout">
                            <div class="left"><span class="icon-check"></span></div>
                            <div class="right">
                                <p>Your property details have been received. It will be reviewed by our staff within 24 hours.</p>
                                <p>Property type: <b>Free Listing</b></p>
                                <p>Property status: <b>Pending</b></p>
                            </div>
                        </div>
                        <a href="{{domain}}" class="btn-default">Got it !</a>
                    </div>
                    <div class="popup-holder">
                        <div class="popup lightbox generic-lightbox" id="forgot-pass">
                            <span>{{message}}</span>
                            <form class='forgot-form' ng-submit="sendForgetPasswordMail()">

                                <h1>Forgot <span>Password</span></h1>

                                <p>Enter your email address below and we will send you a new password.</p>

                                <div class="layout">
                                    <label for="forgot-email">E-mail ID</label>

                                    <div class="input-holder">
                                        <span class="error-text"></span>
                                        <input type="email" name="email" ng-model="forgetPassword.data.email" placeholder="Enter Your Email Address" id="email">

                                    </div>
                                </div>
                                <ul class="buttons-holder text-upparcase text-center">
                                    <li>
                                        <button type="submit">SEND</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         </div>

    </div>

    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/js/jquery-1.11.2.min.js" defer></script>
    <!-- include custom JavaScript -->
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/js/tabset-plugin.js" defer></script>
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/js/helper.js" defer></script>
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/js/add-propertyFrom.js" defer></script>
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/js/jquery.main.js" defer></script>
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/js/customSelect.js" defer></script>
    <!-- include custom JavaScript -->
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('AddPropertyWithAuth', $response['version']) ?>/js/placeholder.js" defer></script>

<?php
require_once(resource_path('/views/frontend/partials/bottom-content.php'));
?>