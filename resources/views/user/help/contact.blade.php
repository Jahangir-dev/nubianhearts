@section('page-title', __tr('Contact'))
@section('head-title', __tr('Contact'))
@section('keywordName', __tr('Contact'))
@section('keyword', __tr('Contact'))
@section('description', __tr('Contact'))
@section('keywordDescription', __tr('Contact'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())
<h3 style="text-align: center;">Contact Us Form</h3>
<form>
    <div class="form-group field-bugreportform-name required">

        <input type="text" id="bugreportform-name" class="form-control bg-light" name="name" value="{{getUserAuthInfo('profile.username')}}" disabled="" autofocus="autofocus" placeholder="Your name here" aria-required="true">
    <div class="help-block"></div>
    </div>

    <div class="form-group field-bugreportform-email required">

        <input type="email" id="bugreportform-email" class="form-control" name="email" value="{{getUserAuthInfo('profile.email')}}" disabled="" autofocus="autofocus" placeholder="Your email here" aria-required="true">

        <div class="help-block"></div>
    </div>
    <div class="form-group field-bugreportform-bug required">

        <textarea id="bugreportform-bug" class="form-control" name="bug" rows="6" placeholder="Your message here" aria-required="true"></textarea>

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