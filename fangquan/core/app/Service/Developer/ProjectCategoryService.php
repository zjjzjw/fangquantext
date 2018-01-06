<?php

namespace App\Service\Developer;


use App\Src\Project\Infra\Repository\ProjectCategoryRepository;


class ProjectCategoryService
{


    /**
     * 获取供应商主营分类
     * @param $status
     * @return array
     */
    public function getProjectCategoryMainList($status)
    {
        $data = [];
        $project_category_repository = new ProjectCategoryRepository();
        $paginate = $project_category_repository->allProjectCategory($status);
        $items = collect($paginate);
        $rows = $items->where('parent_id', 0);
        foreach ($rows as $key => $row) {
            $row = (array)$row;
            $data[$row['id']] = $row['name'];
        }
        return $data;
    }

}

