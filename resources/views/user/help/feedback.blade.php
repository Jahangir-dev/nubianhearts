@section('page-title', __tr('Feedback'))
@section('head-title', __tr('Feedback'))
@section('keywordName', __tr('Feedback'))
@section('keyword', __tr('Feedback'))
@section('description', __tr('Feedback'))
@section('keywordDescription', __tr('Feedback'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())
<h3 style="text-align: center;">Feedback Form</h3>
<form class="lw-ajax-form lw-form"  method="post" data-show-message="true" action="<?= route('feedback-add') ?>" data-callback="getResponse"  id="lwUserContactForm">
    <div class="form-group field-bugreportform-name required">

        <input type="text" id="bugreportform-name" class="form-control bg-light" name="user_name" value="{{getUserAuthInfo('profile.username')}}" disabled="" autofocus="autofocus" placeholder="Your name here" aria-required="true">
    <div class="help-block"></div>
    </div>

    <div class="form-group field-bugreportform-email required">

        <input type="email" id="bugreportform-email" class="form-control" name="user_email" value="{{getUserAuthInfo('profile.email')}}" disabled="" autofocus="autofocus" placeholder="Your email here" aria-required="true">

        <div class="help-block"></div>
    </div>
    <div class="form-group field-bugreportform-bug required">

        <textarea id="bugreportform-bug" class="form-control" name="inq_message" rows="6" placeholder="Your feedback here" aria-required="true"></textarea>

        <div class="help-block"></div>
    </div>
    <button type="submit" class="button btn-success col-2 btn-lg btn-theme full-rounded animated right-icn">Send</button>
</form>
<style type="text/css">
	h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    margin-bottom: 0.66em;
    font-family: inherit !important; 
    font-weight: 600 !important;
    line-height: 1.1 !important;
    color: inherit !important;
}
h3,.h3 {
    font-size: 1.5rem !important;
}

.form-control:disabled, .form-control[readonly]{
    background-color: #f8f9fa !important;
}
.btn-lg, .btn-group-lg > .btn {
    font-size: 1rem !important;
    min-width: 2.75rem !important;
    font-weight: 400 !important;
}
</style>
<script type="text/javascript">
    function getResponse(response) {
        if (response.reaction == 1) {
            $('#bugreportform-bug').val('');
        }
        
    }
</script>