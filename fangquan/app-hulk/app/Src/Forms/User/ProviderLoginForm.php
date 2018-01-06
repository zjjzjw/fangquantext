<?php

namespace App\Hulk\Src\Forms\User;

use App\Hulk\Service\User\AccountHulkService;
use App\Src\Exception\LoginException;
use App\Src\FqUser\Domain\Model\MobileLoginEntity;
use App\Src\FqUser\Domain\Model\WeixinLoginEntity;
use App\Hulk\Src\Forms\Form;
use App\Src\FqUser\Domain\Model\MobileLoginSpecification;
use App\Src\FqUser\Infra\Repository\FqUserRepository;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\MessageBag;

class ProviderLoginForm extends Form
{

    /**
     * @var WeixinLoginEntity
     */
    public $weixin_login_entity;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile'   => 'required|string',
            'ver_code' => 'required|string',
        ];
    }

    protected function messages()
    {
        return [
            'required' => ':attribute必填。',
            'integer'  => ':attribute必须是数字',
            'string'   => ':attribute必须是字符串',
        ];
    }

    public function attributes()
    {
        return [
            'mobile'   => '手机号',
            'ver_code' => '验证码',
        ];
    }

    public function validation()
    {
        $this->weixin_login_entity = new WeixinLoginEntity();
        $this->weixin_login_entity->mobile = array_get($this->data, 'mobile');
        $this->weixin_login_entity->ip = Request::ip();
        $this->weixin_login_entity->ver_code = array_get($this->data, 'ver_code');
        $account_hulk_service = new AccountHulkService();
        $ver_code = array_get($this->data, 'ver_code');
        $result = $account_hulk_service->validVerifyCode(
            $this->weixin_login_entity->mobile,
            $ver_code
        );
        if ($result != 200) {
            $this->addError('ver_code', '错误');
        }

        $fq_user_repository = new FqUserRepository();
        $fq_user_entity = $fq_user_repository->getFqUserByMobile(array_get($this->data, 'mobile'));
        if (!isset($fq_user_entity)) {
            $this->addError('mobile', '不存在');
        } else {
            $this->weixin_login_entity->id = $fq_user_entity->id;
        }

    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Support\MessageBag $message
     */
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