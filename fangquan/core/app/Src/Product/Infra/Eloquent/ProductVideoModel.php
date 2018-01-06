<?php

namespace App\Src\Product\Infra\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVideoModel extends Model
{
    use SoftDeletes;

    protected $table = 'product_video';

    protected $fillable = [
        'product_id',
        'video_id',
    ];
}