
<div class="p-3">
  <h3 class="page-title mb-3 d-flex justify-content-between align-items-center">Connections</h3>
  <ul class="nav flex-column sub-menu">
    <li class="nav-item <?= makeLinkActive('user.my_liked_view') ?>">
      <a class="nav-link" href="<?= route('user.my_liked_view') ?>">
          <i class="fas fa-fw fa-user"></i>
          <span><?= __tr('I like them') ?></span>
      </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.who_liked_me_view') ?>">
        <a class="nav-link" href="<?= route('user.who_liked_me_view') ?>">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span><?= __tr('They like me') ?>
        </a>
    </li>
    <li class="nav-item  <?= makeLinkActive('user.profile_visit_view') ?>">
            <a class="nav-link" href="<?= route('user.profile_visit_view') ?>">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span><?= __tr('My Views') ?></span>
            </a>
    </li>
   <li class="nav-item  <?= makeLinkActive('user.profile_visitors_view') ?>">
          <a class="nav-link" href="<?= route('user.profile_visitors_view') ?>">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span><?= __tr('They viewed me') ?></span>
          </a>
    </li> 
     <li class="nav-item <?= makeLinkActive('user.mutual_like_view') ?>">
        <a class="nav-link" href="<?= route('user.mutual_like_view') ?>">
            <i class="fa fa-users"></i>
            <span><?= __tr('Matches') ?></span>
        </a>
      </li>
        
  </ul>
</div>