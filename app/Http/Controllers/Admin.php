<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Controllers
use App\Http\Controllers\Session;

class Admin extends Controller
{
    public function login()
    {
        return View('admin.login');
    }
}
