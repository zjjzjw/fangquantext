<?php

namespace App\Web\Http\Controllers\Developer;

use App\Service\ContentPublish\ContentService;
use App\Service\Developer\DeveloperService;
use App\Service\Information\InformationService;
use App\Service\Provider\ProviderService;
use App\Web\Http\Controllers\BaseController;
use Illuminate\Http\Request;


class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $data = [];

        //开发商数据 知名客户
        $developer_ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
            16, 17, 18, 19, 20];

        $developer_service = new DeveloperService();
        $developers = $developer_service->getDevelopersByIds($developer_ids);
        $data['developers'] = $developers;

        $count = $developer_service->getDeveloperCount();
        $counts = str_split($count);
        $data['counts'] = $counts;

        //供应商数据 合作伙伴
        $provider_ids = [269, 139, 488, 80, 489, 490, 457, 341, 402, 253];
        $provider_service = new ProviderService();
        $providers = $provider_service->getProvidersByIds($provider_ids);
        $data['providers'] = $providers;

        //文章内容
        $information_service = new InformationService();
        $informations = $information_service->getTopInformationByLimit(12);
        $data['informations'] = $informations;

        $content_service = new ContentService();
        $data['banners'] = $content_service->getContentListByType(19, 5);

        return $this->view('pages.developer.home.index', $data);
    }

}