<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Session;

// Models
use App\Models\Notification;
use App\Models\User;
use App\Models\Job;
use App\Models\Companie;
use App\Models\Team;

class Notifications extends Controller
{
    public static function make_notification_type($type)
    {
        if ( $type == 'JOBAPPLY') {
            $out = 'تقدم الي وظيفة';
        } elseif ( $type == 'ADDTOTEAM' ) {
            $out = 'تمت اضافتك الي فريق';
        }
        return $out;
    }
    public static function make_notification_content($type, $content)
    {
        if ( $type == 'JOBAPPLY') {
            $out = Job::getData(['id' => $content])->title;
        } elseif ( $type == 'ADDTOTEAM' ) {
            $out = Companie::getDataById($content)->name;
        }
        return $out;
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
                'content' => self::make_notification_content($value->notification_type, $value->notification_content),
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
//                'content' => Job::getData(['id' => $notification->notification_content])->title,
                'content' => self::make_notification_content($notification->notification_type, $notification->notification_content),
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
    
    public function ADDTOTEAM_done($id)
    {
        $notification = Notification::where('id', '=', $id)->first();
        $user_public_code = User::getData(['id' => $notification->user_to])->public_code;
        Team::where('user_public_code', '=', $user_public_code)
            ->where('companie_id', '=', $notification->notification_content)
            ->update([
                'status' => 2
            ]);
        $url_co = Companie::where('id', '=', $notification->notification_content)->first()->url;
        return redirect('/'.$url_co);
    }
    
    public function ADDTOTEAM_close($id)
    {
        $notification = Notification::where('id', '=', $id)->first();
        $user_public_code = User::getData(['id' => $notification->user_to])->public_code;
        Team::where('user_public_code', '=', $user_public_code)
            ->where('companie_id', '=', $notification->notification_content)
            ->update([
                'status' => 3
            ]);
        return redirect('/');
    }
    
}
