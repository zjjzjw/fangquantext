<?php

namespace App\Src\CentrallyPurchases\Domain\Model;

use App\Foundation\Domain\Enum;

/**
 * 认证信息
 * Class CentrallyPurchasesStatus
 * @package App\Src\CentrallyPurchases\Domain\Model
 */
class CentrallyPurchasesStatus extends Enum
{
    const YES = 1;//已认证
    const NO = 2;//未认证
    const OFF = 3;//下架


    /**
     * CentrallyPurchasesStatus status.
     *
     * @var int
     */
    public $status;

    /**
     * Define property name of enum value.
     *
     * @var string
     */
    protected $enum = 'status';

    /**
     * Acceptable operation  model type.
     *
     * @var array
     */
    protected static $enums = [
        self::YES => '已认证',
        self::NO  => '未认证',
        self::OFF => '下架',
    ];
}