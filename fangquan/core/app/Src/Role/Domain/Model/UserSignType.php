<?php namespace App\Src\Role\Domain\Model;


use App\Foundation\Domain\Enum;

class UserSignType extends Enum
{
    const YES = 1;
    const No = 2;

    /**
     * loan type.
     *
     * @var string
     */
    public $type;

    /**
     * Define property name of enum value.
     *
     * @var string
     */
    protected $enum = 'type';

    /**
     * Acceptable progress status.
     *
     * @var array
     */
    protected static $enums = [
        self::YES => '已签到',
        self::No  => '未签到',
    ];


}