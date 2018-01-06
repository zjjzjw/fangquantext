<?php

namespace App\Console\Commands\Exhibition;

use App\Src\Role\Domain\Model\UserSignCrowdType;
use App\Src\Role\Infra\Eloquent\UserSignModel;
use Illuminate\Console\Command;

class  ExportUserSign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:user:sign';

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
        $data[] = ['序号', '公司', '职位', '姓名', '电话', '类型'];

        $builder = UserSignModel::query();

        $types = UserSignCrowdType::acceptableEnums();

        $models = $builder->get();
        foreach ($models as $model) {
            $id = $model->id;
            $name = $model->name;
            $phone = $model->phone;
            $type = $types[$model->crowd] ?? '';
            $company_name = $model->company_name;
            $position = $model->position;
            $data[] = [$id, $company_name, $position, $name, $phone, $type];
        }

        \Excel::create('签到数据', function ($excel) use ($data) {
            $excel->sheet('score', function ($sheet) use ($data) {
                $sheet->rows($data);
            });
        })->store('xlsx');

        $this->info('导出结束！');

    }
}
