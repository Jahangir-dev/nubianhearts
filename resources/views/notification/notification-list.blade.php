@section('page-title', __tr('Notifications'))
@section('head-title', __tr('Notifications'))
@section('keywordName', __tr('Notifications'))
@section('keyword', __tr('Notifications'))
@section('description', __tr('Notifications'))
@section('keywordDescription', __tr('Notifications'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h5 class="h5 mb-0 text-gray-200">
	<span class="text-primary"><i class="far fa-bell"></i></span> <?= __tr('Notifications') ?></h5>
</div>

<div class="card mb-4">
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
			<a href class="lw-ajax-form-submit-action btn btn-primary btn-user lw-btn-block-mobile mt-3 btn-sm">
				<?= __tr('Update') ?>
			</a>
			<!-- /Update Button -->
		</form>
	</div>
</div>

 <!-- Start of Notification Wrapper -->
<div class="card mb-4">
	<div class="card-body">
		<table class="table table-hover" id="lwNotificationTable">
			<thead>
				<tr>
					<th><?= __tr('Notification For') ?></th>
					<th><?= __tr('Time') ?></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<!-- End of Notification Wrapper -->

<!-- Notification Msg Action Column -->
<script type="text/_template" id="notificationMsgActionTemplate">
<!-- Notification Msg link -->
<a href="<%= __tData.action %>"><img class="img-profile rounded-circle" src="<%= __tData.picture %>"></a> <%= __tData.message %>  
<!-- /Notification Msg link -->
</script>
<!-- Notification Msg Action Column -->

<!-- Notification Msg Action Column -->
<script type="text/_template" id="notificationTimeActionTemplate">
<!-- Notification Time link -->
	<span title="<%= __tData.created_at %>"><%= __tData.formattedCreatedAt %></span>
<!-- /Notification Time link -->
</script>
<!-- Notification Msg Action Column -->

@push('appScripts')
<script>
    var dtColumnsData = [
        {
            "name"      : "message",
            "orderable" : true,
            "template"  : '#notificationMsgActionTemplate'
        },
        {
            "name"      : "created_at",
            "orderable" : true,
            "template"  : '#notificationTimeActionTemplate'
        }
	],
	notificationTableInstance;

    notificationTableInstance = dataTable('#lwNotificationTable', {
        url         : "<?= route('user.notification.read.list') ?>",
        dtOptions   : {
            "searching": false,
            "order": [[ 0, 'desc' ]],
			"pageLength" : 10
        },
        columnsData : dtColumnsData, 
        scope       : this
	});
	
	//notification read callback
	function notificationReadCallback(response) {
		if (response.reaction == 1) {
			//reload data-table instance
			reloadDT(notificationTableInstance);
			//get notification list
			var requestData = response.data.getNotificationList,
				getNotificationList = requestData.notificationData,
				getNotificationCount = requestData.notificationCount,
				notification = '';
			//empty text
			$("#lwNotificationList").text('');
			if (!_.isEmpty(getNotificationList)) {
				_.forEach(getNotificationList, function(value, key) {
					notification = '<a class="dropdown-item d-flex align-items-center"><div><div class="small text-gray-500">'+value.created_at+'</div><span class="font-weight-bold">'+value.message+'</span></div></a>';
					$("#lwNotificationList").append(notification);
				});
			} else {
				//hide show all notification link in top header
				$("#lwShowAllNotifyLink").hide();
				notification = '<a class="dropdown-item text-center small text-gray-500"><?= __tr('There are no notification.') ?></a>'
			}
			$("#lwNotificationCount").text(getNotificationCount);
		}
	}
</script>
@endpush