<?php namespace App\Src\Information\Domain\Interfaces;


use App\Foundation\Domain\Interfaces\Repository;
use App\Src\Information\Domain\Model\InformationSpecification;
use Carbon\Carbon;
use Carbon\CarbonInterval;

interface InformationInterface extends Repository
{

    /**
     * @param InformationSpecification $spec
     * @param int                      $per_page
     * @return mixed
     */
    public function search(InformationSpecification $spec, $per_page = 10);

    /**
     * @param int|array $ids
     */
    public function delete($ids);

    /**
     * @param int       $brand_id
     * @param int|array $status
     * @return mixed
     */
    public function getInformationListByBrandId($brand_id, $status);

    /**
     * @param int       $product_id
     * @param int       $limit
     * @param int|array $status
     * @return mixed
     */
    public function getInformationListByProductId($product_id, $limit, $status);

    /**
     * @param int $limit
     * @return mixed
     */
    public function getTopInformationByLimit($limit);

    /**
     * @param Carbon $time
     * @return mixed
     */
    public function getInformationListByPublishTime($time);

}