<?php
namespace Database\Seeders;
use App\Models\Grupo;
use App\Models\Parametro;
use Illuminate\Database\Seeder;

class ParametroGrupoTableSeeder extends Seeder{
    public function run(){
        Parametro::create(['id' => 1, 'nombre' => 'Persona natural']);
        Parametro::create(['id' => 2, 'nombre' => 'Persona jurídica']);
        Grupo::create(['id' => 1, 'nombre' => 'Tipo de persona'])->parametros()->sync([1, 2]);
        Parametro::create(['id' => 3, 'nombre' => 'Cédula de ciudadanía']);
        Parametro::create(['id' => 4, 'nombre' => 'Cédula de extranjería']);
        Parametro::create(['id' => 5, 'nombre' => 'Pasaporte']);
        Grupo::create(['id' => 2, 'nombre' => 'Tipo de documento persona natural'])->parametros()->sync([3, 4, 5]);
        Parametro::create(['id' => 6, 'nombre' => 'NIT']);
        Parametro::create(['id' => 7, 'nombre' => 'RUT']);
        Grupo::create(['id' => 3, 'nombre' => 'Tipo de documento persona jurídica'])->parametros()->sync([6, 7]);
        Parametro::create(['id' => 8, 'nombre' => 'Gerente']);
        Parametro::create(['id' => 9, 'nombre' => 'Secretaria']);
        Parametro::create(['id' => 10, 'nombre' => 'Logística']);
        Parametro::create(['id' => 11, 'nombre' => 'Conductor']);
        Grupo::create(['id' => 4, 'nombre' => 'Tipo de función empresa'])->parametros()->sync([8, 9, 10, 11]);
        Parametro::create(['id' => 12, 'nombre' => 'Frente 1 Norte']);
        Parametro::create(['id' => 13, 'nombre' => 'Frente 1 Sur']);
        Parametro::create(['id' => 14, 'nombre' => 'Frente 2']);
        Parametro::create(['id' => 15, 'nombre' => 'Frente 3']);
        Grupo::create(['id' => 5, 'nombre' => 'Frentes'])->parametros()->sync([12, 13, 14, 15]);
        Parametro::create(['id' => 16, 'nombre' => 'Recebo común']);
        Parametro::create(['id' => 17, 'nombre' => 'B-200']);
        Parametro::create(['id' => 18, 'nombre' => 'B-400']);
        Parametro::create(['id' => 19, 'nombre' => 'Caolín']);
        Parametro::create(['id' => 20, 'nombre' => 'Sobrante de Zaranda']);
        Parametro::create(['id' => 21, 'nombre' => 'Piedra rajón']);
        Parametro::create(['id' => 22, 'nombre' => 'B-600']);
        Parametro::create(['id' => 23, 'nombre' => 'Piedra filtro']);
        Parametro::create(['id' => 24, 'nombre' => 'Bases']);
        Parametro::create(['id' => 25, 'nombre' => 'Sub bases granulares']);
        Parametro::create(['id' => 26, 'nombre' => 'Arena']);
        Parametro::create(['id' => 27, 'nombre' => 'Triturado 1/2']);
        Parametro::create(['id' => 28, 'nombre' => 'Triturado 3/4']);
        Parametro::create(['id' => 29, 'nombre' => 'SBG']);
        Parametro::create(['id' => 30, 'nombre' => 'SBG-C']);
        Grupo::create(['id' => 6, 'nombre' => 'Sub materiales'])->parametros()->sync([16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]);
        Parametro::create(['id' => 31, 'nombre' => 'Sub tema 1']);
        Parametro::create(['id' => 32, 'nombre' => 'Sub tema 2']);
        Parametro::create(['id' => 33, 'nombre' => 'Sub tema 3']);
        Parametro::create(['id' => 34, 'nombre' => 'Sub tema 4']);
        Parametro::create(['id' => 35, 'nombre' => 'Sub tema 5']);
        Parametro::create(['id' => 36, 'nombre' => 'Sub tema 6']);
        Grupo::create(['id' => 7, 'nombre' => 'Sub temas'])->parametros()->sync([31, 32, 33, 34, 35, 36]);
    }
}