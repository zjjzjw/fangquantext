<?php

namespace App\Admin\Src\Forms\CentrallyPurchases;


use App\Admin\Src\Forms\Form;
use App\Service\CentrallyPurchases\CentrallyPurchasesProjectService;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesEntity;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesProjectStatus;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesStatus;
use App\Src\CentrallyPurchases\Infra\Repository\CentrallyPurchasesRepository;
use App\Src\CentrallyPurchases\Infra\Repository\CentrallyPurchasesProjectRepository;

class CentrallyPurchasesStoreForm extends Form
{
    /**
     * @var CentrallyPurchasesEntity
     */
    public $centrally_purchases_entity;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'           => 'required|integer',
            'content'      => 'required|string',
            'developer_id' => 'nullable|integer',

            'start_up_time'     => 'date_format:Y-m-d H:i:s',
            'publish_time'      => 'date_format:Y-m-d H:i:s',
            'area'              => 'required|string',
            'province_id'       => 'required|integer',
            'city_id'           => 'required|integer',
            'created_user_id'   => 'required|integer',
            'address'           => 'required|string',
            'bidding_node'      => 'required|string',
            'contact'           => 'required|string',
            'contacts_phone'    => 'required|string',
            'contacts_position' => 'required|string',
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
            'id'           => '标识',
            'name'         => '采集信息名称',
            'logo'         => '封面',
            'status'       => '状态',
            'rank'         => '排名',
            'id'           => '标识',
            'content'      => '招标内容',
            'developer_id' => '开发商id',

            'start_up_time'     => '启动时间',
            'publish_time'      => '发布时间',
            'area'              => '项目覆盖区域',
            'province_id'       => '省ID',
            'city_id'           => '城市ID',
            'created_user_id'   => '创建人ID',
            'address'           => '采集地址',
            'bidding_node'      => '招标期限',
            'contact'           => '联系人',
            'contacts_phone'    => '联系电话',
            'contacts_position' => '职位',
            'status'            => '采集信息状态',
        ];
    }

    public function validation()
    {
        $centrally_purchases_repository = new CentrallyPurchasesRepository();
        if ($id = array_get($this->data, 'id')) {
            /** @var CentrallyPurchasesEntity $centrally_purchases_entity */
            $centrally_purchases_entity = $centrally_purchases_repository->fetch(array_get($this->data, 'id'));
        } else {
            $centrally_purchases_entity = new CentrallyPurchasesEntity();
        }


        $centrally_purchases_entity->content = array_get($this->data, 'content');
        $centrally_purchases_entity->developer_id = array_get($this->data, 'developer_id');
        $centrally_purchases_entity->p_nums = array_get($this->data, 'p_nums');
        $centrally_purchases_entity->start_up_time = array_get($this->data, 'start_up_time');
        $centrally_purchases_entity->publish_time = array_get($this->data, 'publish_time');
        $centrally_purchases_entity->area = array_get($this->data, 'area');
        $centrally_purchases_entity->province_id = array_get($this->data, 'province_id') ?? 0;
        $centrally_purchases_entity->city_id = array_get($this->data, 'city_id');
        $centrally_purchases_entity->created_user_id = array_get($this->data, 'created_user_id');
        $centrally_purchases_entity->address = array_get($this->data, 'address');
        $centrally_purchases_entity->bidding_node = array_get($this->data, 'bidding_node');
        $centrally_purchases_entity->contact = array_get($this->data, 'contact');
        $centrally_purchases_entity->contacts_phone = array_get($this->data, 'contacts_phone');
        $centrally_purchases_entity->contacts_position = array_get($this->data, 'contacts_position');
        $centrally_purchases_entity->status = array_get($this->data, 'status') ?? 0;
        $this->centrally_purchases_entity = $centrally_purchases_entity;
    }

}