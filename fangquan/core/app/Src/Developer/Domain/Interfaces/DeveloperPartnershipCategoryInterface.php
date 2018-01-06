<?php namespace App\Src\Developer\Domain\Interfaces;

use App\Foundation\Domain\Interfaces\Repository;

interface DeveloperPartnershipCategoryInterface extends Repository
{

    /**
     * @param int|array $ids
     */
    public function delete($ids);

    /**
     * @param $developer_partnership_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDeveloperPartnershipCategorysByDeveloperPartnershipId($developer_partnership_id);
}