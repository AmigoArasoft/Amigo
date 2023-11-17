<?php
namespace Database\Seeders;
use DateTimeZone;

use Carbon\Carbon;
use App\Models\Viaje;
use App\Models\Tercero;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class ViajeTableSeeder extends Seeder{
    public function run(){
        // Crear Viajes
        for ($fecha = Carbon::create(2020, 1, 1, 0, 0, 0, 'America/Bogota'); $fecha < Carbon::now(new DateTimeZone('America/Bogota')); $fecha->add(1, 'day')) {
            for ($vehi = 1; $vehi < 22; $vehi++) {
                $vehiculo = Vehiculo::findOrFail($vehi);
                $operador = Tercero::findOrFail($vehiculo->tercero_id)->operadores->first();
                for ($material = 1; $material < 4; $material++) {
                    Viaje::create([
                        'fecha' => $fecha,
                        'vehiculo_id' => $vehiculo->id,
                        'conductor_id' => $vehiculo->conductor_id,
                        'operador_id' => $operador->id,
                        'transporte_id' => $vehiculo->tercero_id,
                        'material_id' => $material,
                        'submaterial_id' => 1,
                        'frente_id' => $operador->frente_id,
                        'volumen' => $vehiculo->volumen,
                        'valor' => $operador->materiales()->select('tarifa')->where('material_id', $material)->first()->tarifa,
                    ]);
                }
            }
        }
    }
}