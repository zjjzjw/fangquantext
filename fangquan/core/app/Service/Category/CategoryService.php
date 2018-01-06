<?php

namespace App\Service\Category;


use App\Src\Category\Domain\Model\CategoryStatus;
use App\Src\Category\Infra\Repository\AttributeRepository;
use App\Src\Category\Infra\Repository\CategoryRepository;
use App\Src\Category\Domain\Model\CategoryEntity;
use App\Src\Category\Domain\Model\CategorySpecification;
use App\Src\Provider\Infra\Eloquent\ProviderModel;
use App\Src\Surport\Domain\Model\ResourceEntity;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Src\Surport\Infra\Repository\ResourceRepository;

class CategoryService
{
    /**
     * @param CategorySpecification $spec
     * @param int                   $per_page
     * @return array
     */
    public function getCategoryList(CategorySpecification $spec, $per_page)
    {
        $data = [];
        $category_repository = new CategoryRepository();
        $paginate = $category_repository->search($spec, $per_page);
        $resource_repository = new ResourceRepository();
        $category_status = CategoryStatus::acceptableEnums();
        $items = [];
        /**
         * @var int                  $key
         * @var CategoryEntity       $category_entity
         * @var LengthAwarePaginator $paginate
         */
        foreach ($paginate as $key => $category_entity) {
            $item = $category_entity->toArray();
            $item['status_name'] = $category_status[$item['status']];
            /** @var ResourceEntity $resource_entity */
            $resource_entity = $resource_repository->fetch($item['image_id']);
            if (isset($resource_entity)) {
                $item['image_url'] = $resource_entity->url;
            }
            $items[] = $item;
        }
        $data['paginate'] = $paginate;
        $data['items'] = $items;
        $data['pager']['total'] = $paginate->total();
        $data['pager']['last_page'] = $paginate->lastPage();
        $data['pager']['current_page'] = $paginate->currentPage();

        return $data;
    }

    /**
     * @param $id
     * @return array
     */
    public function getCategoryInfo($id)
    {
        $data = [];
        $category_repository = new CategoryRepository();
        $resource_repository = new ResourceRepository();
        /** @var CategoryEntity $category_entity */
        $category_entity = $category_repository->fetch($id);
        if (isset($category_entity)) {
            $data = $category_entity->toArray();
            //得到缩略图
            /** @var ResourceEntity $resource_entity */
            $resource_entity = $resource_repository->fetch($category_entity->image_id);
            if (isset($resource_entity)) {
                $data['thumbnail_url'] = $resource_entity->url;
                $thumbnail_images = [];
                $thumbnail_image = [];
                $thumbnail_image['image_id'] = $category_entity->image_id;
                $thumbnail_image['url'] = $resource_entity->url;
                $thumbnail_images[] = $thumbnail_image;
                $data['thumbnail_images'] = $thumbnail_images;
                $data['image_url'] = $resource_entity->url;
            }
        }
        return $data;
    }

    public function getCategoryAndAttributeInfo($id)
    {
        $data = [];
        $items = [];
        $category_repository = new CategoryRepository();
        $category_entity = $category_repository->fetch($id);
        if (isset($category_entity)) {
            $data = $category_entity->toArray();
            if ($data['category_attributes']) {
                $attribute_repository = new AttributeRepository();
                foreach ($data['category_attributes'] as $key => $name) {
                    $attribute_entity = $attribute_repository->fetch($key);
                    $item = $attribute_entity->toArray();
                    $items[] = $item;
                }
            }
        }
        $data['category_attributes'] = $items;
        return $data;
    }

    /**
     * 得到所有的分类
     * @return array
     */
    public function getAllCategories()
    {
        $data = [];
        $category_repository = new CategoryRepository();
        $resource_repository = new ResourceRepository();
        $category_entities = $category_repository->all();
        foreach ($category_entities as $category_entity) {
            $item = $category_entity->toArray();
            $resource_entity = $resource_repository->fetch($category_entity->image_id);
            $item['logo_url'] = $resource_entity->url ?? '/www/images/provider/default_logo.png';
            $data[$item['id']] = $item;
        }
        $category_tree = $this->getTree($data);

        return $category_tree;
    }


    public function getCategoryLists($is_top = true)
    {
        $data = [];
        $category_repository = new CategoryRepository();
        $resource_repository = new ResourceRepository();
        $category_entities = $category_repository->getCategoryListByLevel([2, 3]);
        foreach ($category_entities as $category_entity) {
            $item = $category_entity->toArray();
            $resource_entity = $resource_repository->fetch($category_entity->image_id);
            $item['logo_url'] = $resource_entity->url ?? '/www/images/provider/default_logo.png';
            $data[$item['id']] = $item;
        }
        $category_tree = $this->getTree($data);
        if ($is_top) {
            foreach ($category_tree as $key => $value) {
                if (empty($value['nodes'])) {
                    $category_tree[$key]['nodes'][] = $value;
                    $category_tree[$key]['node_ids'][] = $value['id'];
                }
            }
        }
        return $category_tree;
    }

    /**
     * 通过父类ID得到子级品类
     * @param int $parent_id
     * @return array
     */
    public function getCategoriesByParentId($parent_id)
    {
        $data = [];
        $category_repository = new CategoryRepository();
        $category_entities = $category_repository->getLevelCategorys($parent_id);
        $resource_repository = new ResourceRepository();
        /** @var CategoryEntity $category_entity */
        foreach ($category_entities as $category_entity) {
            $item = $category_entity->toArray();
            //得到图片
            /** @var ResourceEntity $resource_entity */
            $resource_entity = $resource_repository->fetch($category_entity->image_id);
            $item['logo_url'] = $resource_entity->url ?? '/www/images/provider/default_logo.png';
            $data[$item['id']] = $item;
        }
        return $data;
    }


    /**
     *
     * @param array $ids
     */
    public function getCategoriesByIds($ids)
    {
        $items = [];
        $category_repository = new CategoryRepository();
        $category_entities = $category_repository->getProductCategoryByIds($ids);
        /** @var CategoryEntity $category_entity */
        foreach ($category_entities as $category_entity) {
            $items[] = $category_entity->toArray();
        }
        return $items;
    }


    protected function getTree($items)
    {
        $tree = array();
        foreach ($items as $key => $item) {
            if (!empty($items[$item['parent_id']])) {
                $items[$item['parent_id']]['nodes'][] = &$items[$item['id']];
                $items[$item['parent_id']]['node_ids'][] = &$items[$item['id']]['id'];
            } else {
                $tree[] = &$items[$item['id']];
            }
        }
        return $tree;
    }

    /**
     * 供应商ID
     * @param int $provider_id
     */
    public function getCategoriesByProviderId($provider_id)
    {
        $items = [];
        /** @var ProviderModel $provider_model */
        $provider_model = ProviderModel::find($provider_id);
        if (isset($provider_model)) {
            $category_repository = new CategoryRepository();
            foreach ($provider_model->provider_main_categories as $value) {
                /** @var CategoryEntity $category_entity */
                $category_entity = $category_repository->fetch($value->product_category_id);
                if (isset($category_entity)) {
                    $item = $category_entity->toArray();
                    $items[] = $item;
                }
            }
        }
        return $items;
    }


    public function getCategoryListByLevel($id)
    {
        $data = [];
        $category_repository = new CategoryRepository();
        $category_entities = $category_repository->getCategoryListByLevel([1, 2]);
        /** @var CategoryEntity $category_entity */
        foreach ($category_entities as $category_entity) {
            //$item[] = $category_entity->toArray();
            if ($category_entity->id != $id) {
                $item['id'] = $category_entity->id;
                $item['name'] = $category_entity->name;
                $item['parent_id'] = $category_entity->parent_id;
                $data[$item['id']] = $item;
            }
        }
        $category_tree = $this->getTree($data);
        $category_line_tree = [];
        $category_line_tree = $this->getLineTree($category_tree);
        return $category_line_tree;
    }

    protected function getLineTree($items, &$tree = [], $deep = 0, $separator = '--&nbsp;')
    {
        $deep++;
        foreach ($items as $item) {
            $item['name'] = str_repeat($separator, $deep - 1) . $item['name'];
            $tree[$item['id']] = $item;
            if (isset($item['nodes'])) {
                $this->getLineTree($item['nodes'], $tree, $deep, $separator);
            }
        }
        return $tree;
    }


    /**
     * 导出品类的三级数据
     * @return array
     */
    public function getExportCategoryData()
    {
        $rows = [];
        $items = [];
        $category_repository = new CategoryRepository();
        $category_entities = $category_repository->all();
        /** @var CategoryEntity $category_entity */
        foreach ($category_entities as $category_entity) {
            $item = $category_entity->toArray();
            $items[] = $item;
        }
        $collect = collect($items);
        $trees = $this->getAllCategories();
        foreach ($trees as $tree1) {
            foreach ($tree1['nodes'] ?? [] as $tree2) {
                foreach ($tree2['nodes'] ?? [] as $item) {
                    $row = [];
                    if ($item['level'] == 3) {
                        $row[3] = $item['name'];
                        $parent_id = $item['parent_id'];
                        $parent = $collect->where('id', '=', $parent_id)->first();
                        if (!empty($parent)) {
                            $row[2] = $parent['name'];
                            $parent_id = $parent['parent_id'];
                            $parent = $collect->where('id', '=', $parent_id)->first();
                            if (!empty($parent)) {
                                $row[1] = $parent['name'];
                            }
                        }
                        $rows[] = $row;
                    }
                }
            }
        }
        return $rows;
    }


    /**
     * @param $category_ids
     * @return array|string
     */
    public function getCategoryNameByIds($category_ids)
    {
        $category_repository = new CategoryRepository();
        $category_entities = $category_repository->getProductCategoryByIds($category_ids);
        $category_names = [];
        /** @var CategoryEntity $category_entity */
        foreach ($category_entities as $category_entity) {
            $category_names[] = $category_entity->name;
        }
        $category_names = implode(',', $category_names);
        return $category_names;
    }
}

