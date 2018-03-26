<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'city',
        'co_id',
        'years_experience',
        'average_salary',
        'gender',
        'type_work',
        'description',
        'skills',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    public static function list_all()
    {
        return Job::join('companie_list', 'companie_list.id', 'jobs.co_id')
            ->where('jobs.status', '=', 0)
            ->select([
                'companie_list.id AS id',
                'companie_list.name AS companie',
                'jobs.id AS job_id',
                'jobs.title',
                'jobs.gender',
                'jobs.type_work',
                'jobs.created_at'
            ])
            ->get();
    }
    
    public static function show($id)
    {
        return Job::join('companie_list', 'companie_list.id', 'jobs.co_id')
            ->where('jobs.id', '=', $id)
            ->select([
                'companie_list.id AS id',
                'companie_list.name AS companie',
                'companie_list.url AS companie_url',
                'jobs.title',
                'jobs.city',
                'jobs.years_experience',
                'jobs.average_salary',
                'jobs.gender',
                'jobs.type_work',
                'jobs.description',
                'jobs.created_at'
            ])
            ->first();
    }
    
    public static function get_by_skills($skills)
    {
        return self::skills($skills)
            ->select([
                'companie_list.id AS id',
                'companie_list.name AS companie',
                'companie_list.url AS companie_url',
                'jobs.id AS job_id',
                'jobs.title',
                'jobs.created_at'
            ])
            ->get();
    }
    public function scopeSkills($query,$skills)
    {
        $query->join('companie_list', function($query) use ($skills) {
                $query->on('companie_list.id', '=','jobs.co_id');
                foreach ( $skills['skills'] as $skill ) {
                    $query->where('jobs.skills', 'LIKE', '%' . $skill . '%');
                }
            });
        return $query;
    }

    
//    public static function get_by_skills($skills)
//    {
//        return self::join('companie_list', 'companie_list.id', 'jobs.co_id')
//            ->whereIn('skills', explode(',', $skills))
//            ->select([
//                'companie_list.id AS id',
//                'companie_list.name AS companie',
//                'companie_list.url AS companie_url',
//                'jobs.id AS job_id',
//                'jobs.title',
//                'jobs.created_at'
//            ])
//            ->get();
//    }
    
    public static function addView($job_id)
    {
        $views = self::where('id', '=', $job_id)->select('views')->first()->views;
        self::where('id', '=', $job_id)->update([
            'views' => $views+1,
        ]);
    }
    
    public static function is_owner($job_id)
    {
        return self::where('jobs.id', '=', $job_id)
            ->select([
                'companie_list.owner_id AS owner_id'
            ])
            ->join('companie_list', 'companie_list.id', 'jobs.co_id')
            ->first()->owner_id;
    }
    
    public static function getData($where)
    {
        return self::where($where)->first();
    }
    
    public static function exist($where)
    {
        return self::where($where)->exists();
    }
}
