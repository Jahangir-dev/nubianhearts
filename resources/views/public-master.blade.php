<!-- include header -->
@include('includes.header')
<!-- /include header -->
<body>
	
	<!-- include sidebar -->
        @if(isLoggedIn())
        @include('includes.public-top-bar')
        @endif
    <!-- /include sidebar -->
	<!-- ==========Breadcrumb-Section========== -->
    <section class="breadcrumb-area profile-bc-area">
        <div class="container">
            <div class="content">
                <h2 class="title extra-padding">
                    Single Profile
                </h2>
                <ul class="breadcrumb-list extra-padding">
                    <li>
                        <a href="index.html">
                            Home
                        </a>
                    </li>

                    <li>
                        Single Profile
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- ==========Breadcrumb-Section========== -->
    <!-- ========= Profile Section Start -->
    <section class="profile-section">
        <div class="container">
            <div class="row">
			    <!-- include sidebar -->
			        @if(isLoggedIn())
			        @include('includes.public-sidebar')
			        @endif
			    <!-- /include sidebar -->
			</div>
		</div>
	</section>	
     <!-- End of Page Wrapper -->

	<div class="lw-cookie-policy-container row p-4" id="lwCookiePolicyContainer">
		<div class="col-sm-11">
            @include('includes.cookie-policy')
        </div>
		<div class="col-sm-1 mt-2"><button id="lwCookiePolicyButton" class="btn btn-primary"><?= __tr('OK') ?></button></div>
	</div>
    <!-- include footer -->
    @include('includes.footer')
    <!-- /include footer -->

     <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= __tr('Ready to Leave?') ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= __tr('Select "Logout" below if you are ready to end your current session.') ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><?= __tr('Not now') ?></button>
                    <a class="btn btn-primary" href="<?= route('user.logout') ?>"><?= __tr('Logout') ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Logout Modal-->
</body>