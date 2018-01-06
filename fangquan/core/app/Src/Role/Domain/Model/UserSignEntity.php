<?php

namespace App\Src\Role\Domain\Model;

use App\Foundation\Domain\Entity;

class UserSignEntity extends Entity
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
     * @var string
     */
    public $phone;

    /**
     * @var int
     */
    public $is_sign;

    /**
     * @var string
     */
    public $company_name;

    /**
     * @var string
     */
    public $position;

    /**
     * @var string
     */
    public $crowd;


    public function __construct()
    {
    }

    public function toArray($is_filter_null = false)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'phone'        => $this->phone,
            'is_sign'      => $this->is_sign,
            'company_name' => $this->company_name,
            'position'     => $this->position,
            'crowd'        => $this->crowd,
            'created_at'   => $this->created_at->toDateTimeString(),
            'updated_at'   => $this->updated_at->toDateTimeString(),
        ];
    }

}