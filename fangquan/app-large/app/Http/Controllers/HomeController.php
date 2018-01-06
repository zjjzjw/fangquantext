<?php

namespace App\Large\Http\Controllers;

use App\Service\ContentPublish\ContentService;
use App\Src\Content\Infra\Repository\ContentRepository;
use App\Service\Developer\DeveloperProjectService;
use App\Service\Developer\DeveloperService;
use App\Service\Provider\ProviderService;
use App\Src\Developer\Domain\Model\DeveloperProjectStatus;
use App\Src\Developer\Infra\Repository\DeveloperProjectRepository;
use App\Src\Provider\Infra\Repository\ProviderRepository;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class HomeController extends BaseController
{
    public function index(Request $request, $p)
    {
        $data = [];

        \Cookie::unqueue('place_unique_p');
        $cookie = \Cookie::make('place_unique_p', $p, 6 * 24 * 60);
        \Cookie::queue($cookie);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $content_repository = new ContentRepository();
        //展会介绍的ID为1
        $content_entity = $content_repository->fetch(1);
        $data['introduce'] = $content_entity->toArray();
        //开发商数据
        $developer_ids = [21493, 21517, 21450, 21564, 21556, 21406, 21409, 21519, 21460, 21576];
        $developer_service = new DeveloperService();
        $developers = $developer_service->getDevelopersByIds($developer_ids);
        $data['developers'] = $developers;

        //供应商数据
        $provider_ids = [269, 507, 488, 139, 178, 511, 516, 283, 517, 13];
        $provider_service = new ProviderService();
        $providers = $provider_service->getProvidersByIds($provider_ids);
        $data['providers'] = $providers;

        $content_service = new ContentService();
        $data['banners'] = $content_service->getContentListByType(19, 5);
        $data['browser'] = $browser;
        $data['version'] = $version;
        $data['p'] = $p;

        return $this->view('pages.home.index', $data);
    }

    public function map(Request $request)
    {
        $data = [];
        return $this->view('pages.home.map', $data);

    }

}








