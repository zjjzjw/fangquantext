<?php namespace App\Src\Developer\Infra\Eloquent;

use App\Src\Category\Infra\Eloquent\CategoryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DeveloperModel extends Model
{
    use SoftDeletes;

    protected $table = 'developer';

    protected $fillable = [
        'name',
        'logo',
        'status',
        'rank',
        'developer_address',
        'principles',
        'decision',
        'province_id',
        'city_id',
    ];

    public function developer_category()
    {
        return $this->belongsToMany(CategoryModel::class, 'developer_category', 'developer_id', 'category_id')->withTimestamps();
    }
}