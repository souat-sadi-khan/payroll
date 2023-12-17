<aside class="app-sidebar">
    
    <div class="app-sidebar__user">
        {{-- User Photo --}}
        <div class="text-center">
            <a href="{{ route('admin.profile') }}">
                @if (get_option('host') == 1)
                    <img class="app-sidebar__user-avatar" src="{{auth()->user()->image? asset('storage/user/photo/'.auth()->user()->image):'https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg'}}" alt="User Image">
                @else 
                    <img class="app-sidebar__user-avatar" src="{{auth()->user()->image? asset('uploads//'.auth()->user()->image):'https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg'}}" alt="User Image">
                @endif
            </a>
        </div>
        <br>
        <div>
            {{-- User Name --}}
            <p class="app-sidebar__user-name"><a style="color:white" href="{{ route('admin.profile') }}">{{auth()->user()->name?auth()->user()->name:'John Doe'}}</a></p>
            {{-- User Admin/User --}}
            <p style="color:#4CD0BC" class="app-sidebar__user-designation">{{getUserRoleName(auth()->user()->id)?getUserRoleName(auth()->user()->id):'Admin'}}</p>
        </div>
    </div>
    <ul class="app-menu">
        @include('_partials.admin.sidebar.main_sidebar')
    </ul>
</aside>