<?php

namespace App\Src\Developer\Domain\Model;

use App\Foundation\Domain\ValueObject;
use App\Foundation\Support\Interfaces\Validatable;

class DeveloperSpecification extends ValueObject implements Validatable
{
    /**
     * @var int
     */
    public $page;
    /**
     * @var string
     */
    public $keyword;

    /**
     * @var int
     */
    public $status;

    /** @var int */
    public $province_id;

    /** @var int */
    public $city_id;


    public function __construct()
    {

    }

    public function validate()
    {

    }

}