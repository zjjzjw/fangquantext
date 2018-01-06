<?php

namespace App\Wap\Src\Forms\UserSign;

use App\Wap\Src\Forms\Form;
use App\Src\Role\Domain\Model\UserSignEntity;
use App\Src\Role\Domain\Model\UserSignType;
use App\Src\Role\Infra\Repository\UserSignRepository;
use App\Wap\Service\Account\AccountService;
use Illuminate\Support\Collection;

class UserSignStoreForm extends Form
{
    /**
     * @var Collection
     */
    public $user_sign_entities;

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
            'phone'    => 'nullable|string',
            'ver_code' => 'nullable|integer',
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
            'phone'    => '手机号',
            'ver_code' => '验证码',
        ];
    }

    public function validation()
    {
        $phone = array_get($this->data, 'phone') ?? '';
        $name = array_get($this->data, 'name');
        if ($ver_code = array_get($this->data, 'ver_code')) {
            $account_service = new AccountService();
            $result = $account_service->validVerifyCode($phone, $ver_code);
            if ($result != 200) {
                $this->addError('ver_code', '错误');
            }
        }

        $user_sign_repository = new UserSignRepository();
        $user_sign_entities = $user_sign_repository->getUsersByPhoneAndName($phone, $name);


        if ($user_sign_entities->isEmpty()) {
            $this->addError('name', '信息不存在！');
        } else {
            foreach ($user_sign_entities as $user_sign_entity) {
                $user_sign_entity->is_sign = UserSignType::YES;
            }
            $this->user_sign_entities = $user_sign_entities;
        }
    }
}
