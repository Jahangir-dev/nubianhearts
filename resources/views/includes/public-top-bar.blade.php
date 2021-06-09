<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-purple topbar mb-4 static-top shadow">
     <!-- Sidebar Toggle (Topbar) -->
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-block d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
    </button>
   
    <!-- Topbar Navbar -->
    
    <ul class="navbar-nav">
       
        <?php
            $translationLanguages = getStoreSettings('translation_languages');
        ?>
        
        <!-- Language Menu -->
        @if(!__isEmpty($translationLanguages))
            <?php 
                $translationLanguages['en_US'] = [
                    'id' => 'en_US',
                    'name' => 'English',
                    'is_rtl' => false,
                    'status' => true
                ];
            ?>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-md-inline-block"><?= (isset($translationLanguages[CURRENT_LOCALE])) ? $translationLanguages[CURRENT_LOCALE]['name'] : '' ?></span>
                     &nbsp; <i class="fas fa-language"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <h6 class="dropdown-header">
                   <?= __tr('Choose your language') ?>
                </h6>
                <div class="dropdown-divider"></div>
                    <?php foreach($translationLanguages as $languageId => $language) {
                        if ($languageId == CURRENT_LOCALE or (isset($language['status']) and $language['status'] == false)) continue;
                    ?>
                        <a class="dropdown-item" href="<?= route('locale.change', ['localeID' => $languageId]) .'?redirectTo='.base64_encode(Request::fullUrl());  ?>">
                            <?= $language['name'] ?>
                        </a>
                    <?php } ?>
                </div>
            </li>
        @endif
        <!-- Language Menu -->

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="<?= getUserAuthInfo('profile.profile_picture_url') ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <h6 class="dropdown-header">
                    <?= getUserAuthInfo('profile.full_name') ?>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?= __tr('Profile') ?>
                </a>
               
                <a class="dropdown-item" href="<?= route('user.change_password') ?>">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                   <?= __tr('Change Password') ?>
                </a>
                <a class="dropdown-item" href="<?= route('user.change_email') ?>">
                    <i class="fas fa-envelope fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?= __tr('Change Email') ?>
                </a>
                @if(!isAdmin())
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#lwDeleteAccountModel">
                    <i class="fas fa-trash-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?= __tr('Delete Account') ?>
                </a>
                @endif
                @if(isAdmin())
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-primary" target="_blank" href="<?= route('manage.dashboard') ?>">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?= __tr('Admin Panel') ?>
                    </a>
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?= __tr('Logout') ?>
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Modal -->
<div class="modal fade" id="boosterModal" tabindex="-1" role="dialog" aria-labelledby="boosterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="boosterModalLabel"><?= __tr('Boost Profile') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <!-- insufficient balance error message -->
            <div class="alert alert-info" id="lwBoosterCreditsNotAvailable" style="display: none;">
                <?= __tr('Your credit balance is too low, please') ?>
                <a href="<?= route('user.credit_wallet.read.view') ?>"><?= __tr('purchase credits') ?></a>
            </div>
            <!-- / insufficient balance error message -->

            <div class="text-center">

                <?= __tr('This will costs you') ?>
                <span id="lwBoosterPrice">
                    <?=
                        (isPremiumUser()) 
                        ? getStoreSettings('booster_price_for_premium_user')
                        : getStoreSettings('booster_price') 
                    ?>
                </span>
                <?= __tr('credits for immediate') ?>
                <span id="lwBoosterPeriod">
                    <?= getStoreSettings('booster_period') ?>
                </span>
                <?= __tr('minutes') ?>
            </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"><?= __tr('Cancel') ?></button>
            <a class="btn btn-success btn-sm lw-ajax-link-action" data-callback="onProfileBoosted" href="<?= route('user.write.boost_profile') ?>" data-method="post"><i class="fas fa-bolt fa-fw"></i> <?= __tr('Boost') ?></a>
          </div>
        </div>
    </div>
</div>
<!-- Delete Account Container -->
<div class="modal fade" id="lwDeleteAccountModel" tabindex="-1" role="dialog" aria-labelledby="messengerModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __tr('Delete account?') ?></h5>        
            </div>
            <div class="modal-body">
                <!-- Delete Account Form -->
                <form class="user lw-ajax-form lw-form" method="post" action="<?= route('user.write.delete_account') ?>">
                    <!-- Delete Message -->
                    <?= __tr('Are you sure you want to delete your account? All content including photos and other data will be permanently removed!') ?>
                    <!-- /Delete Message -->
                    <hr/>
                    <!-- password input field -->
                    <div class="form-group">
                    <label for="password"><?= __tr('Enter your password') ?></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="<?= __tr( 'Password' ) ?>" required minlength="6">
                    </div>
                    <!-- password input field -->
                    
                    <!-- Delete Account -->
                    <button type="submit" class="lw-ajax-form-submit-action btn btn-primary btn-user btn-block-on-mobile"><?=  __tr( 'Delete Account' )  ?></button>
                    <!-- / Delete Account -->
                </form>
                <!-- /Delete Account Form -->
            </div>
        </div>
    </div>
</div>
<!-- /Delete Account Container -->
<!-- for image gallery -->
@include('includes.image-gallery')

<!-- End of Topbar -->
@push('appScripts')
<script>
    window.onresize = function() {
      _.delay(function(){
           $('#cboxWrapper,#colorbox').height($('#cboxContent').height());
            $('#cboxWrapper,#colorbox').width($('#cboxContent').width()-5);
      }, 300);
    };

    updateBoosterPrice = function(response) {
        if (response.reaction == 1) {
            $("#lwBoosterPeriod").html(response.data.booster_period);
            $("#lwBoosterPrice").html(response.data.booster_price);
        }
    };

    //callback for when profile boosted
    onProfileBoosted = function(response) {
        if (_.has(response.data, 'boosterExpiry')) {
            activateBooster(response.data.boosterExpiry);
            $('#boosterModal').modal('hide');
        }
        //updated credit wallet amt
        if (_.has(response.data, 'creditsRemaining')) {

            if (response.data.creditsRemaining <= 0) {
                $("#lwBoosterCreditsNotAvailable").show();
            }

            $("#lwTotalCreditWalletAmt").html(response.data.creditsRemaining)
        }
    };

    var boosterInterval;

    //to calculate booster and show countdown
    activateBooster = function(boosterExpiry) {
        clearInterval(boosterInterval);
        if (boosterExpiry > 0) {
            var boosterExpiryTime = (new Date().getTime())  + (boosterExpiry * 1000); 
            var now, timeRemaining, days, hours, minutes, seconds = 0;
            var timeString = "";
            boosterInterval = setInterval(function() { 
                now = new Date().getTime(); 
                timeRemaining = boosterExpiryTime - now;
                // days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24)); 
                hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
                minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60)); 
                seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000); 
                timeString = ("0"+hours.toString()).slice(-2)
                            + ":" + ("0"+minutes.toString()).slice(-2)
                            + ":" + ("0"+seconds.toString()).slice(-2);
                $('#lwBoosterTimerCountDown,#lwBoosterTimerCountDownOnSB').html(timeString);
                if (timeRemaining < 0) { 
                    clearInterval(boosterInterval); 
                    $('#lwBoosterTimerCountDown,#lwBoosterTimerCountDownOnSB').html("");
                }
            }, 1000);
        }
    };

    activateBooster(<?= getProfileBoostTime() ?>);
    // Set text direction for RTL language support
    function setTextDirection(isRtl) {
        if (isRtl) {
            $('html').attr('dir', 'rtl');
        }
    };

    var translationLanguages = '<?= (!__isEmpty($translationLanguages)) ? json_encode($translationLanguages) : null ?>',
        currentLocale = "<?= CURRENT_LOCALE ?>";
    // Check if translation language exists
    if (!_.isEmpty(translationLanguages)) {
        if (!_.isUndefined(JSON.parse(translationLanguages)[currentLocale])) {
            var selectedLang = JSON.parse(translationLanguages)[currentLocale];
            if (selectedLang['is_rtl']) {
                setTextDirection(true);
            }
        }
    }

    //get notification data
    <?php $getNotificationList = getNotificationList() ?>;
    // get lodash template
    var template = _.template($("#lwNotificationListTemplate").html());
    // append template
    $("#lwNotificationContent").html(template({
        'notificationList': JSON.parse('<?= json_encode($getNotificationList['notificationData']) ?>'),
    }));
    
    //on read all notification callback
    function onReadAllNotificationCallback(responseData) {
        if (responseData.reaction == 1) {
            __DataRequest.updateModels({
                'totalNotificationCount' : '', //total notification count
            });
        }
    };

</script>
@endpush