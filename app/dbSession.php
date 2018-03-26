<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dbSession extends Model
{
    protected $table = 'sessions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_token',
        'session_key',
        'session_value',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    public static function addValue($token, $key, $value)
    {
        $args['user_token'] = $token;
        $args['session_key'] = $key;
        $args['session_value'] = $value;
        self::create($args);
    }
    
    
    public static function updateValue($token, $key, $value)
    {
        $args['session_value'] = $value;
        self::where('user_token', '=', $token)->where('session_key', '=', $key)->update($args);
    }
    
    
    public static function getValue($token, $key)
    {
        return self::where('user_token', '=', $token)->where('session_key', '=', $key)->first()->session_value;
    }
    
    
    
    public static function exist ($token, $key)
    {
        return self::where('user_token', '=', $token)->where('session_key', '=', $key)->exists();
    }
    
    public static function del ($token, $key)
    {
        return self::where('user_token', '=', $token)->where('session_key', '=', $key)->delete();
    }
    
}
