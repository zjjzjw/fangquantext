<?php

namespace App\Large\Http\Controllers\Developer;

use App\Service\Developer\DeveloperProjectService;
use App\Large\Http\Controllers\BaseController;
use App\Large\Src\Forms\Developer\DeveloperProject\DeveloperProjectSearchForm;
use App\Service\Project\ProjectCategoryService;
use App\Src\Developer\Domain\Model\DeveloperProjectAdType;
use App\Src\Developer\Domain\Model\DeveloperProjectBiddingType;
use App\Src\Developer\Domain\Model\DeveloperProjectSpecification;
use App\Src\Developer\Domain\Model\DeveloperProjectStatus;
use App\Src\Project\Domain\Model\ProjectCategoryEntity;
use App\Src\Project\Infra\Repository\ProjectCategoryRepository;
use App\Src\Surport\Domain\Model\ProvinceEntity;
use App\Src\Surport\Infra\Repository\ProvinceRepository;
use App\Wap\Service\Surport\ChinaAreaWebService;
use App\Web\Service\Developer\DeveloperProjectWebService;
use Illuminate\Http\Request;

class DeveloperProjectController extends BaseController
{
    public function index(Request $request, DeveloperProjectSearchForm $form)
    {

        $data = [];
        $developer_project_service = new DeveloperProjectService();
        $request->merge(['status' => DeveloperProjectStatus::YES]);
        $request->merge(['is_ad' => DeveloperProjectAdType::NO]);

        $form->validate($request->all());

        //项目列表
        $data = $developer_project_service->getDeveloperProjectList($form->developer_project_specification, 10);

        $data['developer_project_status'] = DeveloperProjectStatus::acceptableEnums();
        $data['developer_project_bidding_types'] = DeveloperProjectBiddingType::acceptableEnums();

        //项目品类树
        $project_category_service = new ProjectCategoryService();
        $data['project_main_category'] = $project_category_service->getAllDeveloperCategoryTreeList();

        //区域树
        $china_area_service = new ChinaAreaWebService();
        $data['china_areas'] = $china_area_service->getChinaAreaWithProvince();
        $appends = $this->getDeveloperProjectListAppends($form->developer_project_specification);

        $data['appends'] = $appends;


        return $this->view('pages.developer.developer-project.index', $data);
    }

    public function detail(Request $request, $id)
    {
        $data = [];
        $developer_project_web_service = new DeveloperProjectWebService();
        $project = $developer_project_web_service->getDeveloperProjectInfo($id);
        $data['project'] = $project;
        return $this->view('pages.developer.developer-project.detail', $data);
    }


    public function getDeveloperProjectListAppends(DeveloperProjectSpecification $spec)
    {
        $appends = [];
        if ($spec->keyword) {
            $appends['keyword'] = $spec->keyword;
        }
        if ($spec->developer_id) {
            $appends['developer_id'] = $spec->developer_id;
        }
        if ($spec->bidding_type) {
            $appends['bidding_type'] = $spec->bidding_type;
        }
        if ($spec->project_category_id) {
            $appends['project_category_id'] = $spec->project_category_id;
            $project_category_repository = new ProjectCategoryRepository();
            /** @var ProjectCategoryEntity $project_category_entity */
            $project_category_entity = $project_category_repository->fetch($spec->project_category_id);
            if ($project_category_entity) {
                $appends['project_category_parent_id'] = $project_category_entity->parent_id;
            }
        }
        if ($spec->status) {
            $appends['status'] = $spec->status;
        }
        //项目阶段
        if ($spec->project_stage_id) {
            $appends['project_stage_id'] = $spec->project_stage_id;
        }
        //项目类别
        if ($spec->project_category) {
            $appends['project_category'] = $spec->project_category;
        }
        //是否优选
        if ($spec->is_great) {
            $appends['is_great'] = $spec->is_great;
        }
        //开发商类型
        if ($spec->developer_type) {
            $appends['developer_type'] = $spec->developer_type;
        }
        //省份
        if ($spec->province_id) {
            $province_repository = new ProvinceRepository();
            $appends['province_id'] = $spec->province_id;

            /** @var ProvinceEntity $province_entity */
            $province_entity = $province_repository->fetch($spec->province_id);
            if (isset($province_entity)) {
                $appends['china_area_id'] = $province_entity->area_id;
                $appends['province_name'] = $province_entity->name;
            }
        }
        if ($spec->product_category_id) {
            $appends['product_category_id'] = $spec->product_category_id;
        }


        return $appends;
    }
}


