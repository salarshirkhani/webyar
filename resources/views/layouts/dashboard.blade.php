<!DOCTYPE html>
<!--
BY WEBITO
-->
<html lang="fa_IR">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>کنترل پنل | @yield('title', __('داشبورد'))</title>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/persianDatepicker.css') }}" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.css') }}" />
    <!-- Theme style -->
    <link href="{{ asset('assets/fonts/shabnam.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/toastr/toastr.min.css') }}">
    @yield('styles', '')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/adminlte.rtl.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}
        var module = { };
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    .card-info:not(.card-outline) > .card-header {
        background-color: #dc3545;
    }
    a {
        color: #dc3545
    }
    .content-wrapper {
        background: #f9f4f4;
    }
</style>
<body class="hold-transition sidebar-mini dark-mode">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('dashboard.index') }}" class="nav-link">{{ __('داشبورد') }}</a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="nav-link">{{ __('خروج') }}</a>
            </li>
        </ul>
        <p style="position: absolute;left: 15px;top: 18px;color: #969696;">امروز:{{Facades\Verta::now()->format(' %d  %B، %Y')}}</p>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-gray elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard.index') }}" class="brand-link">
            <img src="{{ asset("assets/images/logo.png") }}" alt="{{ config('app.name') }}" style=" width: auto;" class="brand-image "
                 style="opacity: .8">
            <span class="brand-text font-weight-light">پنل وبیار</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('assets/dashboard/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @yield('sidebar')
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('hierarchy')
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            @if($errors->any())
                <div class="row">
                    @foreach ($errors->all() as $error)
                        <div class="col-md-12">
                            <p class="alert alert-danger">{{ $error }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
            @yield('content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            webyar
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2021 <a href="https://webitofa.ir">webito</a> & <a href="#">Salar Shirkhani</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/popper/popper.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dashboard/js/adminlte.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
</script>
<script src="{{ asset('assets/dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/persianDatepicker.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $("#date, #date1").persianDatepicker();
        $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
         });
    });

</script>
 <script>
  $(function () {
    $('#summernote').summernote();
    $("#example1").DataTable({
    "language": {
          "url": "{{ asset('assets/dashboard/table-persian.json') }}"
      },
      "responsive": true,"searching": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
    "language": {
          "url": "{{ asset('assets/dashboard/table-persian.json') }}"
      },
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('.toastrDefaultSuccess').click(function() {
      toastr.error('شما حضوری خود را ثبت کرده اید')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('درحال پردازش درخواست')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.error('شما یک پیام خوانده نشده دارید')
    });
  });
 </script>
 <script src="{{ asset('assets/dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
 <script type="text/javascript">
    CKEDITOR.replace('description', {
     // Load the Farsi interface.
        language: 'fa'
      });
</script>
@yield('scripts', '')
</body>
</html>
