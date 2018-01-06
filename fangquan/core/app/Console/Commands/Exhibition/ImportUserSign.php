<?php

namespace App\Console\Commands\Exhibition;

use App\Src\Role\Domain\Model\UserSignEntity;
use App\Src\Role\Infra\Eloquent\UserSignModel;
use Illuminate\Console\Command;

class ImportUserSign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:user:sign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

//        //供应商
//        \Excel::load(storage_path() . '/import/12-05-provider.xlsx', function ($reader) {
//            $reader = $reader->getSheet(0);//excel第一张sheet
//            $results = $reader->toArray();
//            unset($results[0]);//去除表头
//            $search = array(' ', '-');
//            $replace = array('', '');
//            foreach ($results as $result) {
//                if (!empty($result) && !empty($result[0])) {
//                    $user_sign_model = new UserSignModel();
//                    $user_sign_model->name = str_replace($search, $replace, ($result[1] ?? ''));
//                    $user_sign_model->phone = str_replace($search, $replace, ($result[2] ?? ''));
//                    $user_sign_model->crowd = $result[3];
//                    $user_sign_model->company_name = $result[4];
//                    $user_sign_model->position = $result[5] ?? '';
//                    $user_sign_model->is_sign = 2;
//                    $user_sign_model->save();
//
//                    dump($result);
//                }
//            }
//        });
//
//        //开发商
//        \Excel::load(storage_path() . '/import/12-04-developer.xlsx', function ($reader) {
//            $reader = $reader->getSheet(0);//excel第一张sheet
//            $results = $reader->toArray();
//            unset($results[0]);//去除表头
//            unset($results[1]);//去除表头
//            $search = array(' ', '-');
//            $replace = array('', '');
//
//            foreach ($results as $result) {
//                if (!empty($result) && !empty($result[0])) {
//                    $user_sign_model = new UserSignModel();
//                    $user_sign_model->name = str_replace($search, $replace, ($result[4] ?? ''));
//                    $user_sign_model->phone = str_replace($search, $replace, ($result[6] ?? ''));
//                    $user_sign_model->crowd = 2;
//                    $user_sign_model->company_name = $result[1] ?? '';
//                    $user_sign_model->position = $result[5] ?? '';
//                    $user_sign_model->is_sign = 2;
//                    $user_sign_model->save();
//                    dump($result);
//                }
//            }
//        });
//
//        //方太
//        \Excel::load(storage_path() . '/import/fangtai.xlsx', function ($reader) {
//            $reader = $reader->getSheet(0);//excel第一张sheet
//            $results = $reader->toArray();
//            unset($results[0]);//去除表头
//            unset($results[1]);//去除表头
//            $search = array(' ', '-');
//            $replace = array('', '');
//
//            foreach ($results as $result) {
//                if (!empty($result) && !empty($result[0])) {
//                    $user_sign_model = new UserSignModel();
//                    $user_sign_model->name = str_replace($search, $replace, ($result[1] ?? ''));
//                    $user_sign_model->phone = str_replace($search, $replace, ($result[4] ?? ''));
//                    $user_sign_model->crowd = $result[2];
//                    $user_sign_model->company_name = $result[3] ?? '';
//                    $user_sign_model->position = '';
//                    $user_sign_model->is_sign = 2;
//                    $user_sign_model->save();
//                    dump($result);
//                }
//            }
//        });
//
//        //媒体
//        \Excel::load(storage_path() . '/import/media.xlsx', function ($reader) {
//            $reader = $reader->getSheet(0);//excel第一张sheet
//            $results = $reader->toArray();
//            unset($results[0]);//去除表头
//            $search = array(' ', '-');
//            $replace = array('', '');
//
//            foreach ($results as $result) {
//                if (!empty($result) && !empty($result[0])) {
//                    $user_sign_model = new UserSignModel();
//                    $user_sign_model->name = str_replace($search, $replace, ($result[1] ?? ''));
//                    $user_sign_model->phone = str_replace($search, $replace, ($result[3] ?? ''));
//                    $user_sign_model->crowd = 5;
//                    $user_sign_model->company_name = $result[0] ?? '';
//                    $user_sign_model->position = $result[2] ?? '';
//                    $user_sign_model->is_sign = 2;
//                    $user_sign_model->save();
//                    dump($result);
//                }
//            }
//        });


        //未付款数据
//        \Excel::load(storage_path() . '/import/no-pay.xlsx', function ($reader) {
//            $reader = $reader->getSheet(0);//excel第一张sheet
//            $results = $reader->toArray();
//            unset($results[0]);//去除表头
//            $search = array(' ', '-');
//            $replace = array('', '');
//
//            foreach ($results as $result) {
//                if (!empty($result) && !empty($result[0])) {
//                    $user_sign_model = new UserSignModel();
//                    $user_sign_model->name = str_replace($search, $replace, ($result[1] ?? ''));
//                    $user_sign_model->phone = str_replace($search, $replace, ($result[2] ?? ''));
//                    $user_sign_model->crowd = $result[3];
//                    $user_sign_model->company_name = $result[4] ?? '';
//                    $user_sign_model->position = $result[5] ?? '';
//                    $user_sign_model->is_sign = 2;
//                    $user_sign_model->save();
//                    dump($result);
//                }
//            }
//        });


        //未付款数据
        \Excel::load(storage_path() . '/import/mianfei.xlsx', function ($reader) {
            $reader = $reader->getSheet(0);//excel第一张sheet
            $results = $reader->toArray();
            unset($results[0]);//去除表头
            $search = array(' ', '-');
            $replace = array('', '');

            foreach ($results as $result) {
                if (!empty($result) && !empty($result[0])) {
                    $user_sign_model = new UserSignModel();
                    $user_sign_model->name = str_replace($search, $replace, ($result[2] ?? ''));
                    $user_sign_model->phone = '';
                    $user_sign_model->crowd = 4;
                    $user_sign_model->company_name = $result[1] ?? '';
                    $user_sign_model->position = '';
                    $user_sign_model->is_sign = 2;
                    $user_sign_model->save();
                    dump($result);
                }
            }
        });


    }
}
