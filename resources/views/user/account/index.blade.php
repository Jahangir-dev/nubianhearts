@section('page-title', __tr("Manage Users"))
@section('head-title', __tr("Manage Users"))
@section('keywordName', strip_tags(__tr("Manage Users")))
@section('keyword', strip_tags(__tr("Manage Users")))
@section('description', strip_tags(__tr("Manage Users")))
@section('keywordDescription', strip_tags(__tr("Manage Users")))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="col-xl-12">
    <!-- card -->
	<div class="card mb-4">
        <!-- card body -->
		<div class="card-body"> 
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h5 class="h5 mb-0 text-gray-200">
				<span class="text-primary"></i></span>
				<?= __tr('Account') ?></h5>
			</div>

			<div class="container-fluid">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true">My details</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="alert-tab" data-toggle="tab" href="#alert" role="tab" aria-controls="alert" aria-selected="false">Alerts</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="billing-tab" data-toggle="tab" href="#billing" role="tab" aria-controls="billing" aria-selected="false">Billing</a>
				  </li>
				 
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
				  	
				  	<div data-show-if="activationRequired">
						<div class="alert alert-success">
							<div class="header">
								<strong><?=  __tr("Activate your new email address") ?></strong>
							</div>
							<p><?=  __tr("Almost finished... You need to confirm your email address. To complete the activation process, please click the link in the email we just sent you.")  ?></p>
						</div>
					</div>
				<div class="col-xl-12 mt-2">
					<div class="card">
					            <div class="card-body">
					<!-- change email form -->
					<form class="lw-ajax-form lw-form mt-2" method="post" action="<?= route('user.change_email.process') ?>" data-callback="onChangeEmailCallback" data-show-if="newChangeEmailRequestForm" data-show-processing="true" id="lwChangeEmailForm">
						<!-- current email input field -->
						<div class="form-group">
	                        <label for="lwCurrentEmail"><?= __tr('Current Email') ?></label>
							<input type="email" value="<?= $data['userEmail'] ?>" class="form-control" name="current_email" id="lwCurrentEmail" required readonly="true">
						</div>
						<!-- current email input field -->

						<!-- current password and new email input field -->
						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">
	                        <label for="lwCurrentPassword"><?= __tr('Current Password') ?></label>
								<input type="password" class="form-control" name="current_password" id="lwCurrentPassword" required minlength="6">
							</div>
							<div class="col-sm-6">
	                        <label for="lwNewEmail"><?= __tr('New Email') ?></label>
								<input type="email" class="form-control" name="new_email" id="lwNewEmail" required>
							</div>
						</div>
						<!-- /current password and new email input field -->
						<div class="form-group row float-right mr-1">
						<!-- update Email button -->
						<button type="submit" class="lw-ajax-form-submit-action btn btn-primary btn-user lw-btn-block-mobile"><?= __tr('Update Email') ?></button>
					</div>
						<!-- update Email button -->
					</form>
				</div>
			</div>
				</div>
					<!-- / change email form -->
				
						<div class="col-xl-12 mt-2">
							<!-- if user password is not password then show info message -->
							@if(isset($data['userPassword']) and $data['userPassword'] == 'NO_PASSWORD')
							<!-- info message -->
							<div class="alert alert-info">
								<?= __tr('As you had registered using social account & didn’t set the password yet, you need to logout and use Forgot Password link to set a password.') ?>
							</div>
							<!-- / info message -->
							@endif
							<!-- /if user password is not password then show info message -->

							<!-- change password form -->
					        <div class="card mb-4">
					            <div class="card-body">
									<!-- change password form -->
					                <form class="lw-ajax-form lw-form <?= (isset($data['userPassword']) and $data['userPassword'] == 'NO_PASSWORD') ? 'lw-disabled-block-content' : '' ?>" method="post" action="<?= route('user.change_password.process') ?>" data-callback="onChangePasswordCallback" id="lwChangePasswordForm">
										<!-- current password input field -->
					                    <div class="form-group">
					                        <label for="lwCurrentPassword"><?= __tr('Current Password') ?></label>
					                        <input type="password" class="form-control" name="current_password" required minlength="6" id="lwCurrentPassword">
					                    </div>
										<!-- / current password input field -->

										<!-- new confirmation password input field -->
					                    <div class="form-group row">
					                        <div class="col-sm-6 mb-3 mb-sm-0">
					                        <label for="lwNewPassword"><?= __tr('New Password') ?></label>
					                            <input type="password" class="form-control" name="new_password" id="lwNewPassword" required minlength="6">
					                        </div>
					                        <div class="col-sm-6">
					                        <label for="lwNewPasswordConfirmation"><?= __tr('New Password Confirmation') ?></label>
					                            <input type="password" class="form-control" name="new_password_confirmation" id="lwNewPasswordConfirmation" required minlength="6">
					                        </div>
					                    </div>
										<!-- / new confirmation password input field -->
									<div class="form-group row float-right mr-1">
										<!-- update Password button -->
					                    <button type="submit" class="lw-ajax-form-submit-action btn btn-primary btn-user lw-btn-block-mobile"><?= __tr('Update Password') ?></button>
										<!-- / update Password button -->
									</div>
					                </form>
									<!-- /change password form -->
					            </div>
							</div>
							<!-- /change password form -->
					    </div>

				  </div>
				  <div class="tab-pane" id="alert" role="tabpanel" aria-labelledby="alert-tab">
				  	
				  	<div class="card mb-4 mt-2">
					<div class="card-body">
						<!-- Notification Setting Form -->
						<form class="lw-ajax-form lw-form" method="post" action="<?= route('user.write.setting', ['pageType' => 'notification']) ?>">
							<div class="row">
								<div class="col-sm-6 mb-2">
									<!-- Show Visitor Notification field -->
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="hidden" name="show_profile_notification" value="false">
										<input type="checkbox" class="custom-control-input" id="lwShowVisitorNotify" name="show_profile_notification" value="true" <?= $userSettingData['show_profile_notification'] == true ? 'checked' : '' ?>>
										<label class="custom-control-label" for="lwShowVisitorNotify"><?=  __tr( 'Profile View Notification' )  ?></label>
									</div>
									<!-- / Show Visitor Notification field -->
								</div>
								<div class="col-sm-6">
									<!-- Show Profile Like Notification field -->
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="hidden" name="show_like_notification" value="false">
										<input type="checkbox" class="custom-control-input" id="lwShowLikeNotify" name="show_like_notification" value="true" <?= $userSettingData['show_like_notification'] == true ? 'checked' : '' ?>>
										<label class="custom-control-label" for="lwShowLikeNotify">
						                    <?=  __tr( 'Likes Notification' )  ?> 
						                </label>
									</div>
									<!-- / Show Profile Like Notification field -->
								</div>
								
								<div class="col-sm-6">
									<!-- Show Messages Notification field -->
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="hidden" name="show_message_notification" value="false">
										<input type="checkbox" class="custom-control-input" id="lwShowMessageNotify" name="show_message_notification" value="true" <?= $userSettingData['show_message_notification'] == true ? 'checked' : '' ?>>
										<label class="custom-control-label" for="lwShowMessageNotify"><?=  __tr( ' Messages Notification' )  ?></label>
									</div>
									<!-- / Show Messages Notification field -->
								</div>
								
							</div>
							
							<!-- Update Button -->
							<a href class="lw-ajax-form-submit-action btn btn-primary btn-user float-right lw-btn-block-mobile mt-3 btn-sm">
								<?= __tr('Update') ?>
							</a>
							<!-- /Update Button -->
						</form>
					</div>
</div>

				  </div>
				  <div class="tab-pane" id="billing" role="tabpanel" aria-labelledby="billing-tab">...3</div>
				 
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.tab-content .active {
		background: transparent !important;
	}
</style>
<!-- End of Page Wrapper -->
@push('appScripts')
<script>
	__DataRequest.updateModels({
		'activationRequired' : false,
		'newChangeEmailRequestForm' : true
	});
	function onChangeEmailCallback(response) {
		if (response.reaction == 1 && response.data.activationRequired) {
			__DataRequest.updateModels({
				'activationRequired' : true,
				'newChangeEmailRequestForm' : false
			});
		} else {
			$("#lwChangeEmailForm")[0].reset();
			$("#lwCurrentEmail").val(response.data.newEmail);
		}
	}
	function onChangePasswordCallback(response) {
		if (response.reaction == 1) {
			$("#lwChangePasswordForm")[0].reset();
		}
	}
</script>
@endpush