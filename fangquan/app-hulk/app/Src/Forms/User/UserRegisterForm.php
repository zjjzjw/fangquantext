<?php

namespace App\Hulk\Src\Forms\User;

use App\Hulk\Service\User\AccountHulkService;
use App\Hulk\Src\Forms\Form;
use App\Src\Content\Domain\Model\UserInfoEntity;
use App\Src\Content\Infra\Repository\UserInfoRepository;
use App\Src\Exception\LoginException;
use Illuminate\Support\MessageBag;

class UserRegisterForm extends Form
{
    /**
     * @var int
     */
    public $role_type;

    /** @var  UserInfoEntity */
    public $user_info_entity;


    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string',
            'company'   => 'required|string',
            'position'  => 'required|string',
            'phone'     => 'required|string',
            'email'     => 'required|string',
            'user_id'   => 'required|integer',
            'wx_avatar' => 'required|string',
            'ver_code'  => 'required|integer',
            'role_type' => 'required|integer',
        ];
    }

    protected function messages()
    {
        return [
            'required'    => ':attribute必填。',
            'date_format' => ':attribute格式错误',
        ];
    }

    public function attributes()
    {
        return [
            'name'     => '姓名',
            'company'  => '公司',
            'position' => '职位',
            'phone'    => '电话',
            'email'    => '邮箱',
            'ver_code' => '验证码',
        ];
    }

    public function validation()
    {
        $user_id = array_get($this->data, 'user_id');
        $user_info_repository = new UserInfoRepository();
        $user_info_entity = $user_info_repository->getUserInfoByUserId($user_id);
        if (!isset($user_info_entity)) {
            $user_info_entity = new UserInfoEntity();
        }
        $user_info_entity->name = array_get($this->data, 'name');
        $user_info_entity->company = array_get($this->data, 'company');
        $user_info_entity->position = array_get($this->data, 'position');
        $user_info_entity->phone = array_get($this->data, 'phone');
        $user_info_entity->email = array_get($this->data, 'email');
        $user_info_entity->user_id = array_get($this->data, 'user_id');
        $user_info_entity->wx_avatar = array_get($this->data, 'wx_avatar');
        $this->role_type = array_get($this->data, 'role_type');

        $account_hulk_service = new AccountHulkService();
        $ver_code = array_get($this->data, 'ver_code');
        $result = $account_hulk_service->validVerifyCode($user_info_entity->phone, $ver_code);
        if ($result != 200) {
            $this->addError('ver_code', '错误');
        }
        $this->user_info_entity = $user_info_entity;
    }


    public function failedValidation(MessageBag $message)
    {
        $msg = '';
        $messages = $this->formatErrors($message);
        if (!empty($messages)) {
            $msg = current(current($messages));
        }
        throw new LoginException($msg, LoginException::ERROR_EMPTY);
    }
}