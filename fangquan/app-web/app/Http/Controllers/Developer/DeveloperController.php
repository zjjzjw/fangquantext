<?php

namespace App\Web\Http\Controllers\Developer;

use App\Web\Http\Controllers\BaseController;
use App\Web\Service\Developer\DeveloperWebService;
use App\Web\Src\Forms\Developer\DeveloperSearchForm;
use Illuminate\Http\Request;
use App\Service\Advertisement\AdvertisementService;
use App\Service\Developer\DeveloperProjectContactService;
use App\Src\Advertisement\Domain\Model\AdvertisementType;
use App\Src\Developer\Domain\Model\DeveloperProjectAdType;
use App\Src\Surport\Domain\Model\ProvinceEntity;
use App\Src\Surport\Infra\Repository\ProvinceRepository;
use App\Web\Src\Forms\Developer\DeveloperProject\DeveloperProjectSearchForm;
use App\Service\Developer\DeveloperProjectService;
use App\Src\Developer\Domain\Model\DeveloperProjectSpecification;
use App\Web\Service\Developer\DeveloperProjectStageWebService;
use App\Src\Developer\Domain\Model\DeveloperProjectStatus;
use App\Web\Service\Developer\DeveloperProjectWebService;
use App\Web\Service\Developer\ProductCategoryWebService;
use App\Src\Developer\Domain\Model\DeveloperType;
use App\Web\Service\Surport\ChinaAreaWebService;
use Maatwebsite\Excel\Facades\Excel;



class DeveloperController extends BaseController
{
    public function index(Request $request, DeveloperSearchForm $form)
    {
        $data = [];
        $form->validate($request->all());

        $developer_web_service = new DeveloperWebService();
        $developers = $developer_web_service->getAllDeveloperList();
        $developers = $developer_web_service->formatDevelopersForWeb($developers);
        $data['developers'] = $developers;
        return $this->view('pages.developer.list', $data);
    }


    public function projectList(Request $request, DeveloperProjectSearchForm $form)
    {
        $data = [];
        $request->merge(['status' => DeveloperProjectStatus::YES]);
        $request->merge(['is_ad' => DeveloperProjectAdType::NO]);
        $form->validate($request->all());
        $developer_project_web_service = new DeveloperProjectWebService();
        $data = $developer_project_web_service->getDeveloperProjectList($form->developer_project_specification, 20);
        $data['appends'] = $this->getProjectListAppends($form->developer_project_specification);
        return $this->view('pages.developer.project-list', $data);
    }


    public function projectListExport(Request $request)
    {

        $data[] = ['项目名称', '开发商', '是否精装', '开盘时间','项目地址','地点','联系人','联系人电话','联系人地址','项目简介','发布时间'];
        $ids = $request->get('ids');
        if (!empty($ids)) {
            $ids = explode(',', $ids);
            $developer_project_web_service = new DeveloperProjectWebService();
            $items = $developer_project_web_service->getDeveloperProjectByIds($ids);
            foreach ($items as $item) {
                $data[] = [
                    $item['name'],
                    $item['developer_info']['name'],
                    $item['has_decorate_name'],
                    $item['opening_time'],
                    $item['address'],
                    $item['city_name'],
                    $item['contacts'],
                    $item['contacts_phone'],
                    $item['contacts_address'],
                    $item['summary'],
                    $item['time'],
                ];
            }
        }
        Excel::create('非战略集采项目信息', function ($excel) use ($data) {
            $excel->sheet('非战略集采项目信息', function ($sheet) use ($data) {
                $sheet->rows($data);
            });
        })->download('xlsx');

    }

    public function projectDetail(Request $request, DeveloperSearchForm $form, $developer_project_id)
    {
        $data = [];

        $developer_project_web_service = new DeveloperProjectWebService();
        $data = $developer_project_web_service->getDeveloperProjectInfo($developer_project_id);

        if ($request->user()) {
            $developer_project_web_service->setProjectBrowseRecord($request->user()->id, $developer_project_id);
        }
        return $this->view('pages.developer.project-detail', $data);
    }

    public function getProjectListAppends(DeveloperProjectSpecification $spec)
    {
        $appends = [];
        $appends['product_category_id'] = $spec->product_category_id ? (string)$spec->product_category_id : 0;
        $appends['province_id'] = $spec->province_id ? (string)$spec->province_id : 0;
        $appends['project_stage_id'] = $spec->project_stage_id ? (string)$spec->project_stage_id : 0;

        if ($spec->province_id) {
            $province_repository = new ProvinceRepository();
            /** @var ProvinceEntity $province_entity */
            $province_entity = $province_repository->fetch($spec->province_id);
            if (isset($province_entity)) {
                $appends['china_area_id'] = $province_entity->area_id;
                $appends['province_name'] = $province_entity->name;
            }
        }

        if ($spec->column) {
            $appends['column'] = $spec->column;
        } else {
            $appends['column'] = 'updated_at';
        }

        if ($spec->sort) {
            $appends['sort'] = $spec->sort;
        } else {
            $appends['sort'] = 'desc';
        }

        if ($spec->keyword) {
            $appends['keyword'] = (string)$spec->keyword;
        }

        if ($spec->developer_id) {
            $appends['developer_id'] = $spec->developer_id;
        }

        return $appends;
    }

}