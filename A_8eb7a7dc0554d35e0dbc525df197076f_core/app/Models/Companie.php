<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
    protected $table = 'companie_list';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'name',
        'url',
        'logo',
        'site',
        'email',
        'specialization',
        'headquarters',
        'establishment',
        'about',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
//        'id',
        'created_at',
        'updated_at',
    ];
    
    public function projects()
    {
        return $this->hasMany('App\Models\ProjectsCompanie', 'companie_id', 'id')
            ->join('projects', 'projects.id', 'project_id');
    }
    
    public function team()
    {
        return $this->hasMany('App\Models\Team', 'companie_id', 'id')
            ->where('status', '=', 2)
            ->join('users', 'users.public_code', 'companie_team.user_public_code')
            ->select([
                'users.username',
                'companie_team.companie_id',
            ]);
    }
    
    public function rss()
    {
        return $this->hasMany('App\Models\Rss', 'companie_id', 'id');
    }
    
    public function jobs()
    {
        return $this->hasMany('App\Models\Job', 'co_id', 'id')
            ->where('status', '=', 0);
    }
    
    public static function get_data($name_companie)
    {
        return self::with(['projects', 'team', 'rss', 'jobs'])
            ->where('url', '=', $name_companie)
            ->first();
    }
    
    public static function exist($where)
    {
        return self::where($where)->exists();
    }
}
