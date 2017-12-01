<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
//    protected $table = 'companie_projects';
    protected $table = 'projects';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'title',
        'icon',
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
    
    public function team()
    {
        return $this->hasMany('App\Models\ProjectsTeam', 'project_id', 'id')
            ->select([
                'projects_team.project_id',
                'projects_team.user_id',
                'users.username',
            ])
            ->join('users', 'users.id', 'projects_team.user_id');
    }
    
    public function companies()
    {
        return $this->hasMany('App\Models\ProjectsCompanie', 'project_id', 'id')
            ->select([
                'projects_companie.project_id',
                'projects_companie.companie_id',
                'companie_list.id',
                'companie_list.name',
                'companie_list.url',
            ])
            ->join('companie_list', 'companie_list.id', 'projects_companie.companie_id')
            ->take(1);
    }
    
    public static function owner_id($where)
    {
        return self::where($where)->first()->owner_id;
    }
    
    public static function show($id)
    {
        return self::with(['team', 'companies'])
            ->where('id', '=', $id)
            ->first();
    }
    
    public static function exist($where)
    {
        return self::where($where)->exists();
    }
}
