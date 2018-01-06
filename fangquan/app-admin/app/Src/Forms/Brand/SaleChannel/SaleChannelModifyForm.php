<?php

namespace App\Admin\Src\Forms\Brand\SaleChannel;


use App\Admin\Src\Forms\Form;
use App\Service\Brand\SaleChannelService;
use App\Src\Brand\Domain\Model\SaleChannelEntity;
use App\Src\Brand\Infra\Repository\SaleChannelRepository;

class SaleChannelModifyForm extends Form
{

    /**
     * @var int
     */
    public $brand_id;

    /**
     * @var array
     */
    public $sales;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand_id'         => 'required|integer',
            'sales'            => 'required|array',
            'certificate_file' => 'nullable|integer',
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
            'brand_id'         => '品牌id',
            'sales'            => '销售数据',
            'certificate_file' => '文件',

        ];
    }

    public function validation()
    {
        $this->brand_id = array_get($this->data, 'brand_id');
        $file_id = array_get($this->data, 'certificate_file') ?? 0;
        $sale_channel_service = new SaleChannelService();
        $sale_channel_service->saveSaleChannelFile($file_id, $this->brand_id);
        $sales = array_get($this->data, 'sales');
        $sales = $this->formatDataFromHorToVert($sales);
        $this->sales = $sales;
    }

}