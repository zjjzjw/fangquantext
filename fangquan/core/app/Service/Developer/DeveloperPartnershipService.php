<?php

namespace App\Service\Developer;

use App\Src\Developer\Infra\Repository\DeveloperPartnershipRepository;
use App\Src\Developer\Infra\Repository\DeveloperPartnershipCategoryRepository;
use App\Src\Developer\Domain\Model\DeveloperPartnershipEntity;
use App\Src\Developer\Domain\Model\DeveloperPartnershipSpecification;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Src\Developer\Infra\Repository\DeveloperRepository;
use App\Src\Provider\Infra\Repository\ProviderRepository;
use App\Src\Category\Infra\Repository\CategoryRepository;
use App\Service\Category\CategoryService;

class DeveloperPartnershipService
{
    /**
     * @param DeveloperPartnershipSpecification $spec
     * @param int                    $per_page
     * @return array
     */

    public function getDeveloperPartnershipList(DeveloperPartnershipSpecification $spec, $per_page)
    {
        $data = [];
        $category_names=[];
        $developer_partnership_repository = new DeveloperPartnershipRepository();
        $developer_partnership_category_repository = new DeveloperPartnershipCategoryRepository();
        $paginate = $developer_partnership_repository->search($spec, $per_page);
        $developer_repository = new DeveloperRepository();
        $provider_repository = new ProviderRepository();
        $category_repository = new CategoryRepository();


        $items = [];
        /**
         * @var DeveloperPartnershipEntity      $developer_partnership_entity
         * @var LengthAwarePaginator $paginate
         */
        foreach ($paginate as $key => $developer_partnership_entity) {
            $item = $developer_partnership_entity->toArray();

            /** @var DeveloperPartnershipEntity $developer_entity */
            $category_entity =$category_repository->getProductCategoryByIds($item['developer_partnership_category']);

            if(!empty($category_entity)){
                foreach ($category_entity as $category) {
                    $category_info = $category->toArray();
                    $category_names[]=$category_info['name'];
                }
            }

            $item['category_names']=implode(',',$category_names);
            $category_names=[];
            $developer_entity = $developer_repository->fetch($item['developer_id']);
            if(!empty($developer_entity)){
                $item['developer_info']=$developer_entity->toArray();
            }


            $provider_entity = $provider_repository->fetch($item['provider_id']);
            if(!empty($provider_entity)){
                $item['provider_info']=$provider_entity->toArray();
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
    public function getDeveloperPartnershipInfo($id)
    {

        $data = [];
        $category_names=[];
        $developer_partnership_repository = new DeveloperPartnershipRepository();
        $developer_repository = new DeveloperRepository();
        $provider_repository = new ProviderRepository();
        $category_repository = new CategoryRepository();
        /** @var DeveloperPartnershipEntity $developer_partnership_entity */
        $developer_partnership_entity = $developer_partnership_repository->fetch($id);
        if (isset($developer_partnership_entity)) {
            $data = $developer_partnership_entity->toArray();
            $developer_entity = $developer_repository->fetch($data['developer_id']);
            if(!empty($developer_entity)){
                $data['developer_info']=$developer_entity->toArray();
            }


            $provider_entity = $provider_repository->fetch($data['provider_id']);
            if(!empty($provider_entity)){
                $data['provider_info']=$provider_entity->toArray();
            }
        }
        $category_entitys =$category_repository->getProductCategoryByIds($data['developer_partnership_category']);

        if(!empty($category_entitys)){
            foreach ($category_entitys as $category_entity) {
                $category_info = $category_entity->toArray();
                $category_names[]=$category_info['name'];
            }
        }

        $data['category_names']=implode(',',$category_names);

        return $data;
    }
}


