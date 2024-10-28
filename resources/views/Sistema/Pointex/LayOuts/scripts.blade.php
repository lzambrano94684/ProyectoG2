<!--   Core JS Files   -->
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/core/jquery-3.2.1.min.js') !!}
{!! HTML::script('/js/jquery.redirect.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/jquery-ui/js/jquery-ui.min.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/core/popper.min.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/core/bootstrap.min.js') !!}

{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/perfect-scrollbar.jquery.min.js') !!}


{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/toastr.min.js') !!}


{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/screenfull.min.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/app-sidebar.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/notification-sidebar.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/customizer.js') !!}


{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/toastr.min.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/tooltip.js') !!}


{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.bootstrap-touchspin.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jqBootstrapValidation.js') !!}
{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/icheck.min.js') !!}

{!! HTML::script('/Sistema/Pointex/Modulo/js/pointex.js') !!}

@if(isset($libs2Load['DataTables']) && $libs2Load['DataTables'])
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/datatables.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/dataTables.buttons.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/buttons.print.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/buttons.html5.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/buttons.flash.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/jszip.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/pdfmake.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/vfs_fonts.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/dataTables.responsive.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/dataTableLanguaje.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/data-tables/datatable-api.js') !!}
@endif

@if(isset($libs2Load['Select2']) && $libs2Load['Select2'])
    {!!HTML::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js') !!}
    <script type="text/javascript">
        $(document).on('focus', '.select2.select2-container', function (e) {
            // only open on original attempt - close focus event should not fire open
            if (e.originalEvent && $(this).find(".select2-selection--single").length > 0) {
                $(this).siblings('select').select2('open');
            }
        });
    </script>
@endif

@if(isset($libs2Load['SweetAlert']) && $libs2Load['SweetAlert'])
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/sweetalert2.min.js') !!}
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/js/sweet-alerts.js') !!}
@endif

@if(isset($libs2Load['Switch']) && $libs2Load['Switch'])
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/switchery.min.js') !!}
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/js/switch.min.js') !!}
@endif


@if(isset($libs2Load['DatePicker']) && $libs2Load['DatePicker'])
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.js') !!}
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.date.js') !!}
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.time.js') !!}
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/translations/es_ES.js') !!}
@endif

