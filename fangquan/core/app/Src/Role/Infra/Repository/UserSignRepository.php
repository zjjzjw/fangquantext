<?php namespace App\Src\Role\Infra\Repository;

use App\Foundation\Domain\Repository;
use App\Src\Role\Domain\Interfaces\UserSignInterface;
use App\Src\Role\Domain\Model\UserSignEntity;
use App\Src\Role\Infra\Eloquent\UserModel;
use App\Src\Role\Infra\Eloquent\UserSignModel;


class UserSignRepository extends Repository implements UserSignInterface
{
    /**
     * Store an entity into persistence.
     *
     * @param UserSignEntity $user_entity
     */
    protected function store($user_entity)
    {
        if ($user_entity->isStored()) {
            $model = UserSignModel::find($user_entity->id);
        } else {
            $model = new UserSignModel();
        }

        $model->fill(
            [
                'name'         => $user_entity->name,
                'phone'        => $user_entity->phone,
                'is_sign'      => $user_entity->is_sign,
                'position'     => $user_entity->position,
                'company_name' => $user_entity->company_name,
                'crowd'        => $user_entity->crowd,
            ]
        );
        $model->save();
        $user_entity->setIdentity($model->id);
    }

    /**
     * Reconstitute an entity from persistence.
     *
     * @param mixed $id
     * @param array $params Additional params.
     *
     * @return \App\Src\Role\Domain\Model\UserSignEntity
     */
    protected function reconstitute($id, $params = [])
    {
        $model = UserSignModel::find($id);
        if (!isset($model)) {
            return null;
        }
        return $this->reconstituteFromModel($model);
    }

    /**
     * @param $model
     * @return \App\Src\Role\Domain\Model\UserSignEntity
     */
    private function reconstituteFromModel($model)
    {
        $entity = new UserSignEntity();
        $entity->id = $model->id;
        $entity->name = $model->name;
        $entity->phone = $model->phone;
        $entity->is_sign = $model->is_sign;
        $entity->company_name = $model->company_name;
        $entity->crowd = $model->crowd;
        $entity->position = $model->position;
        $entity->created_at = $model->created_at;
        $entity->updated_at = $model->updated_at;
        $entity->setIdentity($model->id);
        $entity->stored();
        return $entity;
    }


    /**
     * @param string $phone
     * @param string $name
     * @return array|\Illuminate\Support\Collection
     */
    public function getUsersByPhoneAndName($phone, $name)
    {
        $collect = collect();
        $builder = UserSignModel::query();
        $builder->where('name', $name);
        if ($phone) {
            $builder->where('phone', $phone);
        }
        $models = $builder->get();
        /** @var UserSignModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }


    /**
     * @param int|array $ids
     */
    public function delete($ids)
    {
        $builder = UserSignModel::query();
        $builder->whereIn('id', (array)$ids);
        $models = $builder->get();
        foreach ($models as $model) {
            $model->delete();
        }
    }

    /**
     * @param int|array $ids
     * @return array|\Illuminate\Support\Collection
     */
    public function getUserSignByIds($ids)
    {
        $collect = collect();
        $builder = UserSignModel::query();
        $builder->whereIn('id', (array)$ids);
        $models = $builder->get();
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }

    /**
     * @param string $phone
     * @return UserSignEntity|null
     */
    public function getUserSignByPhone($phone)
    {
        $builder = UserSignModel::query();
        $builder->where('phone', $phone);
        $model = $builder->first();
        if (!isset($model)) {
            return null;
        }
        return $this->reconstituteFromModel($model);
    }


}