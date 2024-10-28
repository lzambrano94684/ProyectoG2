{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/feather/style.min.css') !!}
{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/simple-line-icons/style.css') !!}
{{--{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/font-awesome/css/font-awesome.min.css') !!}--}}
<link href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css">
{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/perfect-scrollbar.min.css') !!}
{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/prism.min.css') !!}

{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/toastr.css') !!}
@if(env("NAME"))
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/css/app.min.css') !!}
@else
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/css/app.css') !!}
@endif
{!! HTML::style('/Sistema/Pointex/Modulo/css/pointex.css') !!}

{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/jquery.bootstrap-touchspin.css') !!}
{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/form-validation.css') !!}

@if(isset($libs2Load['DataTables']) && $libs2Load['DataTables'])
    {{--{!! HTML::style('Vendor/Plantillas/Apex/app-assets/vendors/css/tables/datatable/datatables.min.css') !!}--}}
    {!! HTML::style('Vendor/Plantillas/Apex/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') !!}
    {!! HTML::style('Vendor/Plantillas/Apex/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') !!}
    {!! HTML::style('Vendor/Plantillas/Apex/app-assets/vendors/css/tables/datatable/responsive.dataTables.min.css') !!}


@endif

@if(isset($libs2Load['Select2']) && $libs2Load['Select2'])
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/select2/css/select2.min.css') !!}
@endif

@if(isset($libs2Load['SweetAlert']) && $libs2Load['SweetAlert'])
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/sweetalert2.min.css') !!}
@endif

@if(isset($libs2Load['Switch']) && $libs2Load['Switch'])
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/switchery.min.css') !!}
@endif

@if(isset($libs2Load['DatePicker']) && $libs2Load['DatePicker'])
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/default.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/default.date.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/default.time.css') !!}
@endif
