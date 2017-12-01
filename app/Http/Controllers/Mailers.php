<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Session;
use App\Http\Controllers\komichoSdk;

// Models
use App\Models\User;

use Mail;

class Mailers extends Controller
{
    
    public static function welcomeToUser($email)
    {
        Mail::send('emails.welcomeToUser', [], function ($message) use ($email) {
            $message
                ->to($email)
                ->from('info@dwayr.com')
                ->subject('نرحب بك في دواير');
        });
    }
    
    public static function addNewCompany($name, $url, $email)
    {
        $data = [
            'name' => $name,
            'url' => $url
        ];
        Mail::send('emails.addNewCompany', $data, function ($message) use ($name, $email) {
            $message
                ->to($email)
                ->from('info@dwayr.com')
                ->subject('تم اضافة شركة '. $name .'');
        });
    }
    
    public static function JobToUser($data)
    {
        $email = $data['user']['email'];
        Mail::send('emails.JobToUser', ['data' => $data], function ($message) use ($email) {
            $message
                ->to($email)
                ->from('info@dwayr.com')
                ->subject('الوظائف المقترحة');
        });
    }
}
