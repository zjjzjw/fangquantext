<?php

namespace App\Console\Commands\Category;

use App\Service\Category\CategoryService;
use Illuminate\Console\Command;

class  ExportCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导出品类数据';

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
        $data[] = ['一级', '二级', '三级'];
        $category_service = new CategoryService();
        $rows = $category_service->getExportCategoryData();
        foreach ($rows as $row) {
            $data[] = [$row[1], $row[2], $row[3]];
        }
        \Excel::create('品类数据', function ($excel) use ($data) {
            $excel->sheet('category', function ($sheet) use ($data) {
                $sheet->rows($data);
            });
        })->store('xlsx');
        $this->info('导出结束！');
        exit(0);
    }
}
