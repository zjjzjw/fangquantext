<?php namespace App\Admin\Http\Controllers\Api\Developer;

use App\Admin\Http\Controllers\BaseController;
use App\Admin\Src\Forms\Developer\DeveloperPartnership\DeveloperPartnershipDeleteForm;
use App\Admin\Src\Forms\Developer\DeveloperPartnership\DeveloperPartnershipStoreForm;
use App\Src\Developer\Domain\Model\DeveloperPartnershipEntity;
use App\Src\Developer\Infra\Repository\DeveloperPartnershipRepository;
use App\Src\Developer\Infra\Repository\DeveloperPartnershipCategoryRepository;
use Illuminate\Http\Request;

class DeveloperPartnershipController extends BaseController
{
    /**
     * 添加开发商项目
     * @param Request            $request
     * @param DeveloperPartnershipStoreForm $form
     * @param                    $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, DeveloperPartnershipStoreForm $form, $id)
    {
        $data = [];
        $form->validate($request->all());
        $developer_partnership_repository = new DeveloperPartnershipRepository();

        $developer_partnership_repository->save($form->developer_partnership_entity);
        $data['id'] = $form->developer_partnership_entity->id;
        return response()->json($data, 200);
    }

    /**
     * 修改开发商项目
     * @param Request                  $request
     * @param DeveloperPartnershipStoreForm       $form
     * @param                          $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, DeveloperPartnershipStoreForm $form, $id)
    {
        return $this->store($request, $form, $id);
    }

    /**
     * 删除开发商项目
     * @param Request                    $request
     * @param DeveloperPartnershipDeleteForm        $form
     * @param                            $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, DeveloperPartnershipDeleteForm $form, $id)
    {

        $data = [];
        $request->merge(['id' => $id]);
        $form->validate($request->all());
        $developer_partnership_repository = new DeveloperPartnershipRepository();
        $developer_partnership_repository->delete($id);

        $developer_partnership_category_repository = new DeveloperPartnershipcategoryRepository();
        $developer_partnership_category_repository->deleteByDeveloperPartnershipId($id);
        return response()->json($data, 200);
    }

}
