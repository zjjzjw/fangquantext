<?php namespace App\Src\Brand\Domain\Model;

use App\Foundation\Domain\Enum;

class SaleChannelType extends Enum
{

    const BRAND = 1;
    const PRODUCT = 2;
    const INFORMATION = 3;

    /**
     * MsgStatus status.
     *
     * @var string
     */
    public $status;

    /**
     * Define property name of enum value.
     *
     * @var string
     */
    protected $enum = 'status';

    /**
     * Acceptable progress status.
     *
     * @var array
     */
    protected static $enums = [
        self::BRAND       => '工程',
        self::PRODUCT     => '电商',
        self::INFORMATION => '零售',
    ];


}