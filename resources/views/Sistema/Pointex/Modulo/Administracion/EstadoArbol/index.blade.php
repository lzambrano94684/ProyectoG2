@extends('Sistema.Pointex.LayOuts.layout')
@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <br>
                    <div class="row">
                        <div class="col-1">
                        </div>
                        <div class="col-5">
                            <h3 class="card-title" id="horz-layout-basic">{{$titleMsg}}</h3>
                        </div>
                        <div id="btnadd" class="col-6 text-right">
                            <code style="cursor: pointer;"
                                  class="codeCrearItem"
                                  data-toggle="tooltip"
                                  data-placement="top"
                                  data-titulo="Crear Nuevo Arbol"
                                  data-modelo="PX_SIS_ArbolAProbaciones"
                                  data-camponombre="NombreArbol"
                                  data-campotipoejecucion="IdPerfil"
                                  data-id_cmb="">
                                <a class="form-control text-white btn btn-primary float-lg-right" title="Agregar nuevo">
                                    <i class="icon-plus"></i>
                                    Agregar
                                </a>
                            </code>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="nav-vertical">
                        <ul class="nav nav-tabs navbar-horizontal">
                            <li class="nav-item">
                                <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                                   href="#tab1" aria-expanded="true">Árboles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                                   href="#tab2" aria-expanded="false">Activos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                                   href="#tab3" aria-expanded="false">Inactivos</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1" aria-labelledby="base-tab1">
                                @include("Sistema.Pointex.Modulo.Administracion.EstadoArbol._subVistas._TblArbolCreado")
                            </div>
                            <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                                @include("Sistema.Pointex.Modulo.Administracion.EstadoArbol._subVistas._TblArbolActivo")
                            </div>
                            <div class="tab-pane" id="tab3" aria-labelledby="base-tab3">
                                @include("Sistema.Pointex.Modulo.Administracion.EstadoArbol._subVistas._TblArbolInactivo")
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var tipoejecucion = "{{base64_encode($selectEjecucionTipo)}}";
        var cmbTipoEje = '{{ base64_encode($cmbTipoEjec) }}';
        $('.custom-file input').change(function (e) {
            $(this).next('.custom-file-label').html(e.target.files[0].name);
        });


        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example thead tr').clone(true).appendTo( '#example thead' );
            $('#example thead tr:eq(1) th').each( function (i) {
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
            var table = $('#example').DataTable( JsonDatatableViews);
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





// Setup - add a text input to each footer cell
            $('#example2 thead tr').clone(true).appendTo( '#example2 thead' );
            $('#example2 thead tr:eq(1) th').each( function (i) {
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
            var table = $('#example2').DataTable( JsonDatatableViews);
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





// Setup - add a text input to each footer cell
            $('#example3 thead tr').clone(true).appendTo( '#example3 thead' );
            $('#example3 thead tr:eq(1) th').each( function (i) {
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
            var table = $('#example3').DataTable( JsonDatatableViews);
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



 $("#base-tab1, #base-tab2, #base-tab3, #base-tab4,#base-tab5,#base-tab6,#base-tab7").on("click", function () {
            setTimeout(function () {
                $('input').click();
            }, 1);
        });




 $("#base-tab1, #base-tab2, #base-tab3, #base-tab4,#base-tab5,#base-tab6,#base-tab7").on("click", function () {
            setTimeout(function () {
                $('input').click();
            }, 1);
        });



 $("#base-tab1, #base-tab2, #base-tab3, #base-tab4,#base-tab5,#base-tab6,#base-tab7").on("click", function () {
            setTimeout(function () {
                $('input').click();
            }, 1);
        });


    </script>
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/estructura.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/EstatusArbol.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/Swal.js') !!}
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/sweetalert2.min.js') !!}
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/js/sweet-alerts.js') !!}
@stop
