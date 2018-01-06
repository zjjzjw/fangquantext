<?php

namespace App\Web\Http\Controllers\Developer;

use App\Src\Developer\Infra\Repository\DeveloperRepository;
use App\Web\Http\Controllers\BaseController;
use App\Web\Service\Developer\CooperationWebService;
use Illuminate\Http\Request;


class CooperationController extends BaseController
{
    //合作开发商名录
    public function cooperation(Request $request)
    {
        $data = [];
        $user_info = $this->getUserInfo();
        $user_category = [24,36,190,32];

        //该分类下的开发商列表
        $cooperation_web_service = new CooperationWebService();
        $data['developer_list'] = $cooperation_web_service->getDevelopersByCategoryIds($user_category);

        //供应商采购关系
        $data['provider_list'] = $cooperation_web_service->getProvidersByCategoryIds($user_category, $data['developer_list']);

        return $this->view('pages.developer.cooperation.cooperation', $data);
    }

    //战略集采一览表
    public function strategyChart(Request $request)
    {
        $data = [];
        return $this->view('pages.developer.cooperation.strategy-chart', $data);
    }


}