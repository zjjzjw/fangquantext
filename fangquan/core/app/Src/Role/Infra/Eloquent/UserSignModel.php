<?php namespace App\Src\Role\Infra\Eloquent;

use App\Src\FqUser\Infra\Eloquent\FqUserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSignModel extends Model
{
    use SoftDeletes;

    protected $table = 'user_sign';

    protected $fillable = [
        'name',
        'phone',
        'is_sign',
        'crowd',
        'company_name',
        'position',
    ];


}