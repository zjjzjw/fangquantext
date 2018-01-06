<?php

namespace App\Large\Http\Controllers\Developer;

use App\Large\Http\Controllers\BaseController;
use App\Large\Src\Forms\Developer\DeveloperSearchForm;
use App\Service\Developer\DeveloperService;
use App\Src\Developer\Domain\Model\DeveloperSpecification;
use Illuminate\Http\Request;

class DeveloperController extends BaseController
{
    public function index(Request $request, DeveloperSearchForm $form)
    {

        $data = [];
        $form->validate($request->all());
        $developer_service = new DeveloperService();
        $data = $developer_service->getDeveloperList($form->developer_specification, 48);
        $data['appends'] = $this->getDeveloperAppends($form->developer_specification);

        return $this->view('pages.developer.developer.index', $data);
    }


    public function getDeveloperAppends(DeveloperSpecification $spec)
    {
        $appends = [];
        if ($spec->keyword) {
            $appends['keyword'] = $spec->keyword;
        }
        return $appends;
    }
}


