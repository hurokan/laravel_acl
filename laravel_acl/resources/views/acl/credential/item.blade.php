<li @if ($menu['child']) class="treeview"  @endif>
    <input type="checkbox"  @if ($selected) checked="checked" @endif class="menuCheck" name="menu_item_id[]" value="{{$menu['id']}}"> <span>{{$menu['menu_name']}}</span>
    @if ($menu['child'])
        <ul class="treeview-menu" @if ($selected) style="display: block" @else style="display: none" @endif>
            @foreach($menu['child'] as $menu)
                @include('acl.credential.item', ['menu' => $menu, 'rolaData' => $rolaData, 'selected' => $rolaData->hasMenuPermission($menu['id'])])
            @endforeach
        </ul>
    @endif
</li>
