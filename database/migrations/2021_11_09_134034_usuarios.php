<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{

    public function up()
    {
        Schema::create('usuarios', function(Blueprint $table){
            $table->id();
            $table->string('usuario',50);
            $table->string('senha',200);
            $table->dateTime('last_login')->nullable();
            $table->tinyInteger('active')->default(1); // vai vai falar se o usuario está apto ou nao apto a acessar a sua conta
            $table->timestamps(); // aqui ele vai criar created_at updated_at  sao bastante uteis vai marcar as datas
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::drop('usuarios');
    }
}
