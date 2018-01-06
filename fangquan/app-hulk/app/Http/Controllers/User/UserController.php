<?php

namespace App\Hulk\Http\Controllers\User;

use App\Hulk\Http\Controllers\BaseController;
use App\Hulk\Service\User\AccountHulkService;
use App\Hulk\Service\User\UserHulkService;
use App\Hulk\Src\Forms\User\FindPasswordForm;
use App\Hulk\Src\Forms\User\LoginForm;
use App\Hulk\Src\Forms\User\ProviderLoginForm;
use App\Hulk\Src\Forms\User\RegCodeForm;
use App\Hulk\Src\Forms\User\SetPasswordForm;
use App\Hulk\Src\Forms\User\UserLoginForm;
use App\Hulk\Src\Forms\User\UserRegisterForm;
use App\Hulk\Src\Forms\User\WxLoginForm;
use App\Src\Content\Infra\Repository\UserInfoRepository;
use App\Src\FqUser\Domain\Model\FqUserEntity;
use App\Src\FqUser\Infra\Repository\FqUserRepository;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    public function weixinLogin(Request $request, UserLoginForm $form)
    {
        $data = [];
        $form->validate($request->all());

        $account_hulk_service = new AccountHulkService();
        $user_id = $account_hulk_service->thirdPartyRegister($form->openid, $form->nickname);
        $data['user_id'] = $user_id;
        $data['open_id'] = $form->openid;
        $data['wx_avatar'] = $form->avatar;

        $result['code'] = 200;
        $result['msg'] = 'success';
        $result['data'] = $data;

        return response()->json($result, 200);
    }

    public function wxLogin(Request $request, WxLoginForm $form)
    {
        $data = [];
        $form->validate($request->all());

        $account_hulk_service = new AccountHulkService();
        $user_id = $account_hulk_service->thirdPartyLogin($form->openid,$form->phone,$form->avatar, $form->nickname);
        $data['user_id'] = $user_id;
        $data['open_id'] = $form->openid;
        $data['wx_avatar'] = $form->avatar;

        $result['code'] = 200;
        $result['msg'] = 'success';
        $result['data'] = $data;

        return response()->json($result, 200);
    }

    public function register(Request $request, UserRegisterForm $form)
    {
        $data = [];
        $form->validate($request->all());
        $account_hulk_service = new AccountHulkService();
        $user_info_repository = new UserInfoRepository();
        $fq_user_repository = new FqUserRepository();
        $user_info_repository->save($form->user_info_entity);
        $account_hulk_service->saveFqUserInfo($form->user_info_entity, $form->role_type);
        /** @var FqUserEntity $fq_user_entity */
        $fq_user_entity = $fq_user_repository->fetch($form->user_info_entity->user_id);
        $data['user_id'] = $fq_user_entity->id;
        $data['user_name'] = $fq_user_entity->nickname;
        $data['wx_avatar'] = $form->user_info_entity->wx_avatar ?? '';
        $data['role_type'] = $fq_user_entity->role_type ?? 0;

        $result['code'] = 200;
        $result['msg'] = 'success';
        $result['data'] = $data;

        return response()->json($result, 200);
    }


    /**
     * 登录
     * @param Request   $request
     * @param LoginForm $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, LoginForm $form)
    {
        $data = [];
        $form->validate($request->all());
        $account_service = new AccountHulkService();
        $result = $account_service->login($form->weixin_login_entity);

        $user_hulk_service = new UserHulkService();
        $data = $user_hulk_service->getFqUserInfo($result['user_id']);

        $data['code'] = 200;
        $data['msg'] = 'success';
        $data['data'] = ['success' => true];
        return response()->json($data, 200);
    }

    /**
     * 登录
     * @param Request           $request
     * @param ProviderLoginForm $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function providerLogin(Request $request, ProviderLoginForm $form)
    {
        $data = [];
        $form->validate($request->all());

        $user_hulk_service = new UserHulkService();
        $data = $user_hulk_service->getFqUserInfo($form->weixin_login_entity->id);

        $data['code'] = 200;
        $data['msg'] = 'success';
        $data['data'] = ['success' => true];
        return response()->json($data, 200);
    }

    /**
     * 忘记密码
     * @param Request          $request
     * @param FindPasswordForm $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function modifyPassword(Request $request, FindPasswordForm $form)
    {
        $data = [];
        //$user_id = $request->user()->id;
        $form->validate($request->all());
        /** @var FqUserEntity $fq_user_entity */
        $fq_user_repository = new FqUserRepository();
        $fq_user_entity = $fq_user_repository->getFqUserByMobile($form->mobile);
        $fq_user_entity->password = $form->password;
        $fq_user_repository->updatePassword($fq_user_entity);
        $data['code'] = 200;
        $data['msg'] = 'success';
        $data['data'] = ['success' => true];
        return response()->json($data, 200);
    }

    /**
     * 设置密码
     * @param Request         $request
     * @param SetPasswordForm $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function setPassword(Request $request, SetPasswordForm $form)
    {
        $data = [];
        //$user_id = $request->user()->id;
        $form->validate($request->all());
        /** @var FqUserEntity $fq_user_entity */
        $fq_user_repository = new FqUserRepository();
        $fq_user_entity = $fq_user_repository->fetch($form->user_id);
        $fq_user_entity->nickname = $form->nickname;
        $fq_user_entity->account = $form->nickname;
        $fq_user_entity->password = $form->password;
        $fq_user_repository->updatePassword($fq_user_entity);
        $data['code'] = 200;
        $data['msg'] = 'success';
        $data['data'] = ['success' => true];
        return response()->json($data, 200);
    }

    /**
     * 判断验证码
     * @param Request     $request
     * @param RegCodeForm $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function regFindPwdCode(Request $request, RegCodeForm $form)
    {
        $data = [];
        $data['code'] = 200;
        $data['msg'] = 'success';
        $data['data'] = ['success' => true];
        return response()->json($data, 200);
    }


    public function userInfo(Request $request)
    {
        $data = [];
        $user_id = $request->get('user_id');
        $user_hulk_service = new UserHulkService();
        $data = $user_hulk_service->getFqUserInfo($user_id);
        return response()->json($data, 200);
    }
}


