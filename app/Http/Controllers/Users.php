<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Session;
use App\Http\Controllers\komichoSdk;
use App\Http\Controllers\Mailers;
use App\Http\Controllers\Uploads;
use Hash;

use komicho\geo;
// Models
use App\Models\User;
use App\Models\UserSettingJob;
use App\Models\UserSettingCommunication as USC;
use App\Models\Profile;
use App\Models\GenerateCv;

class Users extends Controller
{
    public static function view($username)
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        $data['header']['notification'] = Notifications::list_header();
        $data['user'] = User::get_data_with(['mycompanie'],['username' => $username]);
        $data['profile'] = User::get_data_with([ 'companie', 'projects' ],[
            'username' => $username
        ]);
//        return $data;
        return view('user.profile',[
            'header_title' => 'دواير | ' . $data['user']->first_name . ' ' . $data['user']->last_name,
            'data' => $data,
            'session' => $exist_id,
        ]); 
    }
    
    public function sign_up()
    {
        $exist_id = Session::exists('user_id');
        if ( $exist_id ) {
            return redirect('/');
        } else {
            return view('user.sign_up',[
                'header_title' => 'دواير | انشاء حساب',
                'session' => $exist_id,
            ]);
        } 
    }
    public function sign_in()
    {
        $exist_id = Session::exists('user_id');
        if ( $exist_id ) {
            return redirect('/');
        } else {
            return view('user.sign_in',[
                'header_title' => 'دواير | تسجيل دخول',
                'session' => $exist_id,
            ]);
        } 
    }
    
    public function notifications()
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        $data['header']['notification'] = Notifications::list_header();
        $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
        if ( !$exist_id ) {
            return redirect('/');
        } else {
            return view('user.notifications',[
                'header_title' => 'دواير | الاشعارات',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } 
    }
    
    public function komicho_login()
    {
        $exist_id = Session::exists('user_id');
        if ( !$exist_id ) {
            $sdk = new komichoSdk('3wFDZtJdQt6ZgpSS','VA9je3rMS3Lb3TdYm2bywuJHjWyNJzAj');

            $data = $sdk->data();

            $in['username'] = $data->username;
            $in['public_code'] = $data->public_code;
            $ex = User::exist( $in );
            if ( $ex == false ) {
                $in['first_name'] = '';
                $in['last_name'] = '';
                $in['email'] = $data->email;
                $in['password'] = '';
                $in['avatar'] = '';
                $in['country_code'] = geo::code();
                $in['about'] = 'about';
                $id = User::create($in);
                Profile::add(2, $in['username']);
                Session::add('user_id', $id->id);
            } else {
                $id = User::getData( $in );
                Session::add('user_id', $id->id);
            }
            return redirect('/');
        } else {
            return redirect('/');
        }
    }
    
    public function sign_out()
    {
        Session::delete('user_id');
        return redirect('/');
    }
    
    public function generate_cv()
    {
        return view('user.generate_cv',[
                'header_title' => 'دواير | الاشعارات',
                'data' => '',
                'session' => false,
            ]);
    }
    
    public function generate_cv_post(Request $req)
    {
        if ( empty($req->fullname) ) {
            $out = back()->with('warning', 'برجاء ادخال اسمك')->withInput();
        } else if ( empty($req->dateBirth) ) {
            $out = back()->with('warning', 'برجاء تحديد تاريخ ميلادك')->withInput();
        } else if ( empty($req->address) ) {
            $out = back()->with('warning', 'برجاء ادخال عنوانك')->withInput();
        } else if ( empty($req->phone) ) {
            $out = back()->with('warning', 'برجاء ادخال رقم الهاتف')->withInput();
        } else if ( empty($req->email) ) {
            $out = back()->with('warning', 'برجاء ادخال بريد الاكتروني')->withInput();
        } else if ( empty($req->githublink) ) {
            $out = back()->with('warning', 'ادخل رابط حسابك علي GitHub')->withInput();
        } else if ( empty($req->linkedinlink) ) {
            $out = back()->with('warning', 'ادخل رابط حسابك علي LinkedIn')->withInput();
        } else if ( empty($req->skills) ) {
            $out = back()->with('warning', 'برجاء تحديد المهارات')->withInput();
        } else if ( empty($req->attachment) ) {
            $out = back()->with('warning', 'برجاء اضافة المرفقات')->withInput();
        } else {
            $reqData = $req->all();
            $reqData['attachment'] = Uploads::store($req->attachment, 'public/generate_cv')['data'];
            GenerateCv::add($reqData);
            $out = back()->with('success', 'تم اضافة الوصفة');
        }
        
        return $out;
    }
    
    public function ajax_sign_up(Request $req)
    {
//        return $req->all();
        $exist_username = Profile::exist( ['url' => $req->username] );
        $exist_email = User::exist( $req->only(['email']) );
        $filter_mail = filter_var($req->email, FILTER_VALIDATE_EMAIL);
        if ( empty($req->first_name) ) {
            $out = [
                'status' => false,
                'message' => 'ادخل الاسم الاول'
            ];
        } elseif ( empty($req->last_name) ) {
            $out = [
                'status' => false,
                'message' => 'ادخل الاسم الثاني'
            ];
        } elseif ( empty($req->username) ) {
            $out = [
                'status' => false,
                'message' => 'الرجاء ادخل اسم المستخدم'
            ];
        } elseif ( empty($req->email) ) {
            $out = [
                'status' => false,
                'message' => 'الرجاء ادخل البريد الالكتروني'
            ];
        } elseif ( !$filter_mail ) {
            $out = [
                'status' => false,
                'message' => 'ادخل البريد الالكتروني بشكل صحيح'
            ];
        } elseif ( $exist_username ) {
            $out = [
                'status' => false,
                'message' => 'اسم المستخدم مسجل من قبل'
            ];
        } elseif ( $exist_email ) {
            $out = [
                'status' => false,
                'message' => 'البريد الالكتروني مسجل من قبل'
            ];
        } elseif ( empty($req->password) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء ادخال كلمة المرور'
            ];
        } elseif ( $req->password != $req->repassword ) {
            $out = [
                'status' => false,
                'message' => 'كلمة المرور غير متطابقة'
            ];
        } else {
            $req['public_code'] = str_random(11);
            $req['password'] = Hash::make($req->password);
            $req['avatar'] = '';
            $req['country_code'] = geo::code();
            $req['about'] = 'about';
            $getData = User::create( $req->all() );
            Profile::add(2, $req->username);
            Session::add('user_id', $getData->id);
            Mailers::welcomeToUser($req->email);
            $out = [
                'status' => true,
                'message' => 'تم التسجيل',
                'action' => ['location.reload()']
            ];
        }
        return response()->json( $out );
    }
    
    public function ajax_sign_in(Request $req)
    {
        $exist_user = User::exist( $req->only(['email']) );
        if ( $exist_user == false ) {
            $out = [
                'status' => false,
                'message' => 'بيانات المستخدم غير صيحية',
            ];
        } else {
            $getData = User::getData( $req->only(['email']) );
            $password_verify = password_verify($req->password, $getData->password);
            if ( !$password_verify ) {
                $out = [
                    'status' => false,
                    'message' => 'كلمة المرور غير صحيحة',
                ];
            } elseif ( $getData->is_activated == 2 ) {
                $out = [
                    'status' => false,
                    'message' => 'تم تعطيل هذا الحساب',
                ];
            } else {
                Session::add('user_id', $getData->id);
                $out = [
                    'status' => true,
                    'message' => 'تم تسجيل الدخول',
                    'action' => ['location.reload()']
                ];
            }
        }
        return response()->json( $out );
    }
    
    public function ajax_edit_info(Request $req)
    {
        if ( !$req->has('first_name') || empty($req->first_name) ) {
            $out = [
                'status' => false,
                'message' => 'قم بادخال اسم الاول'
            ];
        } elseif ( !$req->has('last_name') || empty($req->last_name) ) {
            $out = [
                'status' => false,
                'message' => 'قم بادخال اسم الثاني'
            ];
        } elseif ( !$req->has('email') || empty($req->email) ) {
            $out = [
                'status' => false,
                'message' => 'البريد الاكتروني'
            ];
        } elseif ( !$req->has('country_code') || empty($req->country_code) ) {
            $out = [
                'status' => false,
                'message' => 'ماهي بلدك'
            ];
        }  elseif ( !$req->has('about') || empty($req->about) ) {
            $out = [
                'status' => false,
                'message' => 'اكتب تبذه عنك'
            ];
        } else {
            User::where('id', '=', Session::get('user_id'))->update( $req->all() );
            $out = [
                'status' => true,
                'message' => 'تم تعديل المعلومات بنجاح'
            ];
        }
        return response()->json( $out );
    }
    
    public function ajax_edit_password(Request $req)
    {
        $get_user = User::getData([
            'id' => Session::get('user_id')
        ]);
        $password_verify = password_verify($req->password, $get_user->password);
        if ( !$password_verify ) {
            $out = [
                'status' => false,
                'message' => 'كلمة المرور القديمة غير صحيحة'
            ];
        } elseif ( empty( $req->newpassword ) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء ادخال كلمة المرور الجديدة'
            ];
        } elseif ( empty( $req->renewpassword ) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء ادخال كلمة المرور الجديدة مره اخري'
            ];
        } elseif ( $req->newpassword !== $req->renewpassword ) {
            $out = [
                'status' => false,
                'message' => 'كلمة المرور الجديدة غير متطابقة'
            ];
        } else {
            $password = Hash::make($req->newpassword);
            User::where('id', '=', Session::get('user_id'))->update([
                'password' => $password
            ]);
            $out = [
                'status' => true,
                'message' => 'تم تحديث كلمة المرور'
            ];
        }
        return response()->json( $out );
    }
    
    public function ajax_setting_job(Request $req)
    {
        $exist = UserSettingJob::exist([
            'user_id' => Session::get('user_id')
        ]);
        if ( empty($req->city) ) {
            $out = [
                'status' => false,
                'message' => 'اختبار المدينة'
            ];
        } elseif ( empty($req->type_work) ) {
            $out = [
                'status' => false,
                'message' => 'اختبار طبيعة العمل'
            ];
        } elseif ( empty($req->skills) ) {
            $out = [
                'status' => false,
                'message' => 'ادخل المهارات'
            ];
        }
        elseif ( !$exist ){
            $req['user_id'] = Session::get('user_id');
//            $req['skills'] = json_encode($req->skills);
            UserSettingJob::add($req->all());
            $out = [
                'status' => true,
                'message' => 'تم اضافة اعدادات الوظيفة'
            ];
        } elseif ( $exist ) {
            $req['skills'] = json_encode($req->skills);
            UserSettingJob::where(['user_id' => Session::get('user_id')])
                ->update($req->all());
            $out = [
                'status' => true,
                'message' => 'تم تحديث اعدادات الوظيفة'
            ];
        }
        return response()->json( $out );
    }
    
    public function ajax_setting_communication(Request $req)
    {
        $exist = USC::exist([
            'user_id' => Session::get('user_id')
        ]);
        $filter_mail = filter_var($req->email, FILTER_VALIDATE_EMAIL);
        $filter_phone_number = filter_var($req->phone_number, FILTER_VALIDATE_FLOAT);
        $filter_github_link = filter_var($req->github_link, FILTER_VALIDATE_URL);
        $filter_facebook_link = filter_var($req->facebook_link, FILTER_VALIDATE_URL);
        
        if ( empty($req->email) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء ادخال البريد الاكتروني'
            ];
        } elseif ( !$filter_mail ) {
            $out = [
                'status' => false,
                'message' => 'ادخل البريد الاكتروني بشكل صيحيح'
            ];
        } elseif ( empty($req->phone_number) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء ادخل رقم الهاتف'
            ];
        } elseif ( !$filter_phone_number ) {
            $out = [
                'status' => false,
                'message' => 'ادخل رقم الهاتف صحيحا'
            ];
        } elseif ( !empty($req->github_link) && !$filter_github_link ) {
            $out = [
                'status' => false,
                'message' => 'ادخل رابط حسابك علي GitHub بالشكل الصحيح'
            ];
        } elseif ( !empty($req->facebook_link) && !$filter_facebook_link ) {
            $out = [
                'status' => false,
                'message' => 'ادخل رابط حسابك علي facebook بالشكل الصحيح'
            ];
        } elseif ( !$exist ) {
            if ( empty($req->github_link) ) {
                $req['github_link'] = '';
            }
            if ( empty($req->facebook_link) ) {
                $req['facebook_link'] = '';
            }
            $req['user_id'] = Session::get('user_id');
            USC::add($req->all());
            $out = [
                'status' => true,
                'message' => 'تم اضافة معلومات الاتصال'
            ];
        } elseif ( $exist ) {
            if ( empty($req->github_link) ) {
                $req['github_link'] = '';
            }
            if ( empty($req->facebook_link) ) {
                $req['facebook_link'] = '';
            }
            USC::edit(['user_id' => Session::get('user_id')], $req->all());
            $out = [
                'status' => true,
                'message' => 'تم تحديث معلومات الاتصال'
            ];
        }
        return response()->json( $out );
    }
}
