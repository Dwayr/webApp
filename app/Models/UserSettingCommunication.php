<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSettingCommunication extends Model
{
    protected $table = 'user_setting_communication';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email',
        'phone_number',
        'github_link',
        'facebook_link',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];
    
    public static function add($data)
    {
        self::create($data);
    }
    
    public static function edit($where, $data)
    {
        self::where($where)->update($data);
    }
    
    public static function data($user_id)
    {
        return self::where('user_id', '=', $user_id)->frist();
    }
    
    public static function exist($where)
    {
        return self::where($where)->exists();
    }
}
