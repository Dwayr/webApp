<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Controllers
use App\Http\Controllers\Session;
use App\Http\Controllers\Companies;
use App\Http\Controllers\Mailers;
// Models
use App\Models\User;
use App\Models\UserSettingJob as USJ;
use App\Models\UserSettingCommunication as USC;
use App\Models\Job;
use App\Models\JobApply;
use App\Models\Companie;
use App\Models\Notification;
use App\Models\DwayrOption;

use Roumen\Feed\Feed;

class Jobs extends Controller
{
    
    public function all(Request $req)
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        $data['header']['notification'] = Notifications::list_header();
        $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
        $data['options']['type_job'] = DwayrOption::listOptions('type_job');
//        return $data;
        return view('job.all',[
            'header_title' => 'دواير | عروض الوظائف',
            'data' => $data,
            'session' => $exist_id,
        ]);
    }
    
    public function add(Request $req)
    {
        $exist_id = Session::exists('user_id');
        if ( $exist_id ) {
            $data = array();
            $data['header']['notification'] = Notifications::list_header();
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
            $data['list_co'] = Companie::where('owner_id', '=', Session::get('user_id'))
                ->select([
                    'id',
                    'name',
                ])
                ->get();
            $data['options']['cities'] = DwayrOption::listOptions('cities');
            $data['options']['type_job'] = DwayrOption::listOptions('type_job');
    //        return $data;
            return view('job.add', [
                'header_title' => 'دواير | اضافة وظيفة',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function show($id)
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        if ( Job::is_owner($id) == Session::get('user_id') ) {
            $data['is_owner'] = true;
        } else {
            $data['is_owner'] = false;
        }
        $data['header']['notification'] = Notifications::list_header();
        $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
        $data['job'] = Job::show($id);
        $data['job']['city'] = DwayrOption::getOptions($data['job']['city']);
        $data['job']['type_work'] = DwayrOption::getOptions($data['job']['type_work']);
//        return $data;
        Job::addView($id);
        return view('job.show', [
            'header_title' => 'دواير | وظيفة ' . $data['job']->title,
            'data' => $data,
            'session' => $exist_id,
        ]);
    }
    
    public function ajax_list(Request $req)
    {
        $list = Job::list_all();
        $_list;
        foreach ( $list as $value ) {
            $_list[] = $value;
            $value['type_work'] = DwayrOption::getOptions($value['type_work']);
        }
        return @$_list;
    }
    public function ajax_add(Request $req)
    {
        $filter_years_experience = filter_var($req->years_experience, FILTER_VALIDATE_INT);
        $filter_average_salary = filter_var($req->average_salary, FILTER_VALIDATE_INT);
        
        $exist_job_title = Job::exist( $req->only('title') );
        if ( !$req->has('title') ) {
            $out = [
                'status' => false,
                'message' => 'برجاء ادخل عنوان الوظيفة'
            ];
        } elseif ( $exist_job_title ) {
            $out = [
                'status' => false,
                'message' => 'اسم الوظيفة موجود من قبل'
            ];
        } elseif ( !$req->has('city') || empty($req->city) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء تحديد المدينة'
            ];
        } elseif ( !$req->has('co_id') || empty($req->co_id) ) {
            $out = [
                'status' => false,
                'message' => 'ما هي الشركة التابعة له الوظيفة'
            ];
        } elseif ( !$req->has('years_experience') ) {
            $out = [
                'status' => false,
                'message' => 'كم عدد سنين الخبرة'
            ];
        }  elseif ( !$filter_years_experience ) {
            $out = [
                'status' => false,
                'message' => 'ادخل رقم سنين الخبرة'
            ];
        } elseif ( !$req->has('average_salary') ) {
            $out = [
                'status' => false,
                'message' => 'متوسط راتب الوظيفة'
            ];
        } elseif ( !$filter_average_salary ) {
            $out = [
                'status' => false,
                'message' => 'ادخل متوسط الراتب بالارقام'
            ];
        } elseif ( !$req->has('gender') || empty($req->gender) ) {
            $out = [
                'status' => false,
                'message' => 'حدد نوع الجنس للوظيفة'
            ];
        } elseif ( !$req->has('type_work') || empty($req->type_work) ) {
            $out = [
                'status' => false,
                'message' => 'اختيار طبيعة العمل'
            ];
        } elseif ( !$req->has('description') ) {
            $out = [
                'status' => false,
                'message' => 'ادخل وصف الوظيفة'
            ];
        } elseif ( !$req->has('skills') || empty($req->skills) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء حدد المهرات المطلوبة'
            ];
        } else {
            $req['skills'] = json_encode($req->skills);
            $create_job = Job::create( $req->all() );
            $out = [
                'status' => true,
                'message' => 'تم اضافة الوظيفة بنجاح',
                'action' => ['goTo("/job/show/' . $create_job->id . '")']
            ];
        }
        return response()->json( $out );
    }
    public function ajax_apply(Request $req)
    {
        $exist_id = Session::exists('user_id');
        $user_id = Session::get('user_id');
        
        if ( !$exist_id ) {
            $out = [
                'status' => false,
                'message' => 'برجاء تسجيل الدخول اولا'
            ];
        } elseif ( !USJ::exist([ 'user_id' => $user_id ]) ) {
            $out = [
                'status' => false,
                'message' => 'يجب تسجيل معلومات التوظيف'
            ];
        }  elseif ( !USC::exist([ 'user_id' => $user_id ]) ) {
            $out = [
                'status' => false,
                'message' => 'يجب تسجيل معلومات الاتصال'
            ];
        } else {
            Notification::add($user_id, Job::is_owner($req->id), 'JOBAPPLY', $req->id);
            JobApply::add($user_id, $req->id);
            $out = [
                'status' => true,
                'message' => 'تم تقدم الي الوظيفة'
            ];
        }
        return response()->json( $out );
    }
    
    public function ajax_apply_done(Request $req)
    {
        $exist_id = Session::exists('user_id');
        if ( $exist_id ) {
            Job::where($req->only('id'))->update([
                'status' => 1
            ]);
            $out = [
                'status' => true,
                'message' => 'تم اكمال عملية التطوظيف'
            ];
        } else {
            $out = [
                'status' => false,
                'message' => 'برجاء تسجيل الدخول اولا'
            ];
        }
        return response()->json( $out );
    }
    
    public function ajax_cancel(Request $req)
    {
        $exist_id = Session::exists('user_id');
        if ( $exist_id ) {
            Job::where($req->only('id'))->update([
                'status' => 2
            ]);
            $out = [
                'status' => true,
                'message' => 'تم الغاء اعلان الوظيفة'
            ];
        } else {
            $out = [
                'status' => false,
                'message' => 'برجاء تسجيل الدخول اولا'
            ];
        }
        return response()->json( $out );
    }
    
    public static function freeze()
    {
//        $from_date = time() - 86400; // 1 day
        $from_date = time() - 604800; // 7 days
//        $from_date = time() - 1296000; // 15 days
        $from_date = date('Y-m-d H:i:s', $from_date);
        return Job::where('created_at', '<=', $from_date)->where('status', '=', 0)->update([
            'status' => 3
        ]);
    }
    
    public static function sendTo()
    {
        $users = USJ::get();
        foreach ( $users as $user ) {
            if ( !Job::get_by_skills($user)->isEmpty() ) {
                $data_job = [
                    'user' => User::getData(['id' => $user->user_id]),
                    'jobs' => Job::get_by_skills($user),
                ];
                return Mailers::JobToUser($data_job);
            }
        }
//        return view('emails.JobToUser');
//        return $out;
    }
    
    public function rssFeed()
    {
        /* create new feed */
        $feed = new Feed;

        /* creating rss feed with our most recent 20 posts */
        $jobs = Job::where('status', '!=', 3)-> orderBy('id', 'desc')->get();

        /* set your feed's title, description, link, pubdate and language */
        $feed->title = 'dwayr Jobs';
        $feed->description = 'dwayr Jobs list';
        $feed->logo = 'http://dwayr.com/assets/resources/img/logo.png';
        $feed->link = url('feed');
        $feed->setDateFormat('datetime');
        $feed->pubdate = @$jobs[0]->created_at;
        $feed->lang = 'en';
        $feed->setShortening(true);
        $feed->setTextLimit(100);

        foreach ($jobs as $job)
        {
            $feed->add('دواير | وظيفة ' . $job->title, 'دواير | وظيفة ' . $job->title, \URL::to('job/show/' . $job->id), $job->created_at, strip_tags($job->description), strip_tags($job->description));
        }
        
        $feed->ctype = "text/xml";

        return $feed->render('atom');
    }
}
