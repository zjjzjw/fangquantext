<?php

namespace App\Large\Http\Controllers;

class BaseController extends Controller
{
    protected function view($view, $data = array())
    {
        $data = array_merge(
            [
                'basic_data' => [
                    'user' => request()->user(),
                ],
            ],
            $data
        );
        if (empty($data['p'])) {
            $p = request()->cookie('place_unique_p');
            $data['p'] = $p;
        }
        return view($view, $data);
    }
}


