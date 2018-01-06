<?php

namespace App\Src\Brand\Infra\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleChannelFileModel extends Model
{
    use SoftDeletes;

    protected $table = 'sale_channel_file';

    protected $dates = [

    ];

    protected $fillable = [
        'provider_id',
        'file_id',
    ];

}