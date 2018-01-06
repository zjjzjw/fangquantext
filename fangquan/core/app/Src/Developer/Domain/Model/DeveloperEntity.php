<?php namespace App\Src\Developer\Domain\Model;

use App\Foundation\Domain\Entity;

class DeveloperEntity extends Entity
{
    /**
     * @var int
     */
    public $id;

    public $identity_key = 'id';
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $logo;

    /**
     * @var int
     */
    public $status;

    /**
     * @var int
     */
    public $rank;

    /**
     * @var string
     */
    public $developer_address;

    /**
     * @var string
     */
    public $principles;

    /**
     * @var string
     */
    public $decision;

    /**
     * @var array
     */
    public $developer_category;

    /**
     * @var int
     */
    public $city_id;

    /**
     * @var int
     */
    public $province_id;

    public function __construct()
    {
    }

    public function toArray($is_filter_null = false)
    {
        return [
            'id'                 => $this->id,
            'name'               => $this->name,
            'logo'               => $this->logo,
            'status'             => $this->status,
            'rank'               => $this->rank,
            'decision'           => $this->decision,
            'developer_address'  => $this->developer_address,
            'principles'         => $this->principles,
            'developer_category' => $this->developer_category,
            'city_id'            => $this->city_id,
            'province_id'        => $this->province_id,
            'created_at'         => $this->created_at->toDateTimeString(),
            'updated_at'         => $this->updated_at->toDateTimeString(),
        ];
    }
}