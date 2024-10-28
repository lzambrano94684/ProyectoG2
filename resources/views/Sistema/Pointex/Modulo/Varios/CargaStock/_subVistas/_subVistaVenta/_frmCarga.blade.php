<div class="col-md-4">
    <form class="form" action="/archivos/store_file/{{ $codigo }}-ventasDaf"
          method="post" enctype="multipart/form-data" id="saveFile">
        @csrf
        <div class="form-body">
            <h4 class="form-section"><i class="far fa-file-excel"></i> Por favor
                cargue el <b class="text-danger">Excel de Ventas</b></h4>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="input-group mb-12">
                        <div class="input-group-prepend">
                                                                <span class="input-group-text" id="spInventario">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"
                                   id="fileInventario"
                                   aria-describedby="spInventario"
                                   name="fileInventario" required>
                            <label class="custom-file-label" for="fileInventario">Subir</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
