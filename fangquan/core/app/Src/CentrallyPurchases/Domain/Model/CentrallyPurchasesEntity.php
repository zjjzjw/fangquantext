<?php namespace App\Src\CentrallyPurchases\Domain\Model;

use App\Foundation\Domain\Entity;
use Carbon\Carbon;

class CentrallyPurchasesEntity extends Entity
{
    /**
     * @var int
     */
    public $id;

    public $identity_key = 'id';
    /**
     * @var string
     */
    public $content;

    /**
     * @var int
     */
    public $developer_id;

    /**
     * @var int
     */
    public $p_nums;

    /**
     * @var Carbon
     */
    public $start_up_time;
    /**
     * @var Carbon
     */
    public $publish_time;
    /**
     * @var string
     */
    public $area;
    /**
     * @var int
     */
    public $province_id;

    /**
     * @var int
     */
    public $city_id;
    /**
     * @var int
     */
    public $created_user_id;
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $bidding_node;
    /**
     * @var string
     */
    public $contact;
    /**
     * @var string
     */
    public $contacts_phone;
    /**
     * @var string
     */
    public $contacts_position;
    /**
     * @var int
     */
    public $status;

    public function __construct()
    {
    }

    public function toArray($is_filter_null = false)
    {
        return [
            'id'                => $this->id,
            'content'           => $this->content,
            'developer_id'      => $this->developer_id,
            'p_nums'            => $this->p_nums,
            'start_up_time'     => $this->start_up_time->toDateTimeString(),
            'publish_time'      => $this->publish_time->toDateTimeString(),
            'area'              => $this->area,
            'province_id'       => $this->province_id,
            'city_id'           => $this->city_id,
            'created_user_id'   => $this->created_user_id,
            'address'           => $this->address,
            'bidding_node'      => $this->bidding_node,
            'contact'           => $this->contact,
            'contacts_phone'    => $this->contacts_phone,
            'contacts_position' => $this->contacts_position,
            'status'            => $this->status,
            'created_at'        => $this->created_at->toDateTimeString(),
            'updated_at'        => $this->updated_at->toDateTimeString(),
        ];

    }
}