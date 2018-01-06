<?php

namespace App\Hulk\Service\User;


use App\Src\Content\Domain\Model\UserInfoEntity;
use App\Src\Content\Infra\Repository\UserInfoRepository;
use App\Src\FqUser\Domain\Model\FqUserAccountStatus;
use App\Src\FqUser\Domain\Model\FqUserAccountType;
use App\Src\FqUser\Domain\Model\FqUserEntity;
use App\Src\FqUser\Infra\Repository\FqUserRepository;
use App\Src\Role\Domain\Model\UserEntity;
use App\Src\Role\Domain\Model\UserType;
use App\Src\Role\Infra\Repository\UserRepository;
use App\Src\Surport\Domain\Model\ResourceEntity;
use App\Src\Surport\Infra\Repository\ResourceRepository;
use Carbon\Carbon;

class UserHulkService
{

    public function getUserInfoAndRegister($openid, $data)
    {
        $fq_user_repository = new FqUserRepository();
        $fq_user_entity = $fq_user_repository->getUserByOpenId($openid);
        if (!isset($fq_user_entity)) {
            $fq_user_entity = new FqUserEntity();
            $fq_user_entity->mobile = 0;
            $fq_user_entity->role_type = 0;
            $fq_user_entity->account_type = FqUserAccountType::TYPE_FREE;
            $fq_user_entity->email = '';
            $fq_user_entity->status = FqUserAccountStatus::TYPE_MOBILE;
            $fq_user_entity->role_id = 0;
            $fq_user_entity->account = $data['nickName'] ?? '';
            $fq_user_entity->nickname = $data['nickName'] ?? '';
            $fq_user_entity->platform_id = 0;
            $fq_user_entity->register_type_id = 0;
            $fq_user_entity->project_area = 0;
            $fq_user_entity->avatar = 0/*$data['avatarUrl'] ?? ''*/;
            $fq_user_entity->third_party_bind = [$openid];
            $fq_user_entity->admin_id = 0;
            $fq_user_entity->reg_time = Carbon::now();
            $fq_user_entity->expire = '2018-01-01';
            $fq_user_entity->password = '';
            $fq_user_entity->salt = 0;
            $fq_user_entity->company_name = '';
            $fq_user_entity->project_category = 0;
            $fq_user_repository->save($fq_user_entity);
        } else {
            $fq_user_entity->account = $data['nickName'] ?? '';
            $fq_user_entity->name = $data['nickName'] ?? '';
            $fq_user_entity->avatar = 0;
            $fq_user_repository->save($fq_user_entity);
        }
        $fq_user_entity = $fq_user_repository->fetch($fq_user_entity->id);
        $data = $fq_user_entity->toArray();
        return $data;
    }

    public function getFqUserInfo($id)
    {
        $data = [];
        $fq_user_repository = new FqUserRepository();
        $user_info_repository = new UserInfoRepository();
        /** @var FqUserEntity $fq_user_entity */
        $fq_user_entity = $fq_user_repository->fetch($id);
        if (isset($fq_user_entity)){
            $data = $fq_user_entity->toArray();
            /** @var UserInfoEntity $user_info_entity */
            $user_info_entity = $user_info_repository->getUserInfoByUserId($fq_user_entity->id);
            $data['position'] = $user_info_entity->position ?? '';
            $data['wx_avatar'] = $user_info_entity->wx_avatar ?? '';
            $data['name'] = $user_info_entity->name ?? '';
            $data['company'] = $user_info_entity->company ?? '';
        }
        return $data;
    }
}

