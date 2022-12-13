
<nav {{ $attributes->merge(['class' => 'navbar navbar-expand-lg position-absolute top-0 z-index-3']) }}>
<div class="container {{ in_array(request()->route()->getName(),['illustration-sign-up','illustration-sign-in','illustration-reset','illustration-verification','illustration-lock','cover-lock','cover-sign-up']) ? 'ps-2 pe-0' : '' }}">

 <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 d-flex flex-column text-center {{ in_array(request()->route()->getName(),['illustration-sign-up','illustration-sign-in','illustration-reset','illustration-verification','illustration-lock']) ? '' : 'text-white' }}">
        @if(config('app_settings.app_logo.value'))
            <img src="{{  Storage::disk(config('app_settings.filesystem_disk.value'))->url(config('app_settings.app_logo.value')) }} " class="navbar-brand-img h-100" alt="main_logo">
        @else
            <img src="{{ asset('assets') }}/img/logo-ct.png  " class="navbar-brand-img h-100" alt="main_logo">
        @endif
        <span class="ms-2 font-weight-bold text-white">
        {{ config('app_settings.app_name.value') ?? config('app.name')}}
        </span>   
   </a>
    
</div>
</nav>
