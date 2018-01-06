<?php

namespace App\Web\Src\Forms\Developer\DeveloperProject;

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

    }


    protected function failedValidation(MessageBag $message)
    {
        throw new HttpResponseException($this->response(
            $this->formatErrors($message)
        ));
    }
}