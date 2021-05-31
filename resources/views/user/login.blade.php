@section('page-title', __tr('Login'))
@section('head-title', __tr('Login'))
@section('keywordName', strip_tags(__tr('Login')))
@section('keyword', strip_tags(__tr('Login')))
@section('description', strip_tags(__tr('Login')))
@section('keywordDescription', strip_tags(__tr('Login')))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- include header -->
@include('includes.theme-header')
<!-- /include header -->
<body class="lw-login-register-page">
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
                <div class="col-lg-6" style="margin: 0 auto;">
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
                        <div class="main-content inloginp">
                            <form class="user lw-ajax-form lw-form" data-callback="onLoginCallback" method="post" action="<?= route('user.login.process') ?>" data-show-processing="true" data-secured="true">
                                @csrf
                                <div class="form-group">
                                    <label for="">Your Address</label>
                                    <input name="email_or_username" aria-describedby="emailHelp" type="email" class="my-form-control" placeholder="<?= __tr('Enter Email Address or Username ...') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="my-form-control" placeholder="<?= __tr('Password') ?>" required minlength="6">
                                </div>
                                <!--                                <div class="form-group">
                                                                    <div class="custom-control custom-checkbox small">
                                                                        <input type="checkbox" class="custom-control-input" id="rememberMeCheckbox" name="remember_me">
                                                                        <label class="custom-control-label text-gray-200" for="rememberMeCheckbox"><?= __tr('Remember Me') ?></label>
                                                                    </div>
                                                                </div>-->
                                <!--                                <p class="f-pass">
                                                                    Forgot your password? <a href="#">recover password</a>
                                                                </p>-->
                                <div class="button-wrapper">
                                    <button  type="submit" value="Login" class="lw-ajax-form-submit-action custom-button btn-user btn-block"><?= __tr('Login') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@push('appScripts')
<script>
//on login success callback
    function onLoginCallback(response) {
        //check reaction code is 1 and intended url is not empty
        if (response.reaction == 1 && !_.isEmpty(response.data.intendedUrl)) {
            //redirect to intendedUrl location
            _.defer(function () {
                window.location.href = response.data.intendedUrl;
            })
        }
    }
</script>
@endpush

<!-- include footer -->
@include('includes.theme-footer')
<!-- /include footer -->