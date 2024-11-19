
<!DOCTYPE html>
<html x-data="{ darkMode: localStorage.getItem('dark') }" x-init="$watch('darkMode', val => localStorage.setItem('dark', val))" x-bind:class="{ 'dark': darkMode }"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">

    @if (config('app_settings.app_favicon_logo.value'))
        <link rel="apple-touch-icon" sizes="76x76"
            href="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url(config('filesystems.gcs_path').config('app_settings.app_favicon_logo.value')) }}">
    @else
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/avenue_fevicon.png">
    @endif

    @if (config('app_settings.app_favicon_logo.value'))
        <link rel="icon" type="image/png"
            href="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url(config('filesystems.gcs_path').config('app_settings.app_favicon_logo.value')) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/logo-ct.png">
    @endif
    <title>
        {{ config('app_settings.app_name.value') ?? config('app.name') }}
    </title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

   @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    @livewireStyles
    <wireui:scripts />

      <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NTWTLTM');</script>
  <!-- End Google Tag Manager -->

</head>

<body style="height:100%; overflow:unset !important"
    class="g-sidenav-show bg-gray-200 {{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }}">
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


    @livewireScripts
    @livewire('livewire-ui-modal')
    @wireUiScripts
    @stack('js')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('reset', () => {
                $('.ql-editor').html('');
            });
        });
        $(document).ready(function() {
            $('#reject-modal button').attr('id', 'reject-modal-btn');
            $('#success-modal button').attr('id', 'success-modal-btn');
            $('.swal2-cancel').attr('id', 'reject-modal-btn');
            $('.swal2-confirm').attr('id', 'success-modal-btn');

        });
    </script>
  <!-- Google Maps kyes  -->
  <script type="text/javascript"
              src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places"></script>
  <!-- Google Map load -->

  <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NTWTLTM"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <script>
      google.maps.event.addDomListener(window, 'load', initialize);
      function initialize() {
          var input = document.getElementById('googleMapAutocomplete');
          if(input){
              var autocomplete = new google.maps.places.Autocomplete(input);
              autocomplete.addListener('place_changed', function () {
                  var place = autocomplete.getPlace();
                  $('#latitude').val(place.geometry['location'].lat());
                  $('#longitude').val(place.geometry['location'].lng());
                  console.log(place);
                  window.livewire.emit('set:latitude-longitude',place.geometry['location'].lat(), place.geometry['location'].lng(), place.formatted_address) ;
              });
          }
      }
  </script>

</body>
</html>
