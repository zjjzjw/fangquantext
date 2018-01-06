<?php

namespace App\Hulk\Service\Comment;


use App\Src\Brand\Domain\Model\CommentType;
use App\Src\Brand\Infra\Repository\BrandRepository;
use App\Src\Brand\Infra\Repository\CommentRepository;
use App\Src\Brand\Domain\Model\CommentEntity;
use App\Src\Brand\Domain\Model\CommentSpecification;
use App\Src\Content\Domain\Model\UserInfoEntity;
use App\Src\Content\Infra\Repository\UserInfoRepository;
use App\Src\FqUser\Domain\Model\FqUserEntity;
use App\Src\FqUser\Infra\Repository\FqUserRepository;
use App\Src\Information\Infra\Repository\InformationRepository;
use App\Src\Product\Infra\Repository\ProductRepository;
use App\Src\Role\Domain\Model\UserEntity;
use App\Src\Role\Infra\Repository\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;


class CommentHulkService
{
    /**
     * @param CommentSpecification $spec
     * @param int                  $per_page
    $data = [];
     * @return array
     */
    public function getCommentList(CommentSpecification $spec, $per_page)
    {
        $comment_repository = new CommentRepository();
        $paginate = $comment_repository->search($spec, $per_page);
        $user_repository = new UserRepository();
        $items = [];
        /**
         * @var int                  $key
         * @var CommentEntity        $comment_entity
         * @var LengthAwarePaginator $paginate
         */
        foreach ($paginate as $key => $comment_entity) {
            $item = $comment_entity->toArray();
            /** @var UserEntity $user_entity */
            $user_entity = $user_repository->fetch($item['user_id']);
            if (isset($user_entity)) {
                $item['user_name'] = $user_entity->name;
            }
            $item['time_ago'] = time_ago($item['created_at']);
            $items[] = $item;
        }
        $data['paginate'] = $paginate;
        $data['items'] = $items;
        $data['pager']['total'] = $paginate->total();
        $data['pager']['last_page'] = $paginate->lastPage();
        $data['pager']['current_page'] = $paginate->currentPage();

        return $data;
    }

    /**
     * @param $pid
     * @param $type
     * @return array
     */
    public function getCommentListByPidAndType($pid, $type)
    {
        $data = [];
        $comment_repository = new CommentRepository();
        $user_repository = new UserRepository();
        $comment_entities = $comment_repository->getCommentListByPidAndType($pid, $type);
        /** @var CommentEntity $comment_entity */
        foreach ($comment_entities as $comment_entity) {
            $item['id'] = $comment_entity->id;
            /** @var UserInfoEntity $user_info_entity */
            $item['avatar'] = 'http://www.qq22.com.cn/uploads/allimg/201609081102/mxmlbwdpgcx103550.jpg';
            $item['user_name'] = '匿名';
            $fq_user_repository = new FqUserRepository();
            /** @var FqUserEntity $fq_user_entity */
            $fq_user_entity = $fq_user_repository->fetch($comment_entity->user_id);
            if (isset($fq_user_entity)) {
                if (!empty($fq_user_entity->nickname)) {
                    $item['user_name'] = $fq_user_entity->nickname;
                }
            }
            $user_info_repository = new UserInfoRepository();
            $user_info_entity = $user_info_repository->getUserInfoByUserId($comment_entity->user_id);
            if ($user_info_entity) {
                $item['avatar'] = $user_info_entity->wx_avatar;
            }
            $item['publish_time'] = time_ago($comment_entity->created_at);
            $item['content'] = $comment_entity->content;
            $data[] = $item;
        }
        return $data;
    }

    public function updateCommentCount($p_id, $type)
    {
        switch ($type) {
            case CommentType::BRAND:
                break;
            case CommentType::PRODUCT:
                $product_repository = new ProductRepository();
                $product_repository->updateCommentCount($p_id);
                break;
            case CommentType::INFORMATION:
                $information_repository = new InformationRepository();
                $information_repository->updateCommentCount($p_id);
                break;
        }
    }
}

