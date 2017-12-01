<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Session;

// Models
use App\Models\Notification;
use App\Models\User;
use App\Models\Job;

class Notifications extends Controller
{
    public static function make_notification_type($type)
    {
        if ( $type == 'JOBAPPLY') {
            return 'تقدم الي وظيفة';
        }
    }
    public static function list_header()
    {
        $list = Notification::list_all_header(Session::get('user_id'));
        $outlist;
        foreach ( $list as $value ) {
            $outlist[] = [
                'id' => $value->id,
                'type' => self::make_notification_type($value->notification_type),
                'username' => User::getData(['id' => $value->user_from])->username,
                'content' => Job::getData(['id' => $value->notification_content])->title,
            ];
        }
        
        if ( !empty( $outlist ) ) {
            $outlist = $outlist;
        } else {
            $outlist = [];
        }
        
        $out = [
            'exist' => Notification::exist_is_read(Session::get('user_id')),
            'list' => $outlist,
        ];
        return $out;
    }
    
    public function show($id)
    {
        $exist_id = Session::exists('user_id');
        
        if ( !$exist_id ) {
            return redirect('/');
        } else {
            $notification = Notification::show($id);
            $data = array();
            $data['header']['notification'] = Notifications::list_header();
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);

            $data['notification'] = [
                'id' => $id,
                'typeView' => $notification->notification_type,
                'type' => self::make_notification_type($notification->notification_type),
                'username' => User::getData(['id' => $notification->user_from])->username,
                'content' => Job::getData(['id' => $notification->notification_content])->title,
            ];
            return view('notification.show',[
                'header_title' => 'دواير | عرض اشعار',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } 
    }
    
    public function is_read(Request $req)
    {
        Notification::where($req->only('id'))
            ->where('user_to', '=', Session::get('user_id'))
            ->update([
                'is_read' => true
            ]);
    }
    
}
