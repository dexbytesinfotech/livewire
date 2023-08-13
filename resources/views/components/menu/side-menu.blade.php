@if ($sideBarMenu)
    @foreach ($sideBarMenu as $val)

        @if (!empty($val->sectionTitle))
        <li class="nav-item mt-3">
            <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder text-white">{{ $val->sectionTitle }}</h6>
        </li>    
        @endif

        @if ($val->type == 'collapse')
        <li class="nav-item">
            <a 
            data-bs-toggle="{{  (!$val->noCollapse && count($val->collapse) > 0 ? 'collapse' : null)  }}" 
            @if (!$val->noCollapse && count($val->collapse) > 0)
            aria-controls="{{ $val->id }}" role="button" aria-expanded="false"
            @endif
            href="{{ $val->link }}"
                class="nav-link text-white {{ (Request::route()->uri() == $val->route) ? 'active' : '' }} {{ in_array(Route::currentRouteName(),json_decode($val->routes)) ? 'active' : '' }}  {{ (Route::currentRouteName() == $val->route) ? 'active' : '' }}"
                aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                @empty (!$val->icon)
                <span class="material-symbols-outlined">
                    {{ $val->icon }}
                </span>            
                @else
                <span class="material-icons">
                    {{ mb_substr($val->name, 0, 1) }}
                </span>
                @endempty
                <span class="nav-link-text ms-2 ps-1">  {{ $val->name }}</span>
            </a>


        @if (!$val->noCollapse)
            <div class="collapse {{ (Request::route()->uri() == $val->route) ? 'show' : '' }} {{ in_array(Route::currentRouteName(),json_decode($val->routes)) ? 'show' : '' }}  {{ (Route::currentRouteName() == $val->route) ? 'show' : '' }} "
                id="{{ $val->id }}">

                <ul class="nav nav-sm flex-column ms-2">
                    @foreach ($val->collapse as $collapse)
                        
                    <li class="nav-item">
                        <a class="nav-link text-white  {{ strpos(Route::currentRouteName(), $collapse->route) === false ? '' : 'active' }}"
                            href="{{ $collapse->link }}">
                            @empty(!$collapse->icon)
                            <span class="material-symbols-outlined">
                                {{ $collapse->icon }}
                            </span>
                            @endempty
                            <span class="sidenav-normal ms-3 ps-1"> {{ $collapse->name }} </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        @endif
        </li>
        @elseif ($val->type == 'divider')
            <hr class="horizontal light">
        @endif

    @endforeach

@endif