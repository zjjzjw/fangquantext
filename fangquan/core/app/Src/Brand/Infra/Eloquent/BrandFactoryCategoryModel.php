<?php

namespace App\Src\Brand\Infra\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandFactoryCategoryModel extends Model
{
    use SoftDeletes;

    protected $table = 'brand_factory_category';

    protected $fillable = [
        'brand_factory_id',
        'category_id',
    ];
}