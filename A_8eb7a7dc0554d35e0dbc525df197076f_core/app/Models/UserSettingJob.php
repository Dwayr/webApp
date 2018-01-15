<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSettingJob extends Model
{
    protected $table = 'user_setting_job';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'city',
        'type_work',
        'skills',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
//        'user_id',
        'created_at',
        'updated_at',
    ];
    
    protected $casts = [
        'skills' => 'array',
    ];
    
    public static function add($data)
    {
        self::create($data);
    }
    
    public static function skills($user_id)
    {
        return self::where('user_id', '=', $user_id)->frist();
    }
    
    public static function exist($where)
    {
        return self::where($where)->exists();
    }
}
