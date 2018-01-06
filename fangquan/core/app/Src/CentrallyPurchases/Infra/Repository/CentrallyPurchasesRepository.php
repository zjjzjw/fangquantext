<?php namespace App\Src\CentrallyPurchases\Infra\Repository;

use App\Foundation\Domain\Repository;
use App\Src\CentrallyPurchases\Domain\Interfaces\CentrallyPurchasesInterface;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesEntity;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesSpecification;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesStatus;
use App\Src\CentrallyPurchases\Infra\Eloquent\CentrallyPurchasesModel;

class CentrallyPurchasesRepository extends Repository implements CentrallyPurchasesInterface
{
    /**
     * Store an entity into persistence.
     *
     * @param  CentrallyPurchasesEntity $centrally_purchases_entity
     */
    protected function store($centrally_purchases_entity)
    {
        if ($centrally_purchases_entity->isStored()) {
            $model = CentrallyPurchasesModel::find($centrally_purchases_entity->id);
        } else {
            $model = new CentrallyPurchasesModel();
        }
        $model->fill(
            [
                'content'           => $centrally_purchases_entity->content,
                'developer_id'      => $centrally_purchases_entity->developer_id,
                'p_nums'            => $centrally_purchases_entity->p_nums,
                'start_up_time'     => $centrally_purchases_entity->start_up_time,
                'publish_time'      => $centrally_purchases_entity->publish_time,
                'area'              => $centrally_purchases_entity->area,
                'province_id'       => $centrally_purchases_entity->province_id,
                'city_id'           => $centrally_purchases_entity->city_id,
                'created_user_id'   => $centrally_purchases_entity->created_user_id,
                'address'           => $centrally_purchases_entity->address,
                'bidding_node'      => $centrally_purchases_entity->bidding_node,
                'contact'           => $centrally_purchases_entity->contact,
                'contacts_phone'    => $centrally_purchases_entity->contacts_phone,
                'contacts_position' => $centrally_purchases_entity->contacts_position,
                'status'            => $centrally_purchases_entity->status,
            ]

        );
        $model->save();
        $centrally_purchases_entity->setIdentity($model->id);
    }

    /**
     * Reconstitute an entity from persistence.
     *
     * @param       $id
     * @param array $params
     *
     * @return CentrallyPurchasesEntity|null
     */
    protected function reconstitute($id, $params = [])
    {
        $model = CentrallyPurchasesModel::find($id);
        if (!isset($model)) {
            return null;
        }
        return $this->reconstituteFromModel($model);
    }

    /**
     * @param $model
     * @return CentrallyPurchasesEntity
     */
    private function reconstituteFromModel($model)
    {
        $entity = new CentrallyPurchasesEntity();
        $entity->id = $model->id;
        $entity->content = $model->content;
        $entity->developer_id = $model->developer_id;
        $entity->p_nums = $model->p_nums;
        $entity->start_up_time = $model->start_up_time;
        $entity->publish_time = $model->publish_time;
        $entity->area = $model->area;
        $entity->province_id = $model->province_id;
        $entity->city_id = $model->city_id;
        $entity->created_user_id = $model->created_user_id;
        $entity->address = $model->address;
        $entity->bidding_node = $model->bidding_node;
        $entity->contact = $model->contact;
        $entity->contacts_phone = $model->contacts_phone;
        $entity->contacts_position = $model->contacts_position;
        $entity->status = $model->status;
        $entity->created_at = $model->created_at;
        $entity->updated_at = $model->updated_at;
        $entity->setIdentity($model->id);
        $entity->stored();
        return $entity;
    }


    /**
     * @param CentrallyPurchasesSpecification $spec
     * @param int                             $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(CentrallyPurchasesSpecification $spec, $per_page = 10)
    {
        $builder = CentrallyPurchasesModel::query();

        if ($spec->keyword) {
            $builder->where('content', 'like', '%' . $spec->keyword . '%');
        }
        if ($spec->status) {
            $builder->where('status', $spec->status);
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
        $builder = CentrallyPurchasesModel::query();
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
    public function getAllCentrallyPurchasesList($status)
    {
        $collect = collect();
        $builder = CentrallyPurchasesModel::query();
        $builder->where('status', (array)$status);
        $models = $builder->get();
        /** @var CentrallyPurchasesModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }


    /**
     * @param string $keyword
     * @return array|\Illuminate\Support\Collection
     */
    public function getCentrallyPurchasesByKeyword($keyword)
    {
        $collect = collect();
        $builder = CentrallyPurchasesModel::query();
        $builder->where('content', 'like', '%' . $keyword . '%');
        $builder->limit(10);
        $models = $builder->get();
        /** @var CentrallyPurchasesModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }

    /**
     * @param array $ids
     * @return array|\Illuminate\Support\Collection
     */
    public function getCentrallyPurchasesByIds($ids)
    {
        $collect = collect();
        $builder = CentrallyPurchasesModel::query();
        $builder->whereIn('id', (array)$ids);
        $builder->orderByRaw('FIELD(id,' . implode(',', $ids) . ')');

        $models = $builder->get();
        /** @var CentrallyPurchasesModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }

    /**
     * @param int $developer_id
     * @return array|\Illuminate\Support\Collection
     */
    public function getCentrallyPurchasesByDeveloperId($developer_id)
    {
        $collect = collect();
        $builder = CentrallyPurchasesModel::query();
        $builder->where('developer_id', $developer_id);

        $models = $builder->get();
        /** @var CentrallyPurchasesModel $model */
        foreach ($models as $model) {
            $collect[] = $this->reconstituteFromModel($model);
        }
        return $collect;
    }

}