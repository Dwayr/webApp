<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*
type :-
1 = com
2 = dev
*/
class Profile extends Model
{
    protected $table = 'profiles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    public static function add($type, $url)
    {
        $_create['type'] = $type;
        $_create['url'] = $url;
        self::create($_create);
    }
    public static function get_type($url)
    {
        $exist = self::where('url', '=', $url)->exists();
        if ( $exist ) {
            return self::where('url', '=', $url)->first()->type;
        } else {
            abort(404);
        }
    }
    public static function exist($where)
    {
        return self::where($where)->exists();
    }
}
