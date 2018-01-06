<?php namespace App\Src\Developer\Domain\Model;

use App\Foundation\Domain\Entity;
use Carbon\Carbon;

class DeveloperPartnershipEntity extends Entity
{
    /**
     * @var int
     */
    public $id;

    public $identity_key = 'id';
    /**
     * @var int
     */
    public $developer_id;

    /**
     * @var int
     */
    public $provider_id;
    /**
     * @var array
     */
    public $developer_partnership_category;
    /**
     * @var Carbon
     */
    public $time;

    /**
     * @var string
     */
    public $address;


    public function __construct()
    {
    }

    public function toArray($is_filter_null = false)
    {
        return [
            'id'           => $this->id,
            'developer_id' => $this->developer_id,
            'provider_id'  => $this->provider_id,
            'time'         => $this->time->toDateTimeString(),
            'address'      => $this->address,
            'developer_partnership_category'      => $this->developer_partnership_category,
            'created_at'   => $this->created_at->toDateTimeString(),
            'updated_at'   => $this->updated_at->toDateTimeString(),
        ];
    }
}
