<?php

namespace App\Admin\Src\Forms\Brand\BrandSignList;


use App\Admin\Src\Forms\Form;
use App\Src\Brand\Domain\Model\BrandSignListEntity;
use App\Src\Brand\Infra\Repository\BrandSignListRepository;
use App\Src\Loupan\Domain\Model\LoupanEntity;
use App\Src\Loupan\Infra\Repository\LoupanRepository;

class BrandSignListStoreForm extends Form
{
    /**
     * @var BrandSignListEntity
     */
    public $brand_sign_list_entity;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand_id'             => 'required|integer',
            'loupan_id'            => 'nullable|integer',
            'province_id'          => 'nullable|integer',
            'city_id'              => 'nullable|integer',
            'status'               => 'nullable|integer',
            'product_model'        => 'nullable|string',
            'brand_total_amount'   => 'nullable|numeric',
            'cover_num'            => 'nullable|integer',
            'delivery_num'         => 'nullable|string',
            'order_sign_time'      => 'nullable|string',
            'brand_sign_categorys' => 'nullable|array',
            'developer_ids'        => 'nullable|array',
            'developer_names'      => 'nullable|array',
            'loupan_name'          => 'required|string',
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
            'id'                   => '标识',
            'brand_id'             => '品牌id',
            'loupan_id'            => '楼盘id',
            'province_id'          => '省id',
            'city_id'              => '城市id',
            'status'               => '状态',
            'product_model'        => '产品型号',
            'delivery_num'         => '交付数量',
            'brand_total_amount'   => '交付总金额',
            'order_sign_time'      => '签订时间',
            'developer_ids'        => '开发商',
            'brand_sign_categorys' => '品类',
            'cover_num'            => '套数',
        ];
    }

    public function validation()
    {
        if ($id = array_get($this->data, 'id')) {
            $brand_sign_list_repository = new BrandSignListRepository();
            /** @var BrandSignListEntity $brand_sign_list_entity */
            $brand_sign_list_entity = $brand_sign_list_repository->fetch(array_get($this->data, 'id'));
        } else {
            $brand_sign_list_entity = new BrandSignListEntity();
            $brand_sign_list_entity->status = 0;
        }

        $brand_sign_list_entity->brand_id = array_get($this->data, 'brand_id');

        $brand_sign_list_entity->loupan_id = array_get($this->data, 'loupan_id');
        //如果楼盘ID为空的，则生成一个楼盘
        if (empty($brand_sign_list_entity->loupan_id)) {
            $loupan_name = array_get($this->data, 'loupan_name');
            $loupan_repository = new LoupanRepository();
            $loupan_entities = $loupan_repository->getLoupanListByName($loupan_name);
            if ($loupan_entities->isNotEmpty()) {
                $loupan_entity = $loupan_entities->first();
                $brand_sign_list_entity->loupan_id = $loupan_entity->id;
            } else {
                $loupan_entity = new LoupanEntity();
                $loupan_entity->name = $loupan_name;
                $loupan_entity->city_id = 0;
                $loupan_entity->province_id = 0;
                $loupan_entity->loupan_developers = [];
                $loupan_repository->save($loupan_entity);
                $brand_sign_list_entity->loupan_id = $loupan_entity->id;
            }
        }
        $brand_sign_list_entity->cover_num = array_get($this->data, 'cover_num');
        $brand_sign_list_entity->province_id = array_get($this->data, 'province_id');
        $brand_sign_list_entity->city_id = array_get($this->data, 'city_id');
        $brand_sign_list_entity->product_model = array_get($this->data, 'product_model');
        $brand_sign_list_entity->delivery_num = array_get($this->data, 'delivery_num') ?? 0;
        $brand_sign_list_entity->brand_total_amount = array_get($this->data, 'brand_total_amount') ?? 0;
        $brand_sign_list_entity->order_sign_time = array_get($this->data, 'order_sign_time');
        $brand_sign_list_entity->brand_sign_categorys = array_get($this->data, 'brand_sign_categorys');
        $developers = [];
        $developer_names = array_get($this->data, 'developer_names');
        $developer_ids = array_get($this->data, 'developer_ids');
        if (isset($developer_names) || isset($developer_ids)) {
            foreach ($developer_names as $key => $name) {
                $item['id'] = $developer_ids[$key] ?? 0;
                $item['name'] = $name;
                $developers[] = $item;
            }
        }
        $brand_sign_list_entity->project_developers = $developers;
        $this->brand_sign_list_entity = $brand_sign_list_entity;
    }

}