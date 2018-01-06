<?php

namespace App\Web\Http\Controllers;

use App\Service\Msg\UserMsgService;
use App\Src\Content\Domain\Model\UserInfoEntity;
use App\Src\Content\Infra\Repository\UserInfoRepository;
use App\Src\Surport\Domain\Model\ResourceEntity;
use App\Src\Surport\Infra\Repository\ResourceRepository;

class BaseController extends Controller
{
    protected function view($view, $data = array())
    {
        $data = array_merge(
            [
                'basic_data' => [
                    'user'       => request()->user(),
                    'user_info'  => $this->getUserInfo(),
                    'login_info' => $this->getLoginInfo(),
                ],
            ],
            $data
        );
        return view($view, $data);
    }

    public function getLoginInfo()
    {
        $user_info = [];
        if (request()->user()) {
            $user_info = request()->user()->toArray();
            $user_msg_service = new UserMsgService();
            $user_info['msg_unread_count'] = $user_msg_service->getUnreadMsgCount(request()->user()->id);
        }
        return $user_info;
    }

    /**
     * 得到用户详情
     */
    public function getUserInfo()
    {
        $user_info = [];
        if (request()->user()) {
            $user_info = request()->user()->toArray();
            if (!empty($user_info['avatar'])) {
                $resource_repository = new ResourceRepository();
                /** @var ResourceEntity $resource_entity */
                $resource_entity = $resource_repository->fetch($user_info['avatar']);
                $user_info['avatar_url'] = $resource_entity->url ?? '';
            }
            if (empty($user_info['avatar_url'])) {
                $user_info_repository = new UserInfoRepository();
                /** @var UserInfoEntity $user_info_entity */
                $user_info_entity = $user_info_repository->getUserInfoByUserId($user_info['id']);
                $user_info['avatar_url'] = $user_info_entity->wx_avatar;
            }
        }
        return $user_info;
    }


}


