@if(isset($is_profile_page) and ($is_profile_page === true))
        @if(!$isBlockUser and !$blockByMeUser)
            @stack('sidebarProfilePage')
        @endif
    @endif