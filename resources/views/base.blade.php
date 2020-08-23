<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">        
        <title>Laravel Contacts AJAX</title>
        <!-- Styles -->        
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/toastr/toastr.min.css') }}">
    </head>
    <body>
        @include('include.navigation')
        <div id="root" class="mt-3 ml-3 mr-3"></div>
        @include('include.footer')
        <!-- Scripts -->
        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="{{ asset('/toastr/toastr.min.js') }}"></script>    
        <script>
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            if($.trim($('div#root').html()) === '') {
                let requestData = {
                    '_token': $('meta[name=csrf-token]').attr('content')
                };
                window.ajaxRequest('GET', '/contacts', requestData, '', 'home');
            }
            
            $(document).on('click', 'button.button-create', function() {
                let requestData = {
                    '_token': $('meta[name=csrf-token]').attr('content')
                };                
                window.ajaxRequest('GET', '/contacts/create', requestData, '', 'create');
            });

            $(document).on('click', 'button.button-home', function() {
                let requestData = {
                    '_token': $('meta[name=csrf-token]').attr('content')
                };                  
                window.ajaxRequest('GET', '/contacts', requestData, '', 'home');
            });
        </script>
    </body>
</html>
