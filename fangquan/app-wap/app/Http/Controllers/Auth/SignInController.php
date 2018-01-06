<?php

namespace App\Wap\Http\Controllers\Auth;

use App\Wap\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SignInController extends BaseController
{
    public function index(Request $request)
    {
        $data = [];
        $this->title = '登录';
        $this->file_css = 'auth.sign-in';
        $this->file_js = 'auth.sign-in';
        return $this->view('auth.sign-in', $data);
    }

}