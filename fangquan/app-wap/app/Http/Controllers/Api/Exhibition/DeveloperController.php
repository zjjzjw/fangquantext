<?php

namespace App\Wap\Http\Controllers\Api\Exhibition;


use App\Service\Developer\DeveloperProjectService;
use App\Service\Developer\DeveloperService;
use App\Src\Developer\Domain\Model\DeveloperSpecification;
use App\Src\Developer\Domain\Model\DeveloperProjectBiddingType;
use App\Src\Developer\Domain\Model\DeveloperStatus;
use App\Web\Service\Developer\DeveloperProjectWebService;
use App\Wap\Src\Forms\Developer\DeveloperProject\DeveloperProjectSearchForm;
use App\Wap\Src\Forms\Developer\DeveloperSearchForm;
use App\Src\Developer\Domain\Model\DeveloperProjectSpecification;
use App\Src\Developer\Domain\Model\DeveloperProjectStatus;
use App\Service\Project\ProjectCategoryService;
use App\Wap\Http\Controllers\BaseController;
use App\Src\Surport\Domain\Model\ProvinceEntity;
use App\Src\Surport\Infra\Repository\ProvinceRepository;
use App\Src\Developer\Domain\Model\DeveloperProjectAdType;
use Illuminate\Http\Request;


class DeveloperController extends BaseController
{
    public function developerListMore(Request $request, DeveloperSearchForm $form)
    {

        $data = [];
        $request->merge(['status' => DeveloperStatus::YES]);
        $form->validate($request->all());
        $developer_service = new DeveloperService();
        $data = $developer_service->getDeveloperList($form->developer_specification, 20);
        $data['appends'] = $this->getDeveloperAppends($form->developer_specification);
        return response()->json($data, 200);

    }

    public function getDeveloperAppends(DeveloperSpecification $spec)
    {
        $appends = [];
        if ($spec->keyword) {
            $appends['keyword'] = $spec->keyword;
        }
        return $appends;
    }


}


