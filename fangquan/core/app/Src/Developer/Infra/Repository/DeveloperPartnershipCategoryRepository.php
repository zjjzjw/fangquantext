<?php namespace App\Src\Developer\Infra\Repository;

use App\Foundation\Domain\Repository;
use App\Src\Developer\Domain\Interfaces\DeveloperPartnershipCategoryInterface;
use App\Src\Developer\Domain\Model\DeveloperPartnershipCategoryEntity;
use App\Src\Developer\Infra\Eloquent\DeveloperPartnershipCategoryModel;

class DeveloperPartnershipCategoryRepository extends Repository implements DeveloperPartnershipCategoryInterface
{
    /**
     * Store an entity into persistence.
     *
     * @param  DeveloperPartnershipCategoryEntity $developer_partnership_category_entity
     */
    protected function store($developer_partnership_category_entity)
    {
        if ($developer_partnership_category_entity->isStored()) {
            $model = DeveloperPartnershipCategoryModel::find($developer_partnership_category_entity->id);
        } else {
            $model = new DeveloperPartnershipCategoryModel();
        }
        $model->fill(
            [
                'partnership_id' => $developer_partnership_category_entity->partnership_id,
                'category_id'  => $developer_partnership_category_entity->category_id,
            ]
        );
        $model->save();
        $developer_partnership_category_entity->setIdentity($model->id);
    }

    /**
     * Reconstitute an entity from persistence.
     *
     * @param       $id
     * @param array $params
     *
     * @return DeveloperPartnershipCategoryEntity|null
     */
    protected function reconstitute($id, $params = [])
    {
        $model = DeveloperPartnershipCategoryModel::find($id);
        if (!isset($model)) {
            return null;
        }
        return $this->reconstituteFromModel($model);
    }

    /**
     * @param $model
     * @return DeveloperPartnershipCategoryEntity
     */
    private function reconstituteFromModel($model)
    {
        $entity = new DeveloperPartnershipCategoryEntity();
        $entity->id = $model->id;
        $entity->partnership_id = $model->partnership_id;
        $entity->category_id = $model->category_id;
        $entity->created_at = $model->created_at;
        $entity->updated_at = $model->updated_at;
        $entity->setIdentity($model->id);
        $entity->stored();
        return $entity;
    }

    /**
     * @param int|array $ids
     */
    public function delete($ids)
    {

        $builder = DeveloperPartnershipCategoryModel::query();
        $builder->whereIn('id', (array)$ids);
        $models = $builder->get();
        foreach ($models as $model) {
            $model->delete();
        }
    }
    public function deleteByDeveloperPartnershipId($id)
    {
        $builder = DeveloperPartnershipCategoryModel::query();
        $builder->where('partnership_id', $id);
        $models = $builder->get();
        foreach ($models as $model) {
            $model->delete();
        }
    }


    /**
     * @param $developer_partnership_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDeveloperPartnershipCategorysByDeveloperPartnershipId($developer_partnership_id)
    {
        $collect = collect();
        $builder = DeveloperPartnershipCategoryModel::query();
        $builder->where('partnership_id', $developer_partnership_id);
        $models = $builder->get();
        foreach ($models as $key => $model) {
            $collect[] = $this->reconstituteFromModel($model)->stored();
        }
        return $collect;
    }
}