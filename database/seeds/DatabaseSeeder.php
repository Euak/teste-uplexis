<?php

use App\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('UsuarioTableSeeder');

        $this->command->info('Usuario table seeded!');
    }

}

class UsuarioTableSeeder extends Seeder {

    public function run()
    {	

    	$usuario = new Usuario(array(
                'usuario' => 'kaue',
                'senha' => bcrypt('123')
        ));

        $usuario->timestamps = false;
        $usuario->save();

        $usuario = new Usuario(array(
                'usuario' => 'teste',
                'senha' => bcrypt('321')
        ));

        $usuario->timestamps = false;
        $usuario->save();
    
    }

}