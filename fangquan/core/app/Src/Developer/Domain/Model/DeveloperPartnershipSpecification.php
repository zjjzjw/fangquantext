<?php
namespace App\Src\Developer\Domain\Model;

use App\Foundation\Domain\ValueObject;
use App\Foundation\Support\Interfaces\Validatable;

class DeveloperPartnershipSpecification extends ValueObject implements Validatable
{
    /**
     * @var int
     */
    public $page;
    /**
     * @var int
     */
    public $developer_id;

    /**
     * @var int
     */
    public $provider_id;


    public function __construct()
    {

    }

    public function validate()
    {

    }


}