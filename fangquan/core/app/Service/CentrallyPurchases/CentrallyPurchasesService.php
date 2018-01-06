<?php

namespace App\Service\CentrallyPurchases;


use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesStatus;
use App\Src\CentrallyPurchases\Infra\Repository\CentrallyPurchasesRepository;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesEntity;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesSpecification;
use App\Src\Surport\Domain\Model\ResourceEntity;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Src\Surport\Infra\Repository\ResourceRepository;
use App\Service\Developer\DeveloperService;
use App\Service\FqUser\FqUserService;
use App\Src\Surport\Domain\Model\ProvinceEntity;
use App\Src\Surport\Infra\Repository\ProvinceRepository;
use App\Src\Surport\Domain\Model\CityEntity;
use App\Src\Surport\Infra\Repository\CityRepository;

class CentrallyPurchasesService
{
    /**
     * @param CentrallyPurchasesSpecification $spec
     * @param int                             $per_page
     * @return array
     */

    public function getCentrallyPurchasesList(CentrallyPurchasesSpecification $spec, $per_page)
    {
        $data = [];
        $centrally_purchases_repository = new CentrallyPurchasesRepository();
        $paginate = $centrally_purchases_repository->search($spec, $per_page);
        $developer_service = new DeveloperService();
        $fq_user_service = new FqUserService();
        $city_repository = new CityRepository();
        $province_repository = new ProvinceRepository();

        $centrally_purchases_status = CentrallyPurchasesStatus::acceptableEnums();
        $items = [];
        /**
         * @var int                      $key
         * @var CentrallyPurchasesEntity $centrally_purchases_entity
         * @var LengthAwarePaginator     $paginate
         */
        foreach ($paginate as $key => $centrally_purchases_entity) {
            $item = $centrally_purchases_entity->toArray();
            $item['developer_info'] = $developer_service->getDeveloperInfo($item['developer_id']);
            $item['user_info'] = $fq_user_service->getFqUserInfoById($item['created_user_id']);
            /** @var CityEntity $city_entity */
            $city_entity = $city_repository->fetch($item['city_id']);
            if (isset($city_entity)) {
                $item['city_name'] = $city_entity->name;
            }
            /** @var ProvinceEntity $province_entity */
            $province_entity = $province_repository->fetch($item['province_id']);
            if (isset($province_entity)) {
                $item['province_name'] = $province_entity->name;
            }
            $item['status_name'] = $centrally_purchases_status[$item['status']] ?? '';
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
    public function getCentrallyPurchasesInfo($id)
    {
        $data = [];

        $developer_service = new DeveloperService();
        $fq_user_service = new FqUserService();
        $city_repository = new CityRepository();
        $province_repository = new ProvinceRepository();
        $centrally_purchases_repository = new CentrallyPurchasesRepository();
        /** @var CentrallyPurchasesEntity $centrally_purchases_entity */
        $centrally_purchases_entity = $centrally_purchases_repository->fetch($id);
        if (isset($centrally_purchases_entity)) {
            $data = $centrally_purchases_entity->toArray();
            $data['developer_info'] = $developer_service->getDeveloperInfo($data['developer_id']);
            $data['start_up_time_str'] = $centrally_purchases_entity->start_up_time->format('Y年m月d日');

            $data['user_info'] = $fq_user_service->getFqUserInfoById($data['created_user_id']);
            /** @var CityEntity $city_entity */
            $city_entity = $city_repository->fetch($data['city_id']);
            if (isset($city_entity)) {
                $data['city_name'] = $city_entity->name;
            }
            /** @var ProvinceEntity $province_entity */
            $province_entity = $province_repository->fetch($data['province_id']);
            if (isset($province_entity)) {
                $data['province_name'] = $province_entity->name;
            }

        }
        return $data;
    }


    public function getCentrallyPurchasesByIds($ids)
    {
        $items = [];
        $centrally_purchases_repository = new CentrallyPurchasesRepository();
        $developer_service = new DeveloperService();
        $city_repository = new CityRepository();
        $province_repository = new ProvinceRepository();
        $centrally_purchases_entities = $centrally_purchases_repository->getCentrallyPurchasesByIds($ids);
        /** @var CentrallyPurchasesEntity $centrally_purchases_entity */
        foreach ($centrally_purchases_entities as $centrally_purchases_entity) {
            $item = $centrally_purchases_entity->toArray();
            $item['developer_info'] = $developer_service->getDeveloperInfo($item['developer_id']);
            /** @var CityEntity $city_entity */
            $city_entity = $city_repository->fetch($item['city_id']);
            if (isset($city_entity)) {
                $item['city_name'] = $city_entity->name;
            }
            /** @var ProvinceEntity $province_entity */
            $province_entity = $province_repository->fetch($item['province_id']);
            if (isset($province_entity)) {
                $item['province_name'] = $province_entity->name;
            }
            $items[] = $item;
        }
        return $items;
    }

    public function getCentrallyPurchasesByDeveloperId($developer_id)
    {
        $items = [];
        $centrally_purchases_repository = new CentrallyPurchasesRepository();
        $centrally_purchases_entities = $centrally_purchases_repository->getCentrallyPurchasesByDeveloperId($developer_id);
        /** @var CentrallyPurchasesEntity $centrally_purchases_entity */
        foreach ($centrally_purchases_entities as $centrally_purchases_entity) {
            $item = $centrally_purchases_entity->toArray();
            $items[] = $item;
        }
        return $items;
    }

}

