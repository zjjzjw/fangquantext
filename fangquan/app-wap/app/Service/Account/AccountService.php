<?php

namespace App\Wap\Service\Account;


use App\Service\Match\MatchService;
use App\Service\Smser\SmserService;
use App\Src\Exception\LoginException;
use App\Src\FqUser\Domain\Model\CheckThirdPartyEntity;
use App\Src\FqUser\Domain\Model\FqUserAccountType;
use App\Src\FqUser\Domain\Model\FqUserEntity;
use App\Src\FqUser\Domain\Model\FqUserPlatformType;
use App\Src\FqUser\Domain\Model\FqUserRegisterType;
use App\Src\FqUser\Domain\Model\FqUserRoleType;
use App\Src\FqUser\Domain\Model\FqUserStatus;
use App\Src\FqUser\Domain\Model\ThirdPartyBindEntity;
use App\Src\FqUser\Domain\Model\ValidMobileEntity;
use App\Src\FqUser\Domain\Model\VerifyCodeType;
use App\Src\FqUser\Infra\Repository\FqUserRepository;
use App\Src\FqUser\Infra\Repository\ThirdPartyBindRepository;
use App\Src\FqUser\Infra\Repository\ValidMobileRepository;
use Carbon\Carbon;

class AccountService
{
    /**
     * 第三方注册
     * @param $open_id
     * @param $nickname
     * @param $avatar
     * @return int
     */
    public function thirdPartyRegister($open_id, $nickname, $avatar)
    {
        $check_third_party_entity = new CheckThirdPartyEntity();
        $check_third_party_entity->open_id = $open_id;
        $check_third_party_entity->third_type = FqUserRegisterType::WECHAT;
        $fq_user_repository = new FqUserRepository();
        $fq_user_entity = new FqUserEntity();
        if (!empty($nickname) && MatchService::isValidNickname($nickname)) {
            $fq_user_entity->nickname = $nickname;
        } else {
            $fq_user_entity->nickname = 'fq' . time();
        }
        $fq_user_entity->avatar = $avatar;
        $fq_user_entity->mobile = "";
        $fq_user_entity->email = "";
        $fq_user_entity->account = "";
        $fq_user_entity->project_area = "";
        $fq_user_entity->project_category = "";
        $fq_user_entity->admin_id = 0;
        $fq_user_entity->company_name = "";
        $fq_user_entity->password = "";
        $fq_user_entity->salt = "";
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $expire = Carbon::now()->addMonth()->toDateTimeString();
        $fq_user_entity->expire = $expire;
        $fq_user_entity->reg_time = $now;

        $fq_user_entity->role_type = FqUserRoleType::UNKNOWN;
        $fq_user_entity->role_id = 0;
        $fq_user_entity->status = FqUserStatus::NORMAL_USE;// 正常使用
        $fq_user_entity->account_type = FqUserAccountType::TYPE_FREE;//免费账号
        $fq_user_entity->platform_id = FqUserPlatformType::TYPE_WECHAT_PUBLIC;//微信公众号
        $fq_user_entity->register_type_id = FqUserRegisterType::WECHAT_PUBLIC;//微信公众号
        $fq_user_repository->save($fq_user_entity);
        //第三方绑定表插入数据
        $third_party_bind_repository = new ThirdPartyBindRepository();
        $third_party_bind_entity = new ThirdPartyBindEntity();
        $third_party_bind_entity->open_id = $open_id;
        $third_party_bind_entity->user_id = $fq_user_entity->id;
        $third_party_bind_entity->third_type = FqUserRegisterType::WECHAT_PUBLIC;
        $third_party_bind_repository->save($third_party_bind_entity);
        return $fq_user_entity->id;
    }


    /**
     * 生成访问口令
     *
     * @return string
     */
    public function generateAccessToken()
    {
        return md5(uniqid("fq_mobile", true));
    }

    /**
     * 随机验证码
     * @return string
     */
    public function randCode()
    {
        return (String)rand(100000, 999999);
    }

    /**
     * 防止频繁发送
     * @param $phone
     * @return bool
     */
    public function isFrequently($phone)
    {
        $valid_mobile_repository = new ValidMobileRepository();
        $valid_mobile = $valid_mobile_repository->getValidMobileByPhone($phone);
        // 一分钟只能发送一次
        return $valid_mobile && Carbon::parse($valid_mobile->updated_at)->addMinutes(SmserService::VERIFY_CODE_FREQUENTLY_MINUTES) > Carbon::now();
    }

    /**
     * 验证验证码是否正确
     * @param $phone
     * @param $verifyCode
     * @return int
     */
    public function validVerifyCode($phone, $verifyCode)
    {
        $valid_mobile_repository = new ValidMobileRepository();
        $valid_mobile = $valid_mobile_repository->getValidMobileByPhone($phone);
        if ($valid_mobile && $valid_mobile->verifycode == $verifyCode) {
            if ($this->isVerifyCodeTimeout($valid_mobile)) {
                return LoginException::ERROR_SMS_VERIFY_CODE_TIMEOUT;
            } else {
                return 200;
            }
        } else {
            return LoginException::ERROR_SMS_VERIFY_CODE_ERROR;
        }
    }

    /**
     * 验证码是否已过期
     *
     * @param $model
     * @return bool
     */
    public function isVerifyCodeTimeout($model)
    {
        return Carbon::parse($model->expire) < Carbon::now();
    }

    /**
     * 获取验证码
     * @param $verify_code_entity
     * @throws LoginException
     */
    public function getVerifyCode($verify_code_entity)
    {
        $phone = $verify_code_entity->phone;
        $type = $verify_code_entity->type;
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $fq_user_repository = new FqUserRepository();
        if (!MatchService::isMobile($phone)) {
            throw new LoginException('', LoginException::ERROR_MOBILE_PATTERN_INVALID);
        } elseif ($fq_user_repository->getFqUserByPhone($phone) && (($type == VerifyCodeType::REGISTER || $type == VerifyCodeType::BIND_PHONE))) {
            throw new LoginException('', LoginException::ERROR_SMS_REGISTER_MOBILE_IS_EXIST);
        } elseif ($type == VerifyCodeType::RETRIEVE_PWD && !$fq_user_repository->getFqUserByPhone($phone)) {
            throw new LoginException('', LoginException::ERROR_SMS_SEND_RETRIEVE_PWD_PHONE_NOT_EXIST);
        }
        $valid_mobile_repository = new ValidMobileRepository();
        switch ($type) {
            case VerifyCodeType::REGISTER:
            case VerifyCodeType::RETRIEVE_PWD:
            case VerifyCodeType::BIND_PHONE:
            case VerifyCodeType::LOGIN:
                if ($this->isFrequently($phone)) {
                    throw new LoginException('', LoginException::ERROR_SMS_SEND_TOO_FREQUENTLY);
                }
                /** @var ValidMobileEntity $valid_mobile_entity */
                $valid_mobile_entity = $valid_mobile_repository->getValidMobileByPhone($phone);
                if (empty($valid_mobile_entity)) {
                    $valid_mobile_entity = new ValidMobileEntity();
                    $valid_mobile_entity->mobile = $phone;
                }
                $valid_mobile_entity->verifycode = $this->randCode();
                $valid_mobile_entity->expire = Carbon::parse($now)->addMinutes(SmserService::VERIFY_CODE_TIMEOUT_MINUTES);
                $valid_mobile_repository->save($valid_mobile_entity);
                SmserService::sendMessage($phone, $valid_mobile_entity->verifycode);
                break;
        }
    }
}

