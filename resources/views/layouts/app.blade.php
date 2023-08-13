<x-layouts.base>

<x-siteprogress></x-siteprogress>

   @if (in_array(request()->route()->getName(),['payment.checkout','rtl','privacy-policy']))
        {{ $slot }}
    
    @elseif (in_array(request()->route()->getName(),['payment.checkout','privacy-policy','pricing-page','basic-lock', 'basic-reset', 'basic-sign-in', 'basic-sign-up','basic-verification','cover-lock', 'illustration-lock','cover-reset','illustration-reset','cover-sign-in','illustration-sign-in','cover-sign-up','illustration-sign-up','cover-verification','illustration-verification','error404','error500','register', 'login','forget-password','reset-password']))

        @if (in_array(request()->route()->getName(),['illustration-privacy-policy','illustration-lock','illustration-reset','illustration-sign-in','illustration-sign-up','illustration-verification']))
 
            <div class="container position-sticky z-index-sticky top-0">
                <div class="row">
                  <div class="col-12">
                        <x-navbars.navs.guest class='blur border-radius-lg shadow mt-4 py-2 start-0 end-0 mx-4'>
                        </x-navbars.navs.guest>
                  </div>
                </div>
            </div>

        @else

            <x-navbars.navs.guest class='w-100 shadow-none my-3 navbar-transparent mt-4'>
            </x-navbars.navs.guest>

        @endif

        @if ((in_array(request()->route()->getName(),['login'])))

        <main class="main-content mt-0">
            <div class="page-header page-header-bg-sign-in align-items-start min-vh-100">
                <span class="mask bg-gradient-dark opacity-6"></span>
                {{ $slot }}
                <x-footers.guest.basic-footer textColor="text-white"></x-footers.guest.basic-footer>
            </div>
        </main>

            
        @elseif ((in_array(request()->route()->getName(),['register'])))

        <main class="main-content  mt-0">
            <div class="page-header page-header-bg-sign-up align-items-start min-vh-100">
                <span class="mask bg-gradient-dark opacity-6"></span>
                {{ $slot }}
                <x-footers.guest.basic-footer textColor="text-white"></x-footers.guest.basic-footer>
            </div>
        </main>

        @else
        {{ $slot }}

        @if (in_array(request()->route()->getName(),['basic-reset','cover-sign-in', 'cover-verification','forget-password','cover-reset']))
            <x-footers.guest.basic-footer textColor="text-muted"></x-footers.guest.basic-footer>
        @elseif (in_array(request()->route()->getName(),['basic-sign-in', 'basic-sign-up','reset-password']))
            <x-footers.guest.basic-footer textColor="text-white"></x-footers.guest.basic-footer>
        @elseif(in_array(request()->route()->getName(),['pricing-page','basic-lock', 'cover-lock','cover-sign-up','error404','error500']))
            <x-footers.guest.social-icons-footer></x-footers.guest.social-icons-footer>
        @else
           
        @endif
        @endif

    @elseif (in_array(request()->route()->getName(),['vr-info', 'vr-default']))
        <div class="virtual-reality">
            <x-navbars.navs.auth></x-navbars.navs.auth>
            <div class="border-radius-xl mx-2 mx-md-3 position-relative"
        style="background-image: url('{{ asset('assets') }}/img/vr-bg.jpg'); background-size: cover;">
                <x-navbars.sidebar></x-navbars.sidebar>
                <main class="main-content border-radius-lg h-100">
                    {{ $slot }}
                </main>
            </div>
            <x-footers.auth.footer></x-footers.auth.footer>
            
        </div>
    @else

        <x-navbars.sidebar></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <x-navbars.navs.auth></x-navbars.navs.auth>
                {{ $slot }}
              
            <x-footers.auth.footer></x-footers.auth.footer>
       </main>
         
    @endif
    
</x-layouts.base>