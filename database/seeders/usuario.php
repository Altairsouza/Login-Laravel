<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class usuario extends Seeder
{

    public function run()
    {
        $usuario = new \App\Models\Usuario;

        $usuario->usuario = 'admin@gmail.com';
        $usuario->senha = Hash::make('aaabbb');
        $usuario->save();
        echo "ok";
    }
}
