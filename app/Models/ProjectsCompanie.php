<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectsCompanie extends Model
{
    protected $table = 'projects_companie';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'companie_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'project_id',
        'companie_id',
        'created_at',
        'updated_at',
    ];
    
    public static function basic_projects($companie_id)
    {
        return self::where('companie_id', '=', $companie_id)
            ->join('projects', 'projects.id', 'projects_companie.project_id')
            ->select([
                'projects.id',
                'projects.title'
            ])
            ->get();
    }
}
