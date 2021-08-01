<li class="{{ Request::route()->getName() == $menu['route_name'] ? 'active' : "" }}">
    @if ($menu['child'])
        <a href="#submenu{{$menu['id']}}" data-toggle="collapse">
            <i data-feather="package"></i>
              {!! isset($menu['menu_icon']) ? $menu['menu_icon'] : '<i data-feather="briefcase"></i>' !!}
                <span> {{$menu['menu_name']}} </span>
              <span class="menu-arrow"></span>
        </a>
    @else
        <a href="{{ $menu['url'] != '' ? route($menu['route_name']) : $menu['url'] }}">{{$menu['menu_name']}}</a>
    @endif
@if ($menu['child'])
 <div class="collapse" id="submenu{{$menu['id']}}">
    <ul class="nav-second-level">
    @foreach($menu['child'] as $menu)
            @if (Auth::user()->role->hasMenuPermission($menu['id']))
              @include('layouts.partial.item', ['menu' => $menu])
            @endif
    @endforeach
    </ul>
 </div>
@endif
</li>
