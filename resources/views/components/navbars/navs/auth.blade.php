
<nav class="navbar navbar-main navbar-expand-lg position-sticky top-0 px-0  shadow-none z-index2"
    id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-4">
        <nav aria-label="breadcrumb">
            <h5 class="font-weight-bolder mb-0 text-capitalize">@yield('page_title')</h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav justify-content-end align-items-center">
               
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center pe-3 ">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                
 
                @if(count(config('translatable.locales')) > 1)
                    <li class="nav-item dropdown pe-3">

                        <a title="Dashboard" class="nav-link p-0 position-relative" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false"  href="{{ route('dashboard') }}">
                                <span class="material-icons cursor-pointer d-inline-block align-top">language</span>
                                <b> {{  strtoupper(\App::getLocale()) }} </b>
                            </a>
                        <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            @foreach (config('translatable.locales') as $locale)
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('locale.setting', $locale) }}">
                                <b>({{ Str::upper($locale) }})</b> {{ \App\Dexlib\Locale::getAllLang()[$locale] }} 
                                </a>
                            </li>   
                        @endforeach
                        </ul>
                    </li> 
                @endif

                 <li class="nav-item dropdown pe-3">
                    
                    <a href="javascript:;" class="nav-link p-0 position-relative" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i title="My Account" class="material-icons cursor-pointer d-inline-block align-top" >
                            account_circle
                        </i>
                        @if(Auth::check())
                            {{ Auth::user()->name  }}
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        @can('edit-profile')
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="{{ route('edit-profile') }}">
                                <div class="d-flex align-items-center py-1">
                                    <span class="material-icons">person</span>
                                    <div class="ms-2">
                                        <h6 class="text-sm font-weight-normal my-auto">
                                            Profile
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>   
              
                        @endcan

                        <li class="mb-2">
                            <livewire:auth.logout />
                        </li>   
                     </ul>
                </li>  
            </ul>
        </div>
    </div>
</nav>
