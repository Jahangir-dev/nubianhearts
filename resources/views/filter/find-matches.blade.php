@if(!__isEmpty($filterData))
    @foreach($filterData as $filter)
    <div class="col mb-4">
        <div class="card text-center lw-user-thumbnail-block <?= (isset($filter['isPremiumUser']) and $filter['isPremiumUser'] == true) ? 'lw-has-premium-badge' : '' ?>">
			<!-- show user online, idle or offline status -->
			@if($filter['userOnlineStatus'])
				<div class="pt-2">
					@if($filter['userOnlineStatus'] == 1)
						<span class="lw-dot lw-dot-success" title="Online"></span>
						@else
						<span class="lw-dot lw-dot-grey float-right" title="Idle"></span>
						
					@endif
				</div>
			@endif
			<!-- /show user online, idle or offline status -->
            <a href="<?= route('user.profile_view', ['username' => $filter['username']]) ?>">
                <img data-src="<?= imageOrNoImageAvailable($filter['profileImage']) ?>" class="lw-user-thumbnail lw-lazy-img"/>
            </a>

            <div class="card-title">
                <h5>
                	<a class="text-secondary" style="color: #000 !important;" href="<?= route('user.profile_view', ['username' => $filter['username']]) ?>">
                		<?= $filter['fullName'] ?>, <?= $filter['userAge'] ?>
            		</a>
					<?= $filter['cityName'] ?> ,
	                @if($filter['countryName'])
	                    <?= $filter['countryName'] ?>
	                @endif @if($filter['isPremiumUser'] == true)<i class="fas fa-star" style="color: gold;"></i>@endif
	                <br>
	                <?= $filter['lastMessage'] ?>
				</h5>
            </div>
        </div>
    </div>
    @endforeach
@else
    <!-- info message -->
    <div class="col-sm-12 alert alert-info">
        <?= __tr('There are no matches found.') ?>
    </div>
    <!-- / info message -->
@endif