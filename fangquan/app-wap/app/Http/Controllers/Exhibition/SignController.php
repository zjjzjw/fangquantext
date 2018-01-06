<?php

namespace App\Wap\Http\Controllers\Exhibition;

use App\Src\Role\Domain\Model\UserSignEntity;
use App\Src\Role\Infra\Repository\UserSignRepository;
use App\Wap\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SignController extends BaseController
{
    public function index(Request $request)
    {
        $this->title = '电子签到';
        $this->file_css = 'pages.exhibition.sign.sign';
        $this->file_js = 'pages.exhibition.sign.sign';
        $data = [];
        return $this->view('pages.exhibition.sign.sign', $data);
    }


    public function signName()
    {
        $this->title = '电子签到';
        $this->file_css = 'pages.exhibition.sign.sign-name';
        $this->file_js = 'pages.exhibition.sign.sign-name';
        $data = [];
        return $this->view('pages.exhibition.sign.sign-name', $data);
    }

    public function success(Request $request)
    {
        $this->title = '电子签到';
        $this->file_css = 'pages.exhibition.sign.sign-success';
        $this->file_js = 'pages.exhibition.sign.sign-success';
        $data = [];
        $user_sign_repository = new UserSignRepository();
        $id = $request->get('user_id', 0);
        $items = [];
        if ($id) {
            $ids = explode(';', $id);
            $user_sign_entities = $user_sign_repository->getUserSignByIds($ids);
            /** @var UserSignEntity $user_sign_entity */
            foreach ($user_sign_entities as $user_sign_entity) {
                $item = $user_sign_entity->toArray();
                $items[] = $item;
            }
        }
        $data['items'] = $items;
        return $this->view('pages.exhibition.sign.sign-success', $data);
    }


    public function fail(Request $request)
    {
        $this->title = '电子签到';
        $this->file_css = 'pages.exhibition.sign.sign-fail';
        $this->file_js = 'pages.exhibition.sign.sign-fail';
        $data = [];
        return $this->view('pages.exhibition.sign.sign-fail', $data);
    }
}


