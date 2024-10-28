@php($subTitulo = "Listado")
@php($url = "listar=1")
<section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        Filtros de Búsqueda
                    </h4>
                </div>
                <div class="card-content">
                    <div class="px-3">
                        <form class="form" id="frmFiltroMarca">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <fieldset class="form-group">
                                            <label for="txtNombre">Marca</label>
                                            <input type="text" class="form-control col-md-6" value="{{ $request->txtNombre }}"
                                                   id="txtNombre" name="txtNombre"
                                                   placeholder="Búsqueda por Nombre de la Marca">
                                        </fieldset>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <button id="btnFiltroMarca" class="btn btn-info pull-right"><i
                                                    class="fa fa-search"></i> Buscar
                                        </button>
                                        <a class="btn btn-danger pull-right" href="/pointex/gestion/marca/crear_listar?{{ base64_encode($url) }}"><i
                                                    class="fa fa-times"></i> Limpitar
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>