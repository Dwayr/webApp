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
    public function __construct()
    {
//        $this->mail = new mail;  
    }
    
    public function test()
    {
        
//        $cos = [
//            [
//                'name' => 'xdigitalgroup',
//                'mail' => 'info@xdigitalgroup.com',
//            ],[
//                'name' => 'badrit',
//                'mail' => 'contact@badrit.com',
//            ],[
//                'name' => 'rubikal',
//                'mail' => 'info@rubikal.com',
//            ],[
//                'name' => 'softexpert',
//                'mail' => 'comunication@softexpert.com',
//            ],[
//                'name' => 'alaanak',
//                'mail' => 'info@alaanak.com',
//            ],[
//                'name' => 'civilsoft',
//                'mail' => 'info@civilsoft.net',
//            ],[
//                'name' => 'codesta',
//                'mail' => 'info@codesta.org',
//            ],[
//                'name' => 'savvyarabia',
//                'mail' => 'Contact@savvyarabia.com',
//            ],[
//                'name' => 'it-qan',
//                'mail' => 'info@it-qan.com',
//            ],[
//                'name' => 'ideasgate',
//                'mail' => 'info@ideasgate.com',
//            ],[
//                'name' => 'globalimpactsw',
//                'mail' => 'info@globalimpactsw.com',
//            ],[
//                'name' => 'espace',
//                'mail' => 'info@espace.com.eg',
//            ],[
//                'name' => 'softxpert',
//                'mail' => 'pharous.eg@gmail.com',
//            ],[
//                'name' => 'فاروس',
//                'mail' => 'info@softxpert.com',
//            ],[
//                'name' => 'komicho',
//                'mail' => 'komicho1996@gmail.com',
//            ],
//        ];
        
        $cos = [
            [
                'name' => 'komichoDotCom',
                'mail' => 'komicho1996@gmail.com',
            ]
        ];
  
//        exit;
        foreach ( $cos as $i ) {
            $emailData = [
                'name' => $i['name']
            ];
            $email = $i['mail'];
            Mail::send('emails.aboutCompany', $emailData, function ($message) use ($email) {
                $message
                    ->to($email)
                    ->from('info@dwayr.com')
                    ->subject('نرحب بشركتكم في دواير');
            });
            echo $i['name'] . ' ' . $i['mail'] . '<br>';
        }
        
        exit;
//        $emailData = [
//            'fullname' => 'karim M A'
//        ];
//        Mail::send('emails.welcome', $emailData, function ($message) {
//            $message
//                ->to('komicho1996@gmail.com')
//                ->from('info@dwayr.com')
//                ->subject('مرحبا بكم في دواير');
//        });

        
//        $list = User::select([
//            'first_name',
//            'last_name',
//            'email',
//        ])->get();
//        foreach ( $list as $value ) {
//            $fullname = $value['first_name'] . ' ' . $value['last_name'];
//            $email = $value['email'];
//            ///////////////////////////
//            $emailData = [
//                'fullname' => $fullname
//            ];
//            Mail::send('emails.welcome', $emailData, function ($message) use ($email) {
//                $message
//                    ->to($email)
//                    ->from('info@dwayr.com')
//                    ->subject('مرحبا بكم في دواير');
//            });
//            ///////////////////////////
//        }
    }
}
