<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/php', function () {
    try {
        $useragent = $_SERVER["HTTP_USER_AGENT"];
        if(stripos($useragent, "mobile")!== false){
            return "mobile device";
        }else{
            return "desktop or laptop computer";
        }
        phpinfo();
        exit();
    }catch (\Exception $e){
        dd($e->getMessage());
    }

});

Route::any('/string_pdf', "BaseController@stringPDF");
Route::any('/get_img_ejecucion/{carpeta}/{codigo}', "BaseController@getImgEjecucion");
Route::post('/save_imge_detalle', 'BaseController@saveImgeDetalle');
Route::post('/delete_imge_detalle', 'BaseController@deleteImgeDetalle');
Route::get('/pdf_ventas', function () {
    return view("ventas", get_defined_vars());
});

Route::get('pruebas', 'CurrencyController@pruebas');
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('/', 'Auth\LoginController@showLogin');
Route::get('/otonio', function (\Illuminate\Http\Request $request) {
    $ruta = $request->input("ruta");
    return view("otonio", get_defined_vars());

});

Route::get('/cancer_mama', function (\Illuminate\Http\Request $request) {
    $ruta = $request->input("ruta");
    return view("cancer_mama", get_defined_vars());

});
Route::any('/pointex/recuperar', 'Auth\LoginController@showRecuperar');
Route::get('/salir', 'Auth\LoginController@salir');
Route::group(['prefix' => '/pointex', 'namespace' => 'Auth'], function () {
    Route::get('/', 'LoginController@showLogin');
    Route::any('validar', 'LoginController@showLogin');
});
Route::get('/photo_zoom/', function (\Illuminate\Http\Request $request) {
    $ruta = $request->input("ruta");
    return view("photo_zoom", get_defined_vars());
});
Route::get('/archivos/ver', 'Sistema\Pointex\Modulo\Archivos\ArchivosController@index');
Route::get('/test', 'Sistema\Pointex\TestController@index');
Route::get('/test/citas', 'Sistema\Pointex\TestController@citas');
Route::get('/test/guarda', 'Sistema\Pointex\TestController@guarda');
Route::any('/test/borrar/{id}', 'Sistema\Pointex\TestController@borrar');
Route::get('/test/despacho', 'Sistema\Pointex\TestController@despacho');
Route::group(['prefix' => 'archivos/', 'namespace' => 'Sistema\Pointex\Modulo\Multiples'], function () {
    Route::get('carga_venta/{codcliente}', 'MultiplesController@stockCarga');
    Route::get('carga_inv/{codcliente}', 'MultiplesController@ventaInv');
    Route::get('venta_daf_consolidado/{excel}', 'MultiplesController@consolidadoVenta');
    Route::get('inv_daf_consolidado/{excel}', 'MultiplesController@consolidadoInv');
    Route::post('store_file/{codcliente}', 'MultiplesController@storeFile');
});
Route::get('/getArchivo', 'Sistema\Pointex\PointexController@GetArchivo');

Route::get('/agenda/{administrador}/{Menu}', 'Sistema\Pointex\Modulo\Multiples\ExtencionController@index')->where(array('administrador' => '[0-1]+'));
Route::get("/Extenciones/Agregar/", 'Sistema\Pointex\Modulo\Multiples\ExtencionController@Formularios');
Route::post("/Extenciones/Agregar", 'Sistema\Pointex\Modulo\Multiples\ExtencionController@store');
Route::get("/EditarExtencion/{id}/edit", 'Sistema\Pointex\Modulo\Multiples\ExtencionController@Formularios');
Route::get("/EliminarExtencion/{id}", "Sistema\Pointex\Modulo\Multiples\ExtencionController@destroy");
Route::get("/Extenciones/correo/{id}", "Sistema\Pointex\Modulo\Multiples\ExtencionController@Correo");

Route::group(['middleware' => ['pointex']], function () {

    //rutas del sistema interno
    Route::get('/sendmail', 'SendEmailController@index');
    Route::post('/send', 'SendEmailController@send');
    Route::group(['prefix' => 'pointex', 'namespace' => 'Sistema\Pointex'], function () {
//
        Route::get('/inicio', 'PointexController@showInicio');
        Route::get('/reservar', function (\Illuminate\Http\Request $request) {
            return view("Sistema.Pointex.reservacion", get_defined_vars());
        });
        Route::get('/perfil', 'PointexController@showPerfil');
        Route::post('/mod_clave', 'PointexController@modClaveUsuario');
        Route::post('/mod_perfil', 'PointexController@modPerfilUsuario');
        Route::get('/ayuda', 'PointexController@showAyuda');
        Route::get('/getArchivo', 'PointexController@GetArchivo');
        Route::post('verArchivo', 'PointexController@InitVerArchivo');


        //Mesa de Ayuda
        Route::group(['prefix' => 'ticket', 'namespace' => 'Modulo\Ticket'], function () {
            Route::get('/osticket/{permisos}', 'TicketController@index');
            Route::get('/osticket', 'TicketController@index');
            Route::post('/save', 'TicketController@save');
            Route::any('/get_data/{id}', 'TicketController@getData');
            Route::any('/iniciar/{id}', 'TicketController@Iniciar');
            Route::any('/confirmar/{id}/{tipo}', 'TicketController@Confirmar');
            Route::any('/finalizar/{id}/{observacion}', 'TicketController@Finalizar');
            Route::get('/destroy/{id}', 'TicketController@destroy');
            Route::get('/enviar/{id}', 'TicketController@enviar');
            Route::get('/procesos/{id}', 'TicketController@Procesos');
            Route::post('/save_asignacion', 'TicketController@SaveAsignacion');
            Route::post('/send', 'TicketController@sendComentario');
        });

        //Módulo Administración
        Route::group(['prefix' => 'administracion', 'namespace' => 'Modulo\Administracion'], function () {

            Route::any('/usuarios', 'AdminController@showUsuarios')->middleware("checkURL");

            Route::any('/accesos/roles', 'AdminController@showRoles')->middleware("checkURL");
            Route::post('/accesos/activar_roles', 'AdminController@activarRoles');
            Route::post('/reporteRoles', 'AdminController@reporteRoles');
            Route::post('/accesos/act_sub_menu', 'AdminController@activarSubMenu');
            Route::get('/modulos', 'AdminController@showModulos')->middleware("checkURL");
            Route::post('/usuarios/val_usuario', 'AdminController@val_usuario');
            Route::post('/usuarios/val_usuario/{id}', 'AdminController@val_usuario_id');
            Route::post('/usuarios/val_correo', 'AdminController@val_correo');
            Route::post('/usuarios/estado_user/{id}', 'AdminController@estadoUser');
            Route::post('/usuarios/renew_user_pass/{id}', 'AdminController@renewUserPass');
            Route::post('/usuarios/modificar_user', 'AdminController@modificarUser');
            Route::post('/usuarios/crear_user', 'AdminController@crearUser');
            Route::post('/usuarios/info/{id}', 'AdminController@infoUsuario');

            /**
             * Rutas para Estructuras de sistemas
             */

            //Sistemas
            Route::any('/accesos/sistemas', 'EstructuraController@showSistemas')->middleware("checkURL");
            Route::post('/accesos/estado_sistema/{id}', 'EstructuraController@estadoSistema');
            Route::post('/accesos/val_sistema_id', 'EstructuraController@validarSistemaById');
            Route::post('/accesos/val_sistema', 'EstructuraController@validarSistema');
            Route::post('/accesos/modificar_sistema', 'EstructuraController@modificarSistema');
            Route::post('/accesos/crear_sistema', 'EstructuraController@crearSistema');

            //Módulos
            Route::any('/accesos/modulos', 'EstructuraController@showModulo')->middleware("checkURL");
            Route::post('/accesos/modulos/estado_modulo/{id}', 'EstructuraController@estadoModulo');
            Route::post('/accesos/modulos/val_modulo_id', 'EstructuraController@validarModuloById');
            Route::post('/accesos/modulos/val_modulo', 'EstructuraController@validarModulo');
            Route::post('/accesos/modulos/modificar_modulo', 'EstructuraController@modificarModulo');
            Route::post('/accesos/modulos/crear_modulo', 'EstructuraController@crearModulo');


            //Menús
            Route::get('/accesos/menus', 'EstructuraController@showMenu')->middleware("checkURL");
            Route::post('/accesos/menus/{sistema}/{modulo}', 'EstructuraController@showMenu');
            Route::post('/accesos/menus/estado_menu/{id}', 'EstructuraController@estadoMenu');
            Route::post('/accesos/menus/val_menu_id', 'EstructuraController@validarMenuById');
            Route::post('/accesos/menus/val_menu', 'EstructuraController@validarMenu');
            Route::post('/accesos/menus/modificar_menu', 'EstructuraController@modificarMenu');
            Route::post('/accesos/menus/crear_menu', 'EstructuraController@crearMenu');


            //SubMenús
            Route::get('/accesos/sub_menus', 'EstructuraController@showSubMenu')->middleware("checkURL");
            Route::post('/accesos/sub_menus/{sistema}/{modulo}/{menu}', 'EstructuraController@showSubMenu');
            Route::post('/accesos/sub_menus/estado_sub_menu/{id}', 'EstructuraController@estadoSubMenu');
            Route::post('/accesos/sub_menus/val_sub_menu_id', 'EstructuraController@validarSubMenuById');
            Route::post('/accesos/sub_menus/val_sub_menu', 'EstructuraController@validarSubMenu');
            Route::post('/accesos/sub_menus/modificar_sub_menu', 'EstructuraController@modificarSubMenu');
            Route::post('/accesos/sub_menus/crear_sub_menu', 'EstructuraController@crearSubMenu');


            //Rutas de catálogo país

            Route::get('/catalogos/pais', 'CatalogosController@showPaises')->middleware("checkURL");
            Route::post('/catalogos/pais/crear_pais', 'CatalogosController@crearPais');
            Route::post('/catalogos/pais/val_pais', 'CatalogosController@val_pais');
            Route::post('/catalogos/pais/val_pais_id', 'CatalogosController@val_pais_id');
            Route::post('/catalogos/pais/estado_pais/{id}', 'CatalogosController@estadoPais');
            Route::post('/catalogos/pais/modificar_pais', 'CatalogosController@modificarPais');


            //RUTAS PARA ASIGNAR MODULOS A PERFILES
            Route::get('/accesos/asignar_permisos', 'CatalogosController@showTipoUsers')->middleware("checkURL");
            Route::post('/accesos/asignar_permisos/delete_tipo', 'CatalogosController@deletePermisos');
            Route::post('/accesos/asignar_permisos/modificar_tipo', 'CatalogosController@updateTipoUser');


            //RUTAS PARA PERFILES A USUARIOS
            Route::get('/accesos/asignar_perfil', 'CatalogosController@showAsignarPerfil')->middleware("checkURL");
            Route::post('/accesos/asignar_perfil/crear', 'CatalogosController@crearUsuarioPerfil');
            Route::post('/accesos/asignar_perfil/delete', 'CatalogosController@eliminarPerfil');
            Route::post('/accesos/asignar_perfil/delete_usuario', 'CatalogosController@deleteUsuarioPerfil');

            //rutas para catálgo de perfiles
            Route::get('/catalogos/perfil', 'CatalogosController@showPerfil')->middleware("checkURL");
            Route::post('/catalogos/perfil/estado_perfil/{id}', 'CatalogosController@estadoPerfil');
            Route::post('/catalogos/perfil/validar_Perfil', 'CatalogosController@valPerfil');
            Route::post('/catalogos/perfil/validar_PerfilId', 'CatalogosController@valPerfilId');
            Route::post('/catalogos/perfil/modificarPerfil', 'CatalogosController@updatePerfil');
            Route::post('/catalogos/perfil/crearPerfil', 'CatalogosController@crearPerfil');
            Route::post('/catalogos/perfil/eliminar', 'CatalogosController@deletePerfil');
        });


        Route::group(['prefix' => 'people', 'namespace' => 'Modulo\People'], function () {
            //Altas y Bajas de Usuarios
//            Route::group(['prefix' => 'people'], function () {
            Route::get('/', 'PeopleController@Usuarios')->middleware("checkURL");
            Route::get('/crear', 'PeopleController@frmUsuarios');
            Route::post('/save', 'PeopleController@saveUsuarios');
            Route::get('/ver{id}', 'PeopleController@Ver');
            Route::get('/edit{id}', 'PeopleController@frmUsuarios');
            Route::get('/edit{id}/{ver}', 'PeopleController@frmUsuarios');
            Route::get('/pdf{id}', 'PeopleController@pdfUsuarios');
            Route::get('/aprobacion/{id}', 'PeopleController@Aprobacion');
            Route::get('/info/{id}', 'PeopleController@pdfUsuarios');
            Route::get('/destroy/{id}', 'PeopleController@destroyUsuarios');

            Route::post('/baja/save', 'PeopleController@saveBaja');
            Route::get('/baja/edit{id}', 'PeopleController@frmBajaUsuarios');
            Route::get('/pdf/baja{id}', 'PeopleController@pdfUsuariosBaja');
            Route::get('/aprobacion/baja/{id}', 'PeopleController@AprobacionBaja');
            Route::get('/info/baja/{id}', 'PeopleController@pdfUsuariosBaja');
//            });

            //Catalogos
            Route::group(['prefix' => 'catalogos'], function () {
                Route::group(['prefix' => 'asuetos'], function () {
                    Route::get('/{codigo}', 'PlanificacionAsuetoController@planificacion');
                    Route::get('/guarda_planificacion', 'PlanificacionAsuetoController@guardaPlanificacion');
                    Route::post('/guarda_planificacion', 'PlanificacionAsuetoController@SavePlanificacion');
                    Route::any('/borra_plani/{id}', 'PlanificacionAsuetoController@borraPlani');
                });

                Route::group(['prefix' => 'motivo'], function () {
                    Route::get('/reglas_people', 'ReglaController@reglasMotivo');
                    Route::post('/reglas_people', 'ReglaController@reglasMotivo');
                });
            });

            //Ausencias
            Route::group(['prefix' => 'ausencias'], function () {
                Route::get('/', 'AusenciasController@Index');
                Route::post('/save_encabezado', 'AusenciasController@Save');
                Route::any('/borrar/{id}', 'AusenciasController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}/{IdPersona}', 'AusenciasController@cambiaEstatus');
                Route::post('/save_doc', 'AusenciasController@saveDoc');
                Route::any('/delete_doc/{cod}/{doc}', 'AusenciasController@deleteDoc');
                Route::any('/get_regla/{id}', 'AusenciasController@GetReglaEmergencia');
            });

            //Control de Vacaciones
            Route::group(['prefix' => 'vacaciones'], function () {
                Route::group(['prefix' => 'control'], function () {
                    Route::get('/', 'VacacionesController@Index');
                    Route::post('/save_encabezado', 'VacacionesController@Save');
                    Route::any('/cambia_estatus/{id}/{estado}/{IdPersona}', 'VacacionesController@cambiaEstatus');
                    Route::any('/borrar/{id}', 'VacacionesController@borrar');
                    Route::any('/get_dias/{id}', 'VacacionesController@GetDias');
                    Route::any('/get_regla/{id}', 'VacacionesController@GetReglaEmergencia');
                });
            });
            //Anulacion de Solicitud
            Route::group(['prefix' => 'anulacion'], function () {
                Route::get('/', 'AnulacionController@index');
                Route::post('/save_encabezado', 'AnulacionController@SaveEnc');
                Route::any('/borrar/{id}', 'AnulacionController@borrar');
                Route::post('/save', 'AnulacionController@RazonSave');
                Route::any('/cambia_estatus/{id}/{estado}', 'AnulacionController@cambiaEstatus');
            });
            //Reportes
            Route::group(['prefix' => 'reporte'], function () {
                //vacaciones
                Route::get('/', 'ReporteVacacionesController@reporte');
                Route::get('/pdf/{id}/{pais}', 'ReporteVacacionesController@PrintPDF');
            });
            //Ajustes People

            Route::group(['prefix' => 'ajustes'], function () {
                Route::get('/', 'AjustesPeopleController@index');
                Route::post('/save', 'AjustesPeopleController@save');

                Route::get('/dias/autorizados', 'AjustesPeopleController@indexDiasAutorizados');
                Route::post('/save/dias/autorizados', 'AjustesPeopleController@saveDiasAutorizados');
                Route::any('/dias/autorizados/borrar/{id}', 'AjustesPeopleController@borrar');
                Route::any('/dias/autorizados/cambia_estatus/{id}/{estado}', 'AjustesPeopleController@cambiaEstatus');
                Route::any('/get_arbol/{id}', 'AjustesPeopleController@GetArbol');
            });
        });

        Route::group(['prefix' => 'archivos', 'namespace' => 'Modulo\Archivos'], function () {
            Route::get('/admin', 'ArchivosController@admin');
            Route::get('/ver', 'ArchivosController@index');
            Route::post('/save_archivos', 'ArchivosController@saveArchivos');
            Route::any('/delete_file/{directorio}', 'ArchivosController@deleteFile');

        });

        //Módulo de Gestión del Producto
        Route::group(['prefix' => 'gestion', 'namespace' => 'Modulo\GestionProducto'], function () {

            //Menú Catálogos
            Route::group(['prefix' => 'catalogos'], function () {
                //Control Franquicias
                Route::get('/Franquicias', 'FranquiciaController@index')->middleware("checkURL");
                Route::post('/Franquicias', 'FranquiciaController@store');
                Route::get('/borrar/{id}', 'FranquiciaController@destroy');


                Route::post('/insert_in_table', 'CatalogosController@insertInTable')/*->middleware("checkURL")*/
                ;
                Route::any('/delete/{tabla}/{id}', 'CatalogosController@delete')/*->middleware("checkURL")*/
                ;
                Route::any('/{tabla}', 'CatalogosController@show')/*->middleware("checkURL")*/
                ;
                Route::any('/{tabla}/{form}', 'CatalogosController@show')/*->middleware("checkURL")*/
                ;
                Route::any('/select/{modelo}/{id}/{value}', 'CatalogosController@reloadCat')/*->middleware("checkURL")*/
                ;


            });

            //Marketing
            Route::group(['prefix' => 'marca'], function () {
                Route::any('/crear_listar', 'MarcasController@showMarcas')->middleware("checkURL");
                Route::post('/nueva_marca', 'MarcasController@nuevaMarca');
                Route::post('/inset_in_tables', 'MarcasController@insetInTables');
                Route::any('/val_marca/{Id}/{Nombre}', 'MarcasController@valMarca');
                Route::post('/mod_marca', 'MarcasController@modificarMarca');
                Route::post('/mod_producto', 'MarcasController@modificarProducto');
                Route::any('/data_productos/{idMarca}', 'MarcasController@dataProductos');
                Route::any('/delete_producto/{id}', 'MarcasController@deleteProducto');
                Route::any('/delete_marca/{id}', 'MarcasController@deleteMarca');
            });
            //Supply
            Route::group(['prefix' => 'producto'], function () {
                Route::any('/supply', 'ProductoController@showProductos')->middleware("checkURL");
                Route::any('/supply/delete/{id}', 'ProductoController@delete');
                Route::post('/supply', 'ProductoController@saveProductoCodigos');
                Route::post('/supply/save', 'ProductoController@ProductoSave');
            });
            //regulatorio
            Route::group(['prefix' => 'regulatorio'], function () {
                Route::get('/crear_listar', 'RegulatorioController@index');
                Route::post('/crear_registro_marca', 'RegulatorioController@crearRegistroMarca');
                Route::post('/crear_registro_sanitario', 'RegulatorioController@crearRegistroSanitario');
                Route::any('/eliminar_registro_marca/{idRegMarca}', 'RegulatorioController@eliminarRegistroMarca');
                Route::any('/eliminar_registro_sanitario/{idRegSanitario}', 'RegulatorioController@eliminarRegistroSanitario');
                Route::any('/get_presentaciones/{idMarca}', 'RegulatorioController@getPresentaciones');
                Route::any('/delete_enlazar/{id}', 'RegulatorioController@deleteEnlazar');
                Route::post('/enlazar', 'RegulatorioController@enlazar');

                //Presentacio
                Route::get('/edit_presentacion', 'RegulatorioController@PresentacionesRegistradas');
                Route::get('/agregar_presentacion', 'RegulatorioController@FrmPresentacion');
                Route::get('/agregar_presentacion/{id}/edit', 'RegulatorioController@FrmPresentacion');
                Route::post('/EditarPresentacion', 'RegulatorioController@storePresentacion');
                Route::get("/EliminarPresentacion/{id}", "RegulatorioController@destroyPresentacion");

                //Estatus
                Route::get('/edit_estatus', 'RegulatorioController@EstatusRegistradas');
                Route::get('/agregar_estatus', 'RegulatorioController@FrmEstatus');
                Route::get('/agregar_estatus/{id}/edit', 'RegulatorioController@FrmEstatus');
                Route::post('/Editarestatus', 'RegulatorioController@storeEstatus');
                Route::get("/Eliminarestatus/{id}", "RegulatorioController@destroyEstatus");

                //Principios Activos
                Route::get('/edit_principio_a', 'RegulatorioController@PrincipioARegistradas');
                Route::get('/agregar_principio_a', 'RegulatorioController@FrmPrincipioA');
                Route::get('/agregar_principio_a/{id}/edit', 'RegulatorioController@FrmPrincipioA');
                Route::post('/Editarprincipio_a', 'RegulatorioController@storePrincipioA');
                Route::get("/Eliminarprincipio_a/{id}", "RegulatorioController@destroyPrincipioA");

                //Principios Activos
                Route::get('/edit_farmaceutica', 'RegulatorioController@FarmaceuticaRegistradas');
                Route::get('/agregar_farmaceutica', 'RegulatorioController@FrmFarmaceutica');
                Route::get('/agregar_farmaceutica/{id}/edit', 'RegulatorioController@FrmFarmaceutica');
                Route::post('/Editarfarmaceutica', 'RegulatorioController@storeFarmaceutica');
                Route::get("/Eliminarfarmaceutica/{id}", "RegulatorioController@destroyFarmaceutica");

                //Concentracion
                Route::get('/edit_concentracion', 'RegulatorioController@ConcentracionRegistradas');
                Route::get('/agregar_concentracion', 'RegulatorioController@FrmConcentracion');
                Route::get('/agregar_concentracion/{id}/edit', 'RegulatorioController@FrmConcentracion');
                Route::post('/Editarconcentracion', 'RegulatorioController@storeConcentracion');
                Route::get("/Eliminarconcentracion/{id}", "RegulatorioController@destroyConcentracion");

                //via administracion
                Route::get('/edit_via_administracion', 'RegulatorioController@ViaRegistradas');
                Route::get('/agregar_via_administracion', 'RegulatorioController@FrmVia');
                Route::get('/agregar_via_administracion/{id}/edit', 'RegulatorioController@FrmVia');
                Route::post('/Editarvia_administracion', 'RegulatorioController@storeVia');
                Route::get("/Eliminarvia_administracion/{id}", "RegulatorioController@destroyVia");

                //modalidad venta
                Route::get('/edit_modalidad_venta', 'RegulatorioController@ModalidadVentaRegistradas');
                Route::get('/agregar_modalidad_venta', 'RegulatorioController@FrmModalidadVenta');
                Route::get('/agregar_modalidad_venta/{id}/edit', 'RegulatorioController@FrmModalidadVenta');
                Route::post('/Editarmodalidad_venta', 'RegulatorioController@storeModalidadVenta');
                Route::get("/Eliminarmodalidad_venta/{id}", "RegulatorioController@destroyModalidadVenta");

                //Grupo terapeutico
                Route::get('/edit_terapeutico', 'RegulatorioController@TerapeuticoRegistradas');
                Route::get('/agregar_terapeutico', 'RegulatorioController@FrmTerapeutico');
                Route::get('/agregar_terapeutico/{id}/edit', 'RegulatorioController@FrmTerapeutico');
                Route::post('/Editar_terapeutico', 'RegulatorioController@storeTerapeutico');
                Route::get("/Eliminarterapeutico/{id}", "RegulatorioController@destroyTerapeutico");

                //Fabricante
                Route::get('/edit_fabricante', 'RegulatorioController@FabricanteRegistradas');
                Route::get('/agregar_fabricante', 'RegulatorioController@FrmFabricante');
                Route::get('/agregar_fabricante/{id}/edit', 'RegulatorioController@FrmFabricante');
                Route::post('/Editar_fabricante', 'RegulatorioController@storeFabricante');
                Route::get("/Eliminarfabricante/{id}", "RegulatorioController@destroyFabricante");


            });

            //BI
            Route::group(['prefix' => 'bi'], function () {
                Route::get('/crear_listar', 'BIController@showProductos');
                Route::post('/guardar_grupo', 'BIController@guardarGrupo');
            });

            //Sell In
            Route::group(['prefix' => 'sell_in'], function () {
                Route::get('/', 'PrecioSellInController@index')->middleware("checkURL");
                Route::get('/agregar', 'PrecioSellInController@FrmPrecio');
                Route::post('/save', 'PrecioSellInController@SavePrecio');
                Route::get('/edit{id}', 'PrecioSellInController@FrmPrecio');
                Route::get('/destroy/{id}', 'PrecioSellInController@destroyPrecio');
            });
            //Tercerizados
            Route::group(['prefix' => 'tercerizados'], function () {
                Route::get('/', 'TercerizadosController@index')->middleware("checkURL");
                Route::post('/crear', 'TercerizadosController@saveEncabezado');
                Route::post('/save_detalle', 'TercerizadosController@saveDetalle');
                Route::post('/delete', 'TercerizadosController@saveEncabezado');
                Route::any('/delete_detalle/{id}', 'TercerizadosController@deleteDetlle');
                Route::get('/destroy/{id}', 'TercerizadosController@destroy');
                Route::get('/edit_fecha/{id}/{val}/{tipo}/', 'TercerizadosController@UpdateFecha');
                Route::post('/enviar_correo', 'TercerizadosController@Correo');
                Route::any('/get_cliente/{id}', 'TercerizadosController@GetCliente');
                Route::any('/get_producto/{id}', 'TercerizadosController@GetProducto');
                Route::any('/cambia_fecha/{id}/{fecha}', 'TercerizadosController@CambiaFechaFin');
                Route::get('/correo/aprobar/{fecha}', 'TercerizadosController@CorreoAprobar');
                Route::post('/save', 'TercerizadosController@Observaciones');
                Route::post('/save_dos', 'TercerizadosController@Observacionesdos');
            });
            //Descontinuados
            Route::group(['prefix' => 'descontinuados'], function () {
                Route::get('/', 'DescontinuadosController@index')->middleware("checkURL");
                Route::post('/crear', 'DescontinuadosController@saveEncabezado');
                Route::post('/delete', 'DescontinuadosController@saveEncabezado');
                Route::get('/destroy/{id}', 'DescontinuadosController@destroy');
                Route::get('/edit_fecha/{id}/{val}/{tipo}/', 'DescontinuadosController@UpdateFecha');
                Route::post('/enviar_correo', 'DescontinuadosController@Correo');
                Route::any('/get_cliente/{id}', 'DescontinuadosController@GetCliente');
                Route::any('/get_producto/{id}', 'DescontinuadosController@GetProducto');
                Route::get('/correo/aprobar/{fecha}', 'DescontinuadosController@CorreoAprobar');
                Route::post('/save', 'DescontinuadosController@Observaciones');
                Route::post('/save_dos', 'DescontinuadosController@Observacionesdos');
            });
            //Market Access
            Route::group(['prefix' => 'market_access'], function () {
                Route::get('/', 'MarketAccessController@index')->middleware("checkURL");
                Route::post('/crear', 'MarketAccessController@saveEncabezado');
                Route::post('/delete', 'MarketAccessController@saveEncabezado');
                Route::get('/destroy/{id}', 'MarketAccessController@destroy');
                Route::get('/edit_fecha/{id}/{val}/{tipo}/', 'MarketAccessController@UpdateFecha');
                Route::post('/enviar_correo', 'MarketAccessController@Correo');
                Route::any('/get_cliente/{id}', 'MarketAccessController@GetCliente');
                Route::any('/get_producto/{id}', 'MarketAccessController@GetProducto');
                Route::get('/correo/aprobar/{fecha}', 'MarketAccessController@CorreoAprobar');
                Route::post('/save', 'MarketAccessController@Observaciones');
                Route::post('/save_dos', 'MarketAccessController@Observacionesdos');
            });

            Route::group(['prefix' => 'market_access_inst'], function () {
                Route::get('/', 'MarketAccessInstController@index');
                Route::any('/get_distribuidor/{idPais}', 'MarketAccessInstController@getDistribuidor');
                Route::any('/get_farmacia/{idDistribuidor}', 'MarketAccessInstController@getFarmacia');
                Route::any('/get_cod_pais/{idPais}', 'MarketAccessInstController@getCodPais');
                Route::any('/get_cod_entidad/{idEntidad}', 'MarketAccessInstController@getCodEntidad');
                Route::any('/get_cod_farmacia/{idFarmacia}', 'MarketAccessInstController@getCodFarmacia');
                Route::post('/save_tipo_venta', 'MarketAccessInstController@SaveTipoVenta');
            });
        });

        //Módulo de Reportes
        Route::group(['prefix' => 'reportes', 'namespace' => 'Modulo\Reportes'], function () {
            //Menú INegocios
            Route::group(['prefix' => 'universal'], function () {
                Route::any('/{objeto}', 'UniversalesController@show');
            });

            //Menú PowerBI
            Route::group(['prefix' => 'reporte_power_bi'], function () {
                Route::any('/{objeto}', 'UniversalesController@reporte_power_bi');
            });

            //Menú BI
            Route::group(['prefix' => 'bi'], function () {
                Route::get('/', 'BiController@index')->middleware("checkURL");
            });


            Route::group(['prefix' => 'agentes'], function () {
                Route::get('/listar', 'AgentesFranquiciaController@showReporte')->middleware("checkURL");
            });
        });

        //Módulo de Sales Expenses
        Route::group(['prefix' => 'sales', 'namespace' => 'Modulo\SalesExpenses'], function () {
            // Carga Inicial de Excel
            Route::group(['prefix' => 'supply'], function () {
                Route::get('/import_excel', 'SalesController@CargaExcel')->middleware("checkURL");
                Route::post('/save_document', 'SalesController@SaveDocument');
                Route::post('/import_excel', 'SalesController@iportExcel');
            });
            // Modificacion de data y carga manual
            Route::group(['prefix' => 'finanzas'], function () {
                Route::get('/docs', 'SalesController@docs')->middleware("checkURL");
                Route::get('/trasladar', 'SalesController@trasladar')->middleware("checkURL");
                Route::get('/import_excel', 'SalesController@show');
                Route::get('/se_provision', 'SalesController@seProvision')->middleware("checkURL");
                Route::post('/save_docs', 'SalesController@saveDocs');
                Route::post('/save_detalle', 'SalesController@saveDetalle');
                Route::post('/save_detalleActualizarNota', 'SalesController@saveDetalleActualizarNota');
                Route::post('/save_bonificados', 'SalesController@saveBonificados');
                Route::post('/trasladar', 'SalesController@trasladar');
                Route::any("/delete_detalle/{id}", "SalesController@deleteDetalle");
                Route::any("/delete_detalle_full/{id}", "SalesController@deleteDetalleFull");
                Route::any("/delete_encabezado/{id}", "SalesController@deleteData");

            });
            // Crear reglas para Fehcas y Lotes
            Route::group(['prefix' => 'bi'], function () {
                Route::get('/reglas_sales', 'SalesController@reglasSales')->middleware("checkURL");
                Route::get('/subir_ventas', 'BiController@subirVentas')->middleware("checkURL");
                Route::get('/notas', 'BiController@notas')->middleware("checkURL");
                Route::post('/reglas_sales', 'SalesController@reglasSales')->middleware("checkURL");
            });

            // Crear reglas para unidades
            Route::group(['prefix' => 'bi'], function () {
                Route::group(['prefix' => 'unidades'], function () {
                    Route::get('/reglas_sales', 'SalesController@reglasSalesUnidades')->middleware("checkURL");
                    Route::get('/subir_ventas', 'BiController@subirVentas')->middleware("checkURL");
                    Route::get('/notas', 'BiController@notas')->middleware("checkURL");
                    Route::post('/reglas_sales', 'SalesController@reglasSalesUnidades')->middleware("checkURL");
                });
            });

            // Reportes
            Route::group(['prefix' => 'reportes'], function () {
                Route::get('/dinamico', 'ReportesController@dinamico')->middleware("checkURL");
                Route::post('/dinamico', 'ReportesController@dinamico');
                Route::post('/exportar_excel', 'ReportesController@esportExcel');
                Route::post('/save_consulta', 'ReportesController@saveConsulta');
                Route::any('/delete_consulta/{id}', 'ReportesController@deleteConsulta');
            });
            Route::get('/historico', 'ImportHiscoricoController@index');
            Route::post('/historico/import_excel', 'ImportHiscoricoController@save');

            //Semaforo Controller
            Route::group(['prefix' => 'notas'], function () {
                Route::get('/', 'SemaforoSalesController@IndexSemaforo')->middleware("checkURL");
                Route::post('/save_detalle', 'SemaforoSalesController@saveDetalle');
                Route::any('/update_tipo_cambio/{id}/{valor}', 'SemaforoSalesController@updateTipoCambio');
                Route::post('/crear', 'SemaforoSalesController@SaveSemaforo');
                Route::any("/delete_nota/{id}", "SemaforoSalesController@deleteNota");
                Route::post('save_document', 'SemaforoSalesController@SaveDocument');
//                Route::post('save_document','SemaforoSalesController@Evaluar');
            });

            Route::group(['prefix' => 'notas'], function () {
                Route::get('/carga', 'SemaforoSalesController@CargaNota')->middleware("checkURL");
                Route::post('/save_document_nota', 'SemaforoSalesController@SaveDocumentNota');
            });

            Route::group(['prefix' => 'notas'], function () {
                Route::get('/carga_{Validacion}', 'SemaforoSalesController@CargaNota')->middleware("checkURL");
                Route::post('/save_document_nota/{Pais}', 'SemaforoSalesController@SaveDocumentNota');
            });

            Route::group(['prefix' => 'notas'], function () {
                Route::any('/ver', 'SemaforoSalesController@VisualizarNotasIndex')->middleware("checkURL");
            });

            Route::group(['prefix' => 'notas'], function () {
                Route::get('/cierre/ver', 'SemaforoSalesController@Cierre')->middleware("checkURL");
                Route::get('/cierre/estado_cierre', 'SemaforoSalesController@EstadoCierre');
            });

            Route::group(['prefix' => 'reporte'], function () {
                Route::any('/', 'SemaforoSalesController@ReporteIndex')->middleware("checkURL");
                Route::any('/general', 'SemaforoSalesController@ReporteGeneralMensualIndex')->middleware("checkURL");

            });
        });

        //Modulo finanzas
        Route::group(['prefix' => 'finanzas', 'namespace' => 'Modulo\SalesExpenses'], function () {
            Route::group(['prefix' => 'promotion'], function () {
                Route::get('/', 'SalesController@docsP')->middleware("checkURL");
                Route::get('/data_sap', 'SalesController@dataSap')->middleware("checkURL");
                Route::post('/nota', 'SalesController@saveDocs');
                Route::post('/save_detalleNota', 'SalesController@saveDetalle');
                Route::any("/delete_detalleNota/{id}", "SalesController@deleteDetalle");
                Route::any("/delete_encabezadoNota/{id}", "SalesController@deleteData");
            });
        });

        Route::group(['prefix' => 'finanzas', 'namespace' => 'Modulo\Finanzas'], function () {

            Route::group(['prefix' => 'requisiciones'], function () {
                Route::get('/compras', 'RequisicionController@compras')->middleware("checkURL");
                Route::get('/insert_orden/{id}/{orden}', 'RequisicionController@insertOrden');
                Route::get('/crear', 'RequisicionController@index');
                Route::get('/contrato/{id}', 'RequisicionController@pdfVerRequisiciones');
                Route::any('/borrar/{id}', 'RequisicionController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}', 'RequisicionController@cambiaEstatus');
                Route::any('/delete_detalle/{id}', 'RequisicionController@deleteDetalle');
                Route::any('/delete_doc/{codigo}/{doc}', 'RequisicionController@deleteDoc');
                Route::any('/rechazo_compras/{id}/{comentario}', 'RequisicionController@rechazoCompras');
                Route::any('/estado_compras_pendiente/{id}/{estado}', 'RequisicionController@estadoComprasPendiente');
                Route::post('/save_encabezado', 'RequisicionController@saveEncabezado');
                Route::post('/save_detalle', 'RequisicionController@saveDetalle');
                Route::post('/save_doc', 'RequisicionController@saveDoc');
                Route::post('/save_desc', 'RequisicionController@saveDesc');
            });

            Route::group(['prefix' => 'liquidacioncc'], function () {
                Route::get('/', 'LiquidacionCCController@index');
                Route::any('/borrar/{id}', 'LiquidacionCCController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}', 'LiquidacionCCController@cambiaEstatus');
                Route::any('/delete_detalle/{id}', 'LiquidacionCCController@deleteDetlle');
                Route::any('/delete_doc/{codigo}/{doc}', 'LiquidacionCCController@deleteDoc');
                Route::post('/save_encabezado', 'LiquidacionCCController@saveEncabezado');
                Route::post('/save_detalle', 'LiquidacionCCController@saveDetalle');
                Route::post('/save_doc', 'LiquidacionCCController@saveDoc');
                Route::post('/save_movimientos', 'LiquidacionCCController@saveMovimientos');
            });
            Route::group(['prefix' => 'liquidaciongdr_admon'], function () {
                Route::get('/', 'LiquidacionGDRADMONController@index');
                Route::any('/borrar/{id}', 'LiquidacionGDRADMONController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}', 'LiquidacionGDRADMONController@cambiaEstatus');
                Route::any('/delete_detalle/{id}', 'LiquidacionGDRADMONController@deleteDetlle');
                Route::any('/delete_doc/{codigo}/{doc}', 'LiquidacionGDRADMONController@deleteDoc');
                Route::post('/save_encabezado', 'LiquidacionGDRADMONController@saveEncabezado');
                Route::post('/save_detalle', 'LiquidacionGDRADMONController@saveDetalle');
                Route::post('/save_doc', 'LiquidacionGDRADMONController@saveDoc');
                Route::post('/save_movimientos', 'LiquidacionGDRADMONController@saveMovimientos');
            });

            Route::group(['prefix' => 'liquidaciongdr'], function () {
                Route::get('/', 'LiquidacionGDRController@index');
                Route::any('/borrar/{id}', 'LiquidacionGDRController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}', 'LiquidacionGDRController@cambiaEstatus');
                Route::any('/delete_detalle/{id}', 'LiquidacionGDRController@deleteDetlle');
                Route::any('/delete_doc/{codigo}/{doc}', 'LiquidacionGDRController@deleteDoc');
                Route::post('/save_encabezado', 'LiquidacionGDRController@saveEncabezado');
                Route::post('/save_detalle', 'LiquidacionGDRController@saveDetalle');
                Route::post('/save_doc', 'LiquidacionGDRController@saveDoc');
                Route::post('/save_movimientos', 'LiquidacionGDRController@saveMovimientos');
            });

            Route::group(['prefix' => 'liquidaciongv'], function () {
                Route::get('/', 'LiquidacionGVController@index');
                Route::any('/borrar/{id}', 'LiquidacionGVController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}', 'LiquidacionGVController@cambiaEstatus');
                Route::any('/delete_detalle/{id}', 'LiquidacionGVController@deleteDetlle');
                Route::any('/delete_doc/{codigo}/{doc}', 'LiquidacionGVController@deleteDoc');
                Route::post('/save_encabezado', 'LiquidacionGVController@saveEncabezado');
                Route::post('/save_detalle', 'LiquidacionGVController@saveDetalle');
                Route::post('/save_doc', 'LiquidacionGVController@saveDoc');
                Route::post('/save_movimientos', 'LiquidacionGVController@saveMovimientos');
            });

            Route::group(['prefix' => 'liquidaciongm'], function () {
                Route::get('/', 'LiquidacionGMController@index');
                Route::any('/borrar/{id}', 'LiquidacionGMController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}', 'LiquidacionGMController@cambiaEstatus');
                Route::any('/delete_detalle/{id}', 'LiquidacionGMController@deleteDetlle');
                Route::any('/delete_doc/{codigo}/{doc}', 'LiquidacionGMController@deleteDoc');
                Route::post('/save_encabezado', 'LiquidacionGMController@saveEncabezado');
                Route::post('/save_detalle', 'LiquidacionGMController@saveDetalle');
                Route::post('/save_doc', 'LiquidacionGMController@saveDoc');
                Route::post('/save_movimientos', 'LiquidacionGMController@saveMovimientos');
            });


            Route::group(['prefix' => 'liquidacionfp'], function () {
                Route::get('/', 'LiquidacionFPController@index');
                Route::any('/borrar/{id}', 'LiquidacionFPController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}', 'LiquidacionFPController@cambiaEstatus');
                Route::any('/delete_detalle/{id}', 'LiquidacionFPController@deleteDetlle');
                Route::any('/delete_doc/{codigo}/{doc}', 'LiquidacionFPController@deleteDoc');
                Route::post('/save_encabezado', 'LiquidacionFPController@saveEncabezado');
                Route::post('/save_detalle', 'LiquidacionFPController@saveDetalle');
                Route::post('/save_doc', 'LiquidacionFPController@saveDoc');
                Route::post('/save_movimientos', 'LiquidacionFPController@saveMovimientos');
            });

            Route::group(['prefix' => 'liquidaciontc'], function () {
                Route::get('/', 'LiquidacionTCController@index');
                Route::any('/borrar/{id}', 'LiquidacionTCController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}', 'LiquidacionTCController@cambiaEstatus');
                Route::any('/delete_detalle/{id}', 'LiquidacionTCController@deleteDetlle');
                Route::any('/delete_doc/{codigo}/{doc}', 'LiquidacionTCController@deleteDoc');
                Route::post('/save_encabezado', 'LiquidacionTCController@saveEncabezado');
                Route::post('/save_detalle', 'LiquidacionTCController@saveDetalle');
                Route::post('/save_doc', 'LiquidacionTCController@saveDoc');
                Route::post('/save_movimientos', 'LiquidacionTCController@saveMovimientos');
                Route::get('/carga_estado_cuenta', 'LiquidacionTCController@cargaEstadoCuenta')->middleware("checkURL");
                Route::get('/carga_estado_cuenta/{idUser}', 'LiquidacionTCController@cargaEstadoCuenta')->middleware("checkURL");
                Route::post('/save_excel_tc', 'LiquidacionTCController@saveExcelTC');
            });

            Route::group(['prefix' => 'liquidaciontc_v2'], function () {
                Route::get('/', 'LiquidacionTCV2Controller@index');
                Route::any('/borrar/{id}', 'LiquidacionTCController@borrar');
                Route::any('/cambia_estatus/{id}/{estado}', 'LiquidacionTCController@cambiaEstatus');
                Route::any('/delete_detalle/{id}', 'LiquidacionTCController@deleteDetlle');
                Route::any('/delete_doc/{codigo}/{doc}', 'LiquidacionTCController@deleteDoc');
                Route::post('/save_encabezado', 'LiquidacionTCController@saveEncabezado');
                Route::post('/save_detalle', 'LiquidacionTCController@saveDetalle');
                Route::post('/save_doc', 'LiquidacionTCController@saveDoc');
                Route::post('/save_movimientos', 'LiquidacionTCController@saveMovimientos');
                Route::get('/carga_estado_cuenta', 'LiquidacionTCController@cargaEstadoCuenta')->middleware("checkURL");
                Route::get('/carga_estado_cuenta/{idUser}', 'LiquidacionTCController@cargaEstadoCuenta')->middleware("checkURL");
                Route::post('/save_excel_tc', 'LiquidacionTCController@saveExcelTC');
            });

            Route::group(['prefix' => 'presupuesto'], function () {
                //capex
                Route::get('/extras', 'PresupuestoController@extras');
                Route::get('/extrasle', 'PresupuestoController@extrasLE');
                Route::post('/save_extras', 'PresupuestoController@saveExtras');
                Route::any('/capex', 'PresupuestoController@Capex');
                Route::post('/capex/crear', 'PresupuestoController@SavePresupuesto');
                //opex
                Route::any('/opex', 'PresupuestoController@Opex');
                Route::any('/delete_detalle/{id}', 'PresupuestoController@deleteDetalle');
                Route::post('/save_detalle', 'PresupuestoController@saveDetalle');
                Route::post('/opex/crear', 'PresupuestoController@SavePresupuesto');
                Route::post('/opex/update/arbol', 'PresupuestoController@UpdatedArbol');
                Route::post('/save_presupuesto', 'PresupuestoController@savePresupuesto');
                Route::get('/opex/aprobaciones/{id}', 'MaterialPromocionalController@cambiaEstatusOpex');
                //Marketing
                Route::any('/marketing', 'PresupuestoController@Marketing')->middleware("checkURL");
                Route::any('/marketing/get_marca/{id}', 'PresupuestoController@GetMarca');
                Route::get('/reglas_marketing', 'PresupuestoController@reglasMarketing');
                Route::post('/reglas_marketing', 'PresupuestoController@reglasMarketing');
                Route::get('/delete/{id}', 'PresupuestoController@deleteCapex');
                Route::get('/capex/aprobaciones/{id}', 'PresupuestoController@cambiaEstatusCapex');
                Route::get('/opex/aprobaciones/{id}', 'PresupuestoController@cambiaEstatusOpex');
                Route::get('/opexmk/aprobaciones/{usuario}/{anio}/{idArbol}', 'PresupuestoController@cambiaEstatusOpexMK');

                Route::post('/marketing/crear', 'PresupuestoController@SaveMarketing');
                Route::post('/marketing/crear/archivo', 'PresupuestoController@SaveMarketingExcel');

                Route::get('/empleado', 'AsignacionesController@empleado')->middleware("checkURL");
                Route::get('/general', 'PresupuestoController@general');
                Route::get('/{tipo}', 'AsignacionesController@index')->middleware("checkURL");
                Route::get('/{tipo}/{id}', 'AsignacionesController@delete');
                Route::post('/save_asignaciones', 'AsignacionesController@saveAsignaciones');
                Route::post('/save_asignaciones_detalle', 'AsignacionesController@saveAsignacionesDetalle');
                Route::post('/save_des_asignaciones_detalle', 'AsignacionesController@saveDesAsignacionesDetalle');
                Route::post('/save_asignacion_empleado', 'AsignacionesController@saveAsignacionEmpleado');

            });

            //reportes
            Route::group(['prefix' => 'reportes'], function () {

                Route::get('/global', 'ReportesController@global')->middleware("checkURL");
                Route::get('/print_all', 'ReportesController@printAll')->middleware("checkURL");
                Route::get('/print_user', 'ReportesController@printUser')->middleware("checkURL");
                Route::get('/sales/{tipo}', 'ReportesController@sales')->middleware("checkURL");
                Route::any('/presupuesto', 'ReportesController@getPresupuesto')->middleware("checkURL");
                Route::any('/mk', 'ReportesController@mk')->middleware("checkURL");
            });

            //CargaDocumentos
            Route::group(['prefix' => 'documentos'], function () {
                Route::get('/ksb', 'CargaDocumentosController@index')->middleware("checkURL");
                Route::get('/ksb_ver', 'CargaDocumentosController@KSBVer')->middleware("checkURL");
                Route::any('/ksb_borrar/{id}', 'CargaDocumentosController@KSBBorrar');
                Route::get('/descargar_archivo', 'CargaDocumentosController@descargarArchivo');
                // Route::any('/filas', 'CargaDocumentosController@IndexFilasEliminadasKSB')->middleware("checkURL");
            });

            //AjusteKSB
            Route::group(['prefix' => 'documentos'], function () {
                Route::get('/ksb/ajuste', 'CargaDocumentosController@AjustesIndex')->middleware("checkURL");
                Route::post('/ksb/ajuste/save', 'CargaDocumentosController@SaveAjuste');
                Route::any('/ksb/ajuste/delete/{id}', 'CargaDocumentosController@DeleteRowKSB');

            });

            //reporteKSB
            Route::group(['prefix' => 'documentos'], function () {
                Route::any('/ksb/reporte', 'CargaDocumentosController@IndexReporteKSB')->middleware("checkURL");
                Route::any('/ksb/reporte/periodo', 'CargaDocumentosController@IndexReportePeriodo')->middleware("checkURL");
                // Route::any('/ksb/ajuste/delete/{id}','CargaDocumentosController@DeleteRowKSB');

            });

            //reporteKSBFilasEliminadas
            Route::group(['prefix' => 'documentos'], function () {
                Route::any('/ksb/filas', 'CargaDocumentosController@IndexFilasEliminadasKSB')->middleware("checkURL");

            });
            //Cobrados
            Route::group(['prefix' => 'cobrados'], function () {
                Route::get('/notas', 'CobradosController@index')->middleware("checkURL");
                Route::get('/cobradas', 'CobradosController@cobradas')->middleware("checkURL");
                Route::get('/reporte', 'CobradosController@reporte')->middleware("checkURL");
                Route::any('/cambiar_estado/{id}/{estado}', 'CobradosController@cambiarEstado');
            });

            //Fondo
            Route::group(['prefix' => 'fondo'], function () {
                Route::get('/reasignacion', 'AsignacionFondoController@reasignacion')->middleware("checkURL");
                Route::post('/save_asignacion', 'AsignacionFondoController@saveAsignacion');
                Route::post('/save_reasignacion', 'AsignacionFondoController@saveReAsignacion');
            });

            //Carga Expres
            Route::group(['prefix' => 'carga'], function () {
                Route::get('/carga_expres', 'CargaExpresController@index')->middleware("checkURL");
                Route::post('/carga_expres/save', 'CargaExpresController@Save');
            });

            //Tesoreria
            Route::group(['prefix' => 'tesoreria'], function () {
                Route::get('/ver', 'TesoreriaController@Index')->middleware("checkURL");
                Route::get('/agregar', 'TesoreriaController@FrmTesoreria');
                Route::get('/agregar/{id}/edit', 'TesoreriaController@FrmTesoreria');
                Route::get('/PDF/{id}/tbl', 'TesoreriaController@PDF');
                Route::post('/save_encabezado', 'TesoreriaController@SaveEncabezado');
                Route::post('/suv_save_encabezado', 'TesoreriaController@SubSaveEncabezado');
                Route::post('/save_detalle', 'TesoreriaController@SaveDetalle');
                Route::get('/eliminar/{id}', 'TesoreriaController@destroyEncabezado');
                Route::get('/eliminar_detalle/{id}', 'TesoreriaController@destroyDetalle');
            });

            Route::group(['prefix' => 'KSB'], function () {

                Route::get('/', 'KSBController@index')->middleware("checkURL");
                Route::post('/carga_archivo', 'KSBController@cargaArchivo');
            });

            //CargaDocumentos
            Route::group(['prefix' => 'costos'], function () {
                Route::get('/', 'CostosController@index')->middleware("checkURL");
                Route::get('/le', 'CostosController@indexLE')->middleware("checkURL");
                Route::get('/bdg', 'CostosController@indexBDG')->middleware("checkURL");
                Route::post('/guarda_costos', 'CostosController@guardaCostos');
            });

            //Plan de Compras
            Route::group(['prefix' => 'plan'], function () {
                Route::get('/', 'PlanComprasController@index')->middleware("checkURL");
                Route::post('/save', 'PlanComprasController@Save');
                Route::get('/eliminar/{id}', 'PlanComprasController@deletePlan');
                Route::post('/crear', 'PlanComprasController@Crear');
            });


            Route::group(['prefix' => 'cartera'], function () {
                Route::get('/', 'CarteraController@index');
                Route::post('/save_document', 'CarteraController@SaveDocument');
            });

            Route::group(['prefix' => 'cliente'], function () {
                Route::get('/', 'ClienteController@Cliente')->middleware("checkURL");
                Route::get('/edit{id}', 'ClienteController@frmCliente');
                Route::post('/save', 'ClienteController@saveCliente');
            });
        });


        // ModuloMedical
        Route::group(['prefix' => 'medical', 'namespace' => 'Modulo\Medical'], function () {
            //EducContinua
            Route::group(['prefix' => 'eventos'], function () {
                Route::get('/educ', 'MedicalController@CargaEducContinua');
                Route::get('/educ/{id}/{sumaPresupuesto}/{franquicia}/{IdArbol}/{mes}/{TipoEvento}', 'MedicalController@CargaEducContinua');
                Route::post('/educ/crear', 'MedicalController@SaveEventoEducMedica');
                Route::post('/educ/monto', 'MedicalController@MontoEducMedica');
                Route::get('/educ/producto/{franquicia}', 'MedicalController@FranquiciaProducto');
                Route::get('/educ/conferencista', 'MedicalController@ShowConferencista');
                Route::get('educ/speaker', 'MedicalController@getConferencista');
                Route::post('/educ/conferencista/crear', 'MedicalController@SaveConferencista');
            });


            Route::group(['prefix' => 'eventos'], function () {
                Route::get('/solicitud', 'MedicalController@BuscarFormEducMedica')->middleware("checkURL");
                Route::any('/evento/{id}', 'MedicalController@eventoMedicalpdf');
                Route::any('/contrato/{id}', 'MedicalController@pdfMedical');
                Route::get('/aprobaciones/{id}', 'MedicalController@aprobaciones');
                Route::get('/correo/{id}', 'MedicalController@CorreoAprobacion');
                Route::get('/eliminar/{id}', 'MedicalController@destroyEvento');
            });

            Route::group(['prefix' => 'material'], function () {
                Route::get('/promocional', 'MaterialPromocionalController@ShowMateriales');
                Route::post('/promocional/crear', 'MaterialPromocionalController@RegistroMaterialPromocional');
                Route::any("/promocional/{id}", "MaterialPromocionalController@deleteSolicitud");
                Route::get('/promocional/aprobaciones/{id}', 'MaterialPromocionalController@cambiaEstatus');
            });

            Route::group(['prefix' => 'mdgrow'], function () {
                Route::get('/', 'MDGROWController@Index')->middleware("checkURL");
                Route::post('/crear', 'MDGROWController@SaveMDGrow');
                Route::any("/delete/{id}", "MDGROWController@deleteMDGrow");
            });

            Route::group(['prefix' => 'mdgrow'], function () {
                Route::any('/ver', 'MDGROWController@VisualizarMDGrowIndex')->middleware("checkURL");
            });

        });

        Route::group(['prefix' => 'multiples', 'namespace' => 'Modulo\Multiples'], function () {
            Route::get('/stock_carga', 'MultiplesController@stockCarga')->middleware("checkURL");
            Route::get('/stock_ver', 'MultiplesController@stockVer')->middleware("checkURL");
            Route::any('/stock_borrar/{id}', 'MultiplesController@stockBorrar');
            Route::get('/descargar_archivo', 'MultiplesController@descargarArchivo');
            Route::post('/store_file', 'MultiplesController@storeFile');

            //aprobaciones
            Route::get('/aprobeciones', 'ArbolAprobacionesController@index')->middleware("checkURL");
            Route::any('/canbia_estatus/{id}/{estatus}', 'ArbolAprobacionesController@canbiaEstatus');
            Route::any('/canbia_estatus/{id}/{estatus}/{table}/{observacion}', 'ArbolAprobacionesController@canbiaEstatus');
            Route::any('/canbia_estatus/{id}/{estatus}/{table}', 'ArbolAprobacionesController@canbiaEstatus');
            Route::any('/cambia_estatus_universal/{id}/{estatus}/{tabla}', 'ArbolAprobacionesController@cambia_estatus_universal');

            //Arbol Aprobaciones
            Route::get('/crear_arbol', 'ArbolAprobacionesController@crearArbol')->middleware("checkURL");

            //rutas de Arbol activo
            Route::group(['prefix' => 'arbol'], function () {
                Route::get('/', 'ArbolAprobacionesController@ArbolActivo')->middleware("checkURL");
                Route::post('/save', 'ArbolAprobacionesController@ArbolSave');
                Route::post('/cambia_estatus_activo/{id}', 'ArbolAprobacionesController@ArbolEstatusActivo');
                Route::post('/cambia_estatus_desactivado/{id}', 'ArbolAprobacionesController@ArbolEstatusDesactivado');
                Route::get('/edit/{nombre}/{id}', 'ArbolAprobacionesController@ArbolFrm');
                Route::post('/store', 'ArbolAprobacionesController@ArbolEdit');
                Route::post('/save_solicitante', 'ArbolAprobacionesController@SaveSolicitante');
            });
        });

        Route::group(['prefix' => 'aprobaciones', 'namespace' => 'Modulo\Multiples'], function () {
            Route::get('/', 'AprobacionesController@index')/*->middleware("checkURL")*/
            ;
            Route::get('/ver_doc/{doc}', 'AprobacionesController@verDoc')/*->middleware("checkURL")*/
            ;
            Route::get('/canbia_estatus/{id}/{estatus}/{observaciones}', 'AprobacionesController@cambiaEstatus')/*->middleware("checkURL")*/
            ;
        });


        //promotion
        Route::group(['prefix' => 'promotion', 'namespace' => 'Modulo\Promotion'], function () {


            Route::group(['prefix' => 'promocionales'], function () {

                Route::get('/', 'GastoPromocionController@IndexGastosPromocionales')->middleware("checkURL");
                Route::post('/crear', 'GastoPromocionController@SaveGastoPromocional');
                Route::any("/deleteGastoPromocion/{id}", "GastoPromocionController@deleteSolicitudGastoPromocion");
            });


            Route::group(['prefix' => 'reportes'], function () {
                Route::get('/condicion_comercial/{cliente}/{pais}', 'ReportesController@condicionComercial');
            });

            Route::group(['prefix' => 'comerciales'], function () {
                Route::get('/', 'CondicionComercialController@IndexCondicionComercial');
                Route::get('/finanzas', 'CondicionComercialController@IndexCondicionComercialFinanzas');
                Route::post('/crear', 'CondicionComercialController@SaveCondicionComercial');
                Route::any("/deleteCondicionComercial/{id}", "CondicionComercialController@deleteCondicionComercial");
                Route::get('/aprobaciones/{id}', 'CondicionComercialController@cambiaEstatus');
            });

        });

        //Modulo BI
        Route::group(['prefix' => 'bi', 'namespace' => 'Modulo\BI'], function () {
            Route::group(['prefix' => 'ventas'], function () {
                Route::get('/cargadas', 'VentasController@cargadas')->middleware("checkURL");
                Route::get('/criterio', 'VentasController@criterio')->middleware("checkURL");
                Route::get('/cif', 'VentasController@cif')->middleware("checkURL");
                Route::get('/transitos', 'TransitosController@index')->middleware("checkURL");
                Route::any('/get_data_fac/{id}', 'TransitosController@getDataFac');
                Route::post('/guarda_transito', 'TransitosController@guardaTransito');
                Route::post('/guarda_factura', 'TransitosController@guardaFactura');
                Route::post('/cambia_estatus_activo/{id}', 'TransitosController@TransitoEstatusActivo');
                Route::get('/destroy_factura/{id}', 'TransitosController@destroyFacturaTrancito');
                Route::get('/transitos/documento/{data}', 'TransitosController@documentoFacturacion');
                Route::post('/transitos/enviar_correo', 'TransitosController@CorreoTransito');
                Route::any('/transitos/get_cliente/{id}', 'TransitosController@GetCliente');
                Route::any('/transitos/confirmar', 'TransitosController@Confirmar');
                Route::get('/consolidacion', 'VentasController@consolidacion');
                Route::post('/nota', 'SalesController@saveDocs');
                Route::post('/save_detalleNota', 'SalesController@saveDetalle');
                Route::any("/delete_detalleNota/{id}", "SalesController@deleteDetalle");
                Route::any("/delete_encabezadoNota/{id}", "SalesController@deleteData");
                Route::post('/save_filtro', 'VentasController@saveFiltro');
                Route::post('/save_ventas', 'VentasController@saveVentas');
            });
            Route::group(['prefix' => 'bonificados'], function () {
                Route::get('/cargadas', 'BonificacionesController@cargadas')->middleware("checkURL");
                Route::post('/save_filtro', 'BonificacionesController@saveFiltro');
                Route::post('/save_ventas', 'BonificacionesController@saveBonificados');
            });
        });

        //Modulo Informatica
        Route::group(['prefix' => 'it', 'namespace' => 'Modulo\Informatica'], function () {
            Route::group(['prefix' => 'inventario'], function () {
                Route::get('/asignacion_equipo', 'InventarioEquipoController@AsignacionEquipo')->middleware("checkURL");
                Route::post('/asignacion_equipo', 'InventarioEquipoController@store');
                Route::get('/EliminarAsig/{Id}', 'InventarioEquipoController@destroy');
            });
            Route::group(['prefix' => 'accesos'], function () {
                Route::get('/', 'InventarioEquipoController@Accesos')->middleware("checkURL");
                Route::get('/crear', 'InventarioEquipoController@frmAccesos');
                Route::get('/edit{id}', 'InventarioEquipoController@frmAccesos');
                Route::post('/save', 'InventarioEquipoController@saveAccesos');
                Route::get('/destroy/{id}', 'InventarioEquipoController@destroyAccesos');
            });
            Route::group(['prefix' => 'password'], function () {
                Route::get('/', 'PasswordController@Password')->middleware("checkURL");
                Route::get('/crear', 'PasswordController@frmPassword');
                Route::get('/edit{id}', 'PasswordController@frmPassword');
                Route::post('/save', 'PasswordController@savePassword');
                Route::get('/destroy/{id}', 'PasswordController@destroyPassword');
            });
            Route::group(['prefix' => 'procesos'], function () {
                Route::get('/', 'InventarioEquipoController@Procesos')->middleware("checkURL");
                Route::get('/crear', 'InventarioEquipoController@frmProcesos');
                Route::get('/edit{id}', 'InventarioEquipoController@frmProcesos');
                Route::post('/save', 'InventarioEquipoController@saveProcesos');
                Route::get('/destroy/{id}', 'InventarioEquipoController@destroyProcesos');
            });
        });

        //Modulo Fuerza Ventas
        Route::group(['prefix' => 'visita_medica', 'namespace' => 'Modulo\BI'], function () {

            //Paneles
            Route::group(['prefix' => 'paneles'], function () {
                Route::get('/asignar', 'VisitaAdministracionController@index');
                Route::post('/save_rep', 'VisitaAdministracionController@saveRep');
                Route::post('/save_estatus', 'VisitaAdministracionController@saveEstatus');
                Route::post('/save_doc', 'VisitaAdministracionController@saveDoc');
                //Mi Panel
                Route::get('/fichero', 'VisitaAdministracionController@MiPanel');
                //Asignar Medico
                Route::any('/medico/{idPais}', 'VisitaAdministracionController@SearchMedico');
                Route::any('/prod_medico/{codCloseUp}/{trim}/{asignar}', 'VisitaAdministracionController@SearchProdMedicoTrim');
                Route::post('/dato_medico', 'VisitaAdministracionController@getDatoMedico');
                Route::post('/agrega_panel', 'VisitaAdministracionController@AgregaMedico');
                Route::post('/modifica_panel', 'VisitaAdministracionController@ModificaMedico');
                Route::get('/edit_panel', 'VisitaAdministracionController@EditMedicoU');
                //Autorizar
                Route::get('/autorizar', 'VisitaAdministracionController@AutorizaIndex');
                Route::any('/apr_autoriza/{id}/{estatus}/{tipo}', 'VisitaAdministracionController@AprAutoriza');
            });

            // Administracion Fichero
//            Route::group(['prefix' => 'visita_administracion'], function () {
//                Route::get('/', 'VisitaAdministracionController@index');
//                Route::get('/get_data', 'VisitaAdministracionController@GetData');
//            });

            // Planificacion
            //calendario
            Route::get('/planificacion', 'VisitaMedicaController@planificacion')->middleware("checkURL");
            Route::get('/ir_visita/{id}', 'VisitaMedicaController@irVisita');
            Route::any('/get_fichero/{id}', 'VisitaMedicaController@GetFichero');
            Route::post('/update_planificacion', 'VisitaFarmaciaController@UpdatePlanificacion');

            //fichero
            Route::get('/planificacion/fichero', 'VisitaMedicaController@planificacionFichero')->middleware("checkURL");
            Route::post('/planificacion/fichero/asignacion', 'VisitaMedicaController@PlanificacionAsignacion');
            Route::post('/planificacion/fichero/asignacion/save', 'VisitaMedicaController@PlanificacionAsignacionSave');


            // visita medica
            Route::group(['prefix' => 'visita'], function () {
                Route::get('/', 'VisitaMedicaController@visita')->middleware("checkURL");
                Route::get('/fichero', 'VisitaMedicaController@index')->middleware("checkURL");
                Route::get('/historial/medico/{id}', 'VisitaMedicaController@historialVisita');
                Route::get('/planificacion', 'VisitaMedicaController@planificacion')->middleware("checkURL");
                Route::get('/guarda_planificacion', 'VisitaMedicaController@guardaPlanificacion');
                Route::post('/guarda_visita', 'VisitaMedicaController@guardaVisita');
                Route::post('/guarda_mm', 'VisitaMedicaController@guardaMM');
                Route::post('/guarda_promo', 'VisitaMedicaController@guardaPromo');
                Route::any('/borra_visita/{id}', 'VisitaMedicaController@borraVisita');
                Route::any('/borra_emm/{id}', 'VisitaMedicaController@borraEmm');
                Route::any('/borra_promo/{id}', 'VisitaMedicaController@borraPromo');
                Route::any('/borra_plani/{id}', 'VisitaMedicaController@borraPlani');
                Route::post('/update_status', 'VisitaMedicaController@UpdateStatusVisita');

                //NP
                Route::get('/tiemponp', 'VisitaMedicaController@TNP');
                Route::get('/tiemponp/{id}/{status}', 'VisitaMedicaController@TNPAprobar');
            });

            // visita Farmacia
            Route::group(['prefix' => 'farmacia'], function () {
                Route::get('/', 'VisitaFarmaciaController@visita')->middleware("checkURL");
                Route::get('/fichero', 'VisitaFarmaciaController@index')->middleware("checkURL");
                Route::get('/planificacion', 'VisitaFarmaciaController@planificacion')->middleware("checkURL");
                Route::post('/guarda_visita', 'VisitaFarmaciaController@guardaVisita');
                Route::get('/guarda_planificacion', 'VisitaFarmaciaController@guardaPlanificacion');
            });

            // visita reportes
            Route::group(['prefix' => 'reportes'], function () {
                Route::get('/geo', 'GeoLocalizacionController@geo')->middleware("checkURL");

            });
            // dashboard
            Route::group(['prefix' => 'dashboard'], function () {
                Route::get('/', 'VisitaDashboardController@index');

                Route::group(['prefix' => 'powerbi'], function () {
                    Route::get('/', 'VisitaDashboardController@indexPowerBI');
                });
            });

        });
        //Modulo Budget
        Route::group(['prefix' => 'budget', 'namespace' => 'Modulo\Budget'], function () {
            Route::group(['prefix' => 'si'], function () {
                Route::get('/venta', 'SIController@venta')->middleware("checkURL");
                Route::get('/se', 'SIController@se')->middleware("checkURL");
                Route::get('/so', 'SIController@so')->middleware("checkURL");
                Route::get('/consolidado', 'SIController@consolidado')->middleware("checkURL");
                Route::post('/cargar_ventas', 'SIController@cargarVentas');
                Route::post('/cargar_se', 'SIController@cargarSE');
                Route::post('/cargar_so', 'SIController@cargarSO');
            });

            Route::group(['prefix' => 'le'], function () {
                Route::get('/venta', 'LEController@venta')->middleware("checkURL");
                Route::get('/se', 'LEController@se')->middleware("checkURL");
                Route::get('/so', 'LEController@so')->middleware("checkURL");
                Route::get('/consolidado', 'LEController@consolidado')->middleware("checkURL");
                Route::post('/cargar_ventas', 'LEController@cargarVentas');
                Route::post('/cargar_se', 'LEController@cargarSE');
                Route::post('/cargar_so', 'LEController@cargarSO');
            });
        });
        Route::group(['prefix' => 'supply', 'namespace' => 'Modulo\Supply'], function () {
            Route::group(['prefix' => 'logistics'], function () {
                Route::get('/ingresos', 'LogisticsController@index')->middleware("checkURL");
                Route::get('/pedidos', 'LogisticsController@pedidos')->middleware("checkURL");
                Route::any('/detalle/{codigo}', 'LogisticsController@detalle');
                Route::post('/guarda_ingresos', 'LogisticsController@guardaIngresos');
                Route::post('/guarda_pedidos', 'LogisticsController@guardaPedidos');
                Route::post('/reenviar_ingreso', 'LogisticsController@reenviarIngreso');
            });

        });

    });
    //Rutas del sistema externo
});
