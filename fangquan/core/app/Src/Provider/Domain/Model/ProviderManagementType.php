<?php namespace App\Src\Provider\Domain\Model;

use App\Foundation\Domain\Enum;

class ProviderManagementType extends Enum
{

    const DEVELOPER = 1;
    const PROVIDER = 2;
    const UNKNOWN = 3;
    const AGENT = 4;
    const CZWZ = 5;
    const DLWZ = 6;

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
        self::DEVELOPER => '厂家直营',
        self::PROVIDER  => '经销商',
        self::AGENT     => '代理商',
        self::CZWZ      => '厂家直营为主代理为辅',
        self::DLWZ      => '代理为主厂家直营为辅',
        self::UNKNOWN   => '其他',
    ];


}