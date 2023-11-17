<?php
namespace Database\Seeders;
use App\Models\Material;

use Illuminate\Database\Seeder;

class MaterialTableSeeder extends Seeder{
    public function run(){
        // Crear Material
        Material::create(['id' => 1, 'nombre' => 'Finos'])->submateriales()->sync([16, 17, 18, 19]);
        Material::create(['id' => 2, 'nombre' => 'Duros'])->submateriales()->sync([20, 21, 22, 23]);
        Material::create(['id' => 3, 'nombre' => 'Triturados'])->submateriales()->sync([24, 25, 26, 27, 28, 29, 30]);
    }
}