<?php namespace App\Src\CentrallyPurchases\Infra\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CentrallyPurchasesModel extends Model
{
    use SoftDeletes;

    protected $table = 'centrally_purchases';


    protected $dates = [
        'start_up_time',
        'publish_time',
    ];

    protected $fillable = [
        'content',
        'developer_id',
        'p_nums',
        'start_up_time',
        'publish_time',
        'area',
        'province_id',
        'city_id',
        'created_user_id',
        'address',
        'bidding_node',
        'contact',
        'contacts_phone',
        'contacts_position',
        'status',
    ];
}


