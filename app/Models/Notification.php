<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_to',
        'user_from',
        'notification_type',
        'notification_content',
        'is_read',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    public static function add($from, $to, $type, $content)
    {
        $data = array();
        $data['user_from'] = $from;
        $data['user_to'] = $to;
        $data['notification_type'] = $type;
        $data['notification_content'] = $content;
        $data['is_read'] = 0;
        self::create($data);
    }
    
    public static function list_all_header($user_id)
    {
        return self::where('user_to', '=', $user_id)
            ->where('is_read', '=', 0)
            ->get();
    }
    public static function list_all($user_id)
    {
        $out = array();
        $out['list'] = self::where('user_to', '=', $user_id)
            ->where('is_read', '=', 0)
            ->get();
        $out['number'] = self::where('user_to', '=', $user_id)
            ->where('is_read', '=', 0)
            ->count();
        return $out;
    }
    public static function show($id)
    {
        return self::where('id', '=', $id)->first();
    }
    public static function exist($user_id)
    {
        return self::where('user_to', '=', $user_id)->exists();
    }
    public static function exist_is_read($user_id)
    {
        return self::where('user_to', '=', $user_id)
            ->where('is_read', '=', 0)
            ->exists();
    }
}
