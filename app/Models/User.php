<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'public_code',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'avatar',
        'country_code',
        'about',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    
    public static function get_data_with($with, $where)
    {
        return self::with($with)->where($where)->first();
    }
    public static function getData($where)
    {
        return self::where($where)->first();
    }
    
    public static function exist($where)
    {
        return self::where($where)->exists();
    }
    
    public function mycompanie()
    {
        return $this->hasMany('App\Models\Companie', 'owner_id', 'id')
            ->select([
                'id',
                'owner_id',
                'name',
                'url',
            ]);
    }
    
    public function companie()
    {
        return $this->hasMany('App\Models\Team', 'user_public_code', 'public_code')
            ->where('status', '=', 2)
            ->join('companie_list', 'companie_list.id', 'companie_team.companie_id')
            ->select([
                'companie_team.*',
                'companie_list.name',
                'companie_list.url',
            ]);
    }
    
    public function projects()
    {
        return $this->hasMany('App\Models\ProjectsTeam', 'user_id', 'id')
            ->join('projects', 'projects.id', 'projects_team.project_id')
            ->select([
                'projects_team.user_id',
                'projects_team.project_id',
                'projects.id',
                'projects.title',
            ]);
            
    }
    
    public function settingjob()
    {
        return $this->hasMany('App\Models\UserSettingJob', 'user_id', 'id');
    }
}
