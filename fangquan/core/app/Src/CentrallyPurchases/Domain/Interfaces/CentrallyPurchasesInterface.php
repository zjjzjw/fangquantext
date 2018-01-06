<?php namespace App\Src\CentrallyPurchases\Domain\Interfaces;

use App\Foundation\Domain\Interfaces\Repository;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesSpecification;

interface CentrallyPurchasesInterface extends Repository
{
    /**
     * @param CentrallyPurchasesSpecification $spec
     * @param int                    $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(CentrallyPurchasesSpecification $spec, $per_page = 10);

    /**
     * @param int|array $ids
     */
    public function delete($ids);


    /**
     * @param string $keyword
     * @return array|\Illuminate\Support\Collection
     */
    public function getCentrallyPurchasesByKeyword($keyword);


}