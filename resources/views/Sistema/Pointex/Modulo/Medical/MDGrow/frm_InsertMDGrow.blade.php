
@section("css")
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
    <style>
        .required:after { content:" *";
            color: #e32;
            display:inline;
            font-weight: bold;}
    </style>
@stop

@section('content')
    <section class="basic-elements">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <legend class="fieldset-marco text-muted"><h4 class="form-section"><i
                                        class="ft-file-text"></i> @if(isset($titleMsg)){{$titleMsg}}@endif</h4></legend>
                            <form id="formMDGrow" name="formMDGrow" method="POST"
                                  action="/pointex/medical/mdgrow/crear" enctype="multipart/form-data">
                                <input type="hidden" id="txtId" name="txtId" value="{{$id}}">
                            @csrf
                                @include("Sistema.Pointex.Modulo.Medical.MDGrow.Encabezado")
                            <!--footer -->
                                <div class="form-actions">

                                    <a type="button" class="btn btn-raised btn-warning mr-1"
                                       href="{{  url()->current() }}">
                                        <i class="ft-arrow-left"></i> Regresar
                                    </a>

                                    <button type="submit" class="btn btn-raised btn-primary" id="Idbtn">
                                        <i class="ft-save"></i> Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')

    <script type="text/javascript">
        var validarVer = "{{$ver}}";
        var dataGrow = "{{base64_encode($modelMDGrow)}}";

    </script>
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/MDGrow.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/validarMdGrow.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/numeric/jquery.numeric.js') !!}

@stop
