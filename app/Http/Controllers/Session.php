<?php

namespace App\Http\Controllers;

use App\dbSession;

class Session extends Controller
{
    public static function add($key, $value)
    {
        if(!isset($_COOKIE['sessionToken'])) {
            $token = md5(time());
        } else {
            $token = $_COOKIE['sessionToken'];
        }
        
        $exist = dbSession::exist($token, $key);
        if ( $exist == false ) {
            setcookie('sessionToken', $token, time()+3600, '/');
            dbSession::addValue($token, $key, $value);   
        } else {
            dbSession::updateValue($token, $key, $value);
        }
    }
    
    public static function get($key)
    {
        if(!isset($_COOKIE['sessionToken'])) {
            $token = md5(time());
        } else {
            $token = $_COOKIE['sessionToken'];
            setcookie('sessionToken', $token, time()+3600, '/');
        }
        
        $exist = dbSession::exist($token, $key);
        if ( $exist != false ) {
            return dbSession::getValue($token, $key);   
        }
        return false;
    }
    
    public static function exists($key)
    {
        if(!isset($_COOKIE['sessionToken'])) {
            $token = md5(time());
        } else {
            $token = $_COOKIE['sessionToken'];
        }
        
        $exist = dbSession::exist($token, $key);
        if ( $exist != false ) {
            return true;   
        } else {
            return false;
        }
    }
    
    public static function delete($key)
    {
        if(!isset($_COOKIE['sessionToken'])) {
            $token = md5(time());
        } else {
            $token = $_COOKIE['sessionToken'];
        }
        
        $exist = dbSession::exist($token, $key);
        if ( $exist != false ) {
            dbSession::del($token, $key);
            setcookie('sessionToken', null, -1, '/');
        } else {
            return false;
        }
    }
}
