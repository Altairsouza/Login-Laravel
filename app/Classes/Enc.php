<?php
namespace App\Classes;


class Enc{
    public function encriptar($valor){
          return bin2hex( openssl_encrypt($valor, 'aes-256-cbc', '!|mtm,Hufiku%$cU^&p>N*}Pa{DA~=|y', OPENSSL_RAW_DATA, 'mI-IxAxPD%oNVQ6L'));

    }

    public function desencriptar($valor_encriptado)
    {
        return openssl_decrypt( hex2bin($valor_encriptado), 'aes-256-cbc', '!|mtm,Hufiku%$cU^&p>N*}Pa{DA~=|y', OPENSSL_RAW_DATA, 'mI-IxAxPD%oNVQ6L');
    }
}
