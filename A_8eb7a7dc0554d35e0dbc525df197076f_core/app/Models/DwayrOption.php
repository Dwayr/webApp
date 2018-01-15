<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DwayrOption extends Model
{
    protected $table = 'dwayr_options';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'options_collection',
        'options_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'options_collection'
    ];
    
    public static function listOptions($collection)
    {
        return self::where('options_collection', '=', $collection)
            ->select([
                'id as option_value',
                'options_name as option_text',
            ])
            ->get();
    }
    public static function getOptions($id)
    {
        return self::where('id', '=', $id)
            ->select('options_name')
            ->first()
            ->options_name;
    }
}
