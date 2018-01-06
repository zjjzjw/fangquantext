<?php namespace App\Src\Developer\Infra\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DeveloperCategoryModel extends Model
{
    use SoftDeletes;

    protected $table = 'developer_category';

    protected $fillable = [
        'developer_id',
        'category_id',
    ];
}