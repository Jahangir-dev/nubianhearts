@section('page-title', __tr('Find Matches'))
@section('head-title', __tr('Find Matches'))
@section('keywordName', __tr('Find Matches'))
@section('keyword', __tr('Find Matches'))
@section('description', __tr('Find Matches'))
@section('keywordDescription', __tr('Find Matches'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h5 mb-0 text-gray-200">
        <span class="text-primary"><i class="fas fa-search" aria-hidden="true"></i></span>
        <?= __tr('Update Search') ?>
    </h5>
</div>

<?php
    
    if( request()->query('reset') == True)
    {
        $request = request();
        $request->request->add(['is_advance_filter' => 1]);
    }
    if(isset($search['looking_for']))
    {

        $lookingFor = $search['looking_for'];
    } else{
        $lookingFor = getUserSettings('looking_for');
    }

    if(isset($search['min_age'])){
        $minAge = $search['min_age'];
    } else {
     $minAge = getUserSettings('min_age');
    }   

    if(isset($search['max_age'])){
        $maxAge = $search['max_age'];
    } else {
     $maxAge = getUserSettings('max_age');
    } 
?>
<!-- Page Heading -->
 <form class="" method="post" action="<?= route('user.read.searchUpdate',['id'=>$search['id']]) ?>">
    @csrf
    
<div class="card lw-find-form-container mb-4 ">
    <div class="card-body row">
        <div class="col-md-12 col-sm-12">
           
                 <label for="lookingFor"><?= __tr("Unique Name for Search (Max 30)") ?></label>

                <input type="text" name="name" maxlength="10" class="form-control col-md-4" value="{{$search['name']}}">
                @if($errors->any())
                    <label class="text-danger"><b>{{$errors->first()}}</b></label>
                @endif
            
        </div>
        <div class="col-md-2 col-sm-12">
             <!-- Looking For -->
            <div class="lw-looking-for-container lw-basic-filter-field">
                <label for="lookingFor"><?= __tr("I'm looking for") ?></label>
                <select name="looking_for" class="form-control" id="lookingFor">
                    <option value="all"><?= __tr('All') ?></option>
                    @foreach(configItem('user_settings.gender') as $genderKey => $gender)
                        <option value="<?= $genderKey ?>" <?= (request()->looking_for == $genderKey or $genderKey == $lookingFor) ? 'selected' : '' ?>><?= $gender ?></option>
                    @endforeach
                </select>
            </div>
            <!-- /Looking For -->
        </div>
        <div class="col-md-3 col-sm-12">
             <!-- Age between -->
            <div class="lw-age-between-container row lw-basic-filter-field">
                <div class="col-md-6 col-sm-12">
                    <label for="minAge"><?= __tr('Aged') ?></label>
                    <select name="min_age" class="form-control" id="minAge">
                        @foreach(range(18,70) as $age)
                            <option value="<?= $age ?>" <?= (request()->min_age == $age or $age == $minAge) ? 'selected' : '' ?>><?= __tr('__translatedAge__', [
                                '__translatedAge__' => $age
                            ]) ?></option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-sm-12">
                    <label for="minAge"><?= __tr('') ?></label>
                    <select name="max_age" class="form-control mt-1" id="maxAge">
                        @foreach(range(18,70) as $age)
                            <option value="<?= $age ?>" <?= (request()->max_age == $age or $age == $maxAge) ? 'selected' : '' ?>><?= __tr('__translatedAge__', [
                                '__translatedAge__' => $age
                            ]) ?></option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /Age between -->
        </div>
        <div class="col-sm-12 col-md-2">
            <label for="" class="w-100">Located</label>
            <div class="col-sm-12 col-md-12" style="margin-top: -18px; margin-left: -18px;">
                <label class="radio-inline mb-0">
                <input type="radio" name="locationButton" class="radioInput"  value="distance" @if(isset($search['countries__id']) && __isEmpty($search['countries__id'])) checked @endif>
                <span class="radioText">Near me</span></label>
                <label class="radio-inline mb-0">
                <input type="radio" name="locationButton" class="radioInput" @if(isset($search['countries__id']) && !__isEmpty($search['countries__id'])) checked @endif  value="city">
                <span class="radioText">Country and city</span></label>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 distance box" @if(isset($search['countries__id']) && __isEmpty($search['countries__id'])) style="display:block;" @else style="display:none" @endif>
            <!-- Distance from my location -->
            <div class="lw-distance-location-container lw-basic-filter-field">
                <label class="justify-content-start" for="distance"><?= __tr('Distance in __distanceUnit__', ['__distanceUnit__' =>( getStoreSettings('distance_measurement') == '6371') ? 'KM' : 'Miles']) ?></label>
                <input type="text" class="form-control" name="distance"
                value="<?= (request()->distance != null) ? request()->distance : getUserSettings('distance') ?>" placeholder="<?= __tr('Anywhere') ?>">
            </div>
            <!-- /Distance from my location -->
        </div>
        <div class="col-sm-12 col-md-5 city box" @if(isset($search['countries__id']) && !__isEmpty($search['countries__id'])) style="display:block;" @else style="display:none" @endif >
                <div class="row ">
                    <div class="col-sm-12 col-md-4">
                            <label>Select Country</label>
                        <select class="form-control selectCustom " name="countries__id" id="country">
                            <option value=""></option>
                             @foreach($userSpecifications['groups']['background']['items']['nationality']['options'] as $key => $nation)
                                    <option @if(isset($search['countries__id']) && !__isEmpty($search['countries__id']) && $search['countries__id'] == $key ) selected @endif  value="<?= $key ?>"><?= $nation ?></option>
                                @endforeach
                        </select>
                    </div>
                     <div class="col-sm-12 col-md-4">
                        <label>Select State</label>
                        <select class="form-control selectCustom" name="state" id="state"></select>
                    </div>
                     <div class="col-sm-12 col-md-4">
                        <label>Select City</label>
                        <select class="form-control selectCustom" name="city" id="citySave"></select>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <!-- /Distance from my location -->
            
            
        </div>
    </div>
</div>

<!-- Found matches container -->
    <!-- Advance Filter Options -->
    <div class="lw-advance-filter-container lw-expand-filter col-md-12 col-sm-12">
        <div class="lw-filter-message text-secondary">
        </div>
        <!-- Tabs for advance filter -->
        
                <div class="row p-2">
                        <div class="col-sm-12 col-md-4">
                            <label for="user_name">Search with username</label>
                            <input type="text" name="username" class="form-control" style="margin-top: 4px;text-align: inherit; width:19rem;"  value="@if(isset($search['username']) && !__isEmpty($search['username'])  ) <?=$search['username']?> @endif">
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="relationship_status"><?= __tr('Relationship looking for') ?></label>
                            <input type="hidden" id="for_relationship_status" name="martial_status" value="">
                            <select id="relationship_status" class="form-control col-sm-12 col-md-4" multiple="multiple" style="position:relative !important;">
                                <option @if(isset($search['martial_status']) && !__isEmpty($search['martial_status']) && $search['martial_status'] == 'friendship' ) selected @endif value="friendship">Friendship</option>
                                <option  @if(isset($search['martial_status']) && !__isEmpty($search['martial_status']) && $search['martial_status'] == 'dating' ) selected @endif value="dating">Dating</option>
                                <option  @if(isset($search['martial_status']) && !__isEmpty($search['martial_status']) && $search['martial_status'] == 'marriage' ) selected @endif value="marriage">Marriage</option>
                                <option  @if(isset($search['martial_status']) && !__isEmpty($search['martial_status']) && $search['martial_status'] == 'penpal' ) selected @endif value="penpal">Penpal</option>
                            </select>
                        </div>
                    
                        <div class="col-sm-12 col-md-4">
                            <label for="for_nationality"><?= __tr('Nationality')?></label>
                            <input type="hidden" id="for_nationality" name="nationality" value="">
                            <select id="looking_for_nationality" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['background']['items']['nationality']['options'] as $key => $nation)
                                    <option  @if(isset($search['nationality']) && !__isEmpty($search['nationality']) && $search['nationality'] == $key ) selected @endif value="<?= $key ?>"><?= $nation ?></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-sm-12 col-md-4">
                            <label for="for_ethnicity"><?= __tr('Ethnicity') ?></label>
                            <input type="hidden" id="for_ethnicity" name="ethnicity" value="">
                            <select id="looking_for_ethnicity" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['background']['items']['ethnicity']['options'] as $key => $ethencity)
                                    <option @if(isset($search['ethnicity']) && !__isEmpty($search['ethnicity']) && $search['ethnicity'] == $key ) selected @endif value="<?= $key ?>"><?= $ethencity ?></option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_best_feature"><?= __tr('Best feature') ?></label>
                            <input type="hidden" id="for_best_feature" name="features" value="">
                            <select id="looking_for_best_feature" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['looks']['items']['features']['options'] as $key => $feature)
                                    <option @if(isset($search['features']) && !__isEmpty($search['features']) && $search['features'] == $key ) selected @endif value="<?= $key ?>"><?= $feature ?></option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_religion"><?= __tr('Religion') ?></label>
                            <input type="hidden" id="for_religion" name="religion" value="">
                            <select id="looking_for_religion" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['looks']['items']['religion']['options'] as $key => $religion)
                                    <option @if(isset($search['religion']) && !__isEmpty($search['religion']) && $search['religion'] == $key ) selected @endif value="<?= $key ?>"><?= $religion ?></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row p-2">
                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_kids"><?= __tr('Do they have kids?') ?></label>
                            <input type="hidden" id="for_kids" name="children" value="">
                            <select id="looking_for_kids" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['lifestyle']['items']['children']['options'] as $key => $children)
                                    <option @if(isset($search['children']) && !__isEmpty($search['children']) && $search['children'] == $key ) selected @endif value="<?= $key ?>"><?= $children ?></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_living_situation"><?= __tr('Living situation') ?></label>
                            <input type="hidden" id="for_living_situation" name="i_live_with" value="">
                            <select id="looking_for_living_situation" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['lifestyle']['items']['i_live_with']['options'] as $key => $live)
                                    <option @if(isset($search['i_live_with']) && !__isEmpty($search['i_live_with']) && $search['i_live_with'] == $key ) selected @endif value="<?= $key ?>"><?= $live ?></option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_occupation"><?= __tr('Occupation') ?></label>
                            <input type="hidden" id="for_occupation" name="your_occupation" value="">
                            <select id="looking_for_occupation" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['lifestyle']['items']['your_occupation']['options'] as $key => $occupation)
                                    <option @if(isset($search['your_occupation']) && !__isEmpty($search['your_occupation']) && $search['your_occupation'] == $key ) selected @endif value="<?= $key ?>"><?= $occupation ?></option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_salary"><?= __tr('Annual Salary(USD)') ?></label>
                            <select id="looking_for_salary" name="annual_income" class="form-control custom-select">
                                <option value="">Select</option>
                                @foreach($userSpecifications['groups']['lifestyle']['items']['annual_income']['options'] as $key => $income)
                                    <option @if(isset($search['annual_income']) && !__isEmpty($search['annual_income']) && $search['annual_income'] == $key ) selected @endif value="<?= $key ?>"><?= $income ?></option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_education"><?= __tr('Education') ?></label>
                            <input type="hidden" id="for_education" name="your_education" value="">
                            <select id="looking_for_education" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['lifestyle']['items']['your_education']['options'] as $key => $education)
                                    <option @if(isset($search['your_education']) && !__isEmpty($search['your_education']) && $search['your_education'] == $key ) selected @endif value="<?= $key ?>"><?= $education ?></option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_body"><?= __tr('Body Type') ?></label>
                            <input type="hidden" id="for_body" name="body_type" value="">
                            <select id="looking_for_body" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['looks']['items']['body_type']['options'] as $key => $type)
                                    <option @if(isset($search['body_type']) && !__isEmpty($search['body_type']) && $search['body_type'] == $key ) selected @endif value="<?= $key ?>"><?= $type ?></option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_smoking"><?= __tr('Do they smoke?') ?></label>
                            <input type="hidden" id="for_smoking" name="smoke" value="">
                            <select id="looking_for_smoking" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['lifestyle']['items']['smoke']['options'] as $key => $smoke)
                                    <option @if(isset($search['smoke']) && !__isEmpty($search['smoke']) && $search['smoke'] == $key ) selected @endif value="<?= $key ?>"><?= $smoke ?></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label for="looking_for_alcohol"><?= __tr('Do they drink alcohol?') ?></label>
                            <input type="hidden" id="for_alcohol" name="drink" value="">
                            <select id="looking_for_alcohol" class="form-control" multiple="multiple" style="position:relative !important;">
                                @foreach($userSpecifications['groups']['lifestyle']['items']['drink']['options'] as $key => $drink)
                                    <option @if(isset($search['drink']) && !__isEmpty($search['drink']) && $search['drink'] == $key ) selected @endif value="<?= $key ?>"><?= $drink ?></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="from_height"><?= __tr('Height From') ?></label>
                                    <select class="form-control selectCustom" name="min_height">
                                        <option value="">Select</option>
                                        @foreach($userSpecifications['groups']['looks']['items']['height']['options'] as $key => $height)
                                            <option @if(isset($search['min_height']) && !__isEmpty($search['min_height']) && $search['min_height'] == $key ) selected @endif value="<?= $key ?>"><?= $height ?></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="to_height"><?= __tr('Height To') ?></label>
                                    <select class="form-control selectCustom" name="max_height">
                                        <option value="">Select</option>
                                        @foreach($userSpecifications['groups']['looks']['items']['height']['options'] as $key => $height)
                                            <option @if(isset($search['max_height']) && !__isEmpty($search['max_height']) && $search['max_height'] == $key ) selected @endif value="<?= $key ?>"><?= $height ?></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-2">
                       <div class="col-sm-12 col-md-4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="from_weight"><?= __tr('Weight From') ?></label>
                                    <select class="form-control selectCustom" name="from_weight">
                                        <option value="">Select</option>
                                        @foreach($userSpecifications['groups']['looks']['items']['weight']['options'] as $key => $weight)
                                            <option @if(isset($search['from_weight']) && !__isEmpty($search['from_weight']) && $search['from_weight'] == $key ) selected @endif value="<?= $key ?>"><?= $weight ?></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="to_weight"><?= __tr('Weight To') ?></label>
                                    <select class="form-control selectCustom" name="to_weight">
                                    <option value="">Select</option>
                                        @foreach($userSpecifications['groups']['looks']['items']['weight']['options'] as $key => $weight)
                                            <option @if(isset($search['to_weight']) && !__isEmpty($search['to_weight']) && $search['to_weight'] == $key ) selected @endif value="<?= $key ?>"><?= $weight ?></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="row p-2">
                        <div class="col-sm-12 col-md-4">
                                <div class="form-check form-check-inline">
                              <input class="form-check-input w-20" type="checkbox" id="inlineCheckbox3" @if(isset($search['online']) && !__isEmpty($search['online']) && $search['online'] == 'on' ) checked @endif>
                              <label class="form-check-label" for="inlineCheckbox3">Online</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input w-20" type="checkbox" id="inlineCheckbox2" @if(isset($search['photo']) && !__isEmpty($search['photo']) && $search['photo'] == 'on' ) checked @endif>
                              <label class="form-check-label" for="inlineCheckbox2">Photo</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input w-20" type="checkbox" id="inlineCheckbox1" @if(isset($search['new_member']) && !__isEmpty($search['new_member']) && $search['new_member'] == 'on' ) checked @endif >
                              <label class="form-check-label" for="inlineCheckbox1">New Member</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2 mb-2">
                            <div class="custom-control">
                                <a class="btn text-white" onclick='window.location.href = "?reset=true"'>Clear <i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="custom-control">
                                <button type="submit" class="btn btn-primary"><?= __tr('Update') ?></button>
                            </div>
                        </div>
                    </div>
                <!--  -->
            
        <!-- /Tabs for advance filter -->
    </div>
        </form>

<!-- Found matches container -->
@push('appScripts')
<script>
    function loadMoreUsers(responseData) {
        $(function() {
            applyLazyImages();
        });
        var requestData = responseData.data,
            appendData = responseData.response_action.content;
        $('#lwUserFilterContainer').append(appendData);
        $('#lwLoadMoreButton').data('action', requestData.nextPageUrl);
        if (!requestData.hasMorePages) {
            $('.lw-load-more-container').hide();
        }
    }
// Show advance filter
$('#lwShowAdvanceFilterLink').on('click', function(e) {
    e.preventDefault();
    $('.lw-advance-filter-container').addClass('lw-expand-filter');
    $('#lwShowAdvanceFilterLink').hide();
    $('#lwHideAdvanceFilterLink').show();
    // $('.lw-advance-filter-container').show();
});
// Hide advance filter
$('#lwHideAdvanceFilterLink').on('click', function(e) {
    e.preventDefault();
    $('.lw-advance-filter-container').removeClass('lw-expand-filter');
    $('#lwShowAdvanceFilterLink').show();
    $('#lwHideAdvanceFilterLink').hide();
    // $('.lw-advance-filter-container').hide();
});

    $('#relationship_status').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#relationship_status option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_relationship_status').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#relationship_status option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_relationship_status').val(selected);
            },
    }); 
    $('#looking_for_nationality').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_nationality option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_nationality').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_nationality option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_nationality').val(selected);
            },
    });
    $('#looking_for_ethnicity').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_ethnicity option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_ethnicity').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_ethnicity option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_ethnicity').val(selected);
            },
        });

    $('#looking_for_best_feature').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_best_feature option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_best_feature').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_best_feature option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_best_feature').val(selected);
            },
        });

    $('#looking_for_religion').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_religion option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_religion').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_religion option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_religion').val(selected);
            },
        });

    $('#looking_for_living_situation').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_living_situation option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_living_situation').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_living_situation option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_living_situation').val(selected);
            },
        });

    $('#looking_for_kids').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_kids option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_kids').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_kids option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_kids').val(selected);
            },
        });

    $('#looking_for_occupation').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_occupation option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_occupation').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_occupation option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_occupation').val(selected);
            },
        });

    $('#looking_for_education').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_education option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_education').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_education option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_education').val(selected);
            },
        });

    $('#looking_for_body').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_body option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_body').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_body option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_body').val(selected);
            },
        });

    $('#looking_for_smoking').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_smoking option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_smoking').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_smoking option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_smoking').val(selected);
            },
        });

    $('#looking_for_alcohol').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
                var selected = [];
                $('#looking_for_alcohol option:selected').each(function(index, brand) {
                  selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_alcohol').val(selected);
            },
            onChange: function(element, checked) {
                var brands = $('#looking_for_alcohol option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push(["'"+$(this).val()+"'"]);
                });
                $('#for_alcohol').val(selected);
            },
        });
   $(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
<?php if(isset($search['countries__id']) && !__isEmpty($search['countries__id'])){ ?>
    getStates();
<?php } ?>
$('#country').change(getStates);
    function getStates()
    {
        var country = $('#country').find(":selected").text();
        var country_id = $('#country').find(":selected").val();
        __DataRequest.post("<?= route('user.write.location_data') ?>", {
            'get_state': country,
            '_state': '',
            'country_id':country_id,
            'latitude':'',
            'longitude':'',
            '_city':''
        }, function(responseData) {
            var items = responseData.data.states;
            if(items !== undefined)
            {
                $('#state').empty();
                $('#citySave').empty();

                $.each(items, function (i, item) {
                    <?php if(isset($search['state']) && !__isEmpty($search['state'])){ ?>
                        var state = <?=$search['state']?>;
                        if(state === item.code)
                        {
                            $('#state').append($('<option selected value='+item.code+'>'+item.name+'</option>'));
                        } else {
                            $('#state').append($('<option>', { 
                                value: item.code,
                                text : item.name 
                            }));
                        }
                    <?php } else { ?>
                        $('#state').append($('<option>', { 
                            value: item.code,
                            text : item.name 
                        }));
                    <?php } ?>
                });

                <?php if(isset($search['city']) && !__isEmpty($search['city'])){ ?>
                    setTimeout( function(){ 
                     getCities();
                    }  , 1000 );
                <?php } ?>
            }
        });
    } 
    
    $('#state').change(getCities);
    function getCities() {
        var state = $('#state').find(":selected").val();
        var country = $('#country').find(":selected").text();
        var country_id = $('#country').find(":selected").val();
        __DataRequest.post("<?= route('user.write.location_data') ?>", {
            'get_cities': state,
            '_state': state,
            'get_country': country,
            '_country': country,
            'country_id' : country_id,
            'latitude':'',
            'longitude':'',
            '_city':''
        }, function(responseData) {
            var items = responseData.data.cities;
            
            if(items !== undefined)
            {
                
                $('#citySave').empty();
                $.each(items, function (i, item) {

                   <?php if(isset($search['city']) && !__isEmpty($search['city'])){ ?>
                        var city = <?=$search['city']?>;
                        if(city === item.code)
                        {
                            $('#citySave').append($('<option selected value='+item.code+'>'+item.name+'</option>'));
                        } else {
                            $('#citySave').append($('<option>', { 
                                value: item.code,
                                text : item.name 
                            }));
                        }
                    <?php } else { ?>
                        $('#citySave').append($('<option>', { 
                            value: item.code,
                            text : item.name 
                        }));
                    <?php } ?>
                });
            }
                
            });
    }
    

</script>
@endpush