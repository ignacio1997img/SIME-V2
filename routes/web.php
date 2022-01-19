<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/administracion', 'HomeController@index')->name('administracion')
    ->middleware('permission:administracion-home');
Route::get('/documentaciones', 'HomeController@documentaciones')->name('documentaciones')
    ->middleware('permission:tramitecorrespondencia-home');
Route::get('/recursoshumanos', 'HomeController@recursoshumanos')->name('recursoshumanos')
    ->middleware('permission:recursohumano-home');
Route::get('/aseourbano', 'HomeController@aseourbano')->name('aseourbano')
    ->middleware('permission:aseourbano-home');

Route::get('/maestranza', 'HomeController@maestranza')->name('maestranza')
    ->middleware('permission:maestranza-home');

Route::get('/hyso', 'HomeController@hyso')->name('hyso')
    ->middleware('permission:hyso-home');



Route::get('/Acercade', 'HomeController@AcercaDe')->name('acerca');
//_________________________________________________________________________________________________________
//::::::::::::::::::::::::::::::::::::::::::::::_ADMINISTRACION_::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 

//................................................._SISTEMA_...............................................
Route::post('administracion/sistema/modulo/editar', 'AdmModuloController@update_modulo')
    ->name('adm-modulo.update')
    ->middleware('permission:adm-modulo.update');

Route::post('administracion/sistema/opciones/editar', 'AdmOpcionesController@update_opcion')
    ->name('adm-opcion.update') // para editar tipo cargo en el modal
    ->middleware('permission:adm-opcion.update');

Route::post('administracion/sistema/subopciones/editar', 'AdmSubOpcionesController@update_subopcion')
    ->name('adm-subopcion.update') // para ediatar sub opcion
    ->middleware('permission:adm-subopcion.update');

// Route::post('administracion/sistema/role_permission/update_permiso', 'AdmRoleController@update_permisos')
//     ->name('updatepermisos'); // para editar GRUPO en el modal


//..............................................._EMPRESA_..................................................
Route::post('administracion/empresa/grupo/editar', 'AdmGrupoEmpresaController@update_grupo')
    ->name('adm-grupoempresa.update') // para editar GRUPO en el modal
    ->middleware('permission:adm-grupoempresa.update');

Route::post('administracion/empresa/subgrupo/editar', 'AdmSubGrupoController@update_subgrupo')
    ->name('adm-subgrupo.update') // para editar SUB GRUPO en el modal
    ->middleware('permission:adm-subgrupo.update');

Route::post('administracion/empresa/rubro/editar', 'AdmRubroController@update_rubro')
    ->name('adm-rubro.update') // para editar SUB GRUPO en el modal
    ->middleware('permission:adm-rubro.update');

Route::post('administracion/empresa/empresa/editar', 'AdmEmpresaController@update_empresa')
    ->name('adm-empresa.update') // para editar empresa en el modal
    ->middleware('permission:adm-empresa.update');

Route::get('administracion/empresa/empresa/kardex/{id}', 'AdmEmpresaController@kardex')
    ->name('adm-empresa.kardex') // para ver el kardex de cada empresa
    ->middleware('permission:adm-empresa.kardex');

Route::get('administracion/empresa/empresa/funcionarios/{id}', 'AdmEmpresaController@view_empresa_funcionarios')
    ->name('adm-empresa.funcionario') // para ver el listado de los funcionario de cada empresa
    ->middleware('permission:adm-empresa.funcionario');


//..............................................._GESTION USUARIO_..................................................
Route::get('administracion/gestionusuario/usuario/asignarrole/{id}', 'AdmRoleController@view_asignaroles')
    ->name('adm-usuario.viewasignarroles') // para ir ala vista asignar roles a usario
    ->middleware('permission:adm-usuario.viewasignarroles');

Route::post('administracion/gestionusuario/usuario/reset', 'AdmUsuarioController@reset')
    ->name('adm-usuario.reset'); // para resetear el password
    // ->middleware('permission:adm-tipodocumento.update');

Route::post('usuariopassword/reset', 'HomeController@reset_act')
    ->name('cambiopassword'); // para resetear el password

//..............................................._TIPO DE DOCUMENTO_..................................................

Route::post('administracion/documentacion/tipodocumento/editar', 'AdmTipoDocumentoController@update_tiposdoc')
    ->name('adm-tipodocumento.update') // para editar TIPO DE DOUMENTO en el modal
    ->middleware('permission:adm-tipodocumento.update');
//_________________________________________________________________________________________________________




//::::::::::::::::::::::::::::::::::::::::::::::::::::: RECURSOS HUMANOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//.............................................. ESTRUCTURA EMPRESA ..........................................
Route::post('recursoshumanos/estructuraempresa/area/editar', 'AdmAreaController@update_area')//----------------------
    ->name('rrhh-area.update') // para editar area en el modal
    ->middleware('permission:rrhh-area.update');

Route::post('recursoshumanos/estructuraempresa/tipo/editar', 'AdmTipoCargoController@update_tipo')//-----------------
    ->name('rrhh-tipos.update') // para editar tipo cargo en el modal
    ->middleware('permission:rrhh-tipos.update');

Route::post('recursoshumanos/estructuraempresa/cargos/editar', 'AdmCargoController@update_cargo')//------------------
    ->name('rrhh-cargo.update') // para editar tipo cargo en el modal
    ->middleware('permission:rrhh-cargo.update');

//............................................... FUNCIONARIOS ............................................
Route::post('recursoshumanos/funcionarios/personas/editar', 'AdmPersonaController@update_persona')
    ->name('rrhh-personas.update')
    ->middleware('permission:rrhh-personas.update');

Route::get('recursoshumanos/funcionarios/personas/kardex/{id}', 'AdmPersonaController@kardex')
    ->name('rrhh-personas.kardex')
    ->middleware('permission:rrhh-personas.kardex');// para ver el kardex de una persona
    
Route::get('recursoshumanos/funcionarios/funcionario/inactivo', 'AdmFuncionarioController@view_funcionario_inactivo')
    ->name('rrhh-funcionario.viewinactivo')// para ir ala vista de funcionario inactivo
    ->middleware('permission:rrhh-funcionario.viewinactivo');

Route::get('recursoshumanos/funcionarios/funcionario/designacion/{id?}', 'AdmFuncionarioController@view_designacion')
    ->name('rrhh-funcionario.designacion')
    ->middleware('permission:rrhh-funcionario.designacion');

Route::get('recursoshumanos/funcionarios/funcionario/designacionsistema/{id?}', 'AdmFuncionarioController@view_designacionsistema')
    ->name('rrhh-funcionario.designacionsistema');
    // ->middleware('permission:rrhh-funcionario.designacionsistema');

Route::post('recursoshumanos/funcionarios/funcionario/designacion/corte', 'AdmDesignacionController@update_designacion_corte')
    ->name('rrhh-funcionario.designacioncorte') // para cortar una designacion 
    ->middleware('permission:rrhh-funcionario.designacioncorte');

Route::post('recursoshumanos/funcionarios/funcionario/baja', 'AdmFuncionarioCargoController@baja_funcionariocargo')
    ->name('rrhh-funcionario.bajafuncionario') // para dar de baja al funcionario de cualquier manera
    ->middleware('permission:rrhh-funcionario.bajafuncionario');

Route::get('recursoshumanos/funcionarios/funcionario/historialfuncionario/{id?}', 'AdmFuncionarioController@view_historial')
    ->name('rrhh-funcionario.historial') // para ir al historial de un funcionario -- activo e inactivo
    ->middleware('permission:rrhh-funcionario.historial');

Route::post('recursoshumanos/funcionarios/reemplazo/finalizar', 'AdmReemplazoController@update_reemplazo')
    ->name('rrhh-reemplazo.update') // para finalizar de manera forzada el REEMPLAZO en el modal
    ->middleware('permission:rrhh-reemplazo.update');


Route::delete('recursoshumanos/funcionarios/funcionario/designacionsistema/delete', 'AdmFuncionarioDesignacionSiController@destroy')->name('deletedetallecompra');
    












//7__________________////////////////////////////////_____________________________________////////////////////////////////////____________________________________///////////////////////////______
//_________________________________________________________________________________________________________
//::::::::::::::::::::::::::::::::::::::::::::::_TRAMITE Y CORRESPONDENCIA_::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 
// Route::get('documentaciones/tramite/crearnuevotramite', 'DocDocumentacionController@view_creartramite')
//     ->name('doc-tramite.viewinactivo');// para ir ala vista de crear nuevo tramite
    // ->middleware('permission:adm-funcionario.viewinactivo');

Route::get('documentaciones/tramite/derivartramite/{id?}', 'DocMovimientoDocumentoController@view_derivacion_tramite')
    ->name('doc-tramite.derivar.tramite');// para hacer la primer derivacion del documento
    // ->middleware('permission:doc-tramite.derivar.tramite');

    
Route::get('documentaciones/select/cargoreemplazos/{id?}', 'DocDocumentacionController@index_reemplazo')
->name('doc-tramite.select'); // para cambiar la vista de acuerdo al select selecionado

Route::get('documentaciones/tramite/derivarproceso/{id?}', 'DocMovimientoDocumentoController@view_derivacion_proceso')
->name('doc-tramite.derivar.proceso'); // para hacer la segunda derivacion del documento







//7__________________////////////////////////////////_____________________________________////////////////////////////////////____________________________________///////////////////////////______
//_________________________________________________________________________________________________________
//::::::::::::::::::::::::::::::::::::::::::::::_MAESTRANZA_::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 

Route::post('mestranza/maquinariaequipo/marca/editar', 'MaMarcaController@update_marca')
    ->name('ma-marca.update')// para editar marca en el modal
    ->middleware('permission:ma-marca.update');

Route::post('mestranza/maquinariaequipo/modelo/editar', 'MaModeloVehiculoController@update_modelo')//-----------------
    ->name('ma-modelovehiculo.update') // para editar modelo de vehiculo en el modal
    ->middleware('permission:ma-modelovehiculo.update');

Route::post('mestranza/maquinariaequipo/tipovehiculo/editar', 'MaTipoVehiculoController@update_tipo')//-----------------
    ->name('ma-tipovehiculo.update') // para editar tipo de vehiculo en el modal
    ->middleware('permission:ma-tipovehiculo.update');








//7__________________////////////////////////////////_____________________________________////////////////////////////////////____________________________________///////////////////////////______
//_________________________________________________________________________________________________________
//::::::::::::::::::::::::::::::::::::::::::::::_ASEO URBANO_::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 
Route::post('aseourbano/informacionbasica/contacto/editar', 'AuContactoController@update_contacto')
    ->name('au-contactos.update') // para editar contacto
    ->middleware('permission:au-contactos.update');

Route::post('aseourbano/informacionbasica/distrito/editar', 'AuDistritoController@update_distrito')
    ->name('au-distrito.update') // para editar distrito
    ->middleware('permission:au-distritos.update');

Route::get('aseourbano/informacionbasica/distrito/historialdistrito/{id?}', 'AuDistritoController@view_historial')
    ->name('au-distrito.historial') // para ver el historial de los distritos
    ->middleware('permission:au-distrito.historial');

Route::post('aseourbano/informacionbasica/barrio/editar', 'AuBarrioController@update_barrio')
    ->name('au-barrios.update') // para editar distrito
    ->middleware('permission:au-barrios.update');
    
Route::get('aseourbano/informacionbasica/barrios/historialbarrios/{id?}', 'AuBarrioController@view_historial')
    ->name('au-barrios.historial') // para ver el historial de los distritos
    ->middleware('permission:au-barrios.historial');

Route::post('aseourbano/informacionbasica/tiposerviciosrecoleccion/editar', 'AuTipoServicioController@update_tiposervicio')
    ->name('au-tiposervicio.update'); // para editar tipo de servicio
    // ->middleware('permission:au-tiposervicio.update');

Route::post('aseourbano/informacionbasica/reporte/reporteconstructor', 'AuContructorController@view_reporte_constructor')
    ->name('au-reportes.reporteconstructor'); // para ver el historial de los distritos
    // ->middleware('permission:au-barrios.historial');

Route::get('aseourbano/rtdomiciliario/ruta/kardex/{id}', 'AuRutaController@kardex')
    ->name('au-rutas.kardex')
    ->middleware('permission:au-rutas.kardex');// para ver el kardex de una persona


Route::get('aseourbano/rtdomiciliario/descpacho/detalledespacho/partediario/{id?}', 'AuDespachoDetalleController@view_partediario')
    ->name('au-partediario.view');// para hacer la primer derivacion del documento
    // ->middleware('permission:doc-tramite.derivar.tramite');

Route::get('aseourbano/rtdomiciliario/descpacho/detalledespacho/partediariosiguiente/{id?}', 'AuParteMovimientoController@view_partemovimiento')
    ->name('au-partemovimiento.view');

Route::post('aseourbano/rtdomiciliario/descpacho/detalledespacho/partediariosiguiente/movimiento', 'AuParteMovimientoController@store_movimiento')
    ->name('au-partemovimiento.movimiento');
    // ->middleware('permission:au-distritos.update');

Route::post('aseourbano/rtdomiciliario/descpacho/detalledespacho/partediariosiguiente/personalactivo', 'AuParteMovimientoController@store_personal_activo')
    ->name('au-partemovimiento.personalactivo');
    // ->middleware('permission:au-distritos.update');

Route::post('aseourbano/rtdomiciliario/descpacho/detalledespacho/partediariosiguiente/personalreemplazo', 'AuParteMovimientoController@store_personal_reemplazo')
    ->name('au-partemovimiento.personalreemplazo');
    // ->middleware('permission:au-distritos.update');


Route::post('aseourbano/rtdomiciliario/descpacho/detalledespacho/partediariosiguiente/viajes', 'AuParteMovimientoController@store_viajes')
    ->name('au-partemovimiento.detalleviajes');
    // ->middleware('permission:au-distritos.update');

Route::delete('aseourbano/rtdomiciliario/descpacho/detalledespacho/partediariosiguiente/combustible/delete', 'AuDespachoCombustibleController@destroy')->name('destroy.combustible');

    // ruta para abrir la los detalle de cada despachos diarios 
Route::get('aseourbano/despachos/detalledespacho/{id?}', 'AuDespachoController@view_detalle')
    ->name('detalledespachos');

Route::get('aseourbano/despachos/detalledespacho/cerrar/parte/{id?}', 'AuParteMovimientoController@close_parte_diario')
    ->name('au-cerrarparte');



//para editar el detalle de cada despacho  -----env¿cabezado-----   
Route::post('aseourbano/despachos/detalledespacho/editar', 'AuDespachoDetalleController@update_detalledespacho')
->name('au-despachodetalle.update');
// ->middleware('permission:adm-tipodocumento.update');

Route::delete('aseourbano/despachos/detalledespacho/eliminardetalle', 'AuDespachoDetalleController@destroy')
->name('au-despacho.detalle.delete'); // para editar TIPO DE DOUMENTO en el modal
// ->middleware('permission:adm-tipodocumento.update');




Route::delete('aseourbano/despachos/detalledespacho/parte/viajedelete', 'AuParteMovimientoController@delete_viajes')
->name('au-despachodetalle.parte.viaje.delete'); // para editar TIPO DE DOUMENTO en el modal
// ->middleware('permission:adm-tipodocumento.update');

Route::delete('aseourbano/despachos/detalledespacho/parte/personaldelete', 'AuParteMovimientoController@delete_personal_activo')
->name('au-despachodetalle.parte.personal.delete'); // para editar TIPO DE DOUMENTO en el modal
// ->middleware('permission:adm-tipodocumento.update');

Route::delete('aseourbano/despachos/detalledespacho/parte/reemplazodelete', 'AuParteMovimientoController@delete_personal_reemplazo')
->name('au-despachodetalle.parte.reemplazo.delete'); // para editar TIPO DE DOUMENTO en el modal
// ->middleware('permission:adm-tipodocumento.update');


Route::delete('aseourbano/despachos/detalledespacho/parte/movimientodelete', 'AuParteMovimientoController@delete_movimiento')
->name('au-despachodetalle.parte.movimiento.delete'); // para editar TIPO DE DOUMENTO en el modal
// ->middleware('permission:adm-tipodocumento.update');



Route::get('aseourbano/despachos/printf/{id?}', 'AuDespachoController@printf')
 ->name('au-despacho.prinft');// para hacer la primer derivacion del documento
    // ->middleware('permission:doc-tramite.derivar.tramite');

Route::get('aseourbano/despachos/detallesDespachos/printf/{id?}', 'AuDespachoDetalleController@printf')
    ->name('au-despacho.detalledespacho.prinft');// para hacer la primer derivacion del documento
       // ->middleware('permission:doc-tramite.derivar.tramite');

Route::get('aseourbano/rtdomiciliario/despachos/cerrar/{id?}', 'AuDespachoDetalleController@close_despacho')
    ->name('au-rtdomiciliario.despacho.close');// para hacer la primer derivacion del documento
       // ->middleware('permission:doc-tramite.derivar.tramite');

Route::post('aseourbano/rtdomiciliario/reporte/printf', 'AuReporteDomiciliarioController@printf')
    ->name('au-rtdomiciliario.reporte.prinft');// para hacer la primer derivacion del documento
          // ->middleware('permission:doc-tramite.derivar.tramite');

Route::post('aseourbano/rtdomiciliario/reporte/printfmes', 'AuReporteDomiciliarioController@printfmes')
          ->name('au-rtdomiciliario.reporte.mes.prinft');// para hacer la primer derivacion del documento

                //  TR barrido

Route::get('aseourbano/rtbarrido/ruta/kardex/{id}', 'AuBarridoRutaController@kardex')
    ->name('au-rtbarrido.ruta.kardex');
    //->middleware('permission:rrhh-personas.kardex');// para ver el kardex de una persona

Route::get('aseourbano/rtbarrido/despacho/despachodetalle/index/{id}', 'AuBarridoDespachoDetalleController@index')
    ->name('au-rtbarrido.despacho.viewdespachodetalle');   
    //->middleware('permission:rrhh-personas.kardex');// para abrir la vista de barrido-despacho-despachodetalles.............

Route::get('aseourbano/rtbarrido/despacho/despachodetalle/personal/{id}', 'AuBarridoPersonalController@index')
    ->name('au-rtbarrido.despacho.despachodetalle.viewpersonal');   
    //->middleware('permission:rrhh-personas.kardex');// para abrir la vista de barrido-personal.............

Route::delete('aseourbano/rtbarrido/despacho/despachodetalle/personal/eliminar', 'AuBarridoPersonalController@destroy')
->name('au-rtbarrido.despacho.despachodetalle.personal.delete'); // para borrar el personal de cada barrido activo
// ->middleware('permission:adm-tipodocumento.update');

Route::delete('aseourbano/rtbarrido/despacho/despachodetalle/reemplazopersonal/eliminar', 'AuBarridoPersonalReemplazoController@destroy')
->name('au-rtbarrido.despacho.despachodetalle.reemplazopersonal.delete'); // para borrar el personal de cada barrido activo
// ->middleware('permission:adm-tipodocumento.update');

Route::get('aseourbano/rtbarrido/despachos/detallesDespachos/printf/{id?}', 'AuBarridoDespachoDetalleController@printf')
    ->name('au-rtbarrido.despacho.despachodetalle.printf');// para hacer la primer derivacion del documento
       // ->middleware('permission:doc-tramite.derivar.tramite');

Route::get('aseourbano/rtbarrido/despachos/printf/{id?}', 'AuBarridoDespachoController@printf')
    ->name('au-rtbarrido.despacho.despacho.printf');// para hacer la primer derivacion del documento
       // ->middleware('permission:doc-tramite.derivar.tramite');

Route::delete('aseourbano/rtbarrido/despacho/despachodetalles/eliminar', 'AuBarridoDespachoDetalleController@destroy')
    ->name('au-rtbarrido.despacho.despachodetalle.delete'); // para borrar el personal de cada barrido activo
    // ->middleware('permission:adm-tipodocumento.update');

Route::get('aseourbano/rtbarrido/despachos/detallesDespachos/cerrar/{id?}', 'AuBarridoPersonalController@close_despachodetalle')
    ->name('au-rtbarrido.despacho.despachodetalle.close');// para hacer la primer derivacion del documento
       // ->middleware('permission:doc-tramite.derivar.tramite');

Route::get('aseourbano/rtbarrido/despachos/cerrar/{id?}', 'AuBarridoDespachoDetalleController@close_despacho')
    ->name('au-rtbarrido.despacho.close');// para hacer la primer derivacion del documento
       // ->middleware('permission:doc-tramite.derivar.tramite');

Route::post('aseourbano/rtbarrido/despachos/detallesDespachos/editar', 'AuBarridoDespachoDetalleController@update_detalledespacho')
    ->name('au-rtbarrido.despacho.despachodetalle.update');
// ->middleware('permission:adm-tipodocumento.update');


//··················································GESTION RECLAMO····································································
Route::get('aseourbano/gestionreclamo/reclamo/create', 'AuReclamoController@atender_reclamo')
    ->name('au-gestionreclamo.reclamo.atenderreclamo.view')
    ->middleware('permission:au-gestionreclamo.reclamo.atenderreclamo.view');

Route::get('aseourbano/gestionreclamo/reclamo/atenderreclamo/{id?}', 'AuReclamoController@atender_reclamo')
    ->name('au-gestionreclamo.reclamo.atenderreclamo.view')
    ->middleware('permission:au-gestionreclamo.reclamo.atenderreclamo.view');

Route::delete('aseourbano/gestionreclamo/reclamo/atenderreclamo/eliminardetalleunidad', 'AuReclamoAtenderUnidadController@destroy')
    ->name('au-gestionreclamo.reclamo.atenderreclamo.detalleunidad.delete'); // para borrar el personal de cada barrido activo
    // ->middleware('permission:adm-tipodocumento.update');
Route::post('aseourbano/gestionreclamo/reclamo/atenderreclamo/fin', 'AuReclamoController@store_atender_reclamo')
    ->name('au-gestionreclamo.reclamo.atenderreclamo.store')
    ->middleware('permission:au-gestionreclamo.reclamo.atenderreclamo.view'); //                            PERMISSION HIBRIDO DE VISTA Y STORE DE ATENDER RECLAMO

Route::get('aseourbano/gestionreclamo/reclamo/retrazado/printfdetalle/{id?}', 'AuReclamoController@printf_detalle')
    ->name('au-gestionreclamo.reclamo.retrazado.detalle.printf')
    ->middleware('permission:au-gestionreclamo.reclamo.retrazado.detalle.printf');

Route::get('aseourbano/gestionreclamo/reclamo/realizado/printf/{id?}', 'AuReclamoController@printf_realizado')
    ->name('au-gestionreclamo.reclamo.realizado.printf')
    ->middleware('permission:au-gestionreclamo.reclamo.realizado.printf');

Route::post('aseourbano/gestionreclamo/reporte/printf', 'AuReporteReclamoController@printf')
    ->name('au-gestionreclamo.reclamo.reporte.printf');
    // ->middleware('permission:au-gestionreclamo.reclamo.atenderreclamo.view'); 

//.................................................
//.................................................
//.................................................






// prueba______________________________________________________________________________________
// para hacer la primer derivacion del documento
    // ->middleware('permission:doc-tramite.derivar.tramite');

// Route::get('aseourbano/despachos/partepersona/{id?}', 'AuDespachoDetalleController@view_partepersonal')
//     ->name('partediario');// para hacer la primer derivacion del documento
//     // ->middleware('permission:doc-tramite.derivar.tramite');


// Route::post('aseourbano/despachos/detalledespacho/editaraaa', 'AuDespachoDetalleController@update_despacho')
//     ->name('updatedespachodiario');// para cerrar un parte diario
//     // ->middleware('permission:ma-marca.update');

// Route::get('aseourbano/despachos/parteprintf/{id?}', 'AuDespachoDetalleController@printf')
//     ->name('printf_parte');// para hacer la primer derivacion del documento
//     // ->middleware('permission:doc-tramite.derivar.tramite');

// Route::get('aseourbano/despachos/despachoprintf/{id?}', 'AuDespachoController@printf')
//     ->name('printf_despacho');// para hacer la primer derivacion del documento
//     // ->middleware('permission:doc-tramite.derivar.tramite');





















    //7__________________////////////////////////////////_____________________________________////////////////////////////////////____________________________________///////////////////////////______
//_________________________________________________________________________________________________________
//::::::::::::::::::::::::::::::::::::::::::::::                  _HYSO_               ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 

Route::post('/hyso/pdf', 'HyFormularioController@mguardar')
    ->name('guardar');


Route::get('/thesis/file/{id?}', 'HyFormularioController@urlfile')
    ->name('thesis_file');

Route::get('hyso/docuemntoshyso/formularios/ingresoformularios/{id}', 'HyFormularioController@view_ingresoformularios')
    ->name('hy-formularios.ingreso');
    //->middleware('permission:rrhh-personas.kardex');// para ver el kardex de una persona

Route::get('hyso/prueba/print/{id}', 'HyGlicemiaController@printf')
    ->name('hy-prueba.printf');

//_________________________________________________________________________________________________________



Route::resources([
//################################ HOME ####################################
        'home'  => 'HomeController',

//====================================================================================
//################################ ADMINISTRACION ############################################################

//___________________________________ SISTEMA _______________________________________
        'modulo'        =>  'AdmModuloController',
        'opciones'      =>  'AdmOpcionesController',
        'subopciones'   =>  'AdmSubOpcionesController',
        
        'role'          =>  'AdmRoleController',
        'permiso'       =>  'AdmPermissionsController',
        'designacionsistema'=> 'AdmDesignacionSistemaController',        

//________________________________ DOCUMENTACION  ____________________________________
        'tipo_doc'       =>  'AdmTipoDocumentoController',

//________________________________ RECURSO HUMANO ____________________________________
        'persona'       =>  'AdmPersonaController',
        'area'          =>  'AdmAreaController',
        'tipocargo'     =>  'AdmTipoCargoController',
        'cargo'         =>  'AdmCargoController',
        'funcionario'   =>  'AdmFuncionarioController',
        'reemplazo'     =>  'AdmReemplazoController',
        'funreemplazo'   =>  'AdmFuncionarioReemplazoController',
        'designacion'   =>  'AdmDesignacionController',
        'funcionariodesignacionsi'=>  'AdmFuncionarioDesignacionSiController',

//______________________________ GESTION DE USUARIO __________________________________
        'user'          =>  'AdmUsuarioController',

//___________________________________ EMPRESA _______________________________________
        'grupoempresa'  =>  'AdmGrupoEmpresaController',
        'subgrupo'      =>  'AdmSubGrupoController',
        'rubro'         =>  'AdmRubroController',
        'empresa'       =>  'AdmEmpresaController',

//################################ DOCUMENTACION ##############################################################
//________________________________ TRAMITES _____________________________________
        'documentacion'       =>  'DocDocumentacionController',
        'movdoc'              =>  'DocMovimientoDocumentoController',


//################################ MAESTRANZA ##############################################################
        'marca'               =>  'MaMarcaController',
        'modelo'              =>  'MaModeloVehiculoController', 
        'tipovehiculo'        =>  'MaTipoVehiculoController',
        'vehiculo'            =>  'MaVehiculoController',

//################################### ASEO URBANO ####################################################################
        'contacto'            =>  'AuContactoController',
        'distrito'            =>  'AuDistritoController',
        'barrio'              =>  'AuBarrioController',
        'calle'               =>  'AuCalleController',
        'tiposervicioaseo'    =>  'AuTipoServicioController',
        'distritocontacto'    =>  'AuDistritoContactoController',
        'barriocontacto'      =>  'AuBarrioContactoController',
        'contructor'          =>  'AuContructorController',
        'zona'                =>  'AuZonaController',
        'ruta'                =>  'AuRutaController',
        'detalledespacho'     =>  'AuDespachoDetalleController', //en observacion
        'despachoparte'       =>  'AuDespachoParteController',
        'partemovimiento'     =>  'AuParteMovimientoController',
        'combustibles'         =>  'AuDespachoCombustibleController',
//  prueba.......................................................   funciona pero route
        'despacho'            =>  'AuDespachoController',        
        'partepersona'        =>  'AuPartePersonalController',
        'reportebarrido' =>   'AuReporteBarridoController',
                        //...............BARRIDO
        'barridoruta'         =>  'AuBarridoRutaController',
        'barridodespacho'       =>  'AuBarridoDespachoController',
        'barridodespachodetalle'=>  'AuBarridoDespachoDetalleController',
        'barridopersonal'     =>  'AuBarridoPersonalController',
        'barridopersonalreemplazo'     =>  'AuBarridoPersonalReemplazoController',
        'reportedomiciliario' =>   'AuReporteDomiciliarioController',
        //                      RECLAMO
        'reclamo'             =>  'AuReclamoController',
        'reiteracion'             =>  'AuReclamoReiteracionController',
        'reclamounidadatender'       =>  'AuReclamoAtenderUnidadController',
        'reportereclamo' =>   'AuReporteReclamoController',

//################################### HYSO ####################################################################
        'formulario'          =>  'HyFormularioController',
        'glicemia'          =>  'HyGlicemiaController'
]);


//_________________________________________________AJAX ROUTE______________________________________________________
Route::get('login/modulo/{id?}', 'Auth\LoginController@select_modulo')->name('select_modulo');
//_________________________________________________________________________________________________________________
//::::::::::::::::::::::::::::::::::::::::::::::_ADMINISTRACION_::::::::::::::::::::::::::::::::::::::::::: 
//..............................................._EMPRESA_..................................................
Route::get('administracion/empresa/ajaxsubgrupo/{id?}', 'AdmRubroController@selectsubgrupo')
    ->name('selectsubgrupo'); // para obtener los sub grupos de empresa

Route::get('administracion/empresa/ajaxrubro/{id?}', 'AdmEmpresaController@select_ajax_rubro')
    ->name('selectrubro'); // para obtener los rubro de cada sub grupo

Route::get('administracion/empresa/ajaxempresa/{id?}', 'AdmEmpresaController@select_ajax_empresa')
    ->name('selectempresa'); // para obtener las empresas    

//...............................................RECURSOS HUMANOS..................................................
Route::get('administracion/recursoshumanos/ajaxpersonna/{id?}', 'AdmPersonaController@select_persona')
    ->name('selectpersona'); // para obtener la persona seleccionada para obtencion de sus informacion para editar

            //..........incluye modulo aseo urbano......

Route::get('administracion/recursoshumanos/ajaxarea/{id?}', 'AdmAreaController@select_ajax_area')
    ->name('selectarea'); // para obtener las area de cada empresa

Route::get('administracion/recursoshumanos/ajaxcargo/{id?}', 'AdmFuncionarioController@select_ajax_cargo')
    ->name('selectcargo'); // para obtener las area de cada empresa
            //.....................fin..........

Route::get('administracion/recursoshumanos/ajaxfuncionariocargos/{id?}', 'AdmFuncionarioCargoController@select_ajax_activo')
    ->name('selectactivo'); // para obtener las area de cada empresa

Route::get('administracion/recursoshumanos/ajaxreemplazocargo/{id?}', 'AdmReemplazoController@select_ajax_cargo')
    ->name('selectcargoreemplazo'); // para obtener los cargo para los reemplazo

Route::get('administracion/recursoshumanos/activacion/ajaxactivacionaut', 'AdmBajaFunController@activar_ajax_cargo')
    ->name('activar_ajax_cargo'); // para activar los cargo de manera automatico

Route::get('administracion/recursoshumanos/activacion/ajaxdesignacion', 'HomeController@desactivar_ajax_designacion')
    ->name('desactivar_ajax_designacion'); // para activar los cargo de manera automatico

//...............................................SISTEMA..................................................
Route::get('administracion/sistema/ajaxopciones/{id?}', 'AdmSubOpcionesController@select_ajax_opciones')
->name('selectopciones'); // para obtener la opciones

Route::get('administracion/sistema/ajaxsubopciones/{id?}', 'AdmPermissionsController@select_ajax_subopciones')
    ->name('selectsubopcion'); // para obtener la sub opciones
    




//::::::::::::::::::::::::::::::::::::::::::::::_DOCUMENTACION_::::::::::::::::::::::::::::::::::::::::::: 
Route::get('documentacion/bandeja/crear/ajaxcargo/{id?}', 'DocDocumentacionController@select_ajax_cargo')
    ->name('selectcargoibrido'); // para obtenerlos cargos, reemplazo, designacion

Route::get('documentacion/bandeja/crear/ajaxsiglaplus/{id?}', 'DocDocumentacionController@select_ajax_sigla')
    ->name('selectsigla'); // para obtenerlos cargos, reemplazo, designacion





    

//::::::::::::::::::::::::::::::::::::::::::::::::::MAESTRANZA::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('maestranza/maquinariaequipo/vehiculo/ajaxmodelo/{id?}', 'MaVehiculoController@select_ajax_modelo')
    ->name('selectmodelo'); // para obtenerlos los modelos de a cuerdo a la marca seleccionada

Route::get('maestranza/maquinariaequipo/vehiculo/ajaxhibridoempresa/{id?}', 'MaVehiculoController@select_hibrido_empresa')
    ->name('selecthibridoempresa'); // para obtener todas las empresas que proveen vehiculo

Route::get('maestranza/maquinariaequipo/calculoajax/{id?}', 'MaVehiculoController@ajax_calculo')
    ->name('ajaxcalculo'); // para el interno




//::::::::::::::::::::::::::::::::::::::::::::::::::::ASEO URBANO:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('aseourbano/informacionbasica/reporte/selectajaxbarrio/{id?}', 'AuContructorController@select_ajax_barrios')
    ->name('selectajaxbarrios'); //para obtener todos los barrios/o los barrios de un distrito
//...................Despacho-selecion de personal para el parte diario
Route::get('aseourbano/rtdomiciliario/despacho/rutas/personactiva/{id?}/{despacho?}', 'AuParteMovimientoController@select_ajax_personal')
    ->name('selectpersonas');

Route::get('aseourbano/rtbarrido/despacho/despachodetalles/barridopersona/personactiva/{id?}', 'AuBarridoPersonalController@select_ajax_personal')
    ->name('selectpersonasbarrido');//para seleccionar el personal del barrido


    // barrido rutas.........................................
Route::get('aseourbano/rtbarrido/despacho/despachodetalle/rutas/{id?}/{ruta_id?}', 'AuBarridoDespachoDetalleController@select_ajax_rutas')
    ->name('selectbarridodespachoruta');

    //gestion de reclamo
Route::get('aseourbano/gestionreclamo/reclamo/calle/{id?}', 'AuReclamoController@select_ajax_calle')
    ->name('selecreclamocalle');


Route::get('aseourbano/gestionreclamo/reclamo/activarretrazo', 'AuReclamoController@ajax_retrazo_reclamo')
    ->name('reclamo-activar.retrazo');

Route::get('aseourbano/gestionreclamo/reclamo/reportebarrio/barrios/{id?}', 'AuReporteReclamoController@select_ajax_barrio')
    ->name('reclamo-reporte.barrio');

Route::get('aseourbano/gestionreclamo/reclamo/reportecalle/calles/{id?}', 'AuReporteReclamoController@select_ajax_calle')
    ->name('reclamo-reporte.calle');




    












//prueba_______________________________
Route::get('aseourbano/persona/selectajax/{id?}', 'AuDespachoDetalleController@select_ajax_personal')
    ->name('au_select_ajax_personal'); // para el interno