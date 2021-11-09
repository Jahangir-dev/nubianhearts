<div class="lw-messenger-header row">
    <div class="col-md-10">
       <a href="<?= route('user.profile_view', ['username' => $userData['username']]) ?>"> <img src="<?= $userData['profile_picture_image'] ?>" class="lw-profile-picture lw-online  float-left" alt=""></a>
        <div class="lw-messenger-header-meta">
            <?= $userData['full_name'] ?> @if(!empty($userData['age'])), <?=  $userData['age']?> @endif
            <div class="text-muted">
                <small>
                    @if(!empty($userData['country'])) <?= $userData['country'] ?> @endif
                </small>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-right lw-messenger-user-menu">
        <div class="dropdown">
            <button class="btn btn-black dropdown-toggle lw-datatable-action-dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" style="width: 50px;height: 40px; color: #fff;" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
				@if(getStoreSettings('allow_pusher') and getStoreSettings('allow_agora'))
				@if(getFeatureSettings('audio_call_via_messenger'))
                <a class="dropdown-item" id="lwAudioCallDisableBtn"><i class="fas fa-phone-alt"></i> <?= __tr('Audio Call') ?></a>
				<!-- audio call button -->
				<a class="dropdown-item" href type="button" id="lwAudioCallBtn" data-user-uid="<?= $userData['user_uid'] ?>" data-call-type="audio" data-confirm="#lwCallErrorContainer"><i class="fas fa-phone-alt"></i> <?= __tr('Audio Call') ?></a>
				<!-- /audio call button -->
				@endif

				@if(getFeatureSettings('video_call_via_messenger'))
                <a class="dropdown-item" id="lwVideoCallDisableBtn" readonly><i class="fas fa-video"></i> <?= __tr('Video Call') ?></a>
				<!-- video call button -->
				<a class="dropdown-item" href type="button" id="lwVideoCallBtn" data-user-uid="<?= $userData['user_uid'] ?>" data-call-type="video" data-confirm="#lwCallErrorContainer"><i class="fas fa-video"></i> <?= __tr('Video Call') ?></a>
				<!-- /video call button -->
				@endif
				@endif

				<!-- delete all chat button -->
                <!-- <a class="dropdown-item lw-disable-link" id="lwDeleteAllChatDisableButton" readonly><i class="fas fa-trash"></i> <?= __tr('Delete All Chat') ?></a> -->
				<a class="dropdown-item lw-ajax-link-action" id="lwDeleteAllChatActiveButton" href="<?= route('user.write.delete_all_messages', ['userId' => $userData['user_id']]) ?>" data-method="post" data-callback="userChatResponse" data-post-data='<?= json_encode(['to_user_id' => $userData['user_id']]) ?>' type="button"><i class="fas fa-trash"></i> <?= __tr('Delete All Chat') ?></a>
				<!-- /delete all chat button -->
                 @if(!$userData['isBlockUser'])
                <a class="dropdown-item" type="button" title="<?= __tr('Block User') ?>" id="lwBlockUserBtn"><i class="fas fa-ban"></i> <?= __tr('Block User') ?></a>
                @endif
                <!-- report button -->
                <a class="dropdown-item" type="button" title="" data-toggle="modal" data-target="#lwReportUserDialog"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?= __tr('Report') ?></a>
                        <!-- /report button --> 
			</div>
        </div>
    </div>
</div>
<div class="lw-messenger-chat-window row">
    <!-- Check if user conversation exists -->
    @if(!__isEmpty($userConversations))
        <!-- Loop over the user conversation -->
        @foreach($userConversations as $conversation)
            <!-- Check if message received from other user -->
            @if($conversation['is_message_received'])
                <div class="lw-messenger-chat-message row col-md-12 lw-messenger-chat-recipient">
                    <!-- message received user profile picture -->
                    <img src="<?= $userData['profile_picture_image'] ?>" class="lw-profile-picture lw-online" alt="">
                    <!-- /message received user profile picture -->

                    <!-- Check if message is only text -->
                    @if($conversation['type'] == 1)
                        <div class="lw-messenger-chat-item"><?= $conversation['message'] ?>
                            <a type="button" class="close float-right lw-ajax-link-action lw-single-message-delete" href="<?= route('user.write.delete_message', ['chatId' => $conversation['chat_id'], 'userId' => $userData['user_id']]) ?>" data-method="post" data-callback="userChatResponse">
                                <span aria-hidden="true">&times;</span>
                            </a>
                            <span class="lw-messenger-chat-meta black"><?= $conversation['created_on'] ?></span>
                        </div>
                    <!-- Check if message for Uploaded File / Giphy / Sticker -->
                    @elseif ($conversation['type'] == 2 or $conversation['type'] == 8 or $conversation['type'] == 12)
                        <div class="lw-messenger-chat-item"><img src="<?= $conversation['message'] ?>" alt="">
                            <a type="button" class="close float-right lw-ajax-link-action lw-single-message-delete" href="<?= route('user.write.delete_message', ['chatId' => $conversation['chat_id'], 'userId' => $userData['user_id']]) ?>" data-method="post" data-callback="userChatResponse">
                                <span aria-hidden="true">&times;</span>
                            </a>
                            <span class="lw-messenger-chat-meta"><?= $conversation['created_on'] ?></span>
                        </div>
                    @endif
                </div>
            <!-- Check if message send -->
            @else
                <div class="lw-messenger-chat-message lw-messenger-chat-sender row col-md-12">
                    @if($conversation['type'] == 1)
                        <div class="lw-messenger-chat-item text-black">
                            <a type="button" class="close float-right lw-ajax-link-action lw-single-message-delete" href="<?= route('user.write.delete_message', ['chatId' => $conversation['chat_id'], 'userId' => $userData['user_id']]) ?>" data-method="post" data-callback="userChatResponse">
                                <span aria-hidden="true">&times;</span>
                            </a>
                            <?= $conversation['message'] ?>
                            <span class="lw-messenger-chat-meta"><?= $conversation['created_on'] ?></span>
                        </div>
                    @elseif ($conversation['type'] == 2 or $conversation['type'] == 8 or $conversation['type'] == 12)
                        <div class="lw-messenger-chat-item"><img src="<?= $conversation['message'] ?>" alt="">
                            <span class="lw-messenger-chat-meta"><?= $conversation['created_on'] ?></span>
                            <a type="button" class="close float-right lw-ajax-link-action lw-single-message-delete" href="<?= route('user.write.delete_message', ['chatId' => $conversation['chat_id'], 'userId' => $userData['user_id']]) ?>" data-method="post" data-callback="userChatResponse">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                    @endif
                    <img src="<?= $loggedInUserProfilePicture ?>" class="lw-profile-picture lw-online" alt="">
                </div>
            @endif
            <!-- /Check if message received from other user -->
        @endforeach
        <!-- /Loop over the user conversation -->
    @endif
    <!-- Check if user conversation exists -->
</div>
<div class="lw-messenger-footer">
    <div class="col-12">
        @if($userData['isBlockUser'])
            you have blocked this user <button class="btn btn-primary float-right btn-sm lw-ajax-link-action col-md-2 mr-2" data-callback="onUnblockUser" data-method="post" href="<?= route('user.write.unblock_user', ['userUid' =>  $userData['user_uid']]) ?>"><?= __tr('Unblock') ?></button>
        @else
        <form class="lw-ajax-form lw-form" method="post" action="<?= route('user.write.send_message', ['userId' => $userData['user_id']]) ?>" id="lwSendMessageForm" style="display: none;">
            <div class="input-group">
                <input type="text" name="message" class="form-control" aria-describedby="button-addon4" id="lwChatMessage">
                <div class="input-group-append" id="button-addon4">

                    <!-- Message Type for Example: Text / Gif / Sticker / Uploaded Image etc. --> 
                    <input type="hidden" name="type" value="1">
                    <!-- /Message Type for Example: Text / Gif / Sticker / Uploaded Image etc. --> 

                    <!-- Send Button -->
                    <button class="btn btn-primary" id="lwSendMessageButton" style="height:40px;" type="button"><i class="fas fa-paper-plane"></i></button>
                    <!-- /Send Button -->

                    <!-- Gif Image  Button -->
					@if(getStoreSettings('allow_giphy'))
                    <button class="btn btn-outline-secondary lw-open-gif-action" class="lw-gif-images" type="button"><i class="fa fa-images"></i></button>
					@endif
                    <!-- /Gif Image  Button -->

                    <!-- Sticker Button -->
                    <!-- <a class="btn btn-outline-secondary lw-open-stickers-action lw-ajax-link-action" href="<?php echo route('user.read.get_stickers') ?>" type="button" data-callback="__Messenger.fetchStickers"><i class="fas fa-sticky-note"></i></a> -->
                    <!-- /Sticker Button -->
                    
                    <button class="input-group-text" id="lwUploadingLoader" style="display: none;">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only"><?= __tr('Loading...') ?></span>
                        </div>
                    </button>
                    <!-- Upload Media Button -->
                    <button class="btn btn-outline-secondary lw-messenger-file-upload" type="button" id="lwMessengerFileUpload" style="display:none;"></button>
                    <!-- Upload Media Button -->
                </div>
            </div>
        </form>
        @endif
        <!--  Accept Message Request Button -->
        <a href="<?= route('user.write.accept_decline_message_request', ['userId' => $userData['user_id']]) ?>" type="button" class="btn btn-success btn-sm lw-ajax-link-action" id="lwAcceptChatRequestBtn" data-post-data='<?= json_encode(['message_request_status' => 1]) ?>' style="display: none;" data-method="post" data-callback="__Messenger.acceptMessageRequest"><?= __tr('Accept') ?></a>
        <!--  /Accept Message Request Button -->

        <!--  Decline Message Request Button -->
        <a href="<?= route('user.write.accept_decline_message_request', ['userId' => $userData['user_id']]) ?>" type="button" class="btn btn-danger btn-sm lw-ajax-link-action" id="lwDeclineChatRequestBtn" data-post-data='<?= json_encode(['message_request_status' => 2]) ?>' style="display: none;" data-method="post" data-callback="__Messenger.declineMessageRequest"><?= __tr('Decline') ?></a>
        <!--  Decline Message Request Button -->

        <div class="text-white" id="lwDeclineMessage" style="display: none;">
            <?= __tr('Message Request Declined') ?>
        </div>
        
    </div>
</div>
<div id="lwBuyStickerText" data-message="<?= __('Are you sure to purchase this sticker') ?>"></div>
<!-- Bottom sheet for Sticker / Gif Image -->
<div class="lw-messenger-bottom-sheet">
    <div class="lw-heading"></div>
    <div class="lw-content">
        <div id="lwStickerImagesContainer"></div>
        <div id="lwGifImagesContainer"></div>
        <!-- <div class="lw-overlay offset-md-4"></div> -->
    </div>
</div>

<!-- user report Modal-->
    <div class="modal fade" id="lwReportUserDialog" tabindex="-1" role="dialog" aria-labelledby="userReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userReportModalLabel"><?= __tr('Abuse Report to __username__', [
                    '__username__' => $userData['username']]) ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="margin: -1rem 0rem -1rem auto;width: 20px;">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="lw-ajax-form lw-form" id="lwReportUserForm" method="post" data-callback="userReportCallback" action="<?= route('user.write.report_user', ['sendUserUId' => $userData['user_id']]) ?>">
                    <div class="modal-body">
                        <!-- reason input field -->
                        <div class="form-group">
                            <label for="lwUserReportReason"><?= __tr('Reason') ?></label>
                            <textarea class="form-control" rows="3" id="lwUserReportReason" name="report_reason" required></textarea>
                        </div>
                        <!-- / reason input field -->
                    </div>

                    <!-- modal footer -->
                    <div class="modal-footer mt-3">
                        <button class="btn btn-light btn-sm" id="lwCloseUserReportDialog"><?= __tr('Cancel') ?></button>
                        <button type="submit" class="btn btn-primary btn-sm lw-ajax-form-submit-action btn-user lw-btn-block-mobile"><?= __tr('Report') ?></button>
                    </div>
                </form>
                <!-- modal footer -->
            </div>
        </div>
    </div>
    <!-- /user report Modal-->

<!-- /Bottom sheet for Sticker / Gif Image -->
<!-- Modal -->
<div class="modal fade" id="lwUserNotAcceptedMsgRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close lw-not-accepted-dialog-close-btn" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body py-4 bg-white text-center">
				<h5><?= __tr('User needs to accept chat request') ?></h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary lw-not-accepted-dialog-close-btn"><?= __tr('Close') ?></button>
			</div>
		</div>
	</div>
</div>
<div id="lwBlockUserConfirmationText" style="display: none;">
        <h3><?= __tr('Are You Sure!') ?></h3>
        <strong><?= __tr('You want to block this user.') ?></strong>
    </div>
<script>
__Messenger.recipientUserProfilePicture = "<?= $userData['profile_picture_image'] ?>";
//block user confirmation
    $("#lwBlockUserBtn").on('click', function(e) {
        var confirmText = $('#lwBlockUserConfirmationText');
        //show confirmation 
        showConfirmation(confirmText, function() {
            var requestUrl = '<?= route('user.write.block_user') ?>',
                formData = {
                    'block_user_id' : '<?= $userData['user_uid'] ?>',
                };                  
            // post ajax request
            __DataRequest.post(requestUrl, formData, function(response) {
                if (response.reaction == 1) {
                    __Utils.viewReload();
                }
            });
        });
    });
    //on un block user callback
    function onUnblockUser(response) {
        //check reaction code is 1
        if (response.reaction == 1) {
            var requestData = response.data;
            
            //apply class row fade in
            $("#lwBlockUser_"+requestData.blockUserUid).hide();
            if (requestData.blockUserLength == 0) {
                location.reload();
            }
        }
    } 
</script>