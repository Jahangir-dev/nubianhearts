<!-- include header -->
@include('includes.header')
<?php 
$route = '';
$route = \Request::route()->getName();
        $sidebar = 0 ;
        $file = '';
            if($route == 'user.my_liked_view' || $route == 'user.who_liked_me_view'
                || $route == 'user.profile_visit_view' || $route == 'user.profile_visitors_view' || $route == 'user.mutual_like_view'){
                    
                    $sidebar = 1;
                    $file =  'connection';
               }

            elseif($route == 'user.profile_view')
            {
                
                $sidebar = 1;
                $file = 'profile';
            } else{
                $sidebar = 0;
                $file = '';
            }
?>

<!-- /include header -->
<body >
            <!-- include top bar -->
                @if(isLoggedIn())
                    @include('includes.public-top-bar')
                @endif
            <!-- /include top bar -->
    <!-- Page Wrapper -->
    <div class="container-fluid  w-100 min-h-100">
    <div class="row h-100">
        @if(isLoggedIn()) 
        
            @if( $sidebar != 0)
                <div class="col-3">
                    @if($file == 'connection')
                        @include('includes.connection')
                    @endif
                    @if($file == 'profile')
                         @if(isset($is_profile_page) and ($is_profile_page === true))
                            @if(!$isBlockUser and !$blockByMeUser)
                                @stack('sidebarProfilePage')
                            @endif
                        @endif
                    @endif
                </div>
            @endif
        @endif
        <?php 
            if($sidebar != False){
                $class = 'col-9';
            } else {
                $class = 'col-12';
            }
         ?>
            <div class="{{$class}}">
                <div id="content-wrapper" class="d-flex flex-column lw-page-bg">
               
                        <div id="content" class="mt-3">

                            <!-- Begin Page Content -->
                            <div class="lw-page-content p-3">

                                <!-- header advertisement -->
                                @if(!getFeatureSettings('no_adds') and getStoreSettings('header_advertisement')['status'] == 'true')
                                <div class="lw-ad-block-h90">
                                    <?= getStoreSettings('header_advertisement')['content'] ?>
                                </div>
                                @endif
                                <!-- /header advertisement -->
                                @if(isset($pageRequested))
                                <?php echo $pageRequested; ?>
                                @endif
                                <!-- footer advertisement -->
                                @if(!getFeatureSettings('no_adds') and getStoreSettings('footer_advertisement')['status'] == 'true')
                                <div class="lw-ad-block-h90">
                                    <?= getStoreSettings('footer_advertisement')['content'] ?>
                                </div>
                                @endif
                                <!-- /footer advertisement -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                </div>
            </div>
    </div>
</div>
    <!-- End of Page Wrapper -->

    <!-- include footer -->
    @include('includes.footer')
    <!-- /include footer -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- /Scroll to Top Button-->

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
</html>