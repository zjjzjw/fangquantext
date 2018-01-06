<?php

namespace App\Hulk\Http\Controllers\User;

use App\Hulk\Http\Controllers\BaseController;
use App\Hulk\Service\User\AccountHulkService;
use App\Hulk\Src\Forms\User\VerifyCodeForm;
use Illuminate\Http\Request;

class VerifyCodeController extends BaseController
{
    public function index(Request $request, VerifyCodeForm $form)
    {
        $data = [];
        $form->validate($request->all());
        $mobil_login = new  AccountHulkService();
        $mobil_login->getVerifyCode($form->verify_code_specification);
        $data['code'] = 200;
        $data['msg'] = 'success';
        $data['data'] = ['success' => true];
        return response()->json($data, 200);
    }

}


