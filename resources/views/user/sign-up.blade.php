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
    <section class="log-reg">
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
                            <form class="user lw-ajax-form lw-form" method="post" action="<?= route('user.sign_up.process') ?>" data-show-processing="true" data-secured="true" data-unsecured-fields="first_name,last_name">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <!--<h4 class="content-title">Acount Details</h4>-->
                                        <div class="form-group">
                                            <label for="">Username*</label>
                                            <input type="text" class="my-form-control" placeholder="Enter Your Usewrname">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email Address*</label>
                                            <input type="email" class="my-form-control" placeholder="Enter Your Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password*</label>
                                            <input type="text" class="my-form-control" placeholder="Enter Your Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Confirm Password*</label>
                                            <input type="text" class="my-form-control" placeholder="Enter Your Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Marial status*</label>
                                            <div class="option">
                                                <div class="s-input nice-select-wraper">
                                                    <select class="select-bar" style="background: #eaf2fc;border-color: #eaf2fc;">
                                                        <option value="">Single</option>
                                                        <option value="">Marid</option>
                                                        <option value="">Marid</option>
                                                        <option value="">Marid</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!--<h4 class="content-title mt-5">Profile Details</h4>-->
                                        <div class="form-group">
                                            <label for="">Name*</label>
                                            <input type="text" class="my-form-control" placeholder="Enter Your Full Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Birthday*</label>
                                            <input type="date" class="my-form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">I am a*</label>
                                            <div class="option">
                                                <div class="s-input mr-3">
                                                    <input type="radio" name="gender1" id="males1"><label for="males1">Man</label>
                                                </div>
                                                <div class="s-input">
                                                    <input type="radio" name="gender1" id="females1"><label for="females1">Woman</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Looking for a*</label>
                                            <div class="option">
                                                <div class="s-input mr-3">
                                                    <input type="radio" name="gender2" id="males"><label for="males">Man</label>
                                                </div>
                                                <div class="s-input">
                                                    <input type="radio" name="gender2" id="females"><label for="females">Woman</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">City*</label>
                                            <input type="text" class="my-form-control" placeholder="Enter Your City">
                                        </div>
                                    </div>
                                </div>
                                <button class="custom-button" data-toggle="modal" data-target="#email-confirm">Create Your
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
<!-- include footer -->
@include('includes.footer')
<!-- /include footer -->
</html>