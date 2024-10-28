@php($head = $archivos->first()->keys() )
@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
    <style type="text/css">
        .bg-blue {
            background-color: #1F487C !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">{{ $titleMsg }}</div>
        </div>
    </div>

    @if($archivos->count()>0)
        <section class="basic-elements">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="px-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table  text-center datatablePointer">
                                            <thead class="text-white">
                                            <tr class="headings darken-4 bg-dark">
                                                @foreach($head as $vh)
                                                    <th class="column-title">{{ $vh }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($archivos as $kvd => $vd)
                                                <tr>
                                                    @if($vd->filter()->count()>0)
                                                        @foreach($head as $vdd)
                                                            <td class="column-title">
                                                                {{ $vd->get($vdd) }}
                                                            </td>
                                                        @endforeach
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="alert alert-warning alert-dismissible fade show"
             role="alert" id="tableUsers">
            <div class="text"><i class="fa fa-database"></i> La consulta no gener&oacute;
                resultados.
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="la la-close"></span>
            </button>
        </div>
    @endif

@stop

@section('js')

@endsection
