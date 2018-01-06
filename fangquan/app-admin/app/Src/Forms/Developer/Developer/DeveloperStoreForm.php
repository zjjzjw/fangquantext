<?php

namespace App\Admin\Src\Forms\Developer\Developer;


use App\Admin\Src\Forms\Form;
use App\Service\Developer\DeveloperProjectService;
use App\Src\Developer\Domain\Model\DeveloperEntity;
use App\Src\Developer\Domain\Model\DeveloperProjectStatus;
use App\Src\Developer\Domain\Model\DeveloperStatus;
use App\Src\Developer\Infra\Repository\DeveloperRepository;
use App\Src\Developer\Infra\Repository\DeveloperProjectRepository;

class DeveloperStoreForm extends Form
{
    /**
     * @var DeveloperEntity
     */
    public $developer_entity;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                  => 'required|integer',
            'name'                => 'required|string',
            'logo'                => 'nullable|integer',
            'status'              => 'required|integer',
            'rank'                => 'required|integer',
            'province_id'         => 'nullable|integer',
            'city_id'             => 'nullable|integer',
            'principles'          => 'nullable|string',
            'developer_address'   => 'nullable|string',
            'decision'            => 'nullable|string',
            'developer_categorys' => 'nullable|array',
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
            'id'                  => '标识',
            'name'                => '开发商名称',
            'logo'                => '封面',
            'status'              => '状态',
            'rank'                => '排名',
            'principles'          => '分级原则',
            'developer_address'   => '开发商地点',
            'decision'            => '项目落地决策',
            'developer_categorys' => '招标品类',
        ];
    }

    public function validation()
    {
        $developer_repository = new DeveloperRepository();
        if ($id = array_get($this->data, 'id')) {
            /** @var DeveloperEntity $developer_entity */
            $developer_entity = $developer_repository->fetch(array_get($this->data, 'id'));
        } else {
            $developer_entity = new DeveloperEntity();
        }

        $rank = array_get($this->data, 'rank');

        $developer_entity->name = array_get($this->data, 'name');
        $developer_entity->logo = array_get($this->data, 'logo') ?? 0;
        $developer_entity->status = array_get($this->data, 'status');
        $developer_entity->principles = array_get($this->data, 'principles');
        $developer_entity->developer_address = array_get($this->data, 'developer_address');
        $developer_entity->decision = array_get($this->data, 'decision');
        $developer_entity->province_id = array_get($this->data, 'province_id');
        $developer_entity->city_id = array_get($this->data, 'city_id');
        $developer_entity->developer_category = array_get($this->data, 'developer_categorys') ?? [];
        $developer_entity->rank = $rank;
        $this->developer_entity = $developer_entity;
    }

}