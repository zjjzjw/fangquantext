<?php namespace App\Src\Developer\Infra\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Src\Developer\Infra\Eloquent\DeveloperPartnershipCategoryModel;
use App\Src\Category\Infra\Eloquent\CategoryModel;


class DeveloperPartnershipModel extends Model
{
    use SoftDeletes;

    protected $table = 'developer_partnership';
    protected $dates = [
        'time',
    ];
    protected $fillable = [
        'developer_id',
        'provider_id',
        'time',
        'address',
    ];


    /**
     * 开发商关系分类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function PartnershipCategories()
    {
        return $this->hasMany(DeveloperPartnershipCategoryModel::class, 'partnership_id', 'id');
    }

}

