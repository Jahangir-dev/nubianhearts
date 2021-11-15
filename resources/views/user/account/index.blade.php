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
				  <div class="tab-pane" id="billing" role="tabpanel" aria-labelledby="billing-tab">
						<!-- transaction list card -->
<div class="card mb-4 mt-4">
	<!-- card body -->
	<div class="card-body">
 		<!-- financial transaction list -->
		<h4 class="mt-3"><?= __tr('Wallet Transactions') ?></h4><hr>
		<!-- / financial transaction list -->
		 
		<!-- financial transaction table -->
 		<table class="table table-hover table-responsive" id="lwUserTransactionTable">
			<thead>
				<tr>
					<th><?= __tr('Transaction On') ?></th>
					<th><?= __tr('Transaction For') ?></th>
					<th width="190px;"><?= __tr('Package') ?></th>
					<th><?= __tr('Action') ?></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		<!-- financial transaction table -->
	</div>
	<!-- / card body -->
</div>
<!-- / transaction list card -->

<!-- Transaction Details Action Column -->
<script type="text/_template" id="transactionDetailsActionColumnTemplate">
	<!-- action dropdown -->
	<% if(__tData.transactionType == 1 && !_.isEmpty(__tData.financialTransactionDetail)) { %>
	<div class="btn-group">
		<button type="button" class="btn btn-black dropdown-toggle lw-datatable-action-dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-ellipsis-v"></i>
		</button>
		<div class="dropdown-menu dropdown-menu-right">
			<!-- Transaction Detail Button -->
			<a href class="dropdown-item" data-toggle="modal" data-financial-transaction='<%= JSON.stringify(__tData.financialTransactionDetail) %>' data-target="#userTransactionDetailDialog" data-transaction-detail><i class="far fa-edit"  id="lwTransactionDetailBtn"></i> <?= __tr('Financial Transaction') ?></a>
			<!-- /Transaction Detail Button -->
		</div>
	</div>
	<% } else { %>
		-
	<% } %>
	<!-- /action dropdown -->
</script>
<!-- Transaction Details Action Column -->

<!-- user transaction Modal-->
<div class="modal fade" id="userTransactionDetailDialog" tabindex="-1" role="dialog" aria-labelledby="userTransactionModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
				<h5 class="modal-title" id="userTransactionModalLabel"><?= __tr('Financial Transaction') ?></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body" id="lwUserTransactionContent"></div>
			<script type="text/_template" 
					id="lwTransactionDetailTemplate" 
					data-replace-target="#lwUserTransactionContent"
					data-modal-id="#userTransactionDetailDialog">
					<div>
						<div class="card-body">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">
									<?= __tr('Created On') ?>
									<span class="float-right"><%- __tData.financialTransactionData.created_at %></span>
								</li>
								<li class="list-group-item">
									<?= __tr('Amount') ?>
									<span class="float-right"><%= __tData.financialTransactionData.amount %></span>
								</li>
								<li class="list-group-item">
									<?= __tr('Currency') ?>
									<span class="float-right"><%= __tData.financialTransactionData.currency_code %></span>
								</li>
								<li class="list-group-item">
									<?= __tr('Status') ?>
									<span class="float-right"><%= __tData.financialTransactionData.status %></span>
								</li>
								<li class="list-group-item">
									<?= __tr('Method') ?>
									<span class="float-right"><%= __tData.financialTransactionData.method %></span>
								</li>
								<li class="list-group-item">
									<?= __tr('Mode') ?>
									<span class="float-right"><%= __tData.financialTransactionData.payment_mode %></span>
								</li>
							</ul>
						</div>
					</div>
			</script>
			<!-- modal footer -->
			<div class="modal-footer mt-3">
				<button class="btn btn-light btn-sm" class="close" type="button" data-dismiss="modal"><?= __tr('Close') ?></button>
			</div>
			<!-- modal footer -->
		</div>
	</div>
</div>
<!-- / user transaction Modal-->

				  </div>
				 
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

//user transaction dialog details
__Utils.modalTemplatize('#lwTransactionDetailTemplate', function(e, data) {
		return { 
            'financialTransactionData': data['financialTransaction']
        };
	}, function(e, myData) { });
		//transaction list data table columns data
		var dtColumnsData = [
		{
			"name"      : "created_at",
			"orderable" : true
		},
		{
			"name"      : "formattedTransactionType",
			"orderable" : false
		},
		{
			"name"      : 'credits',
			"orderable" : true
		},
        {
            "name"      : 'action',
            "template"  : '#transactionDetailsActionColumnTemplate'
        }
	],
	transactionListDataTable = '';

	//fetch transaction list data
	function fetchTransactionList() {
		transactionListDataTable = dataTable('#lwUserTransactionTable', {
			url         : "<?= route('user.credit_wallet.read.wallet_transaction_list') ?>",
			dtOptions   : {
				"searching": false,
				"order": [[ 0, 'desc' ]],
				"pageLength" : 10,
				rowCallback : function(row, data, index) {
					$('td:eq(2)', row).css("text-align", "right")
				}
			},
			columnsData : dtColumnsData, 
			scope       : this
		});
	}

	//load transaction list data function
	fetchTransactionList();
</script>
@endpush
<style>
	div.dataTables_wrapper div.dataTables_length select {
		width: auto !important;
	}
	.form-control {
		width: 100% !important;
	}
</style>