<?php

namespace App\Hulk\Src\Forms\User;

use App\Hulk\Src\Forms\Form;
use App\Src\Exception\LoginException;
use Illuminate\Support\MessageBag;

class WxLoginForm extends Form
{
    public $openid;
    public $nickname;
    public $avatar;
    public $phone;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code'  => 'required|string',
            'phone' => 'required|string',
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
            'code'  => 'code',
            'phone' => '电话',
        ];
    }

    public function validation()
    {
        $openid = $this->getWXOpenid(array_get($this->data, 'code'));
        if (!$openid) {
            $this->addError('openid', '参数错误');
        } else {
            $this->openid = $openid;
            $this->nickname = array_get($this->data, 'nickName');
            $this->avatar = array_get($this->data, 'avatarUrl');
            $this->phone = array_get($this->data, 'phone');
        }
    }

    private function getWXOpenid($code)
    {
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=" . env('WX_APP_ID') . "&secret=" . env('Wx_APP_SECRET') . "&js_code={$code}&grant_type=authorization_code";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = curl_exec($ch);
        $data = json_decode($res, true);
        if (array_key_exists('openid', $data)) {
            $openid = $data['openid'];
        } else {
            return $res;
        }
        return $openid;
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