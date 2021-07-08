@section('page-title', __tr('Create an Account'))
@section('head-title', __tr('Create an Account'))
@section('keywordName', strip_tags(__tr('Create an Account!')))
@section('keyword', strip_tags(__tr('Create an Account!')))
@section('description', strip_tags(__tr('Create an Account!')))
@section('keywordDescription', strip_tags(__tr('Create an Account!')))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- include header -->
@include('includes.theme-header')
<!-- /include header -->
<body class="lw-login-register-page">
    <!--    <div class="preloader">
            <div class="preloader-inner">
                <div class="preloader-icon">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>-->
    <section class="log-reg" style="height: auto;">
        <div class="top-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <a style="color: purple;" href="<?= url(''); ?>" class="backto-home"><i class="fas fa-chevron-left"></i> Back to Home</a>
                    </div>
                    <div class="col-lg-8 ">
                        <div class="logo text-right">
                            <img height="50" src="<?= __yesset('dist/Assets/images/logo@2x.png') ?>" alt="logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!--<div class="row justify-content-end">-->
                <!--        <div class="image image-log">
                        </div>-->
                <div class="col-lg-12" style="margin: 0 auto;">
                    <div class="log-reg-inner pt-2" style="height: auto;">
                        <div class="section-header inloginp pt-5">
                            <h2 class="title">
                                Welcome to Nubian Hearts
                            </h2>
                        </div>
                        @if(session('errorStatus'))
                        <!--  success message when email sent  -->
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= session('message') ?>
                        </div>
                        <!--  /success message when email sent  -->
                        @endif
                        <div class="main-content inloginp lw-ajax-form lw-form">
                            <form class="user lw-ajax-form lw-form" method="post" id="form"action="<?= route('user.sign_up.process') ?>" data-show-processing="true" data-secured="true" data-unsecured-fields="first_name,last_name">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <!--<h4 class="content-title">Acount Details</h4>-->
                                        <div class="form-group">
                                            <label for="">Username*</label>
                                            <input type="text" name="username" class="my-form-control" placeholder="Enter Your Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Last Name*</label>
                                            <input type="text" class="my-form-control" name="last_name" placeholder="<?= __tr('Last Name') ?>" required minlength="3">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email Address*</label>
                                            <input type="email" name="email" class="my-form-control" placeholder="Enter Your Email">
                                        </div>
                                        <input type="hidden" name="mobile_number" value="12345678901">
                                        <div class="form-group">
                                            <label for="">Password*</label>
                                            <input type="password" class="my-form-control" placeholder="Enter Your Password" name="password" required="">
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <!--<h4 class="content-title mt-5">Profile Details</h4>-->
                                        <div class="form-group">
                                            <label for="">First Name*</label>
                                            <input type="text" class="my-form-control" name="first_name" placeholder="<?= __tr('First Name') ?>" required minlength="3">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Birthday*</label>
                                            <input type="date" name="dob" class="my-form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">I am a*</label>
                                               <div class="s-input nice-select-wraper">
                                                  <select class="select-bar option"  name="gender" id="select_gender" required>
                                                     @foreach($genders as $genderKey => $gender)
                                                    <option value="<?= $genderKey ?>"><?= $gender ?></option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Confirm Password*</label>
                                            <input type="password" class="my-form-control" placeholder="Enter Your Password" name="repeat_password" required="">
                                        </div>
                                        <input type="hidden" name="looking_for" value="">
                                       <!--  <div class="form-group">
                                            <label for="">Looking for a*</label>
                                        
                                            <div class="s-input nice-select-wraper">
                                              <select class="select-bar option" name="looking_for" id="select_gender" required>
                                                 @foreach($genders as $genderKey => $gender)
                                                <option value="<?= $genderKey ?>"><?= $gender ?></option>
                                                @endforeach
                                              </select>
                                            </div>    
                                        </div> -->
                                        
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="hidden" name="accepted_terms"> 
                                                <input type="checkbox" class="form-check-input" id="acceptTerms" name="accepted_terms" value="1" required> 
                                                <label class="form-check-label" for="acceptTerms">
                                                    <?= __tr('I accept all ') ?>
                                                    <a target="_blank" href="<?= getStoreSettings('terms_and_conditions_url') ?>">
                                                    <?= __tr('terms and conditions') ?></a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="custom-button" id="submitButton" data-toggle="modal" data-target="#email-confirm">Create Your
                                    Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /container end -->
</body>

@push('appScripts')
<script type="text/javascript">
    $(document).ready(function(){
    jQuery.validator.addMethod("twentyone", function(value, element) {
        var today = new Date(),
            dd = today.getDate(),
            mm = today.getMonth() + 1,
            yyyy = today.getFullYear();
        
        var dateOfBirth = value;
        var arr_dateText = dateOfBirth.split("-");
        day = arr_dateText[2];
        month = arr_dateText[1];
        year = arr_dateText[0];

        if (year == (yyyy - 19)) {
            if (month == mm) {
                if (day > dd) {
                    $('#submitButton').prop('disabled', true);
                    return false;
                } else {
                    $('#submitButton').prop('disabled', false);
                    return true;
                }
            } else if (month > mm) {
                 $('#submitButton').prop('disabled', true);
                return false;
            } else {
                $('#submitButton').prop('disabled', false);
                return true;
            }
        } else if (year > (yyyy - 19)) {
             $('#submitButton').prop('disabled', true);
            return false;
        } else {
            $('#submitButton').prop('disabled', false);
            return true;
        }
    }, "You must verify that you are 19 years old.");
    
    $("#form").validate({
        rules: {
            "dob": {
                required: true,
                twentyone: true
            }
        },
        submitHandler: function(form) {
            // form.submit();
          alert("Success! You are over 19.");
        }
    });
});
</script>
@endpush
<!-- include footer -->
@include('includes.footer')
<!-- /include footer -->
</html>