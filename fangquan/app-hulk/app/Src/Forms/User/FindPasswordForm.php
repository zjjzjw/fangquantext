<?php

namespace App\Hulk\Src\Forms\User;

use App\Src\Exception\LoginException;
use App\Hulk\Src\Forms\Form;
use Illuminate\Support\MessageBag;

class FindPasswordForm extends Form
{

    public $password;
    public $mobile;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|string',
            'mobile'   => 'required|integer',
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
            'password' => '新密码',
            'user_id'  => '用户id',
        ];
    }

    public function validation()
    {
        $this->password = array_get($this->data, 'password');
        $this->mobile = array_get($this->data, 'mobile');
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