<?php

namespace App\Hulk\Src\Forms\User;

use App\Src\Exception\LoginException;
use App\Hulk\Src\Forms\Form;
use Illuminate\Support\MessageBag;

class SetPasswordForm extends Form
{


    public $password;
    public $nickname;
    public $user_id;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|string',
            'password' => 'required|string',
            'user_id'  => 'required|integer',
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
            'password' => '密码',
            'user_id'  => '用户id',
        ];
    }

    public function validation()
    {
        $this->password = array_get($this->data, 'password');
        $this->nickname = array_get($this->data, 'name');
        $this->user_id = array_get($this->data, 'user_id');
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