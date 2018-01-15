<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Uploads extends Controller
{
    protected static $extensions = [
        'jpg',
        'png',
        'gif',
    ];
    //
    public static function store ($file, $dir = false)
    {
        if (in_array($file->getClientOriginalExtension(), self::$extensions)) {
         
            // make file name
            $filename = md5(time()) . '.' . $file->getClientOriginalExtension();
            
            if ( $dir == false ) {
                // move file to dir uploads
                $file->move('public/uploads', $filename);
            } else {
                $file->move($dir, $filename);
            }
            
            // return path file
//            $filename = 'public/uploads/' . $filename;
            $out = [
                'status' => true,
                'msg' => true,
                'data' => $filename,
            ];
        } else {
            $out = [
                'status' => false,
                'msg' => false,
                'data' => '',
            ];
        }
        return $out;
    }
    
    //
    public function companie_logo(Request $req)
    {
        if ( $req->hasFile('file') == true ) {
            $up = self::store($req->file, 'public/uploads/photos');
            $out = [
                'status' => true,
                'type' => 'successful',
                'msg' => 'uploaded file',
                'data' => $up
            ];
        } else {
            $out = [
                'status' => false,
            ];
        }
        return response()->json($out);
    }
}