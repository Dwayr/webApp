<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//
use App\Http\Controllers\Session;
// Models
use App\Models\User;
use App\Models\Companie;
use App\Models\ProjectsCompanie;
use App\Models\companieTeam;
use App\Models\UserSettingJob;
use App\Models\UserSettingCommunication as USC;
use App\Models\Job;
use App\Models\DwayrOption;

class Settings extends Controller
{
    public function info()
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
            return view('settings.info', [
                'header_title' => 'دواير | اعدادات - المعلومات',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function job()
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
            $data['setting_job'] = UserSettingJob::where('user_id', '=', Session::get('user_id'))->first();
            if ( !empty(json_decode( $data['setting_job'] )) ) {
                $data['setting_job'] = UserSettingJob::where('user_id', '=', Session::get('user_id'))->first();
            } else {
                $data['setting_job'] = [
                    'city' => '',
                    'type_work' => '',
                    'skills' => ["code"]
                ];
            }
            $data['options']['cities'] = DwayrOption::listOptions('cities');
            $data['options']['type_job'] = DwayrOption::listOptions('type_job');
//            return $data;
            return view('settings.job', [
                'header_title' => 'دواير | اعدادات - التوظيف',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function communication()
    {
        $exist_id = Session::exists('user_id');
        
        $exist_USC = USC::exist([
            'user_id' => Session::get('user_id')
        ]);
        
        $data = array();
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
            if ( $exist_USC ) {
                $data['setting_communication'] = USC::where('user_id', '=', Session::get('user_id'))->first();
            } else {
                $data['setting_communication'] = [
                    'email' => 'email',
                    'phone_number' => '01',
                    'github_link' => '',
                    'facebook_link' => '',
                ];
            }
//            return $data;
            return view('settings.communication', [
                'header_title' => 'دواير | اعدادات - التواصل',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function password()
    {
        $exist_id = Session::exists('user_id');
        
        $data = array();
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
//            return $data;
            return view('settings.password', [
                'header_title' => 'دواير | اعدادات - كلمة المرور',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    //companie
    public function companie_info($name)
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['companie'] = Companie::where('url', '=', $name)->first();
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
            return view('settings.companie.info',[
                'header_title' => 'دواير | اعدادات الشركة - ' . $data['companie']->name,
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function companie_projects($name)
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['companie'] = Companie::where('url', '=', $name)->first();
            $data['projects'] = ProjectsCompanie::basic_projects($data['companie']->id);
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
            return view('settings.companie.projects',[
                'header_title' => 'دواير | اعدادات الشركة - ' . $data['companie']->name,
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function companie_team($name)
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['companie'] = Companie::where('url', '=', $name)->first();
            $data['team'] = companieTeam::team_list($data['companie']->id);
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
            return view('settings.companie.team',[
                'header_title' => 'دواير | اعدادات الشركة - ' . $data['companie']->name,
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function companie_jobs($name)
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['companie'] = Companie::where('url', '=', $name)->first();
            
            $data['jobs'] = Job::where('co_id', '=', $data['companie']->id)
                ->where('status', '=', 0)
                ->select([
                    'id',
                    'title',
                ])
                ->get();
            
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
//            return $data;
            return view('settings.companie.jobs',[
                'header_title' => 'دواير | اعدادات الشركة - ' . $data['companie']->name,
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
}
