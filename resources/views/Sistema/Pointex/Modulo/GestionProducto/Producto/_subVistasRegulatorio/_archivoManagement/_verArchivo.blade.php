<center>
        @php(isset($modelRegistroSanitario) ? $modelRegistroMarca = $modelRegistroSanitario : $modelRegistroMarca = $modelRegistroMarca )
    @if($modelRegistroMarca->URLRegistro)
        <img class="media-object round-media mostarImagen"
             src="{{ strtoupper(substr($modelRegistroMarca->URLRegistro, -3)) == "PDF" ? "/Vendor/Plantillas/Apex/app-assets/img/elements/pdf.png" : "/pointex/getArchivo?ruta=$modelRegistroMarca->URLRegistro" }}"
             url="{{"/pointex/getArchivo?ruta=$modelRegistroMarca->URLRegistro" }}"
             style="height: 200px;cursor: pointer"/>
    @else
        <img class="media-object round-media"
             src="/Sistema/Pointex/Modulo/img/no-image.jpg"
             style="height: 200px;cursor: pointer"/>
    @endif
</center>