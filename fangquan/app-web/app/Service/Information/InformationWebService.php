<?php

namespace App\Web\Service\Information;

use App\Src\Information\Domain\Model\InformationEntity;
use App\Src\Information\Domain\Model\InformationSpecification;
use App\Src\Information\Infra\Repository\InformationRepository;
use App\Src\Surport\Domain\Model\ResourceEntity;
use App\Src\Surport\Infra\Repository\ResourceRepository;
use App\Src\Tag\Domain\Model\TagEntity;
use App\Src\Tag\Infra\Repository\TagRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class InformationWebService
{
    /**
     * @param InformationSpecification $spec
     * @param int                      $per_page
     * @return array
     */
    public function getInformationList(InformationSpecification $spec, $per_page)
    {
        $data = [];
        $information_repository = new InformationRepository();
        $tag_repository = new TagRepository();
        $resource_repository = new ResourceRepository();
        $paginate = $information_repository->search($spec, $per_page);
        $items = [];

        /**
         * @var int                  $key
         * @var InformationEntity    $information_entity
         * @var LengthAwarePaginator $paginate
         */
        foreach ($paginate as $key => $information_entity) {
            $item = $information_entity->toArray();

            $item['publish_at_str'] = $information_entity->publish_at->format('Y.m.d');
            $item['tag_name'] = '';
            if (!empty($information_entity->tag_id)) {
                /** @var TagEntity $tag_entity */
                $tag_entity = $tag_repository->fetch($information_entity->tag_id);
                if (isset($tag_entity)) {
                    $item['tag_name'] = $tag_entity->name;
                }
            }
            $item['image'] = '';
            if (!empty($information_entity->thumbnail)) {
                /** @var ResourceEntity $thumbnail_entity */
                $thumbnail_entity = $resource_repository->fetch($information_entity->thumbnail);
                if (isset($thumbnail_entity)) {
                    $item['image_url'] = $thumbnail_entity->url;
                }
            }
            $items[] = $item;
        }
        $data['items'] = $items;
        $data['pager']['total'] = $paginate->total();
        $data['pager']['last_page'] = $paginate->lastPage();
        $data['pager']['current_page'] = $paginate->currentPage();

        return $data;
    }
}
