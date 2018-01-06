<?php namespace App\Admin\Http\Controllers\Developer;

use App\Admin\Http\Controllers\BaseController;
use App\Admin\Src\Forms\Developer\DeveloperPartnership\DeveloperPartnershipSearchForm;
use App\Service\Developer\DeveloperPartnershipService;
use App\Src\Developer\Domain\Model\DeveloperPartnershipSpecification;
use Illuminate\Http\Request;
use App\Service\Category\CategoryService;

/**
 * 开发商合作关系
 * Class DeveloperPartnershipController
 * @package App\Admin\Http\Controllers\DeveloperPartnership
 */
class DeveloperPartnershipController extends BaseController
{
    public function index(Request $request, DeveloperPartnershipSearchForm $form)
    {
        $data = [];
        $developer_partnership_service = new DeveloperPartnershipService();
        $form->validate($request->all());

        $data = $developer_partnership_service->getDeveloperPartnershipList($form->developer_partnership_specification, 20);
        $appends = $this->getAppends($form->developer_partnership_specification);
        $data['appends'] = $appends;
        $view = $this->view('pages.developer.developer-partnership.index', $data);
        return $view;
    }

    public function edit(Request $request, $id)
    {


        $data = [];
        if (!empty($id)) {
            $developer_partnership_service = new DeveloperPartnershipService();
            $data = $developer_partnership_service->getDeveloperPartnershipInfo($id);
        }

        //获取产品主营分类
        $category_service = new CategoryService();
        $main_category = $category_service->getCategoryLists();
        $data['main_category'] = $main_category;
        $view = $this->view('pages.developer.developer-partnership.edit', $data);
        return $view;
    }

    public function getAppends(DeveloperPartnershipSpecification $spec)
    {
        $appends = [];
        if ($spec->developer_id) {
            $appends['developer_id'] = $spec->developer_id;
        }
        if ($spec->provider_id) {
            $appends['provider_id'] = $spec->provider_id;
        }
        return $appends;
    }
}
