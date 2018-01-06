<?php

namespace App\Admin\Src\Forms\Developer\DeveloperPartnership;


use App\Admin\Src\Forms\Form;
use App\Src\Developer\Domain\Model\DeveloperPartnershipEntity;
use App\Src\Developer\Infra\Repository\DeveloperPartnershipRepository;

class DeveloperPartnershipStoreForm extends Form
{
    /**
     * @var DeveloperPartnershipEntity
     */
    public $developer_partnership_entity;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                             => 'integer',
            'developer_id'                   => 'required|integer',
            'provider_id'                    => 'required|integer',
            'time'                           => 'date_format:Y-m-d H:i:s',
            'address'                        => 'string',
            'developer_partnership_category' => 'string',
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
            'id'                             => '标识',
            'developer_id'                   => '开发商标识',
            'provider_id'                    => '供应商标识',
            'time'                           => '签订时间',
            'address'                        => '地址',
            'developer_partnership_category' => '合作的品类ids',
        ];
    }

    public function validation()
    {
        $developer_partnership_repository = new DeveloperPartnershipRepository();
        if ($id = array_get($this->data, 'id')) {
            /** @var DeveloperPartnershipEntity $developer_partnership_entity */
            $developer_partnership_entity = $developer_partnership_repository->fetch(array_get($this->data, 'id'));
        } else {
            $developer_partnership_entity = new DeveloperPartnershipEntity();
        }


        $developer_partnership_entity->developer_id = array_get($this->data, 'developer_id');
        $developer_partnership_entity->provider_id = array_get($this->data, 'provider_id');
        $developer_partnership_entity->time = array_get($this->data, 'time') ?? '';
        $developer_partnership_entity->address = array_get($this->data, 'address') ?? '';
        $developer_partnership_category = array_get($this->data, 'developer_partnership_category');//项目品类
        if ($developer_partnership_category) {
            $developer_partnership_entity->developer_partnership_category = explode(',', $developer_partnership_category);
        } else {
            $developer_partnership_entity->developer_partnership_category = [];
        }
        $this->developer_partnership_entity = $developer_partnership_entity;
    }

}