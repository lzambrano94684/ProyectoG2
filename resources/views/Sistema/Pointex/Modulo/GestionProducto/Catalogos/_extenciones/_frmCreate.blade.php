<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="horz-layout-basic">{{ $subTitle }}</h4>
                <p class="mb-0">Por favor llenar los campos para hacer una {{ $accion }} a la tabla {{ $table }}.</p>
            </div>
            <div class="card-content">
                <div class="px-3">
                    <form class="form form-horizontal" method="post" action="/pointex/gestion/catalogos/insert_in_table" id="frmInsert">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="Id" name="Id" value="{{$id}}">
                        <input type="hidden" id="table" name="table" value="{{$table}}">
                        <input type="hidden" id="redirect" name="redirect" value="{{$urlAnt}}">
                        <div class="form-body">
                            <h4 class="form-section"><i class="ft-file-text"></i> Requerimientos</h4>
                            @if(count($inputs)>0)
                                @foreach($inputs as $ki => $vi)
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="{{ $ki }}">{{ str_replace("Id","",$ki) }}: </label>
                                        <div class="col-md-9">
                                            {!! $vi !!}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-actions">
                            @if(!$request->form)
                            <a type="button" class="btn btn-raised btn-warning mr-1" href="{{ $urlAnt ? $urlAnt : url()->current() }}">
                                <i class="ft-arrow-left"></i> Regresar
                            </a>
                            @endif
                            <button type="submit" class="btn btn-raised btn-primary" id="btnInserta">
                                <i class="ft-save"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>