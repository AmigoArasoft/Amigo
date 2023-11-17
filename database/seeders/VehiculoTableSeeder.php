<?php
namespace Database\Seeders;
use App\Models\Vehiculo;

use Illuminate\Database\Seeder;

class VehiculoTableSeeder extends Seeder{
    public function run(){
        // Crear Vehiculos
        Vehiculo::create([
            'id' => 1,
            'tercero_id' => 4,
            'conductor_id' => 20,
            'placa' => 'ABC001',
            'volumen' => 11.01,
            'marca' => 'Marca uno',
        ]);
        Vehiculo::create([
            'id' => 2,
            'tercero_id' => 4,
            'conductor_id' => 21,
            'placa' => 'ABC002',
            'volumen' => 12.02,
            'marca' => 'Marca dos',
        ]);
        Vehiculo::create([
            'id' => 3,
            'tercero_id' => 4,
            'conductor_id' => 22,
            'placa' => 'ABC003',
            'volumen' => 13.03,
            'marca' => 'Marca tres',
        ]);
        Vehiculo::create([
            'id' => 4,
            'tercero_id' => 5,
            'conductor_id' => 23,
            'placa' => 'ABC004',
            'volumen' => 14.04,
            'marca' => 'Marca cuatro',
        ]);
        Vehiculo::create([
            'id' => 5,
            'tercero_id' => 5,
            'conductor_id' => 24,
            'placa' => 'ABC005',
            'volumen' => 15.05,
            'marca' => 'Marca cinco',
        ]);
        Vehiculo::create([
            'id' => 6,
            'tercero_id' => 5,
            'conductor_id' => 25,
            'placa' => 'ABC006',
            'volumen' => 16.06,
            'marca' => 'Marca seis',
        ]);
        Vehiculo::create([
            'id' => 7,
            'tercero_id' => 6,
            'conductor_id' => 26,
            'placa' => 'ABC007',
            'volumen' => 17.07,
            'marca' => 'Marca siete',
        ]);
        Vehiculo::create([
            'id' => 8,
            'tercero_id' => 6,
            'conductor_id' => 27,
            'placa' => 'ABC008',
            'volumen' => 18.08,
            'marca' => 'Marca ocho',
        ]);
        Vehiculo::create([
            'id' => 9,
            'tercero_id' => 6,
            'conductor_id' => 28,
            'placa' => 'ABC009',
            'volumen' => 19.09,
            'marca' => 'Marca nueve',
        ]);
        Vehiculo::create([
            'id' => 10,
            'tercero_id' => 7,
            'conductor_id' => 29,
            'placa' => 'ABC010',
            'volumen' => 20.10,
            'marca' => 'Marca diez',
        ]);
        Vehiculo::create([
            'id' => 11,
            'tercero_id' => 7,
            'conductor_id' => 30,
            'placa' => 'ABC011',
            'volumen' => 21.11,
            'marca' => 'Marca once',
        ]);
        Vehiculo::create([
            'id' => 12,
            'tercero_id' => 7,
            'conductor_id' => 31,
            'placa' => 'ABC012',
            'volumen' => 22.12,
            'marca' => 'Marca doce',
        ]);
        Vehiculo::create([
            'id' => 13,
            'tercero_id' => 8,
            'conductor_id' => 32,
            'placa' => 'ABC013',
            'volumen' => 23.13,
            'marca' => 'Marca trece',
        ]);
        Vehiculo::create([
            'id' => 14,
            'tercero_id' => 8,
            'conductor_id' => 33,
            'placa' => 'ABC014',
            'volumen' => 24.14,
            'marca' => 'Marca catorce',
        ]);
        Vehiculo::create([
            'id' => 15,
            'tercero_id' => 8,
            'conductor_id' => 34,
            'placa' => 'ABC015',
            'volumen' => 25.15,
            'marca' => 'Marca quince',
        ]);
        Vehiculo::create([
            'id' => 16,
            'tercero_id' => 9,
            'conductor_id' => 35,
            'placa' => 'ABC016',
            'volumen' => 26.16,
            'marca' => 'Marca dieciseis',
        ]);
        Vehiculo::create([
            'id' => 17,
            'tercero_id' => 9,
            'conductor_id' => 36,
            'placa' => 'ABC017',
            'volumen' => 27.17,
            'marca' => 'Marca diecisiete',
        ]);
        Vehiculo::create([
            'id' => 18,
            'tercero_id' => 9,
            'conductor_id' => 37,
            'placa' => 'ABC018',
            'volumen' => 28.18,
            'marca' => 'Marca dieciocho',
        ]);
        Vehiculo::create([
            'id' => 19,
            'tercero_id' => 10,
            'conductor_id' => 38,
            'placa' => 'ABC019',
            'volumen' => 29.19,
            'marca' => 'Marca diecinueve',
        ]);
        Vehiculo::create([
            'id' => 20,
            'tercero_id' => 10,
            'conductor_id' => 39,
            'placa' => 'ABC020',
            'volumen' => 30.20,
            'marca' => 'Marca veinte',
        ]);
        Vehiculo::create([
            'id' => 21,
            'tercero_id' => 10,
            'conductor_id' => 40,
            'placa' => 'ABC021',
            'volumen' => 31.21,
            'marca' => 'Marca veintiuno',
        ]);
    }
}