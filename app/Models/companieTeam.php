<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class companieTeam extends Model
{
    protected $table = 'companie_team';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companie_id',
        'user_public_code',
        'user_position',
        'work_start_history',
        'work_end_history',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public static function add($data)
    {
        self::create($data);
    }
    
    public static function team_list($id)
    {
        return self::where('companie_id', '=', $id)
            ->select([
                'companie_team.id',
                'users.username',
                'companie_team.user_position AS job_title',
                'companie_team.work_start_history AS start_history',
                'companie_team.work_end_history AS end_history',
            ])
            ->join('users', 'users.public_code', 'companie_team.user_public_code')
            ->get();
    }
    
    public static function exist($where)
    {
        return self::where($where)->exists();
    }
}
