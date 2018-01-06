<?php

namespace App\Src\CentrallyPurchases\Domain\Model;

use App\Foundation\Domain\ValueObject;
use App\Foundation\Support\Interfaces\Validatable;

class CentrallyPurchasesSpecification extends ValueObject implements Validatable
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


    public function __construct()
    {

    }

    public function validate()
    {

    }


}