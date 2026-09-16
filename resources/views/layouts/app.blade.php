{{-- <!DOCTYPE html> --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  
{!! seo($seoData ,null) !!}
<meta content="width=device-width, initial-scale=1.0" name="viewport">


    <!-- Fonts -->
    <!-- Poppins Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/chocolat/dist/css/chocolat.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
   <link rel="stylesheet" href="{{asset('assets/bundles/izitoast/css/iziToast.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

    

   

</head>



   <body class="light light-sidebar theme-white">

  <div id="preloader">
    <div class="circular-loader"></div>
</div>


<div class="main-wrapper main-wrapper-1">

    @yield('main')
</div>
</div>


    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    
    <script src="{{ asset('assets/js/page/index.js') }}"></script>

    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->

    <script src="{{ asset('assets/bundles/summernote/summernote-bs4.js') }}"></script>
   
    <script src="{{ asset('assets/bundles/codemirror/mode/javascript/javascript.js') }}"></script>

    <script src="{{ asset('assets/js/page/ckeditor.js') }}"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/bundles/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/gallery1.js') }}"></script>
   <script src="{{asset('assets/bundles/izitoast/js/iziToast.min.js')}}"></script>
  
  <script src="{{asset('assets/js/page/toastr.js')}}"></script>
 

@stack('scripts')
</body>

</html>
