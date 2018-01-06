<?php

namespace App\Admin\Src\Forms\Developer\DeveloperPartnership;

use App\Src\Developer\Domain\Model\DeveloperPartnershipSpecification;
use App\Admin\Src\Forms\Form;

class DeveloperPartnershipSearchForm extends Form
{
    /**
     * @var DeveloperPartnershipSpecification
     */
    public $developer_partnership_specification;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword' => 'nullable|string',
            'status'  => 'nullable|int',
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
            'keyword' => '关键字',
            'status'  => '状态',
        ];
    }

    public function validation()
    {
        $this->developer_partnership_specification = new DeveloperPartnershipSpecification();
        $this->developer_partnership_specification->keyword = array_get($this->data, 'provider_id');
        $this->developer_partnership_specification->status = array_get($this->data, 'developer_id');
    }
}