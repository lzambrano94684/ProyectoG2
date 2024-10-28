<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Sistema\Pointex\Modulo\Multiples\ArbolAprobacionesController;
use App\Modelos\CORE\PX_SIS_Aprobaciones;
use App\Modelos\CORE\PX_SIS_ArbolAProbaciones;
use App\Modelos\CORE\PX_SIS_ArbolPersona;
use App\Modelos\CORE\PX_SIS_ENTIDAD;
use App\Modelos\GestionProducto\PX_GP_RegulatorioEntidad;
use App\Modelos\CORE\PX_SIS_PAIS;
use App\Modelos\CORE\PX_SIS_PERFIL_USUARIO;
use App\Modelos\CORE\PX_SIS_PERSONA;
use App\Modelos\CORE\PX_SIS_USUARIO;
use App\Modelos\Finanzas\PX_FIN_CentroCosto;
use App\Modelos\Finanzas\PX_FIN_CuentaBpcSap;
use App\Modelos\Finanzas\PX_FIN_Ejecucion;
use App\Modelos\Finanzas\PX_FIN_EjecucionDetalle;
use App\Modelos\Finanzas\PX_FIN_EjecucionDetalleMarca;
use App\Modelos\Finanzas\PX_FIN_EjecucionDetalleProducto;
use App\Modelos\Finanzas\PX_FIN_EjecucionEstatus;
use App\Modelos\Finanzas\PX_FIN_EjecucionEstatusHistorial;
use App\Modelos\Finanzas\PX_FIN_Movimiento;
use App\Modelos\Finanzas\PX_FIN_Presupuesto;
use App\Modelos\Finanzas\PX_SIS_SociedadDepartamentoPersona;
use App\Modelos\GestionProducto\PX_GP_FormaFarmaceutica;
use App\Modelos\GestionProducto\PX_GP_FormaFarmaceuticaTipo;
use App\Modelos\GestionProducto\PX_GP_Franquicia;
use App\Modelos\GestionProducto\PX_GP_GrupoTerapeutico;
use App\Modelos\GestionProducto\PX_GP_Marca;
use App\Modelos\GestionProducto\PX_GP_Patologia;
use App\Modelos\GestionProducto\PX_GP_PrincipioActivo;
use App\Modelos\GestionProducto\PX_GP_Producto;
use App\Modelos\GestionProducto\PX_GP_ProductoCodigos;
use App\Modelos\GestionProducto\PX_GP_ProductoModalidadVenta;
use App\Modelos\GestionProducto\PX_GP_ProductoPresentacionTipo;
use App\Modelos\GestionProducto\PX_GP_RegistroMarcaEstatus;
use App\Modelos\GestionProducto\PX_GP_RegistroSanitario;
use App\Modelos\GestionProducto\PX_GP_RegistroSanitarioEstatus;
use App\Modelos\GestionProducto\PX_GP_ViaAdministracion;
use App\Modelos\Reportes\ENTRY_MARKET;
use App\Modelos\Reportes\Franquicias;
use App\Modelos\Reportes\total_atc;
use App\Modelos\SalesExpenses\PX_SEX_EncabezadoDoc;
use App\Modelos\SalesExpenses\PX_SEX_Moneda;
use App\Modelos\SalesExpenses\PX_SEX_MonedaHistorico;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BaseController extends Controller
{

    public function mesesAbreviado()
    {
        $arrayMeses = config("constants.meses");
        array_unshift($arrayMeses, "");
        unset($arrayMeses[0]);
        $arrayMeses = collect($arrayMeses)->map(function ($v) {
            return str::title(Str::limit($v, 3, ""));
        });
        return $arrayMeses;
    }

    /**
     * Urls por Usuario
     * @param $id
     * @return array
     */
    public function getUrlByUser($id)
    {
        Collection::macro('trim', function () {
            return $this->map(function ($value) {
                return trim($value);
            });
        });
        $Menus = PX_SIS_PERFIL_USUARIO::from("PX_SIS_PERFIL_USUARIO as PU")
            ->select("M.URL")
            ->join("PX_SIS_PerfilModulo as PM", "PU.IdPerfil", "=", "PM.IdPerfil")
            ->join("PX_SIS_PerfilMenu as PME", "PM.IdPerfil", "=", "PME.IdPerfil")
            ->join("PX_SIS_Menu as M", "PME.IdMenu", "=", "M.Id")
            ->where("PU.IdUsuario", $id)
            ->groupBy("M.URL")
            ->get()
            ->pluck("URL")
            ->trim()
            ->toArray();
        $SubMenus = PX_SIS_PERFIL_USUARIO::from("PX_SIS_PERFIL_USUARIO as PU")
            ->select("SM.URL")
            ->join("PX_SIS_PerfilMenu as PME", "PU.IdPerfil", "=", "PME.IdPerfil")
            ->join("PX_SIS_Menu as M", "PME.IdMenu", "=", "M.Id")
            ->join("PX_SIS_PerfilSubMenu as PS", "PME.IdPerfil", "=", "PS.IdPerfil")
            ->join("PX_SIS_Sub_Menu as SM", "PS.IdSubMenu", "=", "SM.Id")
            ->where("PU.IdUsuario", $id)
            ->groupBy("SM.URL")
            ->get()
            ->pluck("URL")
            ->trim()
            ->toArray();
        return collect([$Menus, $SubMenus])->collapse()->all();
    }

    /**
     * Ontiene data de usuario logeado
     * @return mixed
     */
    public function getDataUserLogeado()
    {
        return Session::get("Accesos.usuario");
    }

    /**
     * método para la creación de contraseñas
     * @param $password
     * @return string
     */
    public function Creapass($password)
    {

        $pass = null;
        for ($i = 0; $i < 10; $i++) {
            $pass = rand(1, 100000000);
        }
        $salt = substr(sha1($pass), 20);
        $newPassword = sha1($salt . $password) . ":" . $salt;
        return $newPassword;
    }

    /**
     * pass aleatorio
     * @return bool|string
     */
    public function generarPass()
    {
        $logitud = 8;
        $psswd = substr(md5(microtime()), 1, $logitud);
        return $psswd;

    }

    /**
     * Verificando que el documento exista en el disco
     * @param $url
     * @return bool
     */
    public function checkFile($url)
    {
        $contenido = Storage::disk('local')->exists($url);

        return $contenido;
    }

    /**
     * Eliminando Docuemtos del Disco
     * @param $url
     * @return bool
     *
     */
    public function deleteFile($url)
    {
        $contenido = Storage::disk('local')->delete($url);

        return $contenido;
    }


    /**
     * Método para guardar documentos en disco
     * @param $archivo
     * @param $nameFile
     * @param $ruta
     * @return array
     */
    public function GuardaArchivoStorage($archivo, $nameFile, $ruta)
    {
        $extensiones = ['jpg', 'png', 'jpeg', 'pdf'];
        $file = $archivo;
        $path = $file->getClientOriginalName();

        $valida = $this->ValidaExtension($extensiones, $path);

        if (isset($valida['ESTADO']) && $valida['ESTADO'] == 'OK') {
            $nombreArchivo = $nameFile . '.' . $valida['EXTENSION'];

            if (Storage::put($ruta . $nombreArchivo, file_get_contents($file)))
                return ['ESTADO' => 'OK', 'MENSAJE' => $ruta . $nombreArchivo];
            else
                return ['ESTADO' => 'ERROR', 'MENSAJE' => 'No fue posible almacenar el archivo.'];
        } else {
            return ['ESTADO' => 'ERROR', 'MENSAJE' => 'La extensión del archivo no es válida.'];
        }
    }

    /**
     * Validación de Extensiones de archivos
     * @param $extensiones
     * @param $path
     * @return array
     */
    public function ValidaExtension($extensiones, $path)
    {
        $item = explode('.', $path);
        $ext = array_pop($item);
        $flag = 'NO PERMITIDA';
        foreach ($extensiones as $i) {
            if (strcasecmp($ext, $i) == 0) {
                $flag = 'OK';
                break;
            } else {
                $flag = 'ERROR';
            }
        }

        $response = ["ESTADO" => $flag, "EXTENSION" => strtolower($ext)];

        return $response;
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de paises como value
     * @param bool $activos
     * @return mixed
     */
    public function Paises($activos = false)
    {
        return PX_SIS_PAIS::select("Id", "Nombre")->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de Entidades como value
     * @param bool $activos
     * @return mixed
     */
    public function Entidades($activos = false)
    {
        return PX_SIS_ENTIDAD::select("Id", "Nombre")->where(function ($query) use ($activos) {
            if ($activos) $query->where("Estado", "A");
        })->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de RegulatorioEntidades como value
     * @param bool $activos
     * @return mixed
     */
    public function RegulatorioEntidades($activos = false)
    {
        return PX_GP_RegulatorioEntidad::select("Id", "Nombre")->where(function ($query) use ($activos) {
            if ($activos) $query->where("Estado", "A");
        })->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de Producto como value
     * @param bool $activos
     * @return mixed
     */
    private function Productos($activos = false)
    {
        return PX_GP_Producto::select("Id", "Nombre")->where(function ($query) use ($activos) {
            if ($activos) $query->where("Estado", "A");
        })->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de Producto como value
     * @param bool $activos
     * @return mixed
     */
    private function EstadoRegSanitario($activos = false)
    {
        return PX_GP_EstadoRegSanitario::select("Id", "Nombre")->where(function ($query) use ($activos) {
            if ($activos) $query->where("Estado", "A");
        })->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de Patologia como value
     * @param bool $activos
     * @return mixed
     */
    public function Patologia($activos = false)
    {
        return PX_GP_Patologia::select("Id", "Nombre")->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de Patologia como value
     * @param bool $activos
     * @return mixed
     */
    public function Marca($activos = false)
    {
        return PX_GP_Marca::select("Id", "Nombre")->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de total_atc como value
     * @param bool $activos
     * @return mixed
     */
    private function total_atc($activos = false)
    {
        return total_atc::select("pais")->orderBy("pais")
            ->groupBy("pais")->get()->each(function ($v) {
                $v->Id = $v->pais;
                $v->Nombre = $v->pais;
            })->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de ENTRY_MARKET como value
     * @param bool $activos
     * @return mixed
     */
    private function ENTRY_MARKET($activos = false)
    {
        return ENTRY_MARKET::select("Clase ATC")->orderBy("Clase ATC")
            ->groupBy("Clase ATC")->get()->each(function ($v) {
                $value = "Clase ATC";
                $v->Id = $v->$value;
                $v->Nombre = $v->$value;
            })->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de ENTRY_MARKET como value
     * @param bool $activos
     * @return mixed
     */
    private function Franquicias($activos = false)
    {
        return Franquicias::select("Marca")->orderBy("Marca")
            ->groupBy("Marca")->get()->each(function ($v) {
                $value = "Marca";
                $v->Id = $v->$value;
                $v->Nombre = $v->$value;
            })->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_Franquicia como value
     * @param bool $activos
     * @return mixed
     */
    public function FranquiciaMarca($activos = false)
    {
        return PX_GP_Franquicia::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    private function ModalidadVenta($activos = false)
    {
        return PX_GP_ProductoModalidadVenta::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    private function FormaFarmaceutica($activos = false)
    {
        return PX_GP_FormaFarmaceutica::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    private function TipoFormaFarmaceutica($activos = false)
    {
        return PX_GP_FormaFarmaceuticaTipo::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    private function ViaAdministracion($activos = false)
    {
        return PX_GP_ViaAdministracion::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    private function PresentacionTipo($activos = false)
    {
        return PX_GP_ProductoPresentacionTipo::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    public function GrupoTerapeutico($activos = false)
    {
        return PX_GP_GrupoTerapeutico::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    public function RegistroSanitarioEstatus($activos = false)
    {
        return PX_GP_RegistroSanitarioEstatus::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    public function RegistroMarcaEstatus($activos = false)
    {
        return PX_GP_RegistroMarcaEstatus::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    public function PrincipioActivo($activos = false)
    {
        return PX_GP_PrincipioActivo::select("Id", "Nombre")->orderBy("Nombre")->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    public function Persona($activos = false, $id = 0, $notIn = [])
    {
        return PX_SIS_PERSONA::select("Id",
            DB::raw("RTRIM(CONCAT(Nombres, ' ', Apellidos)) as Nombre"))
            ->where(function ($query) use ($id, $notIn) {
                if (is_array($id)) {
                    $query->whereIn("Id", $id);
                } elseif ($id) {
                    $query->where("Id", $id);
                }
                if (count($notIn) > 0) $query->whereNotIn("Id", $notIn);
            })
            ->orderBy("Nombre")
            ->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    public function CuentaBPC($activos = false, $tipo, $cuentasSelected = [], $t)
    {
        return PX_FIN_CuentaBpcSap::select("Id", "CodBPC", "CodSap", "Nombre")
            ->where("IdTipo", $tipo)
            ->where(function ($query) use ($cuentasSelected, $t) {
                if (count($cuentasSelected) > 0) {
                    $whereTipo = $t == 1 ? "whereNotIn" : "whereIn";
                    $query->$whereTipo("Id", $cuentasSelected);
                }
            })
            ->orderBy("PX_FIN_CuentaBpcSap.Nombre")
            ->get();
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    public function CentroCosto($activos = false)
    {
        return PX_FIN_CentroCosto::select("Id", "Nombre")
            ->orderBy("Nombre")
            ->get()
            ->pluck("Nombre", "Id");
    }

    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    public function MarcaProductoEstatus($idEstatus = false, $all = false)
    {
        $modelProducto = PX_GP_Marca::from("PX_GP_Marca as M")
            ->join("PX_GP_Producto as P", "M.Id", "=", "P.IdMarca")
            //->where("P.IdEstatus", $idEstatus)
            ->select(
                "M.Id",
                "M.Nombre",
                DB::raw("COUNT(P.Id) as  Productos")
            )
            ->groupBy("M.Nombre", "M.Id")
            ->get();
        if ($all) {
            return $modelProducto->sortByDesc("Id");
        }
        return $modelProducto->pluck("Nombre", "Id");
    }

    public function DataFilterRegulatorio($request)
    {
        return PX_GP_RegistroSanitario::from("PX_GP_RegistroSanitario as RS")
            ->where(function ($query) use ($request) {
                if ($request->txtMarca) {
                    $query->where(DB::raw("RTRIM(LTRIM(UPPER(M.nombre))) COLLATE Latin1_General_CI_AI"), 'like',
                        strtoupper(trim($request->txtMarca)) . "%");
                }
                if ($request->cmbMarca) {
                    $query->where("M.Id", $request->cmbMarca);
                }
                if ($request->txtRegistro) {
                    $query->where(DB::raw("RTRIM(LTRIM(UPPER(RS.NoRegistroSanitario))) COLLATE Latin1_General_CI_AI"),
                        strtoupper(trim($request->txtRegistro)));
                }
                if ($request->txtSap) {
                    $query->where(DB::raw("RTRIM(LTRIM(UPPER(PFT.CodigoSap))) COLLATE Latin1_General_CI_AI"),
                        strtoupper(trim($request->txtSap)));
                }
                if ($request->cmbPaises) {
                    $query->where("PPD.IdPaisComercializacion", $request->cmbPaises);
                }
                if ($request->cmbRegistroSanitarioEstatus) {
                    $query->where("RS.IdEstatus", $request->cmbRegistroSanitarioEstatus);
                }
            })
            ->select(
                "RS.Id as IdRegistro",
                "PAIS.Nombre as PaisNombre",
                "PAIS.Codigo as PaisCodigo",
                "RS.NoRegistroSanitario",
                "RS.FechaVencimiento",
                DB::raw("Concat (M.nombre,' ', P.presentacion) as Producto"),
                "F.Nombre as Forma",
                "FT.Nombre as FormaTipo",
                "EN.Nombre as EntidadTitularNombre",
                "PPD.Id as IdProductoPaisDetalle",
                "PPD.PermisoComercializacion",
                "PPD.Descripcion as DescPermiso"
            )
            ->join("PX_GP_ProductoPaisDetalle as PPD", "RS.IdProductoPaisDetalle", "=", "PPD.Id")
            ->join("PX_SIS_Entidad as EN", "PPD.IdTitular", "=", "EN.Id")
            ->join("PX_GP_ProductoFormaTipo as PFT", "PPD.IdProductoFormaTipo", "=", "PFT.Id")
            ->join("PX_GP_FormaFarmaceutica as F", "PFT.IdFormaFarmaceutica", "=", "F.Id")
            ->join("PX_GP_FormaFarmaceuticaTipo as FT", "PFT.IdFormaFarmaceuticaTipo", "=", "FT.Id")
            ->join("PX_GP_Producto as P", "PFT.IdProducto", "=", "P.Id")
            ->join("PX_GP_Marca as M", "P.IdMarca", "=", "M.Id")
            ->join("PX_SIS_Pais as PAIS", "PPD.IdPaisComercializacion", "=", "PAIS.Id")
            ->groupBy(
                "RS.Id",
                "PAIS.Nombre",
                "PAIS.Codigo",
                "RS.NoRegistroSanitario",
                "RS.FechaVencimiento",
                DB::raw("Concat (M.nombre,' ', P.presentacion)"),
                "F.Nombre",
                "FT.Nombre",
                "EN.Nombre",
                "PPD.Id",
                "PPD.PermisoComercializacion",
                "PPD.Descripcion"
            )
            ->orderBy(
                "RS.Id",
                "desc"
            )
            ->get();
    }

    /**
     * Funcion que devuelve selected segun lo enviado
     * @param null $tipoSelected
     * @param bool $activos
     * @return array|string|null
     * @throws \Throwable
     */
    public function SelectedUniversales($tipoSelected = null, $select, $activos = false,
                                        $atributes = [], $requerido = false, $select2 = false,
                                        $multiple = false, $multiple2 = false, $debug = false, $ordenar = true,
                                        $placeholder = "Seleccione...", $attr = null)
    {
        if (is_string($tipoSelected)) {
            $model = $this->$tipoSelected($activos);
        } else {
            $model = collect($tipoSelected->first());
            $tipoSelected = key($tipoSelected->toArray());
        }
        return $tipoSelected ? view("Sistema.Pointex.Universales.selected", get_defined_vars())->render() : $tipoSelected;
    }

    public function modelProductosCodigo($where = [], $no = null)
    {
        return PX_GP_ProductoCodigos::select(
            "CP.Id",
            DB::raw("CONCAT(CP.CodigoSap,' - ', P.Presentacion,' - ', P.TipoPresentacion)as codSap")
        )
            ->from("PX_GP_ProductoCodigos as CP")
            ->join("PX_GP_Producto as P", "CP.IdProducto", "=", "P.Id")
            ->where("CP.CodigoSap", "<>", '')
//            ->where("CP.Estado", 1)
            ->where("P.Presentacion", "<>", '')
            ->whereIn("P.TipoPresentacion", ["Venta", 'Venta Inst'])
            ->where(function ($query) use ($where, $no) {
                if (count($where) > 0) {
                    foreach ($where as $kw => $vw) {
                        if (is_array($vw) && count($vw) > 0) {
                            if ($no) {
                                $query->whereNotIn($kw, $vw);
                            } else {
                                $query->whereIn($kw, $vw);
                            }
                        } else {
                            if (!is_array($vw)) {
                                if ($no) {
                                    $query->where($kw, "<>", $vw);
                                } else {
                                    $query->where($kw, $vw);
                                }
                            }

                        }
                    }
                }
            })
            ->get()
            ->pluck("codSap", "Id");
    }


    /**
     * Funcion que retorna arreglo de id como key y nombre de PX_GP_ProductoModalidadVenta como value
     * @param bool $activos
     * @return mixed
     */
    public function TableUniversal($tabla, $where = null, $pluck = null, $activeName = true, $codBPC = true)
    {
        if ($activeName) {
            switch ($tabla) {
                case "PX_FIN_CentroCosto":
                    $name = DB::raw("CONCAT(Cod,' - ', Nombre) as Nombre");
                    break;
                case "PX_FIN_CuentaBPCSAP":
                    if (!$codBPC) {
                        $name = DB::raw("CONCAT(CodSap,' - ', Nombre) as Nombre");
                    } else {
                        $name = DB::raw("CONCAT(CodBPC,' - ', CodSap,' - ', Nombre) as Nombre");
                    }
                    break;
                case "PX_SIS_Persona":
                    $name = DB::raw("CONCAT(Nombres,' - ', Apellidos) as Nombre");
                    break;
                case "PX_SIS_Pais":
                    if ($activeName)
                        $name = "Codigo";
                    break;
                case "PX_GP_Producto":
                    if ($activeName)
                        $name = "Presentacion";
                    break;
                default:
                    $name = "Nombre";
                    break;

            }
        } else {
            $name = "Nombre";
        }
        $idTable = $tabla == "PX_SEX_Moneda" ?
            DB::raw("(select top 1 mh.Id from PX_SEX_MonedaHistorico as mh where mh.IdMoneda =  PX_SEX_Moneda.Id order by mh.Id desc) as Id")
            : "Id";

        return DB::table($tabla)
            ->select($idTable, $name)
            ->orderBy("Id")
            ->where(function ($query) use ($where) {
                if ($where) {
                    foreach ($where as $kw => $vw) {
                        if (is_array($vw)) {
                            $query->whereIn($kw, $vw);
                        } else {
                            $query->where($kw, $vw);
                        }
                    }
                }
            })
            ->get()
            ->pluck($pluck ? $pluck : "Nombre", "Id");

    }

    public function getEntidadesSpecial($where = null)
    {
        return PX_SIS_ENTIDAD::select("Id", "Nombre", "IdPais as Atributo")
            ->where("Tipo", 1)
            ->where(function ($query) use ($where) {
                if ($where) {
                    foreach ($where as $kw => $vw) {
                        $query->where($kw, $vw);
                    }
                }
            })
            ->orderBy("Nombre")
            ->get();
    }

    public function getMonedaSpecial($where = null)
    {
        return PX_SEX_Moneda::select(DB::raw("(select top 1 mh.IdMoneda from PX_SEX_MonedaHistorico as mh where mh.IdMoneda =  PX_SEX_Moneda.Id order by mh.Id desc) as Id"), "Nombre", "Valor as Atributo")
            ->where(function ($query) use ($where) {
                if ($where) {
                    foreach ($where as $kw => $vw) {
                        $query->where($kw, $vw);
                    }
                }
            })
            ->orderBy("Nombre")
            ->get();
    }

    public function scriptAgrupaCentros()
    {
        $dataCentrosCosto = DB::table("PX_FIN_CentroCosto")->select("Id", "IdEntidad", DB::raw("CONCAT(Cod,' - ', Nombre) as Nombre"))
            ->get();
        $dataCentrosCosto = base64_encode($dataCentrosCosto->groupBy("IdEntidad"));
        return "<script> var dataCentroCosto = '$dataCentrosCosto';</script>";
    }

    public function InputUniversales($atributes, $name = "", $value = "")
    {
        return view("Sistema.Pointex.Universales.input", get_defined_vars())->render();
    }

    public function getEntidadDepCentroCuenta($presona = null, $idDepto = null, $idPerfil = null, $centroCosto = [])
    {
        return PX_SIS_SociedadDepartamentoPersona::from("PX_SIS_SociedadDepartamentoPersona as sdp")
            ->select("sdp.Id", "e.IdPais", "sdp.IdEntidad", "sdp.IdDepartamento", "sdp.IdPersona", "sdp.IdCentroCosto", "cct.IdCtaBPC")
            ->join("PX_FIN_CCostoCtaContable as cct", "sdp.Id", "=", "cct.IdSociedadDeptoPersona")
            ->join("PX_SIS_Entidad as e", "e.Id", "=", "sdp.IdEntidad")
            ->where(function ($query) use ($presona, $idDepto, $idPerfil, $centroCosto) {
                if ($presona) {
                    if (is_array($presona)) {
                        $query->whereIn("sdp.IdPersona", $presona);
                    } else {
                        $query->where("sdp.IdPersona", $presona);
                    }
                }
                if ($idDepto) $query->where("sdp.IdDepartamento", $idDepto);
                if ($idPerfil) $query->where("sdp.IdPerfil", $idPerfil);
                if (count($centroCosto) > 0) $query->whereIn("sdp.IdCentroCosto", $centroCosto);
            })
            ->groupBy("sdp.Id", "e.IdPais", "sdp.IdEntidad", "sdp.IdDepartamento", "sdp.IdPersona", "sdp.IdCentroCosto", "cct.IdCtaBPC")
            ->get();
    }

    /**
     * Funcion que devuelve selected segun lo enviado
     * @param null $tipoSelected
     * @param bool $activos
     * @return array|string|null
     * @throws \Throwable
     */
    public function TextareaUniversales($atributes, $name = "", $value = "")
    {
        return view("Sistema.Pointex.Universales.textarea", get_defined_vars())->render();
    }

    /**
     * Metodo que transforma un string url a data request
     * @param Request $data
     * @return Request
     */
    public function UrlToData(Request $data, $debug = false)
    {
        if ($data->all()) {
            $urlData = base64_decode(array_key_first($data->all()));
            $debug ? dd($urlData) : null;
            $base64ToArray = explode("&", $urlData);
            foreach ($base64ToArray as $kba => $vba) {
                if (trim($vba) != "") {
                    $exploudeInt = explode("=", $vba);
                    try {
                        $ob = "$exploudeInt[0]";
                        $data->$ob = utf8_encode($exploudeInt[1]);
                    } catch (\Exception $e) {
                    }
                }
            }
        }
        return $data;
    }

    public function ExcecSP($db, $nombreSP, $parametros = [], $debug = false)
    {
        try {
            $strExec = "exec [$nombreSP] ";
            $cantParametros = count($parametros);
            if ($cantParametros > 0) {
                $cuentaParametros = 1;
                foreach ($parametros as $kp => $vp) {
                    $comilla = $vp == "string" || $vp == "date" ? "'" : null;
                    $coma = $cuentaParametros < $cantParametros ? "$comilla, " : null;
                    $strExec .= "$comilla$kp$coma";
                    if ($cuentaParametros == $cantParametros) $strExec = $strExec . $comilla;
                    $cuentaParametros++;
                }
            }
            if ($debug) dd($strExec);
            return collect(DB::connection($db)->select($strExec));
        } catch (\Exception $e) {
            return $debug ? dd($e->getMessage()) : $e->getMessage();
        }

    }

    public function backHistory($mensaje)
    {
        return '<script>
            alert("' . $mensaje . '");
            window.history.back();
            </script>';
    }

    function binaryToString($binary)
    {
        $binaries = explode(' ', $binary);

        $string = null;
        foreach ($binaries as $binary) {
            $string .= pack('H*', dechex(bindec($binary)));
        }

        return $string;
    }

    public function getMeses()
    {
        return config("constants.meses");
    }

    public function getPresupuestoAsignado($idPersona)
    {
        return PX_FIN_Presupuesto::from("PX_FIN_Presupuesto as p")
            ->select(
                "pa.Nombre as Pais",
                "pa.Id as IdPais",
                DB::raw("CONCAT(cc.Cod,'-',cc.Nombre) as CentroCosto"),
                DB::raw("CONCAT(cta.CodSap, '-', cta.Nombre) as Cuenta"),
                "p.Id",
                "p.Codigo",
                "pc.Nombre as Clasificacion",
                DB::raw("CONCAT(f.Nombre, '-', m.Nombre) as Franquicia"),
                DB::raw("SUM(pds.Precio) total ")
            )
            ->join("PX_FIN_PresupuestoClasificacion as pc", "pc.Id", "=", "p.IdPresupuestoClasificacion")
            ->join("PX_FIN_PresupuestoDetalle as pd", "p.Id", "=", "pd.IdPresupuesto")
            ->join("PX_FIN_PresupuestoDetalleSub as pds", "pd.Id", "=", "pds.IdPresupuestoDetalle")
            ->join("PX_FIN_CCostoCtaContable as cct", "pd.IdCentroCuenta", "=", "cct.Id")
            ->join("PX_FIN_CuentaBPCSAP as cta", "cct.IdCtaBPC", "=", "cta.Id")
            ->join("PX_SIS_SociedadDepartamentoPersona as sdp", "cct.IdSociedadDeptoPersona", "=", "sdp.Id")
            ->join("PX_FIN_CentroCosto as cc", "sdp.IdCentroCosto", "=", "cc.Id")
            ->join("PX_GP_ProductoCodigos as pcs", "pd.IdProducto", "=", "pcs.Id")
            ->join("PX_GP_Producto as pro", "pcs.IdProducto", "=", "pro.Id")
            ->join("PX_GP_Marca as m", "pro.IdMarca", "=", "m.Id")
            ->join("PX_GP_Franquicia as f", "pcs.IdFranquicia", "=", "f.Id")
            ->join("PX_SIS_Pais as pa", "pds.IdPais", "=", "pa.Id")
            ->with(["PresupuestoDetalle" => function ($query) {
                $query->select('PX_FIN_PresupuestoDetalle.IdPresupuesto',
                    "PX_FIN_PresupuestoDetalle.Id",
                    "sd.Id as IdSubDetalle",
                    "sd.Precio",
                    "sd.IdPais",
                    "sd.Mes"
                )
                    ->join("PX_FIN_PresupuestoDetalleSub as sd", "PX_FIN_PresupuestoDetalle.Id", "=", "sd.IdPresupuestoDetalle");
            }
            ])
            ->where("sdp.IdPersona", $idPersona)
            ->orderBy(DB::raw("CONCAT(cta.CodSap, '-', cta.Nombre)"), "desc")
            ->groupBy("pa.Nombre",
                "pa.Id",
                DB::raw("CONCAT(cc.Cod,'-',cc.Nombre)"),
                DB::raw("CONCAT(cta.CodSap, '-', cta.Nombre)"),
                DB::raw("CONCAT(f.Nombre, '-', m.Nombre)"),
                "p.Id",
                "p.Codigo",
                "pc.Nombre",
                "m.Nombre")
            ->get();


    }


    public function enviaMail($vista, $body, $correo, $nombres, $asunto)
    {
        //$correo = 'hugo.hernandez@exeltis.com';
        if (strtoupper($correo) <> strtoupper("german.garcia@exeltis.com")) {
            try {
                Mail::send($vista, $body, function ($message) use ($correo, $nombres, $asunto) {
                    $message->to($correo, $nombres)
                        ->subject($asunto);
                    $message->from('pointex@exeltis.com', 'POINTEX ERP');
                });
            } catch (\Exception $e) {
                $mensajeReturn = ["Tipo" => "error", "Descripcion" => "No se logro conexión con el servidor de correos"];
                session()->push('msg', $mensajeReturn);
            }
        }
    }

    public function enviaMailMultiple($vista, $body, $correo, $asunto)
    {
        /*Mail::send($vista, $body, function ($message) use ($correo, $asunto) {
            foreach ($correo as $c) {
                $message->to($c["correo"], $c["nombre"])
                    ->subject($asunto);
            }
            $message->from('pointex@exeltis.com', 'POINTEX ERP');
        });*/
    }

    public function getIdDepartamento($IdUsuario)
    {
        $IdDepartamento = PX_SIS_USUARIO::from("PX_SIS_Usuario as u")
            ->Join("PX_SIS_Puesto as p", "p.Id", "=", "u.IdPuesto")
            ->Join("PX_SIS_Departamento as d", "d.Id", "=", "p.IdDepartamento")
            ->Where("u.Id", $IdUsuario)
            ->Select("IdDepartamento")->first();
        return $IdDepartamento->IdDepartamento;
    }

    public function getAprobadores($idPadre, $idArbol)
    {
        $modelArbol = PX_SIS_ArbolAProbaciones::select("Id", "Nombre", "IdPadrePersona", "IdHijoPersona", "Tipo")->find($idArbol);
        if (isset($modelArbol->IdHijoPersona)) {
            $modelPersona = PX_SIS_PERSONA::select(
                DB::raw("CONCAT(Nombres, ' ', Apellidos) as Nombres")
            )->find($modelArbol->IdHijoPersona);
            $modelArbol->Aprobador = $modelPersona->Nombres;
        }
        if ($idPadre) {
            $this->getAprobadores($modelArbol->IdPadrePersona, $modelArbol->IdPadrePersona);
        }
        if ($modelArbol) {
            return $this->arrayAprobadores->push($modelArbol);
        }
    }

    public function insertUpdateEncabezado($nomencla, $arrayInsert, $id)
    {
        $modelEncabezado = new PX_FIN_Ejecucion();
        if ($id) {
            $modelComparation = $modelEncabezado->find($id);
            $arrayInsertUpdate = [];
            foreach ($arrayInsert as $kai => $vai) {
                if (trim($modelComparation->$kai) != trim($vai)) {
                    $arrayInsertUpdate[$kai] = $vai;
                }
            }
            $arrayInsertUpdate["UsuarioModificacion"] = $this->idUsuarioCreacion;
            $modelComparation->update($arrayInsertUpdate);
            return $id;
        } else {
            $id = $modelEncabezado->create($arrayInsert)->Id;
            $arrayInsert["Codigo"] = $nomencla . $this->infoUserLog->IdPersona . "-$id";
            $arrayInsert["UsuarioCreacion"] = $this->idUsuarioCreacion;
            PX_FIN_EjecucionEstatusHistorial::create(["IdEjecucion" => $id, "IdEstatus" => $arrayInsert["IdEstatus"]]);
            return $this->insertUpdateEncabezado($nomencla, $arrayInsert, $id);
        }

    }

    public function replicar($id, $nomencla, $carpeta = null)
    {
        $modelEncabezado = new PX_FIN_Ejecucion();
        $modelDetalle = new PX_FIN_EjecucionDetalle();
        $modelDetalle = $modelDetalle->where("IdEjecucion", $id)->get();
        $arrayInsert = $modelEncabezado->find($id)->toArray();
        $codigoAnt = $arrayInsert["Codigo"];
        $arrayInsert["IdEstatus"] = PX_FIN_EjecucionEstatus::select("Id")->where("Codigo", "I")->first()->Id;
        $arrayInsert["IdArbol"] = $arrayInsert["IdArbolInicio"];
        unset($arrayInsert["Codigo"]);
        unset($arrayInsert["FechaCreacion"]);
        unset($arrayInsert["FechaModificacion"]);
        unset($arrayInsert["UsuarioCreacion"]);
        unset($arrayInsert["UsuarioModificacion"]);
        unset($arrayInsert["Documento"]);
        $idEncabezado = $this->insertUpdateEncabezado($nomencla, $arrayInsert, 0);
        /* $codigoEjecucion = PX_FIN_Ejecucion::select("Codigo")->find($idEncabezado)->Codigo;
         if (Storage::exists("/Pointex/liquidacionesfp/$codigoAnt"))
         {
             Storage::move("/Pointex/liquidacionesfp/$codigoAnt","/Pointex/liquidacionesfp/$codigoEjecucion");
         }*/
        if ($modelDetalle->count() > 0) {
            foreach ($modelDetalle as $v) {
                $arrayInsertd = $v->toArray();
                $codigoAnt = $modelEncabezado->find($id)->Codigo;
                $archivo = "";
                $file = false;
                if ($carpeta && $nomencla != "RQ-") {
                    $urlFile = "/Pointex/$carpeta/$codigoAnt/$v->Id";
                    $carpetaFile = Storage::allFiles($urlFile);
                    if (count($carpetaFile) > 0) {
                        $file = true;
                        $urlFile = $carpetaFile[0];
                        $arrayFile = explode("/", $urlFile);
                        unset($arrayFile[0]);
                        unset($arrayFile[1]);
                        unset($arrayFile[2]);
                        unset($arrayFile[3]);
                        $archivo = implode("/", $arrayFile);
                    }
                }
                $arrayInsertd["IdEjecucion"] = $idEncabezado;
                unset($arrayInsertd["FechaCreacion"]);
                unset($arrayInsertd["FechaModificacion"]);
                unset($arrayInsertd["UsuarioCreacion"]);
                unset($arrayInsertd["UsuarioModificacion"]);
                $idDetalle = $this->saveUpdateDetalle($arrayInsertd, 0);
                $codNewEncabezado = PX_FIN_Ejecucion::select("Codigo")->find($idEncabezado)->Codigo;

                $urlFileNew = "Pointex/$carpeta/$codNewEncabezado/$idDetalle/$archivo";
                if ($file && $nomencla != "RQ-") {
                    Storage::copy($urlFile, $urlFileNew);
                }
//                if ($nomencla == "LQMK-" || $nomencla == "RQ-") {
//                    $modelDetalleMarca = new PX_FIN_EjecucionDetalleProducto();
//                    $modelDetalleMarcaA = $modelDetalleMarca->select("IdProducto")
//                        ->where("IdEjecucionDetalle", $v->Id)
//                        ->get();
//                    if ($modelDetalleMarcaA->count() > 0) {
//                        $arrayMarca = $modelDetalleMarcaA->pluck("IdProducto")
//                            ->transform(function ($v) use ($idDetalle) {
//                                return ["IdEjecucionDetalle" => $idDetalle, "IdProducto" => $v];
//                            })->toArray();
//                        $modelDetalleMarca->insert($arrayMarca);
//                    }
//                }
                if ($nomencla == "LQMK-" || $nomencla == "RQ-") {
                    $modelDetalleMarca = new PX_FIN_EjecucionDetalleMarca();
                    $modelDetalleMarcaA = $modelDetalleMarca->select("IdMarca")
                        ->where("IdEjecucionDetalle", $v->Id)
                        ->get();
                    if ($modelDetalleMarcaA->count() > 0) {
                        $arrayMarca = $modelDetalleMarcaA->pluck("IdMarca")
                            ->transform(function ($v) use ($idDetalle) {
                                return ["IdEjecucionDetalle" => $idDetalle, "IdMarca" => $v];
                            })->toArray();
                        $modelDetalleMarca->insert($arrayMarca);
                    }
                }
            }
        }

        return $idEncabezado;
    }

    public function saveUpdateDetalle($arrayInsert, $id)
    {
        $modelDetalle = new PX_FIN_EjecucionDetalle();
        if ($id) {
            $modelComparation = $modelDetalle->find($id);
            $arrayInsertUpdate = [];
            foreach ($arrayInsert as $kai => $vai) {
                if (trim($modelComparation->$kai) != trim($vai)) {
                    $arrayInsertUpdate[$kai] = $vai;
                }
            }
            $arrayInsertUpdate["UsuarioModificacion"] = $this->idUsuarioCreacion;
            $modelComparation->update($arrayInsertUpdate);
            return $id;
        } else {
            $arrayInsert["UsuarioCreacion"] = $this->idUsuarioCreacion;
            $modelDetalle->create($arrayInsert);
            $idDetalle = PX_FIN_EjecucionDetalle::select("Id")
                ->where("IdEjecucion", $arrayInsert["IdEjecucion"])
                ->orderBy("Id", "DESC")->first();
            return $idDetalle->Id;
        }
    }

    public function saveEjecDetalleMarca($arrayMarcas, $idDetalle)
    {
        if ($arrayMarcas && count($arrayMarcas) > 0) {
            $arrayInsertDetalleMarca = array_map(function ($v) use ($idDetalle) {
                return [
                    "IdEjecucionDetalle" => $idDetalle,
//                    "IdProducto" => $v,
                    "IdMarca" => $v,
                ];
            }, $arrayMarcas);
            //dd($arrayInsertDetalleMarca);
//            $modelEjecucionDetalleMarca = new PX_FIN_EjecucionDetalleProducto();
            $modelEjecucionDetalleMarca = new PX_FIN_EjecucionDetalleMarca();
            $modelEjecucionDetalleMarca->where("IdEjecucionDetalle", $idDetalle)->delete();
            $modelEjecucionDetalleMarca->insert($arrayInsertDetalleMarca);
        }
    }

    public function enviaAprobar($idEjecucuin, $url, $tipoDoc, $table)
    {
        $modelEjecucion = DB::table($table)->find($idEjecucuin);
        $modelArbol = PX_SIS_ArbolAProbaciones::find($modelEjecucion->IdArbol);

        $link = $url . "aprobar=$idEjecucuin";
        $codigo = isset($modelEjecucion->Codigo) ? $modelEjecucion->Codigo : null;

        if (PX_SIS_Aprobaciones::where('IdArbol', $modelEjecucion->IdArbol)->where('IdDoc', $idEjecucuin)->where('IdPersonaAprueba', $modelArbol->IdHijoPersona)->get()->count() == 0) {
            $arrayInsertAp = [
                'IdArbol' => $modelEjecucion->IdArbol,
                'IdPersonaAprueba' => $modelArbol->IdHijoPersona,
                'IdPersonaSolicita' => $this->infoUserLog->Persona->Id,
                'IdTipoDoc' => $this->tipoEjecucion,
                'IdDoc' => $idEjecucuin,
                'Nombre' => "Solicitud de Aprobación de $tipoDoc $codigo",
                'DocumentoUrl' => $link,
                'Estatus' => 1,
                'UsuarioCreacion' => $this->idUsuarioCreacion,
            ];

            $idArbolAp = PX_SIS_Aprobaciones::create($arrayInsertAp)->Id;
            $controllerAprobaciones = new ArbolAprobacionesController();
            $controllerAprobaciones->procesoAprobaciones($idArbolAp, 1, null, $table);
        }
    }

    public function frmLiquidacionU($request, $dataPersona,
                                    $usuarioLogueado, $id, $replicar, $ver = 0, $aprobar = 0, $urlLink, $montoAsignado = false,
                                    $filec, $filesc, $tipoGasto, $VistaLiquidacion, $arrayFranquicia = [])
    {
        $idPerfil = $this->idPerfil->Id;
        $estados = [
            1 => "Pendiente",
            2 => "Aprobado",
            3 => "Rechazado"
        ];
        $tomorrow = date("Y-m-d", time() + 86400);
        $parrafo = null;
        $libs2Load = ["DataTables" => true, "Select2" => true, "SweetAlert" => true];
        $moneda = "USD";
        $modelEstatusHistorial = new PX_FIN_EjecucionEstatusHistorial();
        $modelEncabezado = new PX_FIN_Ejecucion();
        $modelEncabezado->IdPersona = $this->infoUserLog->IdPersona;
        $vmd = $modelEncabezado;
        $vmd->Id = 0;
        $kmd = 0;
        $tipoCambio = 1;
        $modelDetalle = collect([]);
        $archivos = [];
        $estatus = "";
        $totalMlfArray = [];
        $totalUSDArray = [];
        $modelAprobaciones = collect([]);
        $moneda = new PX_SEX_MonedaHistorico();
        if ($id) {
            $arbolEstatus = PX_SIS_ArbolPersona::from("PX_SIS_ArbolPersona as ap")
                ->join("PX_SIS_ArbolAprobaciones as apr", "ap.IdArbol", "=", "apr.Id")
                ->join("PX_FIN_Ejecucion as ej", "apr.Id", "=", "ej.IdArbol")
                ->select("ap.IdArbol", "apr.NombreArbol", "ej.Id as IdRegistro")
                ->where("ej.Id", $id)
                ->first();

            $modelEncabezado = $modelEncabezado->find($id);
            if (!$aprobar && $modelEncabezado->UsuarioCreacion != $this->infoUserLog->Id && !$ver) {
                return false;
            }
            $moneda = $moneda->select("IdMoneda", "Valor")->find($modelEncabezado->IdMoneda);
            $tipoCambio = $moneda ? $moneda->Valor : 1;
            $urlFile = "/Pointex/$filec/$modelEncabezado->Codigo/";
            $archivos = Storage::files($urlFile);
            $modelEstatusHistorial = $modelEstatusHistorial->where("IdEjecucion", $id)
                ->with("Estatus")
                ->orderBy("Id", "desc")
                ->get();
            if ($filesc) $urlFile = "/Pointex/$filesc/$modelEncabezado->Codigo/";
            $modelDetalle = $VistaLiquidacion == "Requisicion" ? $this->modelDetalleRequisiciones($id, $tipoCambio, $urlFile) : $this->modelDetalleLiquidaciones($id, 1, $urlFile);
            $modelAprobacionEsestatus = PX_SIS_Aprobaciones::where("IdDoc", $id)
                ->with("Persona")
                ->whereIn("Estatus", [2, 3])
                ->orderBy("Id", "desc")
                ->get();
        }
        if ($aprobar) {
            $modelAprobaciones = PX_SIS_Aprobaciones::where("IdDoc", $id)
                ->where("Estatus", 1)
                ->where("IdPersonaAprueba", $this->infoUserLog->IdPersona)
                ->where("IdPersonaSolicita", '<>', $this->infoUserLog->IdPersona)
                ->orderBy("Id", "desc")
                ->first();
        }

        $whereMoneda = null;
        if ($VistaLiquidacion != "Requisicion" && $VistaLiquidacion != "Liquidaciontc._subVistaLiquidacionFP" && $VistaLiquidacion != "Liquidaciongv._subVistaLiquidacionFP") {
            $paisEjecucion = PX_SIS_PERSONA::from("PX_SIS_Persona as p")
                ->select("c.IdPais")
                ->join("PX_SIS_Contacto as c", "p.Id", "=", "c.IdPersona")
                ->where("p.Id", $modelEncabezado->IdPersona)
                ->first();
            $whereMoneda = [
                "IdPais" => $paisEjecucion->IdPais
            ];
        }
        $modelArbolPersona = PX_SIS_ArbolPersona::from("PX_SIS_ArbolPersona as ap")
            ->select("ap.IdArbol", "apr.NombreArbol", "apr.IdPadrePersona")
            ->join("PX_SIS_ArbolAprobaciones as apr", "ap.IdArbol", "=", "apr.Id")
            ->where("ap.IdPersona", $modelEncabezado->IdPersona)
            ->where("apr.IdPerfil", $this->tipoEjecucion)
            ->where("apr.Estado", "=", 1)
            ->get();

        $aprobadores = collect();

        if ($request->crear) {
            $cantArbolesAsignados = $modelArbolPersona->count();
            if ($cantArbolesAsignados == 0) {
                return false;
            }
        } else {
            $aprobadoresMpdel = $modelArbolPersona->where("IdArbol", "$modelEncabezado->IdArbolInicio")->first();
            if ($aprobadoresMpdel) {
                $aprobadores = $this->getAprobadores($aprobadoresMpdel->IdPadrePersona, $modelEncabezado->IdArbolInicio);
            }
        }
        $arrayArbol = $modelArbolPersona->pluck("NombreArbol", "IdArbol")->toArray();
        $idPersonaRecolect = $ver && $id ? $modelEncabezado->IdPersona : $dataPersona->Id;
        $uso = $this->getEntidadDepCentroCuenta($idPersonaRecolect, null, $idPerfil);
        $arrayEntidades = $this->TableUniversal("PX_SIS_Entidad", [
            "Id" => $uso->pluck("IdEntidad")->unique()->toArray()
        ]);
        $cosnultaIdMonedaCurso = PX_SEX_Moneda::find($moneda->IdMoneda);
        if ($cosnultaIdMonedaCurso && $ver) {
            $arrayMoneda = collect([
                $moneda->IdMoneda => $cosnultaIdMonedaCurso->Nombre
            ]);
        } else {
            $arrayMoneda = $this->TableUniversal("PX_SEX_Moneda", $whereMoneda);
        }

        $arrayDepartamento = $this->TableUniversal("PX_SIS_Departamento", [
            "Id" => $uso->pluck("IdDepartamento")->unique()->toArray()
        ]);
        $arrayPais = $this->TableUniversal("PX_SIS_Pais", null, null, false);
        $arrayPersonas = $this->TableUniversal("PX_SIS_Persona", [
            "Id" => $uso->pluck("IdPersona")->unique()->toArray()
        ]);

        $whereCentroCosto["Id"] = $uso->where("IdEntidad", "$modelEncabezado->IdEntidad")->pluck("IdCentroCosto")->unique()->toArray();
        $arrayCentroCosto = $this->TableUniversal("PX_FIN_CentroCosto", $ver ? null : $whereCentroCosto);

        $usoCuenta = $this->getEntidadDepCentroCuenta($idPersonaRecolect, null, $idPerfil, $arrayCentroCosto->keys());
        $arrayCuenta = $this->TableUniversal("PX_FIN_CuentaBPCSAP", !$ver ? [
            "Id" => $usoCuenta->pluck("IdCtaBPC")->unique()->toArray()
        ] : [], null, true, false);
        $arrayGasto = $this->TableUniversal("PX_FIN_TipoGasto", ["Tipo" => $tipoGasto]);
        if ($VistaLiquidacion == "Requisicion" || $VistaLiquidacion == "Liquidacionfp._subVistaLiquidacionFP") {
//            $arrayMarca = PX_GP_ProductoCodigos::from("PX_GP_ProductoCodigos as pc")
//                ->select("pc.Id", DB::raw("CONCAT(pc.CodigoSap, '-',p.Presentacion) Presentacion"))
//                ->join("PX_GP_Producto as p", "pc.IdProducto", "=", "p.id")
//                ->where("pc.Estado", 1)
//                ->where("p.TipoPresentacion", "Venta")
//                ->get()
//                ->pluck("Presentacion", "Id");
//            $arrayMarca = $arrayMarca->sort();
            $arrayMarca = PX_GP_Marca::select("Id", "Nombre")->get()->pluck("Nombre", "Id");
            $arrayMarca = $arrayMarca->sort();
        }

        $controller = $this;
        return view("Sistema.Pointex.Modulo.Finanzas.$VistaLiquidacion._subVistas._frmCrear", get_defined_vars());
    }

    public function getMonedaPaisUser($idPersona)
    {
        $paisEjecucion = PX_SIS_PERSONA::from("PX_SIS_Persona as p")
            ->select("c.IdPais")
            ->join("PX_SIS_Contacto as c", "p.Id", "=", "c.IdPersona")
            ->where("p.Id", $idPersona)
            ->first();
        $modelMoneda = PX_SEX_Moneda::select("Nombre")->where("IdPais", $paisEjecucion->IdPais)->first();
        return isset($modelMoneda->Nombre) ? $modelMoneda->Nombre : null;
    }

    public function getMarcasDetalle($idDetalle)
    {
//        $modelEjecucionDetalleMarca = new PX_FIN_EjecucionDetalleProducto();
        $modelEjecucionDetalleMarca = new PX_FIN_EjecucionDetalleMarca();
        return $modelEjecucionDetalleMarca->where("IdEjecucionDetalle", $idDetalle)->get();
    }

    public function modelDetalleLiquidaciones($id, $tipoCambio, $urlFile)
    {
        return PX_FIN_EjecucionDetalle::where("IdEjecucion", $id)
            ->orderBy("Id", "desc")
            ->get()->each(function ($v) use ($tipoCambio, $urlFile) {
                $arrayDoc = Storage::allFiles($urlFile . $v->Id);
                $precioML = ((float)$v->Precio * $tipoCambio);
                $totalMl = $precioML;
                $v->PrecioMl = number_format($precioML, 2, '.', ',');
                $v->SubTotalMl = number_format($totalMl, 2, '.', '');
                $v->TotalUSD = number_format((float)$v->Precio, 2, '.', '');
                $v->urlDoc = count($arrayDoc) > 0 ? $arrayDoc[0] : null;
            });
    }

    public function modelDetalleRequisiciones($id, $tipoCambio)
    {
        return PX_FIN_EjecucionDetalle::where("IdEjecucion", $id)
            ->orderBy("Id", "desc")
            ->get()->each(function ($v) use ($tipoCambio) {
                $cantidad = (float)$v->Cantidad;
                $precioML = ((float)$v->Precio * $tipoCambio);
                $totalMl = $precioML * $cantidad;
                $v->PrecioMl = number_format($precioML, 2, '.', ',');
                $v->SubTotalMl = number_format($totalMl, 2, '.', '');
                $v->TotalUSD = number_format($cantidad * (float)$v->Precio, 2, '.', '');
            });
    }

    public function fromExcelToLinux($excel_time)
    {
        return ($excel_time - 25568) * 86400;
    }

    public function calculaColita($consulta, $mes, $anio)
    {
        return round(PX_FIN_Movimiento::from("PX_FIN_Movimiento as m")
                ->join("PX_FIN_PersonaMoto as pm", "m.IdPersonaMonto", "=", "pm.Id")
                ->select(
                    DB::raw("SUM(m.Monto) as total")
                )
                ->where("pm.IdTipoEjecucion", $this->tipoEjecucion)
                ->where("pm.IdPersona", $this->infoUserLog->IdPersona)
                ->where(DB::raw("MONTH(m.FechaMovimiento)"), "<", $mes)
                ->where(DB::raw("YEAR(m.FechaMovimiento)"), $anio)
                ->where("m.Tipo", 1)
                ->get()->sum("total"), 2) - round($consulta->whereNotIn("EstatusCodigo", ["R", "I"])->sum("Total"), 2);
    }

    public function tblMsg()
    {
        return collect(DB::select("select top 1 Mensaje from MD_Mensaje order by Id Desc"))->first()->Mensaje;
    }

    public function ValidaProductoPais($tab1, $posicionInicio)
    {
        $arrayProductos = collect();
        $arrayPaises = collect();
        $dataInsert = collect();
        $tab1->each(function ($v, $k) use ($posicionInicio, $arrayProductos, $arrayPaises, $dataInsert) {
            if ($k > $posicionInicio) {
                $arrayProductos->push(str_replace(",", "", str_replace(".", '', str_replace(" ", "", trim($v->get(1) . "-" . $v->get(2) . "-" . $v->get(3))))));
                $arrayPaises->push(trim($v->get(0)));
                $dataInsert->push($v);
            }
        });
        $arrayProductos = $arrayProductos->filter()->values()->unique()->sort()->toArray();
        $arrayPaises = $arrayPaises->filter()->values()->unique()->sort()->toArray();

        $dataPais = PX_SIS_PAIS::select("CodigoBi", "Id")
            ->where("TipoUso", 1)
            ->whereIn("CodigoBi", $arrayPaises)
            ->get()
            ->pluck("Id", "CodigoBi");
        $dataProductos = PX_GP_ProductoCodigos::from("PX_GP_ProductoCodigos as pc")
            ->join("PX_GP_Producto as p", "pc.IdProducto", "=", "p.Id")
            ->select(DB::raw("pc.Id, REPLACE(REPLACE(REPLACE(CONCAT(pc.CodigoSap, '-',p.Presentacion, '-', p.TipoPresentacion), ' ', ''), '.', ''), ',','') as CodigoSap"))
            ->whereIn(DB::raw("REPLACE(REPLACE(REPLACE(CONCAT(pc.CodigoSap, '-',p.Presentacion, '-', p.TipoPresentacion), ' ', ''), '.', ''), ',','')"), $arrayProductos)
            ->groupBy("pc.Id", DB::raw("CONCAT(pc.CodigoSap, '-',p.Presentacion, '-', p.TipoPresentacion)"))
            ->get()->pluck("Id", "CodigoSap")->sort();


        foreach ($arrayProductos as $kt => $vt) {
            if ($dataProductos->get($vt) === null) {
                $mensajeReturn = ["Tipo" => "error", "Descripcion" => "Error No se encontro el producto $vt"];
                session()->push('msg', $mensajeReturn);
                return false;
            }
        }


        foreach ($arrayPaises as $kt => $vt) {
            if ($dataPais->get($vt) === null) {
                $mensajeReturn = ["Tipo" => "error", "Descripcion" => "Error No se encontro el país $vt"];
                session()->push('msg', $mensajeReturn);
                return false;
            }
        }

        return ["dataInsert" => $dataInsert, "dataPais" => $dataPais, "dataProductos" => $dataProductos];

    }

    public function stringPDF(Request $request)
    {
        $html = $request->decode ? $request->html : utf8_encode(base64_decode($request->html, true));
        $str = $request->isMethod("GET") ? trim($request->html) : $html;
        $content = $request->link ? $request->link : view("Sistema.Pointex.LayOuts.layoutuniversal", get_defined_vars())->render();
        $pdf = new \mikehaertl\wkhtmlto\Pdf();
        $pdf->addPage($content);
        //$pdf->send(trim($request->codigo));

        if ($request->input("link")) {
            $pdf->send(trim($request->input("codigo")));
        }
        if ($request->descargar) {
            if (!$pdf->send(trim($request->codigo) . ".pdf")) {
                $error = $pdf->getError();
                // ... handle error here
            }
        }
        return base64_encode($pdf->toString());

    }

    public function getImgEjecucion($carpeta, $codigo)
    {
        $ver = isset($_GET["ver"]) ? $_GET["ver"] : false;
        $archivos = "";
        $rutaCodigo = "/Pointex/$carpeta/$codigo/";
        $directorios = Storage::directories($rutaCodigo);
        $ultimo = count($directorios) > 0 ? array_map(function ($v) {
            $cuenta = count(explode(".", $v)) > 1 ? explode(".", $v)[1] : null;
            if ($cuenta) {
                return Storage::files("/$v");
            }
        }, $directorios) : null;
        $files = collect($ultimo)->filter()->collapse();
        foreach ($files as $k => $vmd) {
            $tipoFile = strtoupper(substr($vmd, -3));
            $isPdf = $tipoFile == "PDF";
            $src = $isPdf ?  "/Vendor/Plantillas/Apex/app-assets/img/elements/pdf-mini.png" : "/pointex/getArchivo?ruta=$vmd";
            $href = $isPdf ? "/pointex/getArchivo?ruta=$vmd" : null;
            try { $nombreFile = explode("/", $vmd)[3]; }catch (\Exception $e) { $nombreFile = "Error en el Nombre";}
            $btnBorrar = !$ver ? '<p><a href="javascript:void(0)" onclick="borrarSoporteDetalle(\''."$rutaCodigo/$nombreFile".'\')" class="btn danger text-center" role="button" title="Borrar '.$nombreFile.'"><i class="ft-trash-2"></i></a> </p>' : null;
            $archivos .= '<div class="col-sm-3 col-md-2 text-center">
                                <div class="thumbnail">
                                <div class="text-center" style="height: 121px;background: #f3f5f8" title="'.$nombreFile.'">
                                    <img style="max-height: 121px;"
                                    class="gallery1 img-thumbnail" src="' . $src . '" href="' . $href . '">
                                  </div>
                                  <div class="caption">
                                  <small style="font-size: 8px">'.str_limit($nombreFile, 10).'</small>
                                    '.$btnBorrar.'
                                  </div>
                                </div>
                              </div>';
        }
        echo '<div class="bs-example" data-example-id="thumbnails-with-custom-content">
                <div class="row">
                ' . $archivos . '
                </div>
            </div>';
    }

    public function saveImgeDetalle(Request $request)
    {
        try {
            $file = $request->file("image");
            $fileName = str_replace("/", "", str_replace("+", "", $file->getClientOriginalName()));
            $fileName = str_replace("&", "", $fileName);
            $fileName = str_replace("#", "", $fileName);
            $fileName = str_replace("'", "", $fileName);
            $fileName = str_replace('"', "", $fileName);
            $fileName = str_replace('@', "", $fileName);

            $ruta = "/Pointex/$request->txtCarpeta/$request->codigoFileDetalle/$fileName".date("ymdhis");
            Storage::deleteDirectory($ruta);
           dd( Storage::put($ruta, $file));
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function deleteImgeDetalle(Request $request)
    {
        try {
            Storage::deleteDirectory($request->ruta);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}
