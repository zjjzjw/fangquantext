<?php

namespace App\Hulk\Src\Forms\Developer\DeveloperProject;

use App\Src\Developer\Domain\Model\DeveloperProjectSpecification;
use App\Admin\Src\Forms\Form;
use App\Src\FqUser\Domain\Model\FqUserEntity;
use App\Src\FqUser\Infra\Repository\FqUserRepository;
use App\Src\Role\Domain\Model\UserSignCrowdType;
use App\Src\Role\Infra\Repository\UserSignRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\MessageBag;

class DeveloperProjectDetailForm extends Form
{
    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [

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

        ];
    }


    public function validation()
    {
        $user_id = array_get($this->data, 'user_id');
        if (empty($user_id)) {
            $this->addError('auth', '请先登录！');
        } else {
            $fq_user_repository = new FqUserRepository();
            /** @var FqUserEntity $fq_user_entity */
            $fq_user_entity = $fq_user_repository->fetch($user_id);
            if (empty($fq_user_entity)) {
                $this->addError('auth', '请先登录！');
            } else {
                $phone = $fq_user_entity->mobile;
                $user_sign_repository = new UserSignRepository();
                $user_sign_entity = $user_sign_repository->getUserSignByPhone($phone);

                if (!isset($user_sign_entity) || !in_array($user_sign_entity->crowd, [
                        UserSignCrowdType::PTCZ, UserSignCrowdType::KFS, UserSignCrowdType::TZ,
                    ])
                ) {
                    $this->addError('auth', '会员特享频道，若想了解详情，请致电“联系我们”！');
                }
            }
        }
    }


    protected function failedValidation(MessageBag $message)
    {
        throw new HttpResponseException($this->response(
            $this->formatErrors($message)
        ));
    }
}