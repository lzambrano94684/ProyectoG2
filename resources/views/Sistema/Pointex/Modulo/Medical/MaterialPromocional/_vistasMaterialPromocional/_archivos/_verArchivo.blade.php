<center>

    @if($modelSolicitudMateriales->URLDocumento)
        <img class="media-object round-media mostarImagen"
             src="{{ strtoupper(substr($modelSolicitudMateriales->URLDocumento, -3)) == "PDF" ? "/Vendor/Plantillas/Apex/app-assets/img/elements/pdf.png" : "/pointex/getArchivo?ruta=$modelSolicitudMateriales->URLDocumento"}}"
             url="{{"/pointex/getArchivo?ruta=$modelSolicitudMateriales->URLDocumento"}}"
             style="height: 200px;cursor: pointer"
        />
    @else
        <img class="media-object round-media"
             src="/Sistema/Pointex/Modulo/img/no-image.jpg"
             style="height: 200px;cursor: pointer"/>
    @endif
</center>
