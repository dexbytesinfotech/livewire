<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0  fixed-start bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand ms-3  p-4 h-50 d-flex align-items-center text-wrap" href="{{ route('dashboard') }}">
                @if(config('app_settings.website_title.value') == 'logo' || config('app_settings.website_title.value') == 'name_and_logo')
                    @if(config('app_settings.app_logo.value'))
                        <img src="{{  Storage::disk(config('app_settings.filesystem_disk.value'))->url(config('app_settings.app_logo.value')) }} " class="navbar-brand-img h-65" alt="main_logo">
                    @else
                        <img src="{{ asset('assets') }}/img/logo-ct.png  " class="navbar-brand-img h-65" alt="main_logo">
                    @endif
                @endif

                @if(config('app_settings.website_title.value') == 'name' ||  config('app_settings.website_title.value') == 'name_and_logo')
                    <span class="ms-2  mt-3 font-weight-bold text-white h5">
                        @role('Provider') {{session('store_name')}} |  @endrole {{ config('app_settings.app_name.value') ?? config('app.name')}}
                    </span> 
                @endif               
            </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        
        <ul class="navbar-nav">
            <x-menu.side-menu/>
        </ul>
        </div>


</aside>
