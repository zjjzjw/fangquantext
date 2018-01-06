<?php

namespace App\Web\Http\Controllers\Personal;

use App\Src\Surport\Infra\Repository\CityRepository;
use App\Src\Surport\Infra\Repository\ProvinceRepository;
use App\Web\Http\Controllers\BaseController;
use Illuminate\Http\Request;


class MainController extends BaseController
{

    //个人中心首页
    public function index(Request $request)
    {
        $data = [];

        return $this->view('pages.personal.main.index', $data);
    }

    //完善个人信息
    public function improveInformation(Request $request)
    {
        $data = [];


        return $this->view('pages.personal.main.improve-information', $data);
    }


}