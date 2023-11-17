<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MinaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Empresa\CubicajeController;
use App\Http\Controllers\Empresa\FacturaController;
use App\Http\Controllers\Empresa\ViajeController;
use App\Http\Controllers\Empresa\DocumentoController;
use App\Http\Controllers\Empresa\EmpresaController;
use App\Http\Controllers\Empresa\OperadorController;
use App\Http\Controllers\Empresa\TransporteController;
use App\Http\Controllers\Empresa\VehiculoController;
use App\Http\Controllers\Administracion\TerceroController;
use App\Http\Controllers\Administracion\TemaController;
use App\Http\Controllers\Administracion\MaterialController;
use App\Http\Controllers\Administracion\GrupoController;
use App\Http\Controllers\Administracion\ParametroController;
use App\Http\Controllers\Acceso\UsuarioController;
use App\Http\Controllers\Acceso\RolController;
use App\Http\Controllers\Acceso\PermisoController;

Route::get('/', [WelcomeController::class, 'index'])->name('/');
Route::post('contacto', [WelcomeController::class, 'contacto'])->name('contacto');
// Route::get('storage-link', function(){
// 	$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/mina_app/storage/app/public';
// 	$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
// 	symlink($targetFolder, $linkFolder);
// });
Route::prefix('mina')->group(function () {
	Route::get('/', [MinaController::class, 'index'])->name('mina');
	Route::get('origen', [ViajeController::class, 'origin'])->name('origen');
	Route::post('origen', [ViajeController::class, 'origin']);
	Route::prefix('factura')->group(function () {
		Route::middleware(['permission:Factura leer|Factura crear|Factura editar|Factura borrar'])->group(function () {
			Route::get('', [FacturaController::class, 'index'])->name('factura');
			Route::get('listar', [FacturaController::class, 'list'])->name('factura.listar');
		});
		Route::middleware(['permission:Factura crear'])->group(function () {
			Route::post('buscar', [FacturaController::class, 'create'])->name('factura.buscar');
		});
		Route::middleware(['permission:Factura crear', 'mina'])->group(function () {
			Route::get('crear', [FacturaController::class, 'create'])->name('factura.crear');
			Route::post('crear', [FacturaController::class, 'store']);
		});
		Route::middleware(['permission:Factura editar'])->group(function () {
			Route::post('buscarEditar/{id}', [FacturaController::class, 'edit'])->name('factura.buscarEditar');
			Route::get('editar/{id}', [FacturaController::class, 'edit'])->name('factura.editar');
		});
		Route::middleware(['permission:Factura editar', 'mina'])->group(function () {
			Route::put('editar/{id}', [FacturaController::class, 'update']);
		});
		Route::middleware(['permission:Factura leer'])->group(function () {
			Route::get('pdf/{id}', [FacturaController::class, 'pdf'])->name('factura.pdf');
			Route::get('excel/{id}', [FacturaController::class, 'excel'])->name('factura.excel');
		});
		Route::middleware(['permission:Factura leer', 'mina'])->group(function () {
			Route::get('activar/{id}', [FacturaController::class, 'destroy'])->name('factura.activar');
		});
	});
	Route::prefix('cubicaje')->group(function () {
		Route::middleware(['permission:Cubicaje leer|Cubicaje crear|Cubicaje editar|Cubicaje borrar'])->group(function () {
			Route::get('', [CubicajeController::class, 'index'])->name('cubicaje');
			Route::get('listar', [CubicajeController::class, 'list'])->name('cubicaje.listar');
		});
		Route::middleware(['permission:Cubicaje crear', 'mina'])->group(function () {
			Route::get('crear', [CubicajeController::class, 'create'])->name('cubicaje.crear');
			Route::post('crear', [CubicajeController::class, 'store']);
		});
		Route::middleware(['permission:Cubicaje editar'])->group(function () {
			Route::get('editar/{id}', [CubicajeController::class, 'edit'])->name('cubicaje.editar');
		});
		Route::middleware(['permission:Cubicaje editar', 'mina'])->group(function () {
			Route::put('editar/{id}', [CubicajeController::class, 'update']);
		});
		Route::middleware(['permission:Cubicaje leer'])->group(function () {
			Route::get('pdf/{id}', [CubicajeController::class, 'pdf'])->name('cubicaje.pdf');
		});
		Route::middleware(['permission:Cubicaje leer', 'mina'])->group(function () {
			Route::get('activar/{id}', [CubicajeController::class, 'destroy'])->name('cubicaje.activar');
		});
	});
	Route::prefix('viaje')->group(function () {
		Route::middleware(['permission:Viaje leer|Viaje crear|Viaje editar|Viaje borrar'])->group(function () {
			Route::get('', [ViajeController::class, 'index'])->name('viaje');
			Route::get('listar', [ViajeController::class, 'list'])->name('viaje.listar');
		});
		Route::middleware(['permission:Factura leer|Factura crear|Factura editar|Factura borrar', 'mina'])->group(function () {
			Route::get('listarOperador/{id}/{desde}/{hasta}', [ViajeController::class, 'listOperator'])->name('viaje.listarOperador');
		});
		Route::middleware(['permission:Factura leer|Factura crear|Factura editar|Factura borrar'])->group(function () {
			Route::get('listarFactura/{id}', [ViajeController::class, 'listInvoice'])->name('viaje.listarFactura');
		});
		Route::middleware(['permission:Viaje crear', 'mina'])->group(function () {
			Route::get('crear', [ViajeController::class, 'create'])->name('viaje.crear');
			Route::post('crear', [ViajeController::class, 'store']);
		});
		Route::middleware(['permission:Viaje editar', 'mina'])->group(function () {
			Route::get('editar/{id}', [ViajeController::class, 'edit'])->name('viaje.editar');
			Route::put('editar/{id}', [ViajeController::class, 'update']);
		});
		Route::middleware(['permission:Viaje borrar', 'mina'])->group(function () {
			Route::get('activar/{id}', [ViajeController::class, 'destroy'])->name('viaje.activar');
		});
	});
	Route::middleware(['guest'])->group(function () {
		Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
		Route::post('login', [LoginController::class, 'Login']);
	});
	Route::middleware(['auth'])->group(function () {
		Route::post('logout', [LoginController::class, 'logout'])->name('logout');
		Route::get('clave', [MinaController::class, 'clave'])->name('clave');
		Route::post('clave', [MinaController::class, 'cambio']);
		Route::middleware(['mina'])->group(function () {
			Route::prefix('documento')->group(function () {
				Route::middleware(['permission:Documento leer|Documento crear|Documento editar|Documento borrar'])->group(function () {
					Route::get('', [DocumentoController::class, 'index'])->name('documento');
					Route::get('listar', [DocumentoController::class, 'list'])->name('documento.listar');
				});
				Route::middleware(['permission:Documento crear'])->group(function () {
					Route::get('crear', [DocumentoController::class, 'create'])->name('documento.crear');
					Route::post('crear', [DocumentoController::class, 'store']);
				});
				Route::middleware(['permission:Documento editar'])->group(function () {
					Route::get('editar/{id}', [DocumentoController::class, 'edit'])->name('documento.editar');
					Route::put('editar/{id}', [DocumentoController::class, 'update']);
				});
				Route::middleware(['permission:Documento borrar'])->group(function () {
					Route::get('activar/{id}', [DocumentoController::class, 'destroy'])->name('documento.activar');
				});
			});
			Route::prefix('empresa')->group(function () {
				Route::middleware(['permission:Empresa leer|Empresa crear|Empresa editar|Empresa borrar'])->group(function () {
					Route::get('', [EmpresaController::class, 'index'])->name('empresa');
					Route::get('listarContacto/{id}', [EmpresaController::class, 'listContact'])->name('empresa.listarContacto');
				});
				Route::middleware(['permission:Empresa crear'])->group(function () {
					Route::post('crearContacto/{id}', [EmpresaController::class, 'storeContact'])->name('empresa.crearContacto');
				});
				Route::middleware(['permission:Empresa borrar'])->group(function () {
					Route::get('borrarContacto/{id}/{id1}', [EmpresaController::class, 'destroyContact'])->name('empresa.borrarContacto');
				});
			});
			Route::prefix('operador')->group(function () {
				Route::middleware(['permission:Operador leer|Operador crear|Operador editar|Operador borrar'])->group(function () {
					Route::get('', [OperadorController::class, 'index'])->name('operador');
					Route::get('listar', [OperadorController::class, 'list'])->name('operador.listar');
					Route::get('listarContacto/{id}', [OperadorController::class, 'listContact'])->name('operador.listarContacto');
					Route::get('listarMaterial/{id}', [OperadorController::class, 'listMaterial'])->name('operador.listarMaterial');
					Route::get('listarTransporte/{id}', [OperadorController::class, 'listTransport'])->name('operador.listarTransporte');
				});
				Route::middleware(['permission:Operador crear'])->group(function () {
					Route::get('crear', [OperadorController::class, 'create'])->name('operador.crear');
					Route::post('crear', [OperadorController::class, 'store']);
					Route::post('crearContacto/{id}', [OperadorController::class, 'storeContact'])->name('operador.crearContacto');
					Route::post('crearMaterial/{id}', [OperadorController::class, 'storeMaterial'])->name('operador.crearMaterial');
					Route::post('crearTransporte/{id}', [OperadorController::class, 'storeTransport'])->name('operador.crearTransporte');
				});
				Route::middleware(['permission:Operador editar'])->group(function () {
					Route::get('editar/{id}', [OperadorController::class, 'edit'])->name('operador.editar');
					Route::put('editar/{id}', [OperadorController::class, 'update']);
				});
				Route::middleware(['permission:Operador borrar'])->group(function () {
					Route::get('borrarContacto/{id}/{id1}', [OperadorController::class, 'destroyContact'])->name('operador.borrarContacto');
					Route::get('borrarMaterial/{id}/{id1}', [OperadorController::class, 'destroyMaterial'])->name('operador.borrarMaterial');
					Route::get('borrarTransporte/{id}/{id1}', [OperadorController::class, 'destroyTransport'])->name('operador.borrarTransporte');
				});
			});
			Route::prefix('transporte')->group(function () {
				Route::middleware(['permission:Transporte leer|Transporte crear|Transporte editar|Transporte borrar'])->group(function () {
					Route::get('', [TransporteController::class, 'index'])->name('transporte');
					Route::get('listar', [TransporteController::class, 'list'])->name('transporte.listar');
					Route::get('listarContacto/{id}', [TransporteController::class, 'listContact'])->name('transporte.listarContacto');
					Route::get('listarVehiculo/{id}', [TransporteController::class, 'listVehicle'])->name('transporte.listarVehiculo');
				});
				Route::middleware(['permission:Transporte crear'])->group(function () {
					Route::get('crear', [TransporteController::class, 'create'])->name('transporte.crear');
					Route::post('crear', [TransporteController::class, 'store']);
					Route::post('crearContacto/{id}', [TransporteController::class, 'storeContact'])->name('transporte.crearContacto');
					Route::post('crearVehiculo/{id}', [TransporteController::class, 'storeVehicle'])->name('transporte.crearVehiculo');
				});
				Route::middleware(['permission:Transporte editar'])->group(function () {
					Route::get('editar/{id}', [TransporteController::class, 'edit'])->name('transporte.editar');
					Route::put('editar/{id}', [TransporteController::class, 'update']);
				});
				Route::middleware(['permission:Transporte borrar'])->group(function () {
					Route::get('borrarContacto/{id}/{id1}', [TransporteController::class, 'destroyContact'])->name('transporte.borrarContacto');
					Route::get('borrarVehiculo/{id}/{id1}', [TransporteController::class, 'destroyVehicle'])->name('transporte.borrarVehiculo');
				});
			});
			Route::prefix('vehiculo')->group(function () {
				Route::middleware(['permission:Vehiculo leer|Vehiculo crear|Vehiculo editar|Vehiculo borrar'])->group(function () {
					Route::get('', [VehiculoController::class, 'index'])->name('vehiculo');
					Route::get('listar', [VehiculoController::class, 'list'])->name('vehiculo.listar');
				});
				Route::middleware(['permission:Vehiculo crear'])->group(function () {
					Route::get('crear', [VehiculoController::class, 'create'])->name('vehiculo.crear');
					Route::post('crear', [VehiculoController::class, 'store']);
				});
				Route::middleware(['permission:Vehiculo editar'])->group(function () {
					Route::get('editar/{id}', [VehiculoController::class, 'edit'])->name('vehiculo.editar');
					Route::put('editar/{id}', [VehiculoController::class, 'update']);
				});
				Route::middleware(['permission:Vehiculo borrar'])->group(function () {
					Route::get('activar/{id}', [VehiculoController::class, 'destroy'])->name('vehiculo.activar');
				});
			});
			Route::prefix('tercero')->group(function () {
				Route::middleware(['permission:Tercero leer|Tercero crear|Tercero editar|Tercero borrar'])->group(function () {
					Route::get('', [TerceroController::class, 'index'])->name('tercero');
					Route::get('listar', [TerceroController::class, 'list'])->name('tercero.listar');
				});
				Route::middleware(['permission:Tercero crear'])->group(function () {
					Route::get('crear', [TerceroController::class, 'create'])->name('tercero.crear');
					Route::post('crear', [TerceroController::class, 'store']);
				});
				Route::middleware(['permission:Tercero editar'])->group(function () {
					Route::get('editar/{id}', [TerceroController::class, 'edit'])->name('tercero.editar');
					Route::put('editar/{id}', [TerceroController::class, 'update']);
				});
			});
			Route::prefix('tema')->group(function () {
				Route::middleware(['permission:Tema leer|Tema crear|Tema editar|Tema borrar'])->group(function () {
					Route::get('', [TemaController::class, 'index'])->name('tema');
					Route::get('listar', [TemaController::class, 'list'])->name('tema.listar');
				});
				Route::middleware(['permission:Tema editar|Tema borrar'])->group(function () {
					Route::get('listarParametro/{id}', [TemaController::class, 'listParametro'])->name('tema.listarParametro');
				});
				Route::middleware(['permission:Tema crear'])->group(function () {
					Route::get('crear', [TemaController::class, 'create'])->name('tema.crear');
					Route::post('crear', [TemaController::class, 'store']);
				});
				Route::middleware(['permission:Tema editar'])->group(function () {
					Route::get('editar/{id}', [TemaController::class, 'edit'])->name('tema.editar');
					Route::put('editar/{id}', [TemaController::class, 'update']);
					Route::get('agregar/{id}/{id0}', [TemaController::class, 'updateParametro'])->name('tema.agregar');
				});
				Route::middleware(['permission:Tema borrar'])->group(function () {
					Route::get('eliminar/{id}/{id0}', [TemaController::class, 'destroyParametro'])->name('tema.eliminar');
				});
			});
//			Route::prefix('material')->group(function () {
//				Route::middleware(['permission:Material leer|Material crear|Material editar|Material borrar'])->group(function () {
//					Route::get('', [MaterialController::class, 'index'])->name('material');
//					Route::get('listar', [MaterialController::class, 'list'])->name('material.listar');
//				});
//				Route::middleware(['permission:Material editar|Material borrar'])->group(function () {
//					Route::get('listarParametro/{id}', [MaterialController::class, 'listParametro'])->name('material.listarParametro');
//				});
//				Route::middleware(['permission:Material crear'])->group(function () {
//					Route::get('crear', [MaterialController::class, 'create'])->name('material.crear');
//					Route::post('crear', [MaterialController::class, 'store']);
//				});
//				Route::middleware(['permission:Material editar'])->group(function () {
//					Route::get('editar/{id}', [MaterialController::class, 'edit'])->name('material.editar');
//					Route::put('editar/{id}', [MaterialController::class, 'update']);
//					Route::get('agregar/{id}/{id0}', [MaterialController::class, 'updateParametro'])->name('material.agregar');
//				});
//				Route::middleware(['permission:Material borrar'])->group(function () {
//					Route::get('eliminar/{id}/{id0}', [MaterialController::class, 'destroyParametro'])->name('material.eliminar');
//				});
//			});
			Route::middleware(['permission:Material leer|Material crear|Material editar|Material borrar'])->group(function () {
				Route::get('material', function () {
					return view('mina.administracion.material');
				})->name('material');
			});
			Route::prefix('grupo')->group(function () {
				Route::middleware(['permission:Grupo leer|Grupo crear|Grupo editar|Grupo borrar'])->group(function () {
					Route::get('', [GrupoController::class, 'index'])->name('grupo');
					Route::get('listar', [GrupoController::class, 'list'])->name('grupo.listar');
				});
				Route::middleware(['permission:Grupo editar|Grupo borrar'])->group(function () {
					Route::get('listarParametro/{id}', [GrupoController::class, 'listParametro'])->name('grupo.listarParametro');
				});
				Route::middleware(['permission:Grupo crear'])->group(function () {
					Route::get('crear', [GrupoController::class, 'create'])->name('grupo.crear');
					Route::post('crear', [GrupoController::class, 'store']);
				});
				Route::middleware(['permission:Grupo editar'])->group(function () {
					Route::get('editar/{id}', [GrupoController::class, 'edit'])->name('grupo.editar');
					Route::put('editar/{id}', [GrupoController::class, 'update']);
					Route::get('agregar/{id}/{id0}', [GrupoController::class, 'updateParametro'])->name('grupo.agregar');
				});
				Route::middleware(['permission:Grupo borrar'])->group(function () {
					Route::get('eliminar/{id}/{id0}', [GrupoController::class, 'destroyParametro'])->name('grupo.eliminar');
				});
			});
			Route::prefix('parametro')->group(function () {
				Route::middleware(['permission:Parametro leer|Parametro crear|Parametro editar|Parametro borrar'])->group(function () {
					Route::get('', [ParametroController::class, 'index'])->name('parametro');
					Route::get('listar', [ParametroController::class, 'list'])->name('parametro.listar');
				});
				Route::middleware(['permission:Parametro crear'])->group(function () {
					Route::get('crear', [ParametroController::class, 'create'])->name('parametro.crear');
					Route::post('crear', [ParametroController::class, 'store']);
				});
				Route::middleware(['permission:Parametro editar'])->group(function () {
					Route::get('editar/{id}', [ParametroController::class, 'edit'])->name('parametro.editar');
					Route::put('editar/{id}', [ParametroController::class, 'update']);
				});
			});
			Route::prefix('usuario')->group(function () {
				Route::middleware(['permission:Usuario leer|Usuario crear|Usuario editar|Usuario borrar'])->group(function () {
					Route::get('', [UsuarioController::class, 'index'])->name('usuario');
					Route::get('listar', [UsuarioController::class, 'list'])->name('usuario.listar');
				});
				Route::middleware(['permission:Usuario crear'])->group(function () {
					Route::get('crear', [UsuarioController::class, 'create'])->name('usuario.crear');
					Route::post('crear', [UsuarioController::class, 'store']);
				});
				Route::middleware(['permission:Usuario editar'])->group(function () {
					Route::get('editar/{id}', [UsuarioController::class, 'edit'])->name('usuario.editar');
					Route::put('editar/{id}', [UsuarioController::class, 'update']);
				});
				Route::middleware(['permission:Usuario borrar'])->group(function () {
					Route::get('ver/{id}', [UsuarioController::class, 'show'])->name('usuario.ver');
					Route::delete('ver/{id}', [UsuarioController::class, 'destroy']);
				});
			});
			Route::prefix('rol')->group(function () {
				Route::middleware(['permission:Rol leer|Rol crear|Rol editar|Rol borrar'])->group(function () {
					Route::get('', [RolController::class, 'index'])->name('rol');
					Route::get('listar', [RolController::class, 'list'])->name('rol.listar');
				});
				Route::middleware(['permission:Rol crear'])->group(function () {
					Route::get('crear', [RolController::class, 'create'])->name('rol.crear');
					Route::post('crear', [RolController::class, 'store']);
				});
				Route::middleware(['permission:Rol editar'])->group(function () {
					Route::get('editar/{id}', [RolController::class, 'edit'])->name('rol.editar');
					Route::put('editar/{id}', [RolController::class, 'update']);
				});
				Route::middleware(['permission:Rol borrar'])->group(function () {
					Route::get('ver/{id}', [RolController::class, 'show'])->name('rol.ver');
					Route::delete('ver/{id}', [RolController::class, 'destroy']);
				});
			});
			Route::prefix('permiso')->group(function () {
				Route::middleware(['permission:Permiso leer|Permiso crear|Permiso editar|Permiso borrar'])->group(function () {
					Route::get('', [PermisoController::class, 'index'])->name('permiso');
					Route::get('listar', [PermisoController::class, 'list'])->name('permiso.listar');
				});
				Route::middleware(['permission:Permiso crear'])->group(function () {
					Route::get('crear', [PermisoController::class, 'create'])->name('permiso.crear');
					Route::post('crear', [PermisoController::class, 'store']);

				});
				Route::middleware(['permission:Permiso editar'])->group(function () {
					Route::get('editar/{id}', [PermisoController::class, 'edit'])->name('permiso.editar');
					Route::put('editar/{id}', [PermisoController::class, 'update']);
				});
				Route::middleware(['permission:Permiso borrar'])->group(function () {
					Route::get('ver/{id}', [PermisoController::class, 'show'])->name('permiso.ver');
					Route::delete('ver/{id}', [PermisoController::class, 'destroy']);
				});
			});
		});
	});
});
