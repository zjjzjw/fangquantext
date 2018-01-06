<?php

namespace App\Wap\Http\Controllers\Exhibition;

use App\Service\Developer\ProjectCategoryService;
use App\Service\Developer\DeveloperProjectService;
use App\Src\Developer\Domain\Model\DeveloperProjectBiddingType;
use App\Src\Project\Domain\Model\ProjectCategoryStatus;
use App\Wap\Service\Surport\ChinaAreaWebService;
use App\Web\Service\Developer\DeveloperProjectWebService;
use App\Wap\Src\Forms\Developer\DeveloperProject\DeveloperProjectSearchForm;
use App\Src\Developer\Domain\Model\DeveloperProjectSpecification;
use App\Src\Developer\Domain\Model\DeveloperProjectStatus;
use App\Wap\Http\Controllers\BaseController;
use App\Src\Surport\Domain\Model\ProvinceEntity;
use App\Src\Surport\Infra\Repository\ProvinceRepository;
use App\Src\Developer\Domain\Model\DeveloperProjectAdType;
use App\Src\Project\Infra\Repository\ProjectCategoryRepository;
use Illuminate\Http\Request;


class DeveloperProjectController extends BaseController
{

    public function list(Request $request, DeveloperProjectSearchForm $form)
    {

        $this->title = '开发商项目列表';
        $this->file_css = 'pages.exhibition.developer-project.list';
        $this->file_js = 'pages.exhibition.developer-project.list';
        $data = [];

        $developer_project_service = new DeveloperProjectService();
        $request->merge(['status' => DeveloperProjectStatus::YES]);
        $request->merge(['is_ad' => DeveloperProjectAdType::NO]);
        $form->validate($request->all());

        //项目列表
        $data = $developer_project_service->getDeveloperProjectList($form->developer_project_specification, 6);

        // 所在区域
        $china_area_wap_service = new ChinaAreaWebService();
        $data["area"] = $china_area_wap_service->getChinaAreaWithProvince();
        $data['bidding_types'] = DeveloperProjectBiddingType::acceptableEnums();

        $project_category_service = new ProjectCategoryService();
        $data['project_categorys'] = $project_category_service->getProjectCategoryMainList(ProjectCategoryStatus::STATUS_ONLINE);

        $appends = $this->getDeveloperProjectListAppends($form->developer_project_specification);
        $per_page = $request->get('per_page', 6);
        $appends['per_page'] = $per_page;
        $appends['page'] = $data['page']['current_page'] ?? 1;

        $data['appends'] = $appends;

        $data['developer_project_status'] = DeveloperProjectStatus::acceptableEnums();
        $data['developer_project_bidding_type'] = DeveloperProjectBiddingType::acceptableEnums();
        return $this->view('pages.exhibition.developer-project.list', $data);
    }

    public function detail(Request $request, $id)
    {
        $this->title = '开发商详情';
        $this->file_css = 'pages.exhibition.developer-project.detail';
        $this->file_js = 'pages.exhibition.developer-project.detail';
        $data = [];

        $developer_project_web_service = new DeveloperProjectWebService();
        $project = $developer_project_web_service->getDeveloperProjectInfo($id);

        $data['project'] = $project;
        return $this->view('pages.exhibition.developer-project.detail', $data);
    }


    public function getDeveloperProjectListAppends(DeveloperProjectSpecification $spec)
    {
        $appends = [];
        if ($spec->keyword) {
            $appends['keyword'] = $spec->keyword;
        }
        if ($spec->bidding_type) {
            $appends['bidding_type'] = $spec->bidding_type;
        }
        if ($spec->project_category_id) {
            $appends['project_category_id'] = $spec->project_category_id;
        }
        if ($spec->status) {
            $appends['status'] = $spec->status;
        }
        //项目阶段
        if ($spec->project_stage_id) {
            $appends['project_stage_id'] = $spec->project_stage_id;
        }
        if ($spec->project_first_category_id) {
            $appends['project_first_category_id'] = $spec->project_first_category_id;
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
        if ($spec->developer_id) {
            $appends['developer_id'] = $spec->developer_id;
        }


        return $appends;
    }


}


