<?php

use App\Http\Livewire\Component1;
use App\Http\Livewire\PosController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\UsersController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\ReportsController;
use App\Http\Livewire\PermisosController;
use App\Http\Controllers\ExportController;
use App\Http\Livewire\AlmacenesController;
use App\Http\Livewire\ZonasController;
use App\Http\Livewire\InventariosController;
use App\Http\Livewire\UsuariosconteosController;
use App\Http\Livewire\ProductosController;
use App\Http\Livewire\ExistenciasController;
use App\Http\Livewire\ProdunidController;
use App\Http\Livewire\ConteosController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]); // deshabilitamos el registro de nuevos users

Route::get('/home', ProductosController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('produnid', ProdunidController::class)->middleware('role:ADMIN');
    Route::get('existencias', ExistenciasController::class)->middleware('role:ADMIN');
    Route::get('excel', ProductosController::class)->middleware('role:ADMIN');
    
    Route::get('almacenes', AlmacenesController::class)->middleware('role:ADMIN');
    Route::get('zonas', ZonasController::class)->middleware('role:ADMIN');  
    Route::get('inventarios', InventariosController::class)->middleware('role:ADMIN');    
    Route::get('usuariosconteos', UsuariosconteosController::class)->middleware('role:ADMIN');

    Route::get('conteos', ConteosController::class);
     

    Route::group(['middleware' => ['role:ADMIN']], function () {
        Route::get('roles', RolesController::class);
        Route::get('permisos', PermisosController::class);
        Route::get('asignar', AsignarController::class);
    });

    Route::get('users', UsersController::class);
    Route::get('reports', ReportsController::class);
    
    //reportes PDF
    Route::get('report/pdf/{user}/{type}/{f1}/{f2}', [ExportController::class, 'reportPDF']);
    Route::get('report/pdf/{user}/{type}', [ExportController::class, 'reportPDF']);


    //reportes EXCEL
    Route::get('report/excel/{user}/{type}/{f1}/{f2}', [ExportController::class, 'reporteExcel']);
    Route::get('report/excel/{user}/{type}', [ExportController::class, 'reporteExcel']);
});























Route::get('conte', Component1::class);
Route::get('conte2', function () {
    return view('contenedor');
});



//rutas utils
//Route::get('select2', Select2::class);
