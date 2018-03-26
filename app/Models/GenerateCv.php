<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenerateCv extends Model
{
    protected $table = 'generate_cv';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'dateBirth',
        'address',
        'phone',
        'email',
        'githublink',
        'linkedinlink',
        'skills',
        'attachment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
    
    public static function add($data)
    {
        self::create($data);
    }
    
    public static function exist($where)
    {
        return self::where($where)->exists();
    }
}
