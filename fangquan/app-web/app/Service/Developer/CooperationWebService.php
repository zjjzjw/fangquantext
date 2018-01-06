<?php

namespace App\Web\Service\Developer;

use App\Src\Developer\Domain\Model\DeveloperEntity;
use App\Src\Developer\Infra\Repository\DeveloperPartnershipRepository;
use App\Src\Developer\Infra\Repository\DeveloperRepository;
use App\Src\Provider\Domain\Model\ProviderEntity;
use App\Src\Provider\Infra\Repository\ProviderRepository;

class CooperationWebService
{
    public function getDevelopersByCategoryIds($categorys)
    {
        $data = [];
        $developer_repository = new DeveloperRepository();
        $developer_entities = $developer_repository->getDevelopersByCategoryIds($categorys);
        /** @var DeveloperEntity $developer_entity */
        foreach ($developer_entities as $developer_entity) {
            $item = $developer_entity->toArray();
            $data[] = $item;
        }
        return $data;
    }


    public function getProvidersByCategoryIds($categorys, $developer_list)
    {
        $data = [];
        $provider_repository = new ProviderRepository();
        $provider_entities = $provider_repository->getProviderBrandRank($categorys, false);
        $developer_partnership_repository = new DeveloperPartnershipRepository();
        /** @var ProviderEntity $provider_entity */
        foreach ($provider_entities as $provider_entity) {
            $item = $provider_entity->toArray();
            $item['relations'] = [];
            foreach ($developer_list as $developer) {
                $relation = $developer_partnership_repository->getRelation($provider_entity->id, $developer['id']);
                if ($relation->isNotEmpty()) {
                    $list['is_relation'] = true;
                } else {
                    $list['is_relation'] = false;

                }
                $item['relations'][] = $list;
            }
            $data[] = $item;
        }

        return $data;
    }


}