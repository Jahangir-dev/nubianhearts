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
    <span class="text-primary"><i class="far fa-bell"></i></span> <?= __tr('Saved Searches') ?></h5>
</div>
<div class="col-2 col-sm-12 mb-2 ml-0">
     <a href="<?= route('user.read.savedSearches') ?>" class="btn btn-secondary p-2 sm-width"><?= __tr('Save New Search') ?></a>
</div>
 <!-- Start of Notification Wrapper -->
<div class="card mb-4">
    <div class="card-body">
        <table class="table table-hover" id="lwNotificationTable">
            <thead>
                <tr>
                    <th><?= __tr('Name') ?></th>
                    <th><?= __tr('Action') ?></th>
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
 <%= __tData.name %>  
<!-- /Notification Msg link -->
</script>
<!-- Notification Msg Action Column -->

<!-- Notification Msg Action Column -->
<script type="text/_template" id="notificationTimeActionTemplate">
<!-- Notification Time link -->
   <%= __tData.action %>  
<!-- /Notification Time link -->
</script>
<!-- Notification Msg Action Column -->

@push('appScripts')
<script>
     $(document).ready(function(){
        function deleteRecord()
        {
            alert('yes');
        }
    });

    var dtColumnsData = [
        {
            "name"      : "name",
            "orderable" : true,
            "template"  : '#notificationMsgActionTemplate'
        },
        {
            "name"      : "action",
            "orderable" : false,
            "template"  : '#notificationTimeActionTemplate'
        }
    ],
    notificationTableInstance;

    notificationTableInstance = dataTable('#lwNotificationTable', {
        url         : "<?= route('user.read.getAllSaved') ?>",
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
               
            } else {
                //hide show all notification link in top header
                $("#lwShowAllNotifyLink").hide();
                notification = '<a class="dropdown-item text-center small text-gray-500"><?= __tr('There are no Saved Searches.') ?></a>'
            }
            $("#lwNotificationCount").text(getNotificationCount);
        }
    }
</script>
@endpush
<style>
    @media (max-width: 575px) {
        .form-control {
            width: 100% !important;
    }
    .custom-select {
            width: auto !important;
    }
    .sm-width {
        min-width: 165px !important;
    }
    }
</style>