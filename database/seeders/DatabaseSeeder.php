<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    public function run(){
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(ParametroGrupoTableSeeder::class);
        $this->call(MaterialTableSeeder::class);
        $this->call(TerceroTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(VehiculoTableSeeder::class);
        $this->call(ViajeTableSeeder::class);
    }
}