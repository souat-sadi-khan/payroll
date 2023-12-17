<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ isset($title) ? $title .' | '. config('app.name', 'Payroll Management ') :  config('app.institue_name', config('app.name', 'Payroll Management'))}}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset(get_option('favicon')?'storage/logo/'.get_option('favicon'):'favicon.ico')}}">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('print/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('print/css/al.min.css') }}">
    <style>
    
        .table-light tbody+tbody, .table-light td, .table-light th, .table-light thead th {
            border-color: #bdbdbd;
        }
        .table-light, .table-light>td, .table-light>th {
            background-color: #ebeefd;
        }

        @media print {
       
            table thead.bg-primary{
                background-color: #007bff!important;
            }
    
            .table thead th {
                background-color: #007bff!important;
            }
       
            .table td {
                background-color: #ebeefd !important;
            }   
            .table th {
                background-color: #ebeefd !important;
            }
    
            .fotter-bottom{
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
            }
    
        }
    
    </style>
</head>
  <body>
        
    @section('print.main')
    @show

    <script src="{{ asset('print/js/jquery.min.js') }}"></script>
    <script src="{{ asset('print/js/popper.min.js') }}"></script>
    <script src="{{ asset('print/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('backend/js/toastr.min.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('print.scripts')
</body>
</html>