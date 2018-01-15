<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    protected $table = 'job_apply';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'job_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    public static function add($user_id, $job_id)
    {
        $data['user_id'] = $user_id;
        $data['job_id'] = $job_id;
        self::create($data);
    }
}
