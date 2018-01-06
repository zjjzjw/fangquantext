<?php namespace App\Src\Developer\Domain\Interfaces;

use App\Foundation\Domain\Interfaces\Repository;

interface DeveloperPartnershipInterface extends Repository
{

    /**
     * @param int|array $ids
     */
    public function delete($ids);

    /**
     * @param $provider_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDevelopersByProviderId($provider_id);

    /**
     * @param $developer_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProvidersByDeveloperId($developer_id);
}