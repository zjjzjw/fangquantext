<?php

namespace App\Web\Http\Controllers\Information;

use App\Admin\Src\Forms\Information\InformationSearchForm;
use App\Service\ContentPublish\ContentService;
use App\Service\Information\InformationService;
use App\Src\Content\Domain\Model\ContentSpecification;
use App\Src\Information\Domain\Model\InformationStatus;
use App\Web\Service\Information\InformationWebService;
use App\Web\Src\Forms\Content\ContentSearchForm;
use App\Web\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class InformationController extends BaseController
{
    public function list(Request $request, ContentSearchForm $form)
    {
        $data = [];
        $content_service = new ContentService();
        $limit = $request->get('limit');
        $limit = ($limit == 'all') ? 0 : 15;
        $data = $content_service->getContentListByType(10, $limit);
        return $this->view('pages.information.list', $data);
    }

    public function detail(Request $request, $id)
    {
        $data = [];
        if (!empty($id)) {
            $content_service = new ContentService();
            $data = $content_service->getContentInfo($id);
        }
        return $this->view('pages.information.detail', $data);
    }

    public function particulars(Request $request, $id)
    {
        $data = [];
        if (!empty($id)) {
            $information_service = new InformationService();
            $data = $information_service->getInformationInfo($id);
        }
        return $this->view('pages.information.particulars', $data);
    }


    public function index(Request $request, InformationSearchForm $form)
    {
        $data = [];
        $form->validate($request->all());
        $information_web_service = new InformationWebService();
        $data = $information_web_service->getInformationList($form->information_specification, 20);
        return $this->view('pages.information.index', $data);
    }


    public function inforDetail(Request $request, $id)
    {
        $data = [];
        return $this->view('pages.information.infor-detail', $data);
    }

}