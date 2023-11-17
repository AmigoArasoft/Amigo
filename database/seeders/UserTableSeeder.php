<?php
namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder{
    public function run(){
        $super = User::create([
            'tercero_id' => 1,
            'name' => 'Edwin Marvin Villarreal Hernández',
            'email' => 'edwinvillarreal@hotmail.com',
            'password' => '12345678',
            'telefono' => '3007481793',
    	]);
        $super->assignRole('Super administrador');
    	$super = User::create([
            'tercero_id' => 1,
            'name' => 'Miguel Ángel Salamanca Rodríguez',
            'email' => 'masalaro@gmail.com',
            'password' => '12345678',
            'telefono' => '3007740596',
    	]);
        $super->assignRole('Super administrador');
    }
}