<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reat extends Model
{
    protected $table = 'companie_reat';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public static function total($companie_id)
    {
        $exists = self::where('companie_id', '=', $companie_id)->exists();
        if ( $exists == true ) {
            $rows = self::where('companie_id', '=', $companie_id)->get();
            $count = self::where('companie_id', '=', $companie_id)->count();
            $reat_value = 0;
            foreach($rows as $row) {
                $reat_value += $row->reat_value;
            }
            return $reat_value/$count;
        }
        return 0;
    }
}
