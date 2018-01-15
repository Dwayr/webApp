<?php

namespace App\Http\Controllers;

class komichoSdk
{
    public function __construct($public_code, $secret_code)
    {
        $this->public_code = $public_code;
        $this->secret_code = $secret_code;
        if ( isset($_GET['komichoToken']) ) {
            $this->komicho_token = $_GET['komichoToken'];
        } else {
            $this->komicho_token = false;
        }
    }
    
    public function deCrypt($key, $string = ''){
        $secret_key = $key;
        $secret_iv = $key;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        return $output;
    }
    
    public function data()
    {
        if ( $token = $this->komicho_token != false ) {
            $token = $this->komicho_token;
            $data = $this->deCrypt($this->secret_code, $token);
            $data = (object) json_decode($data);
            if ( @$data->app_public_code == @$this->public_code ) {
                unset( $data->app_public_code );
                return $data;
            } else {
                die('public not re');
            }
        } else {
            die('not get token');
        }
    }
}