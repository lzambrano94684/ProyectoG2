<?php

namespace App\Http\Controllers\Sistema\Pointex\Modulo\BI;

use App\Http\Controllers\BaseController;
use App\Modelos\CORE\PX_SIS_Contacto;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\CORE\PX_SIS_PERSONA;
use App\Modelos\CORE\PX_SIS_Puesto;
use App\Modelos\Finanzas\PX_SIS_Usuario;
use App\Modelos\VisitaMedica\MD_Especialidad;
use App\Modelos\VisitaMedica\MD_Fichero;
use App\Modelos\VisitaMedica\MD_Linea;
use App\Modelos\VisitaMedica\MD_Localidad;
use App\Modelos\VisitaMedica\MD_Region;
use App\Modelos\VisitaMedica\MD_Representante;
use App\Modelos\VisitaMedica\MD_UniversoMedico;
use App\Modelos\VisitaMedica\MD_UniversoMedicoQuintalizacion;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class VisitaAdministracionController extends BaseController
{
    var $idUsuarioCreacion;
    var $consultaPuesto;
    var $arrayPersonaAdministrador;
    var $UsuarioPerisos;
    var $consultaIdPaisSupervisor;

    public function __construct()
    {
        try {
            $this->idUsuarioCreacion = $this->getDataUserLogeado()->Id;
            $this->consultaPuesto = PX_SIS_Usuario::where("Id", $this->idUsuarioCreacion)->first()->IdPuesto;
            $this->arrayPersonaAdministrador = [1, 10, 11, 12, 13];
            $this->UsuarioPerisos = in_array($this->getDataUserLogeado()->IdPersona, $this->arrayPersonaAdministrador) ? $UsuarioPerisos = true : $UsuarioPerisos = false;
            $this->consultaIdPaisSupervisor = PX_SIS_Contacto::select("IdPais")->where("IdPersona", $this->getDataUserLogeado()->IdPersona)->first()->IdPais;
        } catch (\Exception $e) {

        }
    }

    public function index(Request $request)
    {
        $msg = Session::get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $request = $this->UrlToData($request);
        $titleMsg = "Asignación del Panel Médico";
        $vista = "";

        if ($request->crear) {
            $vista = $this->frm($request, 0);
        } elseif ($request->editar) {
            $vista = $this->frm($request, $request->editar);
        } else {
            $vista = $this->tbl($request);
        }

        return view("Sistema.Pointex.Modulo.VisitaAdministracion.Fichero.index", get_defined_vars());
    }

    public function frm($request, $id)
    {
        $arrayPersona = PX_SIS_PERSONA::from("PX_SIS_PERSONA as p")
            ->select(DB::raw("concat(Nombres,' ',Apellidos) as Persona"), "Id")
            ->where("Estado", "A")->get()->pluck("Persona", "Id")->toArray();

        $arrayLinea = MD_Linea::select("Nombre", "Id")->get()->pluck("Nombre", "Id")->toArray();
//        $arrayUEspecialidad = MD_UniversoMedico::select("cdg_esp1", "cdg_esp1")->groupby("cdg_esp1")->get()->pluck("cdg_esp1", "cdg_esp1")->toArray();
        $arrayUEspecialidad = MD_Especialidad::select("Id", "Nombre")->get()->pluck("Nombre", "Id")->toArray();
        $arrayLocalidad = MD_Localidad::select("Id", "Nombre")->get()->pluck("Nombre", "Id")->toArray();
        $arrayRegion = MD_Region::select("Id", "Nombre")->get()->pluck("Nombre", "Id")->toArray();

        $consultaIdPersona = $id ? MD_Representante::from("MD_Representante as rep")
            ->join("PX_SIS_Usuario as u", "rep.IdUsuario", "=", "u.Id")
            ->select("u.IdPersona")
            ->where("rep.Id", $id)
            ->first()->IdPersona : null;

        $consultaIdPais = $id ? MD_Representante::from("MD_Representante as rep")
            ->join("PX_SIS_Usuario as u", "rep.IdUsuario", "=", "u.Id")
            ->join("PX_SIS_Contacto as c", "u.IdPersona", "=", "c.IdPersona")
            ->select("c.IdPais")
            ->where("rep.Id", $id)
            ->first()->IdPais : null;

        $consultaIdLinea = $id ? MD_Representante::select("IdLinea")
            ->where("Id", $id)
            ->first()->IdLinea : null;

        $fichero = MD_Fichero::where("IdRepresentante", $id)->get();

        $cmbPersona = $this->SelectedUniversales(collect(["Persona" => $arrayPersona]), $consultaIdPersona,
            false, [
                "name" => "cmbPersona",
                "id" => "cmbPersona",
                "class" => "select2_single form-control"
            ], true, true, false, false, false, false);

        $cmbLinea = $this->SelectedUniversales(collect(["Linea" => $arrayLinea]), $consultaIdLinea,
            false, [
                "name" => "cmbLinea",
                "id" => "cmbLinea",
                "class" => "select2_single form-control"
            ], true, true, false, false, false, false);

        $cmbEspecialidad = $this->SelectedUniversales(collect(["Especialidad" => $arrayUEspecialidad]), null,
            false, [
                "name" => "cmbEspecialidad",
                "id" => "cmbEspecialidad",
                "class" => "select2_single form-control"
            ], true, true, false, false, false, false);

        $cmbLocalidad = $this->SelectedUniversales(collect(["Localidad" => $arrayLocalidad]), null,
            false, [
                "name" => "cmbLocalidad",
                "id" => "cmbLocalidad",
                "class" => "select2_single form-control"
            ], true, true, false, false, false, false);

        $cmbRegion = $this->SelectedUniversales(collect(["Region" => $arrayRegion]), null,
            false, [
                "name" => "cmbRegion",
                "id" => "cmbRegion",
                "class" => "select2_single form-control"
            ], true, true, false, false, false, false);

        $panel = $this->getFichero($id);
        $consultaPuesto = $this->consultaPuesto;
        return view("Sistema.Pointex.Modulo.VisitaAdministracion.Fichero._subVistas._frm", get_defined_vars());
    }

    public function tbl($request)
    {
        if ($this->consultaPuesto == 2 && !$this->UsuarioPerisos) {
            $data = MD_Representante::from("MD_Representante as rep")
                ->join("PX_SIS_Usuario as us", "rep.IdUsuario", "=", "us.Id")
                ->join("PX_SIS_Contacto as c", "us.IdPersona", "=", "c.IdPersona")
                ->join("PX_SIS_Pais as pa", "c.IdPais", "=", "pa.Id")
                ->join("PX_SIS_Persona as p", "us.IdPersona", "=", "p.Id")
                ->join("PX_SIS_Entidad as e", "p.IdEntidad", "=", "e.Id")
                ->select("rep.Id", "rep.Representante", "pa.Nombre as Pais", "e.Nombre as Entidad")
                ->where("us.Id", $this->idUsuarioCreacion)->orderBy("rep.Id", "desc")->get();
        } else if ($this->consultaPuesto != 2 && !$this->UsuarioPerisos) {
            $data = MD_Representante::from("MD_Representante as rep")
                ->join("PX_SIS_Usuario as us", "rep.IdUsuario", "=", "us.Id")
                ->join("PX_SIS_Contacto as c", "us.IdPersona", "=", "c.IdPersona")
                ->join("PX_SIS_Pais as pa", "c.IdPais", "=", "pa.Id")
                ->join("PX_SIS_Persona as p", "us.IdPersona", "=", "p.Id")
                ->join("PX_SIS_Entidad as e", "p.IdEntidad", "=", "e.Id")
                ->select("rep.Id", "rep.Representante", "pa.Nombre as Pais", "e.Nombre as Entidad")
                ->where("pa.Id",$this->consultaIdPaisSupervisor)->orderBy("rep.Id", "desc")->get();
        } else if ($this->UsuarioPerisos) {
            $data = MD_Representante::from("MD_Representante as rep")
                ->join("PX_SIS_Usuario as us", "rep.IdUsuario", "=", "us.Id")
                ->join("PX_SIS_Contacto as c", "us.IdPersona", "=", "c.IdPersona")
                ->join("PX_SIS_Pais as pa", "c.IdPais", "=", "pa.Id")
                ->join("PX_SIS_Persona as p", "us.IdPersona", "=", "p.Id")
                ->join("PX_SIS_Entidad as e", "p.IdEntidad", "=", "e.Id")
                ->select("rep.Id", "rep.Representante", "pa.Nombre as Pais", "e.Nombre as Entidad")->orderBy("rep.Id", "desc")->get();
        }


        return view("Sistema.Pointex.Modulo.VisitaAdministracion.Fichero._subVistas._tbl", get_defined_vars());
    }

    public function saveRep(Request $request)
    {
        $model = new MD_Representante();

        $IdRep = $request->input("txtIdRep");
        $IdPersona = $request->input("cmbPersona");

        $consultaNombre = PX_SIS_PERSONA::select(DB::raw("CONCAT(Nombres,' ',Apellidos)as Nombre"))->where("Id", $IdPersona)->first()->Nombre;
        $consultaIdUsuario = PX_SIS_Usuario::select("Id")->where("IdPersona", $IdPersona)->first()->Id;

        $arrayInsertUpdate = [
            "IdLinea" => $request->input("cmbLinea"),
            "Representante" => $consultaNombre,
            "IdUsuario" => $consultaIdUsuario
        ];

        if ($IdRep) {
            $arrayInsertUpdate["UsuarioModificacion"] = $this->idUsuarioCreacion;
            $accion = $model->where("Id", $IdRep)->update($arrayInsertUpdate);
        } else {

            $existe = MD_Representante::where("IdUsuario", $consultaIdUsuario)->get();

            if (empty($existe->toArray())) {
                $arrayInsertUpdate["UsuarioCreacion"] = $this->idUsuarioCreacion;
                $accion = $model->insert($arrayInsertUpdate);
            } else {
                $mensajeReturn = ["Tipo" => "error", "Descripcion" => "Usuario ya registrado"];
                session()->push('msg', $mensajeReturn);
                $urlLink = "/pointex/visita_medica/paneles/asignar?" . base64_encode("editar=$IdRep");
                return redirect($urlLink);
            }
        }

        if ($accion) {
            $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        } else {
            $mensajeReturn = ["Tipo" => "error", "Descripcion" => "Hubo un problema al momento de realizar la
            inserción, por favor pongase en contacto con el administrador del sistema"];
        }
        session()->push('msg', $mensajeReturn);
        $urlLink = "/pointex/visita_medica/paneles/asignar?" . base64_encode("editar=$IdRep");
        return redirect($urlLink);
    }

    public function saveDoc(Request $request)
    {
        $model = new MD_Fichero();

        $IdRep = $request->input("txtIdRep");
        $PrimerNombre = $request->input("txtPrimerNombre");
        $SegundoNombre = $request->input("txtSegundoNombre");
        $PrimerApellido = $request->input("txtPrimerApellido");
        $SegundoApellido = $request->input("txtSegundoApellido");
        $IdRegion = $request->input("cmbRegion");
        $IdEspecialidad = $request->input("cmbEspecialidad");
        $IdLocalidad = $request->input("cmbLocalidad");
        $Nombre = $PrimerNombre . " " . $SegundoNombre . " " . $PrimerApellido . " " . $SegundoApellido;
        $consultaEspecialidad = MD_Especialidad::where("Id", $IdEspecialidad)->first()->Nombre;
        $consultaRegion = MD_Region::where("Id", $IdRegion)->first()->Nombre;
        $consultaLocalidad = MD_Localidad::where("Id", $IdLocalidad)->first()->Nombre;

        $arrayInsertUpdate = [
            "IdRepresentante" => $IdRep,
            "NombreLargo" => $Nombre,
            "Colegiado" => $request->input("txtNoColegiado"),
            "EspecialidadPrimaria" => $consultaEspecialidad,
            "Region" => $consultaRegion,
            "Localidad" => $consultaLocalidad,
            "Cat" => "SC",
            "Depto" => $request->input("txtDepto"),
            "Direccion" => $request->input("txtDireccion"),
            "TipoDomicilio" => $request->input("cmbTipoDomicilio"),
            "Municipio" => $request->input("txtMunicipio"),
            "Telefono" => $request->input("txtTelefono"),
            "Mail1" => $request->input("txtCorreo"),
            "Frecuencia" => $request->input("txtFrecuencia"),
            "PerfilActutidinal" => $request->input("cmbPerfilActitudinal"),
            "Justificacion" => $request->input("txtJustificacion"),
            "SolicitudActivo" => 1,
            "IdEstatusFichero" => 2,
            "Tipo" => 1
        ];

        $existe = MD_Fichero::where("NombreLargo", $Nombre)->where("IdRepresentante", $IdRep)->get();

        if (empty($existe->toArray())) {
            $arrayInsertUpdate["UsuarioCreacion"] = $this->idUsuarioCreacion;
            $accion = $model->insert($arrayInsertUpdate);
        } else {
            $mensajeReturn = ["Tipo" => "error", "Descripcion" => "Cuenta ya registrada"];
            session()->push('msg', $mensajeReturn);
            $urlLink = "/pointex/visita_medica/paneles/asignar?" . base64_encode("editar=$IdRep");
            return redirect($urlLink);
        }

        if ($accion) {
            $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        } else {
            $mensajeReturn = ["Tipo" => "error", "Descripcion" => "Hubo un problema al momento de realizar la
            inserción, por favor pongase en contacto con el administrador del sistema"];
        }
        session()->push('msg', $mensajeReturn);
        $urlLink = "/pointex/visita_medica/paneles/asignar?" . base64_encode("editar=$IdRep");
        return redirect($urlLink);
    }

    public function GetData(Request $request)
    {
        $model = new MD_Fichero();
//        return  $model->select("Id")->get();
        $solicitudes = $model->select("Id")->get();
        return json_encode($solicitudes);
//            datatables()->of($solicitudes)
//            ->addColumn('btn','solicitante.btn')
//            ->rawColumns(['btn'])
//            ->toJson();

    }

    public function getFichero($IdRep)
    {
        $sql = "select f.*,(CASE WHEN f.CodCloseUp in (select CodCloseUp from VW_UniversoMedico) THEN 1 ELSE 0 END)as Cruze,ef.Estado
                from MD_Fichero as f
                left join MD_EstadoFichero as ef on f.IdEstatusFichero = ef.Id
                where f.IdRepresentante = $IdRep and f.Aplica is null";
        return collect(DB::select($sql));
//        return MD_Fichero::where("IdRepresentante", $IdRep)->get();
    }

    public function saveEstatus(Request $request)
    {
        try {
            if ($request->estado) {
                $update = MD_Fichero::find($request->id)->update(["SolicitudActivo" => $request->estado, "IdEstatusFichero" => 2, "Justificacion" => $request->justificacion]);
            } else {
                $update = MD_Fichero::find($request->id)->update(["SolicitudActivo" => $request->estado, "IdEstatusFichero" => 2, "JustificacionBaja" => $request->justificacion]);
            }


            if ($update) {
                return ["ESTADO" => "OK", "Id" => $request->id, "Estatus" => $request->estado];
            } else {
                return ["ESTADO" => "NO", "DESCRIPCION" => "Se presentó un error al realizar la actualización"];
            }
        } catch (QueryException $ex) {
            Log::error("Error" . $ex->getMessage());
        }
    }

    public function MiPanel(Request $request)
    {
        $msg = Session::get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $request = $this->UrlToData($request);
        $titleMsg = "Fichero Médico";
        $vista = "";
        $fichero = MD_Representante::from("MD_Representante as rep")
            ->join("MD_Fichero as f", "rep.Id", "=", "f.IdRepresentante")
            ->select("f.NombreLargo as Medico", "f.EspecialidadPrimaria as Especialidad", "f.Direccion", "f.Frecuencia", "Cat")
            ->where("f.Activo", 1)
            ->where("rep.IdUsuario", $this->idUsuarioCreacion)
            ->get();
        return view("Sistema.Pointex.Modulo.VisitaAdministracion.Fichero.Reporte.index", get_defined_vars());
    }

    public function SearchMedico($IdPais)
    {
//        $sql = "select CONCAT(Id,'-.',nombre)as nombre from MD_UniversoMedico where IdPais = $IdPais";

        //$sql = "select MAX( CONCAT(Id,'-.',nombre))as nombre
        //        from MD_UniversoMedico
        //        where IdPais = $IdPais
        //        group by nombre,region,Pais,DOMICILIO_UNIFICADO,LOCALIDAD_UNIFICADA,REGI_N_UNIFICADA,cdg_esp1";
        $sql = "select MAX( CONCAT(IdUniversoMedico,'-.',Medico))as nombre from VW_UniversoMedicoAsignar
                where IdPais = $IdPais
                group by Medico,region,Pais,DOMICILIO_UNIFICADO,cdg_esp1";

        $data = collect(DB::select($sql));
        $varReturn = [];
        foreach ($data as $k) {
            array_push($varReturn, $k->nombre);
        }
        return response()->json($varReturn);
    }

    public function SearchProdMedicoTrim($codCloseUp, $Trim, $asignar)
    {

        if ($asignar) {
            if ($Trim == "TRIM_4") {
                $sqlTrim = "select TOP(3) REPLACE(Mercado, 'MKT', '')AS Mercado,prod
                        from VW_UniversoMedicoAsignar
                        where TRIM_4 is not null and TRIM_4 <> '' and CodCloseUp = $codCloseUp
                        ORDER BY CONVERT(int, TRIM_4) DESC";
            } elseif ($Trim == "TRIM_3") {
                $sqlTrim = "select TOP(3) REPLACE(Mercado, 'MKT', '')AS Mercado,prod
                        from VW_UniversoMedicoAsignar
                        where TRIM_3 is not null and TRIM_3 <> '' and CodCloseUp = $codCloseUp
                        ORDER BY CONVERT(int, TRIM_3) DESC";
            } elseif ($Trim == "TRIM_2") {
                $sqlTrim = "select TOP(3) REPLACE(Mercado, 'MKT', '')AS Mercado,prod
                        from VW_UniversoMedicoAsignar
                        where TRIM_2 is not null and TRIM_2 <> '' and CodCloseUp = $codCloseUp
                        ORDER BY CONVERT(int, TRIM_2) DESC";
            } elseif ($Trim == "TRIM_1") {
                $sqlTrim = "select TOP(3) REPLACE(Mercado, 'MKT', '')AS Mercado,prod
                        from VW_UniversoMedicoAsignar
                        where TRIM_1 is not null and TRIM_1 <> '' and CodCloseUp = $codCloseUp
                        ORDER BY CONVERT(int, TRIM_1) DESC";
            }
        } else {
            if ($Trim == "TRIM_4") {
                $sqlTrim = "select TOP(3) REPLACE(Mercado, 'MKT', '')AS Mercado,prod
                        from VW_UniversoMedico
                        where TRIM_4 is not null and TRIM_4 <> '' and CodCloseUp = $codCloseUp
                        ORDER BY CONVERT(int, TRIM_4) DESC";
            } elseif ($Trim == "TRIM_3") {
                $sqlTrim = "select TOP(3) REPLACE(Mercado, 'MKT', '')AS Mercado,prod
                        from VW_UniversoMedico
                        where TRIM_3 is not null and TRIM_3 <> '' and CodCloseUp = $codCloseUp
                        ORDER BY CONVERT(int, TRIM_3) DESC";
            } elseif ($Trim == "TRIM_2") {
                $sqlTrim = "select TOP(3) REPLACE(Mercado, 'MKT', '')AS Mercado,prod
                        from VW_UniversoMedico
                        where TRIM_2 is not null and TRIM_2 <> '' and CodCloseUp = $codCloseUp
                        ORDER BY CONVERT(int, TRIM_2) DESC";
            } elseif ($Trim == "TRIM_1") {
                $sqlTrim = "select TOP(3) REPLACE(Mercado, 'MKT', '')AS Mercado,prod
                        from VW_UniversoMedico
                        where TRIM_1 is not null and TRIM_1 <> '' and CodCloseUp = $codCloseUp
                        ORDER BY CONVERT(int, TRIM_1) DESC";
            }
        }
        $data = collect(DB::select($sqlTrim));
        return response()->json($data);
    }

    function ModificaMedico(Request $request)
    {
        $id = $request->input("txtId");
        $Colegiado = $request->input("txtColegiado");
        $EspPromoRegilla = $request->input("EspPromoRegilla");
        $EspecialidadSecundaria = $request->input("SegundaEsp");
        $Frecuencia = $request->input("Frecuencia");
        $Mail1 = $request->input("Mail1");
        $Direccion = $request->input("Direccion");
        $Depto = $request->input("Depto");
        $Municipio = $request->input("Municipio");
        $Localidad = $request->input("Localidad");
        $Region = $request->input("Region");
        $Telefono = $request->input("Telefono");
        $arrayInsert = [
            "Colegiado" => $Colegiado,
            "EspPromoRegilla" => $EspPromoRegilla,
            "EspecialidadSecundaria" => $EspecialidadSecundaria,
            "Frecuencia" => $Frecuencia,
            "Mail1" => $Mail1,
            "Direccion" => $Direccion,
            "Depto" => $Depto,
            "Municipio" => $Municipio,
            "Localidad" => $Localidad,
            "Region" => $Region,
            "Telefono" => $Telefono,
            "UsuarioCreacion" => $this->idUsuarioCreacion
        ];
        MD_Fichero::find($id)->update($arrayInsert);
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos almacenados correctamente"];
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    public function AgregaMedico(Request $request)
    {
        if ($request->ajax()) {
            $varReturn["STATUS"] = "OK";
            try {
                $idRep = $request->input("idRep");
                $Medico = $request->input("Medico");

                if ($Medico) {
                    foreach ($Medico as $k) {
                        $id = explode("-.", $k);

                        $consultaUniversoM = MD_UniversoMedico::select("region", "localidad", "nombre", "DOMICILIO_UNIFICADO", "cdg_esp1", "MEDICO_UNICO", "TRIM_Cat_1", "TRIM_Cat_2", "TRIM_Cat_3", "TRIM_Cat_4")->where("Id", $id[0])->first();

                        $consultaQuintil = MD_UniversoMedicoQuintalizacion::where("CodigoMed", $consultaUniversoM->MEDICO_UNICO)->where("Activo","Activo")->first();

                        $Quintil = $consultaQuintil ? $consultaQuintil->Quintil : "SC";

//                       if (!empty($consultaUniversoM->TRIM_Cat_4)) {
//                            $Quintil = $consultaUniversoM->TRIM_Cat_4;
//                        }elseif (!empty($consultaUniversoM->TRIM_Cat_3)) {
//                            $Quintil = $consultaUniversoM->TRIM_Cat_3;
//                        }elseif (!empty($consultaUniversoM->TRIM_Cat_2)) {
//                            $Quintil = $consultaUniversoM->TRIM_Cat_2;
//                        }elseif (!empty($consultaUniversoM->TRIM_Cat_1)) {
//                            $Quintil = $consultaUniversoM->TRIM_Cat_1;
//                        }else{$Quintil = "SC";}

                        MD_Fichero::insert([
                            "NombreLargo" => $consultaUniversoM->nombre,
                            "Direccion" => $consultaUniversoM->DOMICILIO_UNIFICADO,
                            "EspPromoRegilla" => $consultaUniversoM->cdg_esp1,
                            "SolicitudActivo" => 1,
                            "IdEstatusFichero" => 2,
                            "Frecuencia" => 1,
                            "Cat" => "" . $Quintil,
                            "CodCloseUp" => $consultaUniversoM->MEDICO_UNICO,
                            "IdRepresentante" => $idRep,
                            "Region" => $consultaUniversoM->region,
                            "Localidad" => $consultaUniversoM->localidad,
                            "IdUniversoM" => $id[0],
                            "UsuarioCreacion" => $this->idUsuarioCreacion
                        ]);
                    }
                }

                $varReturn["idRep"] = $idRep;
                return response()->json($varReturn);
            } catch (\Exception $e) {
                $varReturn["STATUS"] = "ERROR";
                $varReturn["DATA"] = $e->getMessage();
            }
        } else {
            abort(404);
        }
    }

    public function getDatoMedico(Request $request)
    {
        if ($request->ajax()) {
            try {
                $txtMedico = $request->input("Medico");
                $Medico = explode(",", $txtMedico);

                $arrayIdPanelMedico = [];
                if ($Medico) {
                    foreach ($Medico as $k) {
                        $id = explode("-.", $k);
                        array_push($arrayIdPanelMedico, $id[0]);
                    }
                }
                $datoUniversoMedico = MD_UniversoMedico::select("Id", "nombre as Medico", "DOMICILIO_UNIFICADO as Domicilio", "LOCALIDAD_UNIFICADA as Localidad", "REGI_N_UNIFICADA as Region", "cdg_esp1 as Especialidad", "cdg_esp2 as SegundaEspecialidad", "MEDICO_UNICO")
                    ->wherein("Id", $arrayIdPanelMedico)->get();
                $varReturn["datoUniversoMedico"] = $datoUniversoMedico;
                $varReturn["STATUS"] = "OK";
            } catch (\Exception $e) {
                $varReturn["STATUS"] = "ERROR";
                $varReturn["DATA"] = $e->getMessage();
            }
            return response()->json($varReturn);
        } else {
            abort(404);
        }
    }

    function AutorizaIndex(Request $request)
    {
        $msg = Session::get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $request = $this->UrlToData($request);
        $titleMsg = "Aprobación del Panel Médico";
        $vista = $this->tblAutoriza($request);
        return view("Sistema.Pointex.Modulo.VisitaAdministracion.AutorizaFichero.index", get_defined_vars());
    }

    public function tblAutoriza($request)
    {
        if ($this->UsuarioPerisos) {
            $sqlpanel = "select f.*,(CASE WHEN f.CodCloseUp in (select CodCloseUp from VW_UniversoMedico) THEN 1 ELSE 0 END)as Cruze,ef.Estado,rep.Representante
                from MD_Fichero as f
                    join MD_Representante as rep on f.IdRepresentante = rep.Id
                left join MD_EstadoFichero as ef on f.IdEstatusFichero = ef.Id
                where f.IdEstatusFichero = 2 and f.SolicitudActivo = 1
                ";

            $sql = "select f.*,(CASE WHEN f.CodCloseUp in (select CodCloseUp from VW_UniversoMedico) THEN 1 ELSE 0 END)as Cruze,ef.Estado,rep.Representante
                from MD_Fichero as f
                    join MD_Representante as rep on f.IdRepresentante = rep.Id
                left join MD_EstadoFichero as ef on f.IdEstatusFichero = ef.Id
                where f.IdEstatusFichero = 2 and f.SolicitudActivo = 0
                ";
        }else{
            $sqlpanel = "select f.*,(CASE WHEN f.CodCloseUp in (select CodCloseUp from VW_UniversoMedico) THEN 1 ELSE 0 END)as Cruze,ef.Estado,rep.Representante
                from MD_Fichero as f
                    join MD_Representante as rep on f.IdRepresentante = rep.Id
                left join MD_EstadoFichero as ef on f.IdEstatusFichero = ef.Id
                left join PX_SIS_Usuario as u on rep.IdUsuario = u.Id
                left join PX_SIS_Contacto as c on u.IdPersona = c.IdPersona
                where f.IdEstatusFichero = 2 and f.SolicitudActivo = 1 and c.IdPais = $this->consultaIdPaisSupervisor
                ";

            $sql = "select f.*,(CASE WHEN f.CodCloseUp in (select CodCloseUp from VW_UniversoMedico) THEN 1 ELSE 0 END)as Cruze,ef.Estado,rep.Representante
                from MD_Fichero as f
                    join MD_Representante as rep on f.IdRepresentante = rep.Id
                left join MD_EstadoFichero as ef on f.IdEstatusFichero = ef.Id
                left join PX_SIS_Usuario as u on rep.IdUsuario = u.Id
                left join PX_SIS_Contacto as c on u.IdPersona = c.IdPersona
                where f.IdEstatusFichero = 2 and f.SolicitudActivo = 0 and c.IdPais = $this->consultaIdPaisSupervisor
                ";
        }

        $panel = collect(DB::select($sqlpanel));
        $panelDesactivar = collect(DB::select($sql));
        return view("Sistema.Pointex.Modulo.VisitaAdministracion.AutorizaFichero._subVistas._tbl", get_defined_vars());
    }

    public function AprAutoriza($id, $estatus, $tipo)
    {
        if ($tipo == "Aprobar") {
            $update = MD_Fichero::find($id)->update(["Activo" => $estatus, "IdEstatusFichero" => 1]);
        } else {
            $update = MD_Fichero::find($id)->update(["IdEstatusFichero" => 3]);
        }
        $mensajeReturn = ["Tipo" => "success", "Descripcion" => "Datos actualizados"];
        if (!$update) {
            $mensajeReturn = ["Tipo" => "error", "Descripcion" => "Hubo un problema al momento de almacenar la información"];
        }
        session()->push('msg', $mensajeReturn);
        return redirect(url()->previous());
    }

    function EditMedicoU(Request $request)
    {
        $msg = Session::get("msg");
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true, "DatePicker" => true, "Switch" => true];
        $request = $this->UrlToData($request);
        $titleMsg = "Asignación del Panel Médico";
        $vista = "";

        $data = MD_Fichero::find($request->editar);
        return view("Sistema.Pointex.Modulo.VisitaAdministracion.Fichero._subVistas._frmEditUniversoPanel", get_defined_vars());

    }
}
