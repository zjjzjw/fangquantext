<?php

namespace App\Src\Brand\Infra\Eloquent;

use App\Src\Category\Infra\Eloquent\CategoryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandFactoryModel extends Model
{
    use SoftDeletes;

    protected $table = 'brand_factory';

    protected $dates = [

    ];

    protected $fillable = [
        'brand_id',
        'factory_type',
        'province_id',
        'city_id',
        'unit',
        'production_area',
        'address',
        'status',
    ];

    public function brand_factory_categorys()
    {
        return $this->belongsToMany(CategoryModel::class, 'brand_factory_category', 'brand_factory_id', 'category_id')->withTimestamps();
    }
}