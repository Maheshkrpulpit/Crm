<!-- master settings -->
@if(isset($___sideBarMenu) && count($___sideBarMenu))
    @foreach($___sideBarMenu as $mIndex => $menuItem)
        @if(isset($menuItem['code']) && !in_array($menuItem['code'],$___moduleSettings))
            @continue
        @endif

        @if(isset($menuItem['permissions']) && !user_has_any_permission($menuItem['permissions']))
            @continue
        @endif

        @if(!(isset($menuItem['submenu'])))
            <li class="nav-item">
                <a href="{{$menuItem['url']}}" class="@if(\Route::is($menuItem['routes'])) active @endif nav-link" ><i class="{{$menuItem['icon']}}"></i> {{$menuItem['title']}}
                </a>
            </li>
        @else
            <li class="nav-item">
                <a href="{{$menuItem['url'].'sidebar'.$mIndex}}" class="@if(\Route::is($menuItem['routes'])) active collapsed @endif nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{'sidebar'.$mIndex}}"><i class="{{$menuItem['icon']}}"></i><span>{{$menuItem['title']}}</span>
                </a>
                <div class="collapse menu-dropdown @if(\Route::is($menuItem['routes'])) show @endif" id="{{'sidebar'.$mIndex}}">
                    <ul class="nav nav-sm flex-column">
                        @foreach($menuItem['submenu'] as $sIndex => $subMenuItem)
                            @if(isset($subMenuItem['permissions']) && !user_has_all_permissions($subMenuItem['permissions']))
                                @continue
                            @endif
                            <li class="nav-item">
                                <a href="{{$subMenuItem['url']}}" class="nav-link @if(\Route::is($subMenuItem['routes'])) active @endif">{{$subMenuItem['title']}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif
    @endforeach
@endif