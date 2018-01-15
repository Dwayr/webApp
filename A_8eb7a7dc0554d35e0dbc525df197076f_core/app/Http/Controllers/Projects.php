<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Controllers
use App\Http\Controllers\Session;
// Models
use App\Models\User;
use App\Models\Companie;
use App\Models\Project;
use App\Models\ProjectsTeam;
use App\Models\ProjectsCompanie;

class Projects extends Controller
{

    public function add()
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        if ( $exist_id ) {
            $data['header']['notification'] = Notifications::list_header();
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
            return view('project.add', [
                'header_title' => 'دواير | اضافة مشروع جديد',
                'data' => $data,
                'session' => $exist_id,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function edit($id)
    {
        $exist_id = Session::exists('user_id');
        if ( $exist_id ) {
            $project_exist = Project::exist(['id' => $id]);
            $data = array();
            $data['header']['notification'] = Notifications::list_header();
            $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
            $data['project'] = Project::show($id);
    //        return $data;
            if ( $project_exist == false ) {
                return redirect('/');
            } elseif ( $data['project']->owner_id != Session::get('user_id') ) {
                return redirect('/');
            } else {
                return view('project.edit', [
                    'header_title' => 'دواير | تعديل مشروع',
                    'data' => $data,
                    'session' => $exist_id,
                ]);
            }
        } else {
            return redirect('/');
        }
    }
    
    public function show($id)
    {
        $exist_id = Session::exists('user_id');
        $data = array();
        $data['header']['notification'] = Notifications::list_header();
        $data['user'] = User::get_data_with(['mycompanie'],['id' => Session::get('user_id')]);
        $data['project'] = Project::show($id);
        return view('project.show', [
            'header_title' => 'دواير | مشروع ' . $data['project']->title,
            'data' => $data,
            'session' => $exist_id,
        ]);
    }
    
    public function tag_team($username)
    {
        $out = User::where('username', '=', $username)->orWhere('public_code', '=', $username)
            ->select([
                'id',
                'username AS username',
                'username AS text',
                'first_name AS firstName',
                'last_name AS lastName',
            ])
            ->get();
        return response()->json( $out );
    }
    
    public function ajax_add(Request $req)
    {
        if ( !$req->has('title') ) {
            $out = [
                'status' => false,
                'message' => 'ادخل عنوان المشروع'
            ];
        } elseif ( empty($req->co_id) ) {
            $out = [
                'status' => false,
                'message' => 'اختيارالشركة التابع لها المشروع'
            ];
        } elseif ( !$req->has('about') ) {
            $out = [
                'status' => false,
                'message' => 'ادخل وصف المشورع'
            ];
        } elseif ( empty($req->icon) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء اختيار ايقونة للمشروع'
            ];
        } elseif ( empty($req->team) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء تحديد اعضاء فريق تطوير المشروع'
            ];
        } else {
            $exist_project = Project::exist($req->except(['team', 'co_id']));
            if ( $exist_project == false ) {
                $req['owner_id'] = Session::get('user_id');
                $projectid = Project::create($req->except(['team', 'co_id']))->id;
                // ProjectsCompanie
                $dataProjectsCompanie['project_id'] = $projectid;
                $dataProjectsCompanie['companie_id'] = $req->co_id;
                ProjectsCompanie::create($dataProjectsCompanie);
                // ProjectsTeam
                foreach ( $req->team as $i) {
                    $dataProjectsTeam['project_id'] = $projectid;
                    $dataProjectsTeam['user_id'] = $i['id'];
                    ProjectsTeam::create($dataProjectsTeam);
                }
                $out = [
                    'status' => true,
                    'message' => 'تم اضافة المشروع بنجاح'
                ];
            } else {
                $out = [
                    'status' => false,
                    'message' => 'هذه المعلومات موجوده من قبل'
                ];
            }
        }
        return response()->json( $out );
    }
    public function ajax_edit(Request $req)
    {
        $owner_id = Project::owner_id($req->only(['id']));
        $project_exist = Project::exist($req->only(['id']));
        
        if ( !$req->has('title') ) {
            $out = [
                'status' => false,
                'message' => 'ادخل عنوان المشروع'
            ];
        } elseif ( empty($req->co_id) ) {
            $out = [
                'status' => false,
                'message' => 'اختيارالشركة التابع لها المشروع'
            ];
        } elseif ( !$req->has('about')|| empty($req->about) ) {
            $out = [
                'status' => false,
                'message' => 'ادخل وصف المشورع'
            ];
        } elseif ( empty($req->icon) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء اختيار ايقونة للمشروع'
            ];
        } elseif ( empty($req->team) ) {
            $out = [
                'status' => false,
                'message' => 'برجاء تحديد اعضاء فريق تطوير المشروع'
            ];
        } elseif ( $owner_id != Session::get('user_id') ) {
            $out = [
                'status' => false,
                'message' => 'غير مسمح لك التعديل علي هذا المشروع'
            ];
        } elseif ( $project_exist == false ) {
            $out = [
                'status' => false,
                'message' => 'معرف المشروع غير معروف'
            ];
        } else {
            
            $projectid = Project::where($req->only(['id']))
                ->update($req->except(['team', 'co_id']));
            // remove companie to project
            ProjectsCompanie::where('project_id', '=', $req->id)->delete();
            // add companie to project
            $data['project_id'] = $req->id;
            $data['companie_id'] = $req->co_id;
            ProjectsCompanie::create($data);
            // remove team to project
            ProjectsTeam::where('project_id', '=', $req->id)->delete();
            // add team to project
            foreach ( $req->team as $i) {
                $data['project_id'] = $req->id;
                $data['user_id'] = $i['id'];
                ProjectsTeam::create($data);
            }
            $out = [
                'status' => true,
                'message' => 'تم تعديل المشروع بنجاح'
            ];
            
        }
        return response()->json( $out );
    }
    public function ajax_edit_get_data(Request $req)
    {
        return ProjectsTeam::list_team($req->only(['id']));
    }
    // GET
    public function logo($id)
    {
        
        $out = Project::where('id', '=', $id)->first();
        
        $file = 'public/uploads/photos/' . $out->icon;
        
        if (file_exists($file)) {
            $file = $file;
        } else {
            $file = 'public/uploads/photos/default.png';
        }
        
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        header('Content-Type: image/' . $ext);
        echo file_get_contents($file);
    }
}
