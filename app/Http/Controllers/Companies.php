<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//
use App\Http\Controllers\Session;
use App\Http\Controllers\Mailers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Companie;
use App\Models\companieTeam;
use App\Models\Project;
use App\Models\Team;
use App\Models\Rss;
use App\Models\Reat as CR;
use App\Models\Job;
use App\Models\Notification;

class Companies extends Controller
{
    public static function view($name_companie)
    {
        $data = array();
        $data = Companie::get_data($name_companie);
        $data['host'] = parse_url($data->site)['host'];
//        return $data;
        $is_owner = true;

        $reat_percent = mb_substr(CR::total($data->id), 0, 5);

        if ( $reat_percent == 0 ) {
            $reat_text = 'zero';
        } elseif ( $reat_percent <= 20 ) {
            $reat_text = 'Bad';
        } elseif ( $reat_percent <= 40 ) {
            $reat_text = 'Mediocre';
        } elseif ( $reat_percent <= 60 ) {
            $reat_text = 'Good';
        } elseif ( $reat_percent <= 80 ) {
            $reat_text = 'VGood';
        } elseif ( $reat_percent <= 100 ) {
            $reat_text = 'Excellent';
        }
        
        $data['header'] = [
            'notification' => Notifications::list_header()
        ];
        
        $data['reat_text'] = $reat_text;
        $data['reat_percent'] = $reat_percent;
        $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
        $exist_id = Session::exists('user_id');
//        return $data;
        return view('companie.view',[
            'header_title' => 'دواير | ' . $data->name,
            'is_owner' => $is_owner,
            'data' => $data,
            'reat_percent' => $reat_percent,
            'session' => $exist_id,
        ]); 
    }
    
    public function add(Request $req)
    {
        $data = array();
        $data['header']['notification'] = Notifications::list_header();
        $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
        $exist_id = Session::exists('user_id');
        if ( $exist_id ) {
            return view('companie.add',[
                'header_title' => 'دواير | اضافة شركة',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function logo($url)
    {
        
        $out = Companie::where('url', '=', $url)->first();
        
        $file = 'public/uploads/photos/' . $out->logo;
        
        if( strpos($out->logo, '../') ){
            $file = 'public/uploads/photos/default.png';
        } elseif ( file_exists($file) ) {
            $file = $file;
        }elseif ( !file_exists($file) ) {
            $file = 'public/uploads/photos/default.png';
        } else {
            $file = 'public/uploads/photos/default.png';
        }
        
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        header('Content-Type: image/' . $ext);
        echo file_get_contents($file);
    }
    
    ///////////////////////////////////////////// AJAX /////////////////////////////////////////////
    public function ajax_add(Request $req)
    {
        //
        $exist_companie_data = Companie::exist($req->all());
        //
        $exist_companie_title = Companie::exist($req->only(['name']));
        //
        $exist_profile = Profile::exist($req->only(['url']));
        //
        $file = 'public/uploads/photos/' . $req->logo;
        //
        $filter_url = filter_var($req->url, FILTER_VALIDATE_URL);
        //
        $filter_site = filter_var($req->site, FILTER_VALIDATE_URL);
        //
        $filter_establishment = filter_var($req->establishment, FILTER_VALIDATE_INT);
        //
        if ( !$req->has('name') ) {
            $out = [
                'status' => false,
                'message' => 'ماهو اسم شركتك'
            ];
        } elseif ( $exist_companie_title ) {
            $out = [
                'status' => false,
                'message' => 'اسم الشركة مستخدم من قبل'
            ];
        } elseif ( !$req->has('url') ) {
            $out = [
                'status' => false,
                'message' => 'برجاء ادخال الاسم المستعار'
            ];
        } elseif ( $filter_url ) {
            $out = [
                'status' => false,
                'message' => 'لا يمكن ان يكون عنوان URL'
            ];
        } elseif ( $exist_profile ) {
            $out = [
                'status' => false,
                'message' => 'عنوان الرابط مستخدم من قبل'
            ];
        } elseif ( !$req->has('logo') || empty($req->logo) ) {
            $out = [
                'status' => false,
                'message' => 'قم بختيار لوجو لشركتك'
            ];
        } elseif ( !file_exists($file) ) {
            $out = [
                'status' => false,
                'message' => 'حدث خطاء اتناء رفع الملف'
            ];
        } elseif ( !$req->has('site') ) {
            $out = [
                'status' => false,
                'message' => 'ادخل عنوان الموقع الالكتروني'
            ];
        } elseif ( !$req->has('email') ) {
            $out = [
                'status' => false,
                'message' => 'ادخل البريد الالكتروني'
            ];
        } elseif ( !$filter_site ) {
            $out = [
                'status' => false,
                'message' => 'الراجاء دخال رابط الموقع بشكل صحيح'
            ];
        } elseif ( !$req->has('specialization') ) {
            $out = [
                'status' => false,
                'message' => 'ماهو تخصص شركتك'
            ];
        } elseif ( !$req->has('headquarters') ) {
            $out = [
                'status' => false,
                'message' => 'اين ماكن المقر'
            ];
        } elseif ( !$req->has('establishment') ) {
            $out = [
                'status' => false,
                'message' => 'اذكر سنه التاسيس'
            ];
        } elseif ( !$filter_establishment ) {
            $out = [
                'status' => false,
                'message' => 'ادخل سنة التاسيس بشكل صحيح'
            ];
        } elseif ( !$req->has('about') ) {
            $out = [
                'status' => false,
                'message' => 'بحاجة الي وصف شركنك'
            ];
        } elseif ( $exist_companie_data ) {
            $out = [
                'status' => false,
                'message' => 'هذا المعلومات مسجلة من قبل'
            ];
        } else {
            $req['owner_id'] = Session::get('user_id');
            Companie::create( $req->all() );
            Profile::add(1, $req->url);
            Mailers::addNewCompany($req->name, $req->url, $req->email);
            $out = [
                'status' => true,
                'message' => 'تم اضافة الشركة بنجاح'
            ];
        }
        return response()->json( $out );
    }
    
    public function ajax_edit(Request $req)
    {
        
        if ( !$req->has('name') || empty($req->name) ) {
            $out = [
                'status' => false,
                'message' => 'ماهو اسم شركتك'
            ];
        } elseif ( !$req->has('url') || empty($req->url) ) {
            $out = [
                'status' => false,
                'message' => 'يمكنك تحديد عنوان للرابط شركتك'
            ];
        }  elseif ( !$req->has('logo') || empty($req->logo) ) {
            $out = [
                'status' => false,
                'message' => 'قم بختيار لوجو لشركتك'
            ];
        } elseif ( !$req->has('site') || empty($req->site) ) {
            $out = [
                'status' => false,
                'message' => 'ادخل عنوان الموقع الالكتروني'
            ];
        } elseif ( !$req->has('email') ) {
            $out = [
                'status' => false,
                'message' => 'ادخل البريد الالكتروني'
            ];
        } elseif ( !$req->has('specialization') || empty($req->specialization) ) {
            $out = [
                'status' => false,
                'message' => 'ماهو تخصص شركتك'
            ];
        } elseif ( !$req->has('headquarters') || empty($req->headquarters) ) {
            $out = [
                'status' => false,
                'message' => 'اين ماكن المقر'
            ];
        } elseif ( !$req->has('establishment') || empty($req->establishment) ) {
            $out = [
                'status' => false,
                'message' => 'اذكر تاريخ التاسيس'
            ];
        } elseif ( !$req->has('about') || empty($req->about) ) {
            $out = [
                'status' => false,
                'message' => 'بحاجة الي وصف شركنك'
            ];
        } else {
            Companie::where('url', '=', $req->seturl)->update( $req->except(['seturl']) );
            Profile::where('url', '=', $req->seturl)->update( $req->only(['url']) );
            $out = [
                'status' => true,
                'message' => 'تم اضافة الشركة بنجاح'
            ];
        }
        return response()->json( $out );
    }
    
    public function ajax_team_add(Request $req)
    {
        $exist_user_public_code = User::exist([
            'public_code' => $req->user_public_code
        ]);
        if ( !$req->has('user_public_code') || empty($req->user_public_code) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء ادخل معرف المستخدم'
            ];
        } elseif ( !$exist_user_public_code ) {
            $out = [
                'status' => false,
                'message' => 'معرف المستخدم غير صحيح'
            ];
        } elseif ( !$req->has('user_position') || empty($req->user_position) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء ادخال المسمى الوظيفي'
            ];
        } elseif ( !$req->has('work_start_history') || empty($req->work_start_history) ) {
            $out = [
                'status' => false,
                'message' => 'قم بتحديد تاريخ بداء العمل'
            ];
        } else {
            // add notification
            Notification::add(Session::get('user_id'), User::getData(['public_code' => $req->user_public_code])->id, 'ADDTOTEAM', $req->companie_id);
            //
            $req['work_end_history'] = $req->work_start_history;
            companieTeam::add($req->only([
                'companie_id',
                'user_public_code',
                'user_position',
                'work_start_history',
                'work_end_history',
            ]));
            $out = [
                'status' => true,
                'message' => 'تم اضافة العضو الي لفريق'
            ];
        }
        return response()->json( $out );
    }
    
}
