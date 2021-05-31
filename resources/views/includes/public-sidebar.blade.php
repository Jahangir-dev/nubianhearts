<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <li>
        <a class="sidebar-brand d-flex align-items-center bg-purple" href="<?= url('/home') ?>">
            <div class="sidebar-brand-icon">
                <img class="lw-logo-img" src="<?= getStoreSettings('small_logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
            </div>
            <img class="lw-logo-img d-sm-none d-none d-md-block" src="<?= getStoreSettings('logo_image_url') ?>"
                    alt="<?= getStoreSettings('name') ?>">
            <img class="lw-logo-img d-sm-block d-md-none" src="<?= getStoreSettings('small_logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
        </a>
    </li>
    @if(isset($is_profile_page) and ($is_profile_page === true))
        @if(!$isBlockUser and !$blockByMeUser)
            @stack('sidebarProfilePage')
        @endif
    @endif
    <hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">
    <!-- Heading -->
    <li class="mt-2 nav-item <?= makeLinkActive('home_page')?>">
        <a class="nav-link" href="<?= route('home_page') ?>">
            <i class="fas fa-home"></i>
            <span><?= __tr('Home') ?></span>
        </a>
    </li>

    <li class="nav-item <?= makeLinkActive('user.read.find_matches') ?>">
        <a class="nav-link"
            href="<?= route('user.read.find_matches') ?>">
            <i class="fas fa-search"></i>
            <span><?= __tr('Find Matches') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.profile_view') ?>">
        <a class="nav-link"
            href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>">
            <i class="fas fa-user"></i>
            <span><?= __tr('My Profile') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.photos_setting') ?>">
        <a class="nav-link"
            href="<?= route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) ?>">
            <i class="far fa-images"></i>
            <span><?= __tr('My Photos') ?></span>
        </a>
    </li>
    <!-- Featured Users -->
    @if(!__isEmpty(getFeatureUserList()))
    <div class="card">
        <div class="card-header">
            <?= __tr('Featured Users') ?>
        </div>
        <div class="card-body lw-featured-users">
            @foreach(getFeatureUserList() as $users)
            <a href="<?= route('user.profile_view', ['username' => $users['username']]) ?>">
                <img class="img-fluid img-thumbnail lw-sidebar-thumbnail lw-lazy-img"
                    data-src="<?= $users['userImageUrl'] ?>">
            </a>
            @endforeach
        </div>
    </div>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endif
    <!-- /Featured Users -->
    
    <!-- sidebar advertisement -->
    @if(!getFeatureSettings('no_adds') and getStoreSettings('user_sidebar_advertisement')['status'] == 'true')
    <li class="nav-item lw-sidebar-ads-container d-none d-md-block">
        <!-- sidebar advertisement content -->
        <div>
            <?= getStoreSettings('user_sidebar_advertisement')['content'] ?>
        </div>
        <!-- /sidebar advertisement content -->
    </li>
    <!-- sidebar advertisement -->
    @endif
    <!-- Sidebar Toggler (Sidebar) -->
</ul>
<!-- End of Sidebar -->