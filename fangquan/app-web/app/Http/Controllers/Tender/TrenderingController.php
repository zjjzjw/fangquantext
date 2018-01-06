<?php

namespace App\Web\Http\Controllers\Tender;

use App\Web\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class TrenderingController extends BaseController
{
    public function index(Request $request)
    {
        $data = [];
        return $this->view('pages.tender.trendering.index', $data);
    }

}