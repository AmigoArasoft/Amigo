<?php
namespace Database\Seeders;
use App\Models\Tercero;

use Illuminate\Database\Seeder;
// use Faker\Factory as Faker;

class TerceroTableSeeder extends Seeder{
    public function run(){
        // Crear Propietario
        Tercero::create([
            'id' => 1,
            'persona_id' => 2,
            'documento_id' => 7,
            'documento' => '900349029-7',
            'direccion' => 'Km 4 Vía Mosquera La Mesa Vereda Balsillas Hacienda Venecia Mosquera Cundinamarca',
            'telefono' => '3002182686',
            'email' => 'villaufaz1@hotmail.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Garzón Romero G. S.A.S.'
        ]);
        // Crear Operadores
        Tercero::create([
            'id' => 2,
            'persona_id' => 2,
            'documento_id' => 7,
            'frente_id' => 12,
            'documento' => '1-1',
            'direccion' => 'Ope 1 Dir 1',
            'telefono' => 'Ope 1 Tel 1',
            'email' => 'Ope1@correo.com',
            'operador' => true,
            'transporte' => false,
            'nombre' => 'Operador uno'
        ])->materiales()->attach([
            1 => ['tarifa' => 100],
            2 => ['tarifa' => 110],
            3 => ['tarifa' => 120]
        ]);
        Tercero::create([
            'id' => 3,
            'persona_id' => 2,
            'documento_id' => 7,
            'frente_id' => 13,
            'documento' => '2-2',
            'direccion' => 'Ope 2 Dir 2',
            'telefono' => 'Ope 2 Tel 2',
            'email' => 'Ope2@correo.com',
            'operador' => true,
            'transporte' => false,
            'nombre' => 'Operador dos'
        ])->materiales()->attach([
            1 => ['tarifa' => 101],
            2 => ['tarifa' => 111],
            3 => ['tarifa' => 121]
        ]);
        Tercero::create([
            'id' => 4,
            'persona_id' => 2,
            'documento_id' => 7,
            'frente_id' => 14,
            'documento' => '3-3',
            'direccion' => 'Ope 3 Dir 3',
            'telefono' => 'Ope 3 Tel 3',
            'email' => 'Ope3@correo.com',
            'operador' => true,
            'transporte' => true,
            'nombre' => 'Operador tres'
        ])->materiales()->attach([
            1 => ['tarifa' => 102],
            2 => ['tarifa' => 112],
            3 => ['tarifa' => 122]
        ]);

        // Crear Transportadora
        Tercero::findOrFail(4)->transportes()->attach(4);

        // Crear Transportadores
        Tercero::create([
            'id' => 5,
            'persona_id' => 2,
            'documento_id' => 7,
            'frente_id' => null,
            'documento' => '4-4',
            'direccion' => 'Tra 1 Dir 1',
            'telefono' => 'Tra 1 Tel 1',
            'email' => 'Tra1@correo.com',
            'operador' => false,
            'transporte' => true,
            'nombre' => 'Transportador uno'
        ]);
        Tercero::create([
            'id' => 6,
            'persona_id' => 2,
            'documento_id' => 7,
            'frente_id' => null,
            'documento' => '5-5',
            'direccion' => 'Tra 2 Dir 2',
            'telefono' => 'Tra 2 Tel 2',
            'email' => 'Tra2@correo.com',
            'operador' => false,
            'transporte' => true,
            'nombre' => 'Transportador dos'
        ]);
        Tercero::create([
            'id' => 7,
            'persona_id' => 2,
            'documento_id' => 7,
            'frente_id' => null,
            'documento' => '6-6',
            'direccion' => 'Tra 3 Dir 3',
            'telefono' => 'Tra 3 Tel 3',
            'email' => 'Tra3@correo.com',
            'operador' => false,
            'transporte' => true,
            'nombre' => 'Transportador tres'
        ]);
        Tercero::create([
            'id' => 8,
            'persona_id' => 2,
            'documento_id' => 7,
            'frente_id' => null,
            'documento' => '7-7',
            'direccion' => 'Tra 4 Dir 4',
            'telefono' => 'Tra 4 Tel 4',
            'email' => 'Tra4@correo.com',
            'operador' => false,
            'transporte' => true,
            'nombre' => 'Transportador cuatro'
        ]);
        Tercero::create([
            'id' => 9,
            'persona_id' => 2,
            'documento_id' => 7,
            'frente_id' => null,
            'documento' => '8-8',
            'direccion' => 'Tra 5 Dir 5',
            'telefono' => 'Tra 5 Tel 5',
            'email' => 'Tra5@correo.com',
            'operador' => false,
            'transporte' => true,
            'nombre' => 'Transportador cinco'
        ]);
        Tercero::create([
            'id' => 10,
            'persona_id' => 2,
            'documento_id' => 7,
            'frente_id' => null,
            'documento' => '9-9',
            'direccion' => 'Tra 6 Dir 6',
            'telefono' => 'Tra 6 Tel 6',
            'email' => 'Tra6@correo.com',
            'operador' => false,
            'transporte' => true,
            'nombre' => 'Transportador seis'
        ]);

        // Asignar Transportadoras
        Tercero::findOrFail(2)->transportes()->attach([5, 6]);
        Tercero::findOrFail(3)->transportes()->attach([7, 8]);
        Tercero::findOrFail(4)->transportes()->attach([9, 10]);

        // Crear Gerentes
        Tercero::create([
            'id' => 11,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '10-10',
            'direccion' => 'Ger 1 Dir 1',
            'telefono' => 'Ger 1 Tel 1',
            'email' => 'Ger1@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Gerente uno'
        ]);
        Tercero::create([
            'id' => 12,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '11-11',
            'direccion' => 'Ger 2 Dir 2',
            'telefono' => 'Ger 2 Tel 2',
            'email' => 'Ger2@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Gerente dos'
        ]);
        Tercero::create([
            'id' => 13,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '12-12',
            'direccion' => 'Ger 3 Dir 3',
            'telefono' => 'Ger 3 Tel 3',
            'email' => 'Ger3@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Gerente tres'
        ]);
        Tercero::create([
            'id' => 14,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '13-13',
            'direccion' => 'Ger 4 Dir 4',
            'telefono' => 'Ger 4 Tel 4',
            'email' => 'Ger4@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Gerente cuatro'
        ]);
        Tercero::create([
            'id' => 15,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '14-14',
            'direccion' => 'Ger 5 Dir 5',
            'telefono' => 'Ger 5 Tel 5',
            'email' => 'Ger5@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Gerente cinco'
        ]);
        Tercero::create([
            'id' => 16,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '15-15',
            'direccion' => 'Ger 6 Dir 6',
            'telefono' => 'Ger 6 Tel 6',
            'email' => 'Ger6@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Gerente seis'
        ]);
        Tercero::create([
            'id' => 17,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '16-16',
            'direccion' => 'Ger 7 Dir 7',
            'telefono' => 'Ger 7 Tel 7',
            'email' => 'Ger7@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Gerente siete'
        ]);
        Tercero::create([
            'id' => 18,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '17-17',
            'direccion' => 'Ger 8 Dir 8',
            'telefono' => 'Ger 8 Tel 8',
            'email' => 'Ger8@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Gerente ocho'
        ]);
        Tercero::create([
            'id' => 19,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '18-18',
            'direccion' => 'Ger 9 Dir 9',
            'telefono' => 'Ger 9 Tel 9',
            'email' => 'Ger9@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Gerente nueve'
        ]);

        // Crear Conductores
        Tercero::create([
            'id' => 20,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '19-19',
            'direccion' => 'Con 1 Dir 1',
            'telefono' => 'Con 1 Tel 1',
            'email' => 'Con1@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor uno'
        ]);
        Tercero::create([
            'id' => 21,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '20-20',
            'direccion' => 'Con 2 Dir 2',
            'telefono' => 'Con 2 Tel 2',
            'email' => 'Con2@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor dos'
        ]);
        Tercero::create([
            'id' => 22,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '21-21',
            'direccion' => 'Con 3 Dir 3',
            'telefono' => 'Con 3 Tel 3',
            'email' => 'Con3@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor tres'
        ]);
        Tercero::create([
            'id' => 23,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '22-22',
            'direccion' => 'Con 4 Dir 4',
            'telefono' => 'Con 4 Tel 4',
            'email' => 'Con4@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor cuatro'
        ]);
        Tercero::create([
            'id' => 24,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '23-23',
            'direccion' => 'Con 5 Dir 5',
            'telefono' => 'Con 5 Tel 5',
            'email' => 'Con5@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor cinco'
        ]);
        Tercero::create([
            'id' => 25,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '24-24',
            'direccion' => 'Con 6 Dir 6',
            'telefono' => 'Con 6 Tel 6',
            'email' => 'Con6@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor seis'
        ]);
        Tercero::create([
            'id' => 26,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '25-25',
            'direccion' => 'Con 7 Dir 7',
            'telefono' => 'Con 7 Tel 7',
            'email' => 'Con7@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor siete'
        ]);
        Tercero::create([
            'id' => 27,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '26-26',
            'direccion' => 'Con 8 Dir 8',
            'telefono' => 'Con 8 Tel 8',
            'email' => 'Con8@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor ocho'
        ]);
        Tercero::create([
            'id' => 28,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '27-27',
            'direccion' => 'Con 9 Dir 9',
            'telefono' => 'Con 9 Tel 9',
            'email' => 'Con9@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor nueve'
        ]);
        Tercero::create([
            'id' => 29,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '28-28',
            'direccion' => 'Con 10 Dir 10',
            'telefono' => 'Con 10 Tel 10',
            'email' => 'Con10@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor diez'
        ]);
        Tercero::create([
            'id' => 30,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '29-29',
            'direccion' => 'Con 11 Dir 11',
            'telefono' => 'Con 11 Tel 11',
            'email' => 'Con11@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor once'
        ]);
        Tercero::create([
            'id' => 31,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '30-30',
            'direccion' => 'Con 12 Dir 12',
            'telefono' => 'Con 12 Tel 12',
            'email' => 'Con12@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor doce'
        ]);
        Tercero::create([
            'id' => 32,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '31-31',
            'direccion' => 'Con 13 Dir 13',
            'telefono' => 'Con 13 Tel 13',
            'email' => 'Con13@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor trece'
        ]);
        Tercero::create([
            'id' => 33,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '32-32',
            'direccion' => 'Con 14 Dir 14',
            'telefono' => 'Con 14 Tel 14',
            'email' => 'Con14@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor catorce'
        ]);
        Tercero::create([
            'id' => 34,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '33-33',
            'direccion' => 'Con 15 Dir 15',
            'telefono' => 'Con 15 Tel 15',
            'email' => 'Con15@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor quince'
        ]);
        Tercero::create([
            'id' => 35,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '34-34',
            'direccion' => 'Con 16 Dir 16',
            'telefono' => 'Con 16 Tel 16',
            'email' => 'Con16@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor dieciseis'
        ]);
        Tercero::create([
            'id' => 36,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '35-35',
            'direccion' => 'Con 17 Dir 17',
            'telefono' => 'Con 17 Tel 17',
            'email' => 'Con17@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor diecisiete'
        ]);
        Tercero::create([
            'id' => 37,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '36-36',
            'direccion' => 'Con 18 Dir 18',
            'telefono' => 'Con 18 Tel 18',
            'email' => 'Con18@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor dieciocho'
        ]);
        Tercero::create([
            'id' => 38,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '37-37',
            'direccion' => 'Con 19 Dir 19',
            'telefono' => 'Con 19 Tel 19',
            'email' => 'Con19@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor diecinueve'
        ]);
        Tercero::create([
            'id' => 39,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '38-38',
            'direccion' => 'Con 20 Dir 20',
            'telefono' => 'Con 20 Tel 20',
            'email' => 'Con20@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor veinte'
        ]);
        Tercero::create([
            'id' => 40,
            'persona_id' => 1,
            'documento_id' => 3,
            'frente_id' => null,
            'documento' => '39-39',
            'direccion' => 'Con 21 Dir 21',
            'telefono' => 'Con 21 Tel 21',
            'email' => 'Con21@correo.com',
            'operador' => false,
            'transporte' => false,
            'nombre' => 'Conductor veintiun'
        ]);

        // Asignar Contactos
        Tercero::findOrFail(2)->contactos()->attach([
            11 => ['funcion_id' => 8]
        ]);
        Tercero::findOrFail(3)->contactos()->attach([
            12 => ['funcion_id' => 8]
        ]);
        Tercero::findOrFail(4)->contactos()->attach([
            13 => ['funcion_id' => 8],
            20 => ['funcion_id' => 11],
            21 => ['funcion_id' => 11],
            22 => ['funcion_id' => 11]
        ]);
        Tercero::findOrFail(5)->contactos()->attach([
            14 => ['funcion_id' => 8],
            23 => ['funcion_id' => 11],
            24 => ['funcion_id' => 11],
            25 => ['funcion_id' => 11]
        ]);
        Tercero::findOrFail(6)->contactos()->attach([
            15 => ['funcion_id' => 8],
            26 => ['funcion_id' => 11],
            27 => ['funcion_id' => 11],
            28 => ['funcion_id' => 11]
        ]);
        Tercero::findOrFail(7)->contactos()->attach([
            16 => ['funcion_id' => 8],
            29 => ['funcion_id' => 11],
            30 => ['funcion_id' => 11],
            31 => ['funcion_id' => 11]
        ]);
        Tercero::findOrFail(8)->contactos()->attach([
            17 => ['funcion_id' => 8],
            32 => ['funcion_id' => 11],
            33 => ['funcion_id' => 11],
            34 => ['funcion_id' => 11]
        ]);
        Tercero::findOrFail(9)->contactos()->attach([
            18 => ['funcion_id' => 8],
            35 => ['funcion_id' => 11],
            36 => ['funcion_id' => 11],
            37 => ['funcion_id' => 11]
        ]);
        Tercero::findOrFail(10)->contactos()->attach([
            19 => ['funcion_id' => 8],
            38 => ['funcion_id' => 11],
            39 => ['funcion_id' => 11],
            40 => ['funcion_id' => 11]
        ]);

        // $faker = Faker::create('es_ES');
        // for ($i = 1; $i <= 20; $i++) {
        // 	$persona = $faker->randomElement(['1', '2']);
        // 	if($persona == 1){
        // 		$documento = $faker->randomElement(['3', '4', '5']);
        // 	} else {
        // 		$documento = $faker->randomElement(['6', '7']);
        // 	}
        // 	Tercero::create([
        // 		'persona_id' => $persona,
        // 		'documento_id' => $documento,
        // 		'documento' => 1000000000 + $i,
        // 		'nombre' => $faker->firstName.' '.$faker->lastName,
        // 		'direccion' => $faker->address,
        // 		'telefono' => $faker->phoneNumber,
        // 		'email' => $faker->unique()->safeEmail
        // 	]);
        // }
    }
}