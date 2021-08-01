<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div class="user-box text-center">
            <div class="dropdown">
            </div>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{url('/home')}}">
                        <i data-feather="airplay"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                   @foreach (\App\Helper\HelperClass::menuList() as $key=>$menu)
                    @if (Auth::user()->role->hasMenuPermission($menu['id']))
                         @include('layouts.partial.item', ['menu' => $menu])
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
