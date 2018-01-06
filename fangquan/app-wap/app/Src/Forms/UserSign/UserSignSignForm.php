<?php

namespace App\Wap\Src\Forms\UserSign;

use App\Admin\Src\Forms\Form;
use App\Src\Content\Domain\Model\UserInfoEntity;
use App\Src\Role\Domain\Model\UserSignEntity;
use App\Src\Role\Infra\Repository\UserSignRepository;

class UserSignSignForm extends Form
{
    /**
     * @var UserSignEntity
     */
    public $user_sign_entity;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'       => 'required|integer',
            'name'     => 'required|string',
            'phone'    => 'required|string',
            'ver_code' => 'required|integer',
        ];
    }

    protected function messages()
    {
        return [
            'required'    => ':attribute必填。',
            'date_format' => ':attribute格式错误。',
        ];
    }

    public function attributes()
    {
        return [
            'id'       => '标识',
            'name'     => '名称',
            'phone'    => '联系方式',
            'ver_code' => '验证码',
        ];
    }

    public function validation()
    {
        if ($id = array_get($this->data, 'id')) {
            $user_sign_repository = new UserSignRepository();
            /** @var UserSignEntity $user_sign_entity */
            $user_sign_entity = $user_sign_repository->fetch(array_get($this->data, 'id'));
        } else {
            $user_sign_entity = new UserInfoEntity();
        }

        $user_sign_entity->user_id = request()->user()->id;
        $this->user_sign_entity = $user_sign_entity;
    }
}
