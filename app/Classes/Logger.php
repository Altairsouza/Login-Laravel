<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;

class Logger{
    public function log($level, $message){

        //tenta adicionar á mensagem a indetificacao do usuario ativo
        if(session()->has('usuario')){
            $message = '['.session('usuario')->usuario . '] - ' . $message;
        }else {
            $message = '[]N/A' . $message;
        }

      //  REGOSTA uma entrada nos logs

      Log::channel('main')->$level($message);

    }
}

?>
