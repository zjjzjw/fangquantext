<?php

namespace App\Admin\Src\Forms\CentrallyPurchases;

use App\Admin\Src\Forms\Form;
use App\Src\CentrallyPurchases\Infra\Repository\CentrallyPurchasesRepository;
use App\Src\Developer\Infra\Repository\DeveloperProjectRepository;
use App\Src\Developer\Infra\Eloquent\DeveloperProjectModel;

class CentrallyPurchasesDeleteForm extends Form
{


    /**
     * @var int
     */
    public $id;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
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
            'id'                => '标识',
            'developer_project' => '项目',
        ];
    }

    public function validation()
    {
        //项目列表中是否有此集采id centrally_purchases_id
        $this->id = array_get($this->data, 'id');

        $developer_project_model = DeveloperProjectModel::where('centrally_purchases_id', $this->id)
            ->first();
        if (!empty($developer_project_model)){
            $this->addError('developer_project', '需清空已有的项目才能删除!');
        }
    }


}