<?php namespace App\Src\Developer\Infra\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DeveloperPartnershipCategoryModel extends Model
{
    use SoftDeletes;

    protected $table = 'developer_partnership_category';

    protected $fillable = [
        'partnership_id',
        'category_id',
    ];
}
