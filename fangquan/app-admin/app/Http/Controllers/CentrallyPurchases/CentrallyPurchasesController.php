<?php namespace App\Admin\Http\Controllers\CentrallyPurchases;

use App\Admin\Http\Controllers\BaseController;
use App\Admin\Src\Forms\CentrallyPurchases\CentrallyPurchasesDeleteForm;
use App\Admin\Src\Forms\CentrallyPurchases\CentrallyPurchasesSearchForm;
use App\Service\CentrallyPurchases\CentrallyPurchasesService;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesSpecification;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesStatus;
use App\Service\Surport\ProvinceService;

use Illuminate\Http\Request;

/**
 * 采集信息
 * Class CentrallyPurchasesController
 * @package App\Admin\Http\Controllers\CentrallyPurchases
 */
class CentrallyPurchasesController extends BaseController
{
    public function index(Request $request, CentrallyPurchasesSearchForm $form)
    {
        $data = [];
        $centrally_purchases_service = new CentrallyPurchasesService();
        $form->validate($request->all());
        $data = $centrally_purchases_service->getCentrallyPurchasesList($form->centrally_purchases_specification, 20);
        $appends = $this->getAppends($form->centrally_purchases_specification);
        $data['appends'] = $appends;
        $data['centrally_purchases_status'] = CentrallyPurchasesStatus::acceptableEnums();
        $view = $this->view('pages.centrally-purchases.centrally-purchases.index', $data);
        return $view;
    }

    public function edit(Request $request, $id)
    {

        $data = [];

        if (!empty($id)) {
            $centrally_purchases_service = new CentrallyPurchasesService();
            $data = $centrally_purchases_service->getCentrallyPurchasesInfo($id);
        }

        $province_service = new ProvinceService();
        $areas = $province_service->getProvinceForSearch();
        $user = request()->user();
        $user_info = $user->toArray();
        $data['user_info'] = $user_info;
        $data['areas'] = $areas;
        $data['centrally_purchases_status'] = CentrallyPurchasesStatus::acceptableEnums();
        $view = $this->view('pages.centrally-purchases.centrally-purchases.edit', $data);
        return $view;
    }

    public function getAppends(CentrallyPurchasesSpecification $spec)
    {
        $appends = [];
        if ($spec->keyword) {
            $appends['keyword'] = $spec->keyword;
        }
        if ($spec->status) {
            $appends['status'] = $spec->status;
        }
        return $appends;
    }
}
