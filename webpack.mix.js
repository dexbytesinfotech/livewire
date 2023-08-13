const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */ 
 
 mix.styles([
    'resources/css/icon/*.css',
    'resources/css/nucleo-icons.css',    
    'resources/css/nucleo-svg.css',    
    'resources/css/material-dashboard.css',    
    'resources/css/custom.css',    
    'resources/css/quill.snow.css',    
    'resources/css/toastr.min.css',    
    'resources/css/select2.min.css',
    ], 'public/css/app.css').version();

mix.scripts([
      'resources/js/plugins/perfect-scrollbar.min.js',
      'resources/js/jquery.min.js',
      'resources/js/core/popper.min.js',
      'resources/js/core/bootstrap.min.js',
      'resources/js/material-dashboard.min.js',
      'resources/js/plugins/sweetalert.min.js',
      'resources/js/sweetalert2@11.js',
      'resources/js/42d5adcbca.js',
      'resources/js/alpine.min.js',
      'resources/js/plugins/smooth-scrollbar.min.js',      
      'resources/js/custom.js',      
      'resources/js/toastr.min.js',      
      'resources/js/select2.min.js',
      'resources/js/plugins/quill.min.js',
      ], 'public/js/app.js').version();