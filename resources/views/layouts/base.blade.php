<!DOCTYPE html>
<html lang='en' dir="{{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @if(config('app_settings.app_favicon_logo.value'))
    <link rel="apple-touch-icon" sizes="76x76" href="{{  Storage::disk(config('app_settings.filesystem_disk.value'))->url(config('app_settings.app_favicon_logo.value')) }}">
  @else
   <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
  @endif

  @if(config('app_settings.app_favicon_logo.value'))
    <link rel="icon" type="image/png" href="{{  Storage::disk(config('app_settings.filesystem_disk.value'))->url(config('app_settings.app_favicon_logo.value')) }}">
  @else
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
  @endif
  <title>
  {{ config('app_settings.app_name.value') ?? config('app.name')}} | Food Delivery, Dining and Restaurant Discovery Service. Better food for more
  </title>

  <!--  Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.1" rel="stylesheet" />
  <link id="pagestyle" href="{{ asset('assets') }}/css/custom.css" rel="stylesheet" />  
  <!-- Quill -->
  <link href="{{ asset('assets') }}/css/quill.snow.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- toastr -->
  <link href="{{ asset('assets') }}/css/toastr.min.css" rel="stylesheet">
  <!-- select2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

 @livewireStyles
 
</head>
<body class="g-sidenav-show bg-gray-200 {{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }}">

{{ $slot }}
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/jquery.min.js"></script>
<script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
<script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/js/material-dashboard.min.js?v=3.0.1"></script>
<script src="{{ asset('assets') }}/js/plugins/sweetalert.min.js"></script>
<script src="{{ asset('assets') }}/js/sweetalert2@11.js"></script>
<script src="{{ asset('assets') }}/js/42d5adcbca.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets') }}/js/alpine.min.js" defer></script>

<script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/custom.js"></script>
<script src="{{ asset('assets') }}/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
  
  // Alert Modal windows
  window.addEventListener('alert', event => { 
      toastr[event.detail.type](event.detail.message, 
      event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });
 
    // Slider bar animations
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script> 

<!-- Google Maps kyes  -->
<script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places"></script>
<!-- Google Map load -->
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
 
@stack('js')
@livewireScripts 
 
</body>
</html>
