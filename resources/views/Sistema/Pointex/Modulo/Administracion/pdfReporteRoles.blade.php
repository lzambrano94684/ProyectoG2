<head>
    <title>Reporte de Roles</title>

</head>

<table>
    <tr>
        <td style="width: 25%;">
            <img src="Sistema/Pointex/Modulo/img/exeltis_logo.png" alt="" style="width: 150px; height: 45px;">
        </td>
        <td style="width: 75%; text-align: center">

        </td>
    </tr>
</table>
<div style="text-align: center;">
    <h1>REPORTE DE ROLES</h1>
</div>

<div>
    <div>
        <b>Nombre:</b> {{$persona->Nombres . ' ' . $persona->Apellidos}}<br>
        <b>CUI:</b> {{$persona->CUI}}<br>
        <b>Correo:</b> {{$persona->Correo}}<br>
    </div>
    <div class="col-md-6">

    </div>
</div>

@php($date = \Carbon\Carbon::now())
@php($date = $date->format('d/m/Y'))
<br>
<div class="datagrid">
    <table class="table borde">
        <thead>
        <tr style="color: white; background-color: #7F4614; text-align: center">
            <td>#</td>
            @foreach($info[1] as $k => $v)
                <td>{{$k}}</td>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @php($contador = 0)
        @foreach($info as $k => $v)
            <tr class=" {{ $contador % 2 ? "alt" : null }}">
                <td>{{$contador + 1}}</td>
                @foreach($v as $ka => $va)
                    <td class="borde">{{$va}}</td>
                @endforeach
            </tr>
            @php( $contador++)
        @endforeach
        </tbody>
    </table>
</div>
<div>

</div>
