<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Controllers
use App\Http\Controllers\Session;
use App\Http\Controllers\Companies;
use App\Http\Controllers\Users;
use App\Http\Controllers\Notifications;
// Models
use App\Models\Profile;
use App\Models\User;
use App\Models\UserSettingJob;
use App\Models\UserSettingCommunication as USC;
use App\Models\Companie;
use App\Models\Job;
use App\Models\Notification;

class Dwayr extends Controller
{
    public function index(Request $req)
    {
        $data = array();
        $exist_id = Session::exists('user_id');
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['user'] = User::get_data_with(['mycompanie','settingjob'],['id' => Session::get('user_id')]);
            if ( !empty(json_decode($data['user']['settingjob'])) ) {
                $data['jobs'] = Job::get_by_skills($data['user']['settingjob'][0]);
            } else {
                $data['jobs'] = false;
            }
            $data['notification'] = Notification::list_all(Session::get('user_id'));
            $data['steps'] = [
                'USJ' => UserSettingJob::exist([ 'user_id' => Session::get('user_id') ]),
                'USC' => USC::exist([ 'user_id' => Session::get('user_id') ]),
            ];
//            return $data;
            return view('dwayr.account',[
                'header_title' => 'دواير | حسابك',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            $data['companies'] = Companie::inRandomOrder()->limit(6)->get();
            $data['jobs'] = Job::where('status', '=', 0)->inRandomOrder()->limit(6)->get();
//            return $data;
            return view('dwayr.index',[
                'header_title' => 'دواير | اهلا بك',
                'data' => $data,
                'session' => $exist_id,
            ]);
        }
    }
    
    public function profile($name)
    {
        $get_type = Profile::get_type($name);
        if ($get_type == 1) {
            return Companies::view($name);
        } elseif ($get_type == 2) {
            return Users::view($name);
        }
    }
    
    public function faq()
    {
        $data = array();
        $exist_id = Session::exists('user_id');
        $data['header']['notification'] = Notifications::list_header();
        $data['user'] = User::get_data_with(['mycompanie','settingjob'],['id' => Session::get('user_id')]);
//        return $data;
        return view('dwayr.faq',[
            'header_title' => 'دواير | الأسئلة الشائعة',
            'data' => $data,
            'session' => $exist_id,
        ]);
    }
    
}
