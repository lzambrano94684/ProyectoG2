@extends('Sistema.Pointex.LayOuts.layout')
@section('content')
    @php
        $allMonths=array(
                       "ENERO",
                       "FEBRERO",
                       "MARZO",
                       "ABRIL",
                       "MAYO",
                       "JUNIO",
                       "JULIO",
                       "AGOSTO",
                       "SEPTIEMBRE",
                       "OCTUBRE",
                       "NOVIEMBRE",
                       "DICIEMBRE"
                   );

   # 4
   $mSelect="<select id=\"mes\" name=\"mes\">";
   foreach ($allMonths as $k=>$month){
       # a
       $v=$k+1;
       $mSelect.="<option value=\"$v\">$month</option>";
   }
   $mSelect.="</select>";
    @endphp
    <div class="row">
        <div class="col-sm-6">
            <div class="content-header">{{ $titleMsg }}</div>
        </div>
    </div>
    <section id="shopping-cart">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Traer presupuesto del mes de:<br>
                        {!! $mSelect !!}
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row panel">
                    <div id="table1" class="col-md-5 bitacoratable">
                        <table id="table1" class="table table-striped childgrid tabla1 searchTable">
                            <thead>
                            <tr class="placeholder">
                                <th colspan=4>
                                    Usuario: María Guzman <br>
                                    Puesto: Gerente de Marca <br>
                                    Depto: Marketing <br>
                                    Concepto: Detalle del Presupuesto mes de Enero
                                </th>
                            </tr>
                            <tr class="placeholder">
                                <th>Mes</th>
                                <th>Marca</th>
                                <th>País</th>
                                <th>Gasto</th>
                                <th>Cantidad</th>
                                <th>Precio Aproximado</th>
                                <th>SubTotal</th>
                            </tr>

                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="checkbox" class="selectedProperty">Enero</td>
                                <td>Slinda</td>
                                <td>GT</td>
                                <td>Guías Gold</td>
                                <td>5</td>
                                <td>2</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="selectedProperty">Enero</td>
                                <td>Miflonide</td>
                                <td>NI</td>
                                <td>Vademécums/ Calendarios</td>
                                <td>200</td>
                                <td>3</td>
                                <td>600</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="selectedProperty">Febrero</td>
                                <td>Sargenor</td>
                                <td>GT</td>
                                <td>EMC/ Congresos</td>
                                <td>1000</td>
                                <td>1</td>
                                <td>1000</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4">Total</td>
                                <td class="totalCant"></td>
                                <td></td>
                                <td class="totalSub"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="col-md-2">

                    </div>
                    <div class="col-md-5" id="table2">
                        <table id="table2" class="table table-striped childgrid selectedPropsTable">
                            <thead>
                            <tr class="placeholder">
                                <th colspan=4>
                                    Usuario: María Guzman <br>
                                    Puesto: Gerente de Marca <br>
                                    Depto: Marketing <br>
                                    Concepto: Detalle de plan de compras
                                </th>
                                <th colspan="2">
                                    <button type="button"
                                            class="btn btn-raised btn-danger btn-min-width mr-1 mb-1"
                                            id="gplanc">Generar Plan de compras
                                    </button>
                                </th>
                            </tr>
                            <tr class="placeholder">
                                <th>Mes</th>
                                <th>Marca</th>
                                <th>País</th>
                                <th>Gasto</th>
                                <th>Cantidad</th>
                                <th>Precio Aproximado</th>
                                <th>SubTotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4">Total</td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@stop

@section('js')
    {{--{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/prism.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.matchHeight-min.js') !!}--}}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.countdown.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/coming-soon.js') !!}
    {!! HTML::script('https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js') !!}
    {!! HTML::script('https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js') !!}
    <script type="text/javascript">



        $(function () {
            $("table").on('click', ".selectProperty, .selectedProperty", function () {
                if ($(this).hasClass('selectProperty'))
                    var newTd = 'selectedProperty', newTbl = 'selectedPropsTable';
                else
                    var newTd = 'selectProperty', newTbl = 'searchTable';
                $(this).prop('checked', false).attr('class', newTd);
                var tr = $(this).closest('tr');
                $('table.' + newTbl).find("tbody").append(tr.clone());
                tr.remove();
            });
        });
        $(document).ready(function () {
            $('#table1 table thead th').each(function (i, v) {
                calculateColumn(i, "table1");
            });
        });

        function calculateColumn(index, IdTable) {
            var total = 0;
            $("#" + IdTable + ' table tr').each(function () {
                var value = parseInt($('td', this).eq(index).text());
                if (!isNaN(value)) {
                    console.log(index)
                    total += value;
                }
            });
            //console.log(total)
            $("#" + IdTable + ' table tfoot td .totalCant').html(total);
        }

        $("#table1 .childgrid tr, #table2 .childgrid tr").draggable({
            helper: function () {
                var selected = $('.childgrid tr.selectedRow');
                if (selected.length === 0) {
                    selected = $(this).addClass('selectedRow');
                }
                var container = $('<div/>').attr('id', 'draggingContainer');
                container.append(selected.clone().removeClass("selectedRow"));
                return container;
            }
        });

        $("#table1 .childgrid, #table2 .childgrid").droppable({
            drop: function (event, ui) {
                $(this).append(ui.helper.children());
                $('.selectedRow').remove();
            }
        });

        $(document).on("click", ".childgrid tr", function () {
            $(this).toggleClass("selectedRow");
        });

    </script>
@stop
