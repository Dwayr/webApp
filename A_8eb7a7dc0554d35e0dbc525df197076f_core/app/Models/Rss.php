<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rss extends Model
{
    protected $table = 'companie_rss';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companie_id',
        'title',
        'content',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'companie_id',
        'created_at',
        'updated_at',
    ];
}
