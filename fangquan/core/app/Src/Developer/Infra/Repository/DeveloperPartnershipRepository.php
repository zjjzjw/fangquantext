<?php namespace App\Src\Developer\Infra\Repository;

use App\Foundation\Domain\Repository;
use App\Src\Developer\Domain\Interfaces\DeveloperPartnershipInterface;
use App\Src\Developer\Domain\Model\DeveloperPartnershipEntity;
use App\Src\Developer\Domain\Model\DeveloperPartnershipSpecification;
use App\Src\Developer\Infra\Eloquent\DeveloperPartnershipModel;
use App\Src\Developer\Infra\Eloquent\DeveloperPartnershipCategoryModel;

class DeveloperPartnershipRepository extends Repository implements DeveloperPartnershipInterface
{
    /**
     * Store an entity into persistence.
     *
     * @param  DeveloperPartnershipEntity $developer_partnership
     */
    protected function store($developer_partnership_entity)
    {
        if ($developer_partnership_entity->isStored()) {
            $model = DeveloperPartnershipModel::find($developer_partnership_entity->id);
        } else {
            $model = new DeveloperPartnershipModel();
        }
        $model->fill(
            [
                'developer_id'   => $developer_partnership_entity->developer_id,
                'provider_id'   => $developer_partnership_entity->provider_id,
                'time' => $developer_partnership_entity->time,
                'address'   => $developer_partnership_entity->address,

            ]
        );

        $model->save();


        if (!empty($developer_partnership_entity->developer_partnership_category)) {
            $this->savePartnershipCategories($model, $developer_partnership_entity->developer_partnership_category);

        }
        $developer_partnership_entity->setIdentity($model->id);
    }

    /**
     * Reconstitute an entity from persistence.
     *
     * @param       $id
     * @param array $params
     *
     * @return DeveloperPartnershipEntity|null
     */
    protected function reconstitute($id, $params = [])
    {
        $model = DeveloperPartnershipModel::find($id);
        if (!isset($model)) {
            return null;
        }
        return $this->reconstituteFromModel($model);
    }

    /**
     * @param $model
     * @return DeveloperPartnershipEntity
     */
    private function reconstituteFromModel($model)
    {
        $entity = new DeveloperPartnershipEntity();
        $entity->id = $model->id;
        $entity->developer_id = $model->developer_id;
        $entity->provider_id = $model->provider_id;
        $entity->time = $model->time;
        $entity->address = $model->address;
        //产品品类类型
        $entity->developer_partnership_category = $model->PartnershipCategories->pluck('category_id')->toArray();
        $entity->created_at = $model->created_at;
        $entity->updated_at = $model->updated_at;
        $entity->setIdentity($model->id);
        $entity->stored();
        return $entity;
    }
    /**
     * 开发商合作品类数据保存
     * @param DeveloperPartnershipModel $model
     * @param                       $developer_partnership_category
     */
    protected function savePartnershipCategories($model, $developer_partnership_category)
    {
        $item = [];

        $this->deletePartnershipCategories($model->id);

        foreach ($developer_partnership_category as $partnership_category) {
            $item[] = new DeveloperPartnershipCategoryModel([
                'category_id' => $partnership_category,
                'partnership_id' => $model->id,
            ]);
        }

        $model->PartnershipCategories()->saveMany($item);
    }

    protected function deletePartnershipCategories($id)
    {
        $developer_partnership_category_query = DeveloperPartnershipCategoryModel::query();
        $developer_partnership_category_query->where('partnership_id', $id);
        $developer_partnership_category_models = $developer_partnership_category_query->get();
        foreach ($developer_partnership_category_models as $developer_partnership_category_model) {

            $developer_partnership_category_model->delete();
        }
    }

    /**
     * @param DeveloperPartnershipSpecification $spec
     * @param int                    $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(DeveloperPartnershipSpecification $spec, $per_page = 10)
    {
        $builder = DeveloperPartnershipModel::query();

        if ($spec->provider_id) {
            $builder->where('provider_id',  $spec->provider_id );
        }
        if ($spec->developer_id) {
            $builder->where('developer_id', $spec->developer_id);
        }


        if ($spec->page) {
            $paginator = $builder->paginate($per_page, ['*'], 'page', $spec->page);
        } else {
            $paginator = $builder->paginate($per_page);
        }

        foreach ($paginator as $key => $model) {
            $paginator[$key] = $this->reconstituteFromModel($model)->stored();
        }

        return $paginator;
    }

    /**
     * @param int|array $ids
     */
    public function delete($ids)
    {
        $builder = DeveloperPartnershipModel::query();
        $builder->whereIn('id', (array)$ids);
        $models = $builder->get();
        foreach ($models as $model) {

            $model->delete();
        }
    }

    /**
     * @param int|array $status
     * @return array|\Illuminate\Support\Collection
     */
    public function getAllDeveloperPartnershipList()
    {
        $collect = collect();
        $builder = DeveloperPartnershipModel::query();
        $models = $builder->get();
        /** @var DeveloperPartnershipModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }

    /**
     * @param $provider_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDevelopersByProviderId($provider_id)
    {
        $collect = collect();
        $builder = DeveloperPartnershipModel::query();
        $builder->where('provider_id', $provider_id);
        $models = $builder->get();
        foreach ($models as $key => $model) {
            $collect[] = $this->reconstituteFromModel($model)->stored();
        }
        return $collect;
    }

    /**
     * @param $developer_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProvidersByDeveloperId($developer_id)
    {
        $collect = collect();
        $builder = DeveloperPartnershipModel::query();
        $builder->where('developer_id', $developer_id);
        $models = $builder->get();
        foreach ($models as $key => $model) {
            $collect[] = $this->reconstituteFromModel($model)->stored();
        }
        return $collect;
    }


    public function getRelation($provider_id ,$developer_id)
    {
        $collect = collect();
        $builder = DeveloperPartnershipModel::query();
        $builder->where('developer_id', $developer_id);
        $builder->where('provider_id', $provider_id);
        $models = $builder->get();
        foreach ($models as $key => $model) {
            $collect[] = $this->reconstituteFromModel($model)->stored();
        }
        return $collect;
    }
}