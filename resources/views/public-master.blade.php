<!-- include header -->
@include('includes.header')
<?php $route = \Request::route()->getName(); print($route);
 $sidebar = false ;
 $file = '';
 if($route == 'user.my_liked_view' || $route == 'user.who_liked_me_view'
                    || $route == 'user.profile_visit_view' || $route == 'user.profile_visitors_view' || $route == 'user.mutual_like_view'){
                    
                     $sidebar = true;
                   $file =  'connection';
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
        <div class="col-12">
            <?php 
                $time = freeTrial();
            ?>
            <!-- info message -->
        <div class="alert alert-info justify-content-between text-center align-items-center">
            Free trail : <?= $time['total'] ?>
        </div>
        <!-- / info message -->
        </div>
        
        @if( $sidebar != False)
            <div class="col-3">
                @if($file == 'connection')
                    @include('includes.connection')
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

    <div class="lw-cookie-policy-container row p-4" id="lwCookiePolicyContainer">
        <div class="col-sm-11">
            @include('includes.cookie-policy')
        </div>
        <div class="col-sm-1 mt-2"><button id="lwCookiePolicyButton" class="btn btn-primary"><?= __tr('OK') ?></button></div>
    </div>
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