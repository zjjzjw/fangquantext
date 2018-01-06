<?php

namespace App\Web\Http\Controllers\Developer;

use App\Service\CentrallyPurchases\CentrallyPurchasesService;
use App\Service\Developer\DeveloperProjectService;
use App\Service\Developer\DeveloperService;
use App\Service\Regional\ProvinceService;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesSpecification;
use App\Src\Developer\Domain\Model\DeveloperProjectSpecification;
use App\Src\Developer\Domain\Model\DeveloperSpecification;
use App\Src\Developer\Domain\Model\DeveloperStatus;
use App\Web\Http\Controllers\BaseController;
use App\Web\Src\Forms\Developer\CentrallyPurchases\CentrallyPurchasesSearchForm;
use App\Web\Src\Forms\Developer\DeveloperProject\DeveloperProjectSearchForm;
use App\Web\Src\Forms\Developer\DeveloperSearchForm;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class CentrallyPurchaseController extends BaseController
{
    /**
     * 战略招采节点列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, CentrallyPurchasesSearchForm $form)
    {
        $data = [];
        $form->validate($request->all());
        $centrally_purchase_service = new  CentrallyPurchasesService();
        $data = $centrally_purchase_service->getCentrallyPurchasesList($form->centrally_purchases_specification, 20);
        $appends = $this->getAppends($form->centrally_purchases_specification);
        $data['appends'] = $appends;

        return $this->view('pages.developer.centrally-purchase.index', $data);
    }

    /**
     * 战略招采节点详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $id)
    {
        $data = [];
        $centrally_purchase_service = new  CentrallyPurchasesService();
        $data = $centrally_purchase_service->getCentrallyPurchasesInfo($id);
        return $this->view('pages.developer.centrally-purchase.detail', $data);
    }

    /**
     * 战略集采专区开发商列表
     * @param Request $request
     */
    public function developer(Request $request, DeveloperSearchForm $form)
    {
        $data = [];
        $form->validate($request->all());
        $developer_service = new DeveloperService();
        $data = $developer_service->getDeveloperList($form->developer_specification, 20);
        $cities = [
            ['id' => 1, 'name' => '北京'],
            ['id' => 38, 'name' => '广州'],
            ['id' => 40, 'name' => '深圳'],
            ['id' => 63, 'name' => '上海'],
        ];
        $data['cities'] = $cities;
        $appends = $this->getDeveloperAppends($form->developer_specification);
        $data['appends'] = $appends;
        return $this->view('pages.developer.centrally-purchase.developer', $data);
    }

    /**
     * 战略集采专区项目列表
     * @param Request $request
     */
    public function developerProject(Request $request, DeveloperProjectSearchForm $form, $id)
    {
        $data = [];
        $request->merge(['developer_id' => $id]);
        $request->merge(['status' => DeveloperStatus::YES]);

        $form->validate($request->all());

        $developer_project_service = new DeveloperProjectService();
        $data = $developer_project_service->getDeveloperProjectList($form->developer_project_specification, 10);

        $province_service = new ProvinceService();
        $provinces = $province_service->getAllProvince();
        $data['provinces'] = $provinces;
        $appends = $this->getDeveloperProjectAppends($form->developer_project_specification);

        $data['appends'] = $appends;

        $data['id'] = $id;
        $data['developer_id'] = $id;


        return $this->view('pages.developer.centrally-purchase.developer-project', $data);
    }


    public function projectDetail(Request $request, $id)
    {
        $data = [];
        $developer_project_service = new DeveloperProjectService();
        $data = $developer_project_service->getDeveloperProjectInfo($id);

        return $this->view('pages.developer.centrally-purchase.project-detail', $data);
    }


    /**
     * 战略集采专区分级原则
     * @param Request $request
     */
    public function grade(Request $request, $id)
    {
        $data = [];
        $developer_service = new DeveloperService();
        $data = $developer_service->getDeveloperInfo($id);

        $data['id'] = $id;
        $data['developer_id'] = $id;
        return $this->view('pages.developer.centrally-purchase.grade', $data);
    }


    public function export(Request $request)
    {
        $data[] = ['公司', '招标内容', '招标期限', '地点', '联系人', '联系人职位', '联系人电话'];
        $ids = $request->get('ids');
        if (!empty($ids)) {
            $ids = explode(',', $ids);
            $centrally_purchases_service = new CentrallyPurchasesService();
            $items = $centrally_purchases_service->getCentrallyPurchasesByIds($ids);
            foreach ($items as $item) {
                $data[] = [
                    $item['developer_info']['name'],
                    $item['content'],
                    $item['bidding_node'],
                    $item['city_name'] ?? '',
                    $item['contact'],
                    $item['contacts_position'],
                    $item['contacts_phone'],
                ];
            }
        }
        Excel::create('集采信息', function ($excel) use ($data) {
            $excel->sheet('集采信息', function ($sheet) use ($data) {
                $sheet->rows($data);
            });
        })->download('xlsx');

    }


    public function getAppends(CentrallyPurchasesSpecification $spec)
    {
        $appends = [];
        if ($spec->keyword) {
            $appends['keyword'] = $spec->keyword;
        }
        return $appends;
    }


    public function getDeveloperAppends(DeveloperSpecification $spec)
    {
        $appends = [];
        if ($spec->keyword) {
            $appends['keyword'] = $spec->keyword;
        }

        if ($spec->province_id) {
            $appends['province_id'] = $spec->province_id;
        }
        if ($spec->city_id) {
            $appends['city_id'] = $spec->city_id;
        }

        return $appends;
    }


    public function getDeveloperProjectAppends(DeveloperProjectSpecification $spec)
    {
        $appends = [];
        if ($spec->keyword) {
            $appends['keyword'] = $spec->keyword;
        }
        if ($spec->developer_id) {
            $appends['developer_id'] = $spec->developer_id;
        }
        if ($spec->province_id) {
            $appends['province_id'] = $spec->province_id;
        }
        if ($spec->column) {
            $appends['column'] = $spec->column;
        }
        if ($spec->sort) {
            $appends['sort'] = $spec->sort;
        }
        return $appends;

    }


}