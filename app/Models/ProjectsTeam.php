<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectsTeam extends Model
{
    protected $table = 'projects_team';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'project_id',
        'user_id',
        'created_at',
        'updated_at',
    ];
    
    public static function list_team($id)
    {
        return self::where('project_id', '=', $id)
            ->select([
                'projects_team.project_id',
                'projects_team.user_id',
                'users.id',
                'users.username AS username',
                'users.username AS text',
                'users.first_name AS firstName',
                'users.last_name AS lastName',
            ])
            ->join('users', 'users.id', 'projects_team.user_id')
            ->get();
    }
        
}
