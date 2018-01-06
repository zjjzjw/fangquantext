<?php

namespace App\Hulk\Src\Forms\User;

use App\Hulk\Service\User\AccountHulkService;
use App\Src\Exception\LoginException;
use App\Hulk\Src\Forms\Form;
use Illuminate\Support\MessageBag;

class RegCodeForm extends Form
{


    public $ver_code;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile' => 'required|string',
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
        $ver_code = array_get($this->data, 'ver_code');
        $mobile = array_get($this->data, 'mobile');
        $account_hulk_service = new AccountHulkService();
        $result = $account_hulk_service->validVerifyCode($mobile, $ver_code);
        if ($result != 200) {
            $this->addError('ver_code', '错误');
        }
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