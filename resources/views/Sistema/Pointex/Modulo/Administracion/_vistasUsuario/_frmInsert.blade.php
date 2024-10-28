
@section('content')
    <section class="basic-elements">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <legend class="fieldset-marco text-muted"><h4 class="form-section"><i
                                        class="ft-file-text"></i> @if(isset($titleMsg)){{$titleMsg}}@endif</h4></legend>
                            <form id="formUser" name="formUser" method="POST"
                                  action="/pointex/administracion/usuarios/crear_user">
                                @csrf
                                <section id="form-action-layouts">
                                    <div class="row match-height">
                                        <div class="col-md-6">
                                            @include("Sistema.Pointex.Modulo.Administracion._vistasUsuario._Persona")
                                        </div>
                                        <div class="col-md-6">
                                            @include("Sistema.Pointex.Modulo.Administracion._vistasUsuario._Contacto")
                                        </div>

                                    </div>
                                </section>

                            <!-- detalle-->
                                <div class="form-actions">

                                    <a type="button" class="btn btn-raised btn-warning mr-1"
                                       href="{{  url()->current() }}">
                                        <i class="ft-arrow-left"></i> Regresar
                                    </a>

                                    <button type="button" class="btn btn-raised btn-primary" id="Idbtn">
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
    <script !src="">
        var entDeptPuesto = "{{ base64_encode($EntidadDeptoPuesto) }}";

    </script>
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/usuario.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/numeric/jquery.numeric.js') !!}
@stop
