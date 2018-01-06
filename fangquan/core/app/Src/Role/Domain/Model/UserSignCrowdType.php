<?php namespace App\Src\Role\Domain\Model;


use App\Foundation\Domain\Enum;

class UserSignCrowdType extends Enum
{
    const PTCZ = 1;
    const KFS = 2;
    const TZ = 3;
    const MFGYS = 4;
    const MT = 5;
    const DC = 6;
    const XH = 7;

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
        self::PTCZ  => '普通参展', //供应商 橙色
        self::KFS   => '开发商', //绿色
        self::TZ    => '特展',   //供应商 蓝色
        self::MFGYS => '免费供应商', //黄色
        self::MT    => '媒体',  //紫色
        self::DC    => '地产\领导\部门高层', //红色
        self::XH    => '协会\工作人员',
    ];


}