
<div class="p-3">
  <h3 class="page-title mb-3 d-flex justify-content-between align-items-center">Settings</h3>
  <ul class="nav flex-column sub-menu">
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
        <li class="nav-item <?= makeLinkActive('user.settings') ?>">
            <a class="nav-link"
                href="<?= route('user.settings', ['username' => getUserAuthInfo('profile.username')]) ?>">
                <i class="fas fa-cog"></i>
                <span><?= __tr('Account') ?></span>
            </a>
        </li>
        <li class="nav-item <?= makeLinkActive('user.read.block_user_list') ?>">
            <a class="nav-link" href="<?= route('user.read.block_user_list') ?>">
                <i class="fas fa-ban"></i>
                <span><?= __tr('Blocked Users') ?></span>
            </a>
        </li>
         @if(!isAdmin())        
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#lwDeleteAccountModel">
                    <i class="fas fa-trash-alt"></i>
                    <span><?= __tr('Delete Account') ?></span>
                </a>
            </li>
        @endif
  </ul>
</div>