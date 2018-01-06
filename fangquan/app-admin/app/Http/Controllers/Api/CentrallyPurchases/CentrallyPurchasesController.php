<?php namespace App\Admin\Http\Controllers\Api\CentrallyPurchases;

use App\Admin\Http\Controllers\BaseController;
use App\Admin\Src\Forms\CentrallyPurchases\CentrallyPurchasesDeleteForm;
use App\Admin\Src\Forms\CentrallyPurchases\CentrallyPurchasesStoreForm;
use App\Src\CentrallyPurchases\Domain\Model\CentrallyPurchasesEntity;
use App\Src\CentrallyPurchases\Infra\Repository\CentrallyPurchasesRepository;
use Illuminate\Http\Request;

class CentrallyPurchasesController extends BaseController
{
    /**
     * 添加采集信息
     * @param Request                     $request
     * @param CentrallyPurchasesStoreForm $form
     * @param                             $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, CentrallyPurchasesStoreForm $form, $id)
    {
        $data = [];
        $form->validate($request->all());
        $centrally_purchases_repository = new CentrallyPurchasesRepository();
        $centrally_purchases_repository->save($form->centrally_purchases_entity);
        $data['id'] = $form->centrally_purchases_entity->id;
        return response()->json($data, 200);
    }

    /**
     * 修改采集信息
     * @param Request                     $request
     * @param CentrallyPurchasesStoreForm $form
     * @param                             $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, CentrallyPurchasesStoreForm $form, $id)
    {
        return $this->store($request, $form, $id);
    }

    /**
     * 删除采集信息
     * @param Request                      $request
     * @param CentrallyPurchasesDeleteForm $form
     * @param                              $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, CentrallyPurchasesDeleteForm $form, $id)
    {
        $data = [];
        $request->merge(['id' => $id]);
        $form->validate($request->all());
        $centrally_purchases_repository = new CentrallyPurchasesRepository();
        $centrally_purchases_repository->delete($id);

        return response()->json($data, 200);
    }


    public function keyword(Request $request)
    {
        $data = [];
        $keyword = $request->get('keyword');
        if ($keyword) {
            $centrally_purchases_repository = new CentrallyPurchasesRepository();
            $centrally_purchases_entities = $centrally_purchases_repository->getCentrallyPurchasesByKeyword($keyword);
            /** @var CentrallyPurchasesEntity $centrally_purchases_entity */
            foreach ($centrally_purchases_entities as $centrally_purchases_entity) {
                $brand = $centrally_purchases_entity->toArray();
                $item['id'] = $brand['id'];
                $item['name'] = $brand['content'];
                $data[] = $item;
            }
        }
        return response()->json($data, 200);
    }
}
