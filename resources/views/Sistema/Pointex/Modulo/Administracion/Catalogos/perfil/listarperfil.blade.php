@extends('Sistema.Pointex.LayOuts.layout')
@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/pickadate.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
@stop

@section('content')
    <section class="basic-elements">
        <!-- se asígna título a la web -->
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <div class="card">

                    <div class="card-content">
                        <div class="card-body">

                            <input type="hidden" id="_token" value="{{csrf_token()}}">


                            <button class="btn btn-outline-primary mr-1 dropdown-toggle float-md-right"  id="btn-asignaPerfil" onclick="addForm('AsigarPerfil')">Asignar
                                Perfil <i class="ft-save"></i></button>



                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

    @include("Sistema.Pointex.Modulo.Administracion.Catalogos.perfil.TablaPerfil")
    @include("Sistema.Pointex.Modulo.Administracion.Catalogos.perfil.createOrUpdate")
    @include("Sistema.Pointex.Modulo.Administracion.Catalogos.perfil.delete")

@stop

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jqBootstrapValidation.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/cat.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#datatable-pais thead tr').clone(true).appendTo( '#datatable-pais thead' );
            $('#datatable-pais thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                if (i) {
                    $(this).html( '<input type="text" id="txtSearch'+i+'" placeholder="Buscar '+title+'" />' );
                }else {
                    $(this).html( '' );

                }

                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
            var table = $('#datatable-pais').DataTable( JsonDatatableViews);
            $(".clearCache").on("click",function () {
                table.state.clear();
                location.reload(true);
            });
            var state = table.state.loaded();
            if (state)
            {
                $.each(state.columns, function (k, v){
                    if (v.search.search)
                    {
                        $("#txtSearch"+k).val(v.search.search);
                    }
                })
            }
        } );
    </script>
@stop
