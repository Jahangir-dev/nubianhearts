<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-purple topbar static-top">
     <!-- Sidebar Toggle (Topbar) -->
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-block d-md-none rounded-circle mr-3" style="background-color: #fff !important; color: #000;">
    <i class="fa fa-bars"></i>
    </button>


        <a class="sidebar-brand d-flex align-items-center bg-purple" href="<?= url('/home') ?>">
            <div class="sidebar-brand-icon">
                <img class="lw-logo-img" src="<?= getStoreSettings('small_logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
            </div>
            <img class="lw-logo-img d-sm-none d-none d-md-block" src="<?= getStoreSettings('logo_image_url') ?>"
                    alt="<?= getStoreSettings('name') ?>">
            <img class="lw-logo-img d-sm-block d-md-none" src="<?= getStoreSettings('small_logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
        </a>
    
    <!-- Topbar Navbar -->
    
    <ul class="navbar-nav">
         
        @if(!isPremiumUser())
        <li class="nav-item d-none d-sm-none d-md-block">
            <a class="nav-link" href="<?= route('user.credit_wallet.read.view') ?>">
                <i class="fas fa-money-bill fa-fw mr-2"></i>
            </a>
        </li>
        @else
        <li class="nav-item d-none d-sm-none d-md-block">
            <a class="nav-link" data-toggle="tooltip" title="You already purchased package.">
                <i class="fas fa-money-bill fa-fw mr-2" style="color:#b8b9c3"></i>
            </a>
        </li>
        @endif
        <li class="nav-item dropdown no-arrow mx-1 d-none d-sm-none d-md-block">
            <a class="nav-link dropdown-toggle lw-ajax-link-action" href="<?= route('user.notification.write.read_all_notification') ?>" data-callback="onReadAllNotificationCallback" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-method="post">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter" data-model="totalNotificationCount"><?= (getNotificationList()['notificationCount'] > 0) ? getNotificationList()['notificationCount'] : '' ?></span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    <?= __tr('Notification') ?>
                </h6>
                <!-- Notification block -->     
                <div id="lwNotificationContent"></div>
                <script type="text/_template" id="lwNotificationListTemplate">
                    <% if(!_.isEmpty(__tData.notificationList)) { %>
                        <% _.forEach(__tData.notificationList, function(notification) { %>
                            <!-- show all notification list -->
                            <a class="dropdown-item d-flex align-items-center" href="<%- notification['actionUrl'] %>">
                                <div>
                                    <div class="small text-gray-500"><%- notification['created_at'] %></div>
                                    <span class="font-weight-bold"><%- notification['message'] %></span>
                                </div>
                            </a>
                            <!-- show all notification list -->
                        <% }); %>
                        <!-- show all notification link -->
                        <a class="dropdown-item text-center small text-gray-500" href="<?= route('user.notification.read.view') ?>" id="lwShowAllNotifyLink" data-show-if="showAllNotifyLink"><?= __tr('Show All Notifications.') ?></a>
                        <!-- /show all notification link -->
                    <% } else { %>
                        <!-- info message -->
                        <a class="dropdown-item text-center small text-gray-500"><?= __tr('There are no notification.') ?></a>
                        <!-- /info message -->

                        <!-- show all notification link -->
                        <a class="dropdown-item text-center small text-gray-500" href="<?= route('user.notification.read.view') ?>" id="lwShowAllNotifyLink" data-show-if="showAllNotifyLink"><?= __tr('Show All Notifications.') ?></a>
                        <!-- /show all notification link -->

                    <% } %>
                </script>
                <!-- /Notification block -->
            </div>
        </li>
        <!-- /Notification Link -->
        <?php
            $translationLanguages = getStoreSettings('translation_languages');
        ?>
        
        
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
                
                <a class="dropdown-item"
                        href="<?= route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) ?>">
                        <i class="far fa-images fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?= __tr('Photos') ?>
                </a>
                <a class="dropdown-item"
                        href="<?= route('user.settings', ['username' => getUserAuthInfo('profile.username')]) ?>">
                        <i class="fa fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?= __tr('Settings') ?>
                </a>
               <!--  <a class="dropdown-item" href="<?= route('user.change_password') ?>">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                   <?= __tr('Change Password') ?>
                </a>
                <a class="dropdown-item" href="<?= route('user.change_email') ?>">
                    <i class="fas fa-envelope fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?= __tr('Change Email') ?>
                </a> -->
               
                @if(isAdmin())
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-primary" target="_blank" href="<?= route('manage.dashboard') ?>">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?= __tr('Admin Panel') ?>
                    </a>
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-primary" target="#" href="<?= route('faq',['username' => getUserAuthInfo('profile.username')]) ?>">
                        <i class="fa fa-question-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?= __tr('Need help?') ?>
                    </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?= __tr('Logout') ?>
                </a>
            </div>
        </li>
    </ul>
</nav>
<ul class="navbar-nav sidebar sidebar-dark bg-purple accordion float-left list-inline" id="accordionSidebar">
     <li class="nav-item text-white nav-link <?= makeLinkActive('home_page')?>">
            <a class="nav-link" href="<?= route('home_page') ?>">
                <i class="fas fa-home"></i>
                <span><?= __tr('Dashboard') ?></span>
            </a>
        </li>
     <li class="nav-item <?= makeLinkActive('user.read.find_matches') ?>">
            <a class="nav-link"
                href="<?= route('user.read.find_matches') ?>">
                <i class="fas fa-user"></i>
                <span><?= __tr('Browse') ?></span>
            </a>
        </li>
         <li class="nav-item <?= makeLinkActive('user.my_liked_view') ?>">
            <a class="nav-link" href="<?= route('user.my_liked_view') ?>">
                <i class="fas fa-fw fa-heart"></i>
                <span><?= __tr('Connections') ?></span>
            </a>
        </li>

         <li class="nav-item d-sm-block d-md-none">
            <a class="nav-link <?= makeLinkActive('user.read.messenger') ?>" href="{{route('user.read.messenger')}}" >
                <i class="fas fa-envelope"></i>
                <span><?= __tr('Messages') ?></span>
            </a>
        </li>
</ul>
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
                <?= __tr('No Package') ?>
                <a href="<?= route('user.credit_wallet.read.view') ?>"><?= __tr('Package') ?></a>
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