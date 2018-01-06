<?php namespace App\Src\Developer\Domain\Model;

use App\Foundation\Domain\Entity;

class DeveloperPartnershipCategoryEntity extends Entity
{
    /**
     * @var int
     */
    public $id;

    public $identity_key = 'id';
    /**
     * @var int
     */
    public $partnership_id;

    /**
     * @var int
     */
    public $category_id;


    public function __construct()
    {
    }

    public function toArray($is_filter_null = false)
    {
        return [
            'id'             => $this->id,
            'partnership_id' => $this->partnership_id,
            'category_id'    => $this->category_id,
            'created_at'     => $this->created_at->toDateTimeString(),
            'updated_at'     => $this->updated_at->toDateTimeString(),
        ];
    }
}