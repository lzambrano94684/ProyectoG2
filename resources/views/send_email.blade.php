@extends('Sistema.Pointex.LayOuts.layout')
@section('title', )

@section("css")
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">{{ "Contacto" }}</div>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-card-center">Contacto</h4>
                    envio de correo <p>a <code> a Soporte</code></p>
                </div>
                <div class="card-content">
                    <div class="px-3">
                        @if(count($errors)>0)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($message = session()->get("success"))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <form class="form form-horizontal" method="post" action="/send">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput1">Nombre: </label>
                                    <div class="col-md-9">
                                        <input type="text" id="eventRegInput1" class="form-control" name="name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput1">Email: </label>
                                    <div class="col-md-9">
                                        <input type="email" id="eventRegInput1" class="form-control" name="email">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="userinput8">Mensaje: </label>
                                    <div class="col-md-9">
                                        <textarea id="userinput8" rows="5" class="form-control col-md-9 border-primary"
                                                  name="message"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions center">
                                <button type="button" class="btn btn-raised btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-raised btn-primary">
                                    <i class="fa fa-check-square-o"></i> Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
@endsection