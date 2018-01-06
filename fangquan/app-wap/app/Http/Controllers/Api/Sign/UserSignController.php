<?php

namespace App\Wap\Http\Controllers\Api\Sign;

use App\Src\Role\Infra\Repository\UserSignRepository;
use App\Wap\Service\Account\AccountService;
use App\Wap\Src\Forms\UserSign\SendCodeForm;
use App\Wap\Src\Forms\UserSign\UserSignStoreForm;
use App\Wap\Http\Controllers\BaseController;
use Illuminate\Http\Request;


class UserSignController extends BaseController
{

    public function userSign(Request $request, UserSignStoreForm $form)
    {
        $data = [];
        $form->validate($request->all());
        $user_sign_repository = new UserSignRepository();
        $user_ids = [];
        foreach ($form->user_sign_entities as $user_sign_entity) {
            $user_sign_repository->save($user_sign_entity);
            $user_ids[] = $user_sign_entity->id;
        }
        $data['id'] = implode(';', $user_ids);
        return response()->json($data, 200);
    }

    public function sendCode(Request $request, SendCodeForm $form)
    {
        $data = [];
        $form->validate($request->all());
        $account_service = new AccountService();
        $account_service->getVerifyCode($form->verify_code_specification);
        $data['code'] = 200;
        $data['msg'] = 'success';
        $data['data'] = ['success' => true];
        return response()->json($data, 200);
    }
}

