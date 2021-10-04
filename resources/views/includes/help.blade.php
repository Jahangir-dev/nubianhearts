
<div class="p-3">
  <h3 class="page-title mb-3 d-flex justify-content-between align-items-center">Need Help?</h3>
  <ul class="nav flex-column sub-menu">
     <li class="nav-item <?= makeLinkActive('contact-us') ?>">
            <a class="nav-link"
                href="<?= route('contact-us', ['username' => getUserAuthInfo('profile.username')]) ?>">
                <i class="fa fa-at"></i>
                <span><?= __tr('Contact Us') ?></span>
            </a>
        </li>
        <li class="nav-item <?= makeLinkActive('feedback') ?>">
            <a class="nav-link"
                href="<?= route('feedback', ['username' => getUserAuthInfo('profile.username')]) ?>">
                <i class="fa fa-thumbs-up"></i>
                <span><?= __tr('Feedback') ?></span>
            </a>
        </li>
        <li class="nav-item <?= makeLinkActive('bug-report') ?>">
            <a class="nav-link"
                href="<?= route('bug-report', ['username' => getUserAuthInfo('profile.username')]) ?>">
                <i class="fa fa-check"></i>
                <span><?= __tr('Report a bug') ?></span>
            </a>
        </li>
        <li class="nav-item <?= makeLinkActive('faq') ?>">
            <a class="nav-link" href="<?= route('user.read.block_user_list') ?>">
                <i class="fa fa-check"></i>
                <span><?= __tr('FAQs') ?></span>
            </a>
        </li>
  </ul>
</div>