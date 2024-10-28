<section class="basic-select">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
{{--                    <h4 class="card-title mb-0">Filtro de Búsqueda</h4>--}}
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="frmBuscar">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txtMedico">Médico</label>
{{--                                            <input id='tags' name='tags' class='some_class_name' placeholder='Buscar'--}}
{{--                                                   data-blacklist='PHP' value="">--}}
                                            <input id='tags' name='tags-manual-suggestions' placeholder='write some tags'>
                                            <button type="button" id="GuardaD"
                                                    class="btn btn-outline-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body card-dashboard table-responsive">
                                        <table id="TblUniversoMedico" class="table display nowrap table-striped table-bordered scroll-horizontal-vertical">
                                            <thead>
                                            <tr>
                                                <th>Medico</th>
                                                <th>Especialidad</th>
                                                <th>Domicilio</th>
                                                <th>Localidad </th>
                                                <th>Region</th>
                                                <th>Ranking</th>
                                            </tr>
                                            </thead>
                                            <tbody id="bodyUniversoMedico">
                                            </tbody>
                                        </table>
                                        </div>
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

