<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleTableSeeder extends Seeder{
    public function run(){
    	// Restablecer roles y permisos en caché
    	app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    	// crear permisos Factura
	    Permission::create(['name' => 'Factura leer']);
	    Permission::create(['name' => 'Factura crear']);
	    Permission::create(['name' => 'Factura editar']);
	    Permission::create(['name' => 'Factura borrar']);
    	// crear permisos Viaje
	    Permission::create(['name' => 'Viaje leer']);
	    Permission::create(['name' => 'Viaje crear']);
	    Permission::create(['name' => 'Viaje editar']);
	    Permission::create(['name' => 'Viaje borrar']);
    	// crear permisos Vehículo
	    Permission::create(['name' => 'Vehiculo leer']);
	    Permission::create(['name' => 'Vehiculo crear']);
	    Permission::create(['name' => 'Vehiculo editar']);
	    Permission::create(['name' => 'Vehiculo borrar']);
    	// crear permisos Transporte
	    Permission::create(['name' => 'Transporte leer']);
	    Permission::create(['name' => 'Transporte crear']);
	    Permission::create(['name' => 'Transporte editar']);
	    Permission::create(['name' => 'Transporte borrar']);
    	// crear permisos Operador
	    Permission::create(['name' => 'Operador leer']);
	    Permission::create(['name' => 'Operador crear']);
	    Permission::create(['name' => 'Operador editar']);
	    Permission::create(['name' => 'Operador borrar']);
	    // crear permisos Empresa
	    Permission::create(['name' => 'Empresa leer']);
	    Permission::create(['name' => 'Empresa crear']);
	    Permission::create(['name' => 'Empresa editar']);
	    Permission::create(['name' => 'Empresa borrar']);
    	// crear permisos Tercero
	    Permission::create(['name' => 'Tercero leer']);
	    Permission::create(['name' => 'Tercero crear']);
	    Permission::create(['name' => 'Tercero editar']);
	    Permission::create(['name' => 'Tercero borrar']);
	    // crear permisos Tema
	    Permission::create(['name' => 'Tema leer']);
	    Permission::create(['name' => 'Tema crear']);
	    Permission::create(['name' => 'Tema editar']);
	    Permission::create(['name' => 'Tema borrar']);
	    // crear permisos Material
	    Permission::create(['name' => 'Material leer']);
	    Permission::create(['name' => 'Material crear']);
	    Permission::create(['name' => 'Material editar']);
	    Permission::create(['name' => 'Material borrar']);
    	// crear permisos Grupo
	    Permission::create(['name' => 'Grupo leer']);
	    Permission::create(['name' => 'Grupo crear']);
	    Permission::create(['name' => 'Grupo editar']);
	    Permission::create(['name' => 'Grupo borrar']);
    	// crear permisos Parametro
	    Permission::create(['name' => 'Parametro leer']);
	    Permission::create(['name' => 'Parametro crear']);
	    Permission::create(['name' => 'Parametro editar']);
	    Permission::create(['name' => 'Parametro borrar']);
	    // crear permisos Usuario
	    Permission::create(['name' => 'Usuario leer']);
	    Permission::create(['name' => 'Usuario crear']);
	    Permission::create(['name' => 'Usuario editar']);
	    Permission::create(['name' => 'Usuario borrar']);
	    // crear permisos Rol
	    Permission::create(['name' => 'Rol leer']);
	    Permission::create(['name' => 'Rol crear']);
	    Permission::create(['name' => 'Rol editar']);
	    Permission::create(['name' => 'Rol borrar']);
	    // crear permisos Permiso
	    Permission::create(['name' => 'Permiso leer']);
	    Permission::create(['name' => 'Permiso crear']);
	    Permission::create(['name' => 'Permiso editar']);
	    Permission::create(['name' => 'Permiso borrar']);
	    // crear roles y asignar los permisos
    	Role::create(['name' => 'Super administrador'])->givePermissionTo(Permission::all());
    }
}