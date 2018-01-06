<?php namespace App\Src\Role\Domain\Interfaces;

use App\Foundation\Domain\Interfaces\Repository;
use App\Src\Role\Domain\Model\UserSignEntity;

interface UserSignInterface extends Repository
{
    /**
     * @param string $phone
     * @param string $name
     * @return array|\Illuminate\Support\Collection
     */
    public function getUsersByPhoneAndName($phone, $name);

    /**
     * @param int|array $ids
     */
    public function delete($ids);

    /**
     * @param int|array $ids
     * @return array|\Illuminate\Support\Collection
     */
    public function getUserSignByIds($ids);

    /**
     * @param string $phone
     * @return UserSignEntity|null
     */
    public function getUserSignByPhone($phone);

}