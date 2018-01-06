<?php

namespace App\Wap\Http\Controllers\Exhibition;

use App\Wap\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class BroadcastController extends BaseController
{
    public function detail(Request $request)
    {
        $data = [];
        $this->title = '展会直播';
        $this->file_css = 'pages.exhibition.broadcast.detail';
        $this->file_js = 'pages.exhibition.broadcast.detail';
        return $this->view('pages.exhibition.broadcast.detail', $data);
    }

}