<?php

namespace App\Web\Src\Forms\Developer\CentrallyPurchases;

use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesSpecification;
use App\Web\Src\Forms\Form;

class CentrallyPurchasesSearchForm extends Form
{
    /**
     * @var CentrallyPurchasesSpecification
     */
    public $centrally_purchases_specification;

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
        $this->centrally_purchases_specification = new CentrallyPurchasesSpecification();
        $this->centrally_purchases_specification->keyword = array_get($this->data, 'keyword');
        $this->centrally_purchases_specification->status = array_get($this->data, 'status');
    }
}