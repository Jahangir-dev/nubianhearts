<div class="modal-content" id="chatBox">
            <div class="modal-header">
                <button id="lwChatSidebarToggle" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <h5 class="modal-title"><?= __tr('Chat') ?></h5>
                <button style="position: absolute; right: 0; width: 100px;" type="button" class="close" data-dismiss="modal" aria-label="<?= __tr('Close') ?>"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="lwChatDialogLoader" style="display: none;">
                    <div class="d-flex justify-content-center m-5">
                        <div class="spinner-border" role="status">
                            <span class="sr-only"><?= __tr('Loading...') ?></span>
                        </div>
                    </div>
                </div>
                <div id="lwMessengerContent"></div>
            </div>
        </div>
        <div class="card" id="noChat" style="display:none">
                <div class="card-body">
                    <div class="empty-state"><div class="empty-icon mb-4">
                        <i class="fa fa-envelop"></i>
                    </div>
                    <h5 class="empty-title">No contacts</h5>
                    <p class="empty-subtitle">You don't have any conversations yet</p>
                        <div class="empty-action">
                            <a class="btn btn-primary" href="<?= route('user.read.find_matches') ?>">Browse people</a>    </div>
                    </div>
                </div>
            </div>
@push('appScripts')
<script type="text/javascript">
	 getChatMessenger('<?= route('user.read.all_conversation') ?>', true);
</script>
@endpush