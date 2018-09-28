<?php

namespace APP\Http\Service;

use App\Http\Repository\UserRepository;
use App\Http\Controllers\Traits\GetParamsTrait;

class UserService{

    use GetParamsTrait;
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 註冊會員
     */
    public function RegisterMember($data) {
        // 註冊會員
        $result = $this->repository->RegisterMember($data);

        if($result["Result"] == false){
            return $result;
        }

        $result["Message"] = "register member access";
        return $result;
    }

    /**
     * 取用戶清單
     */
    public function GetUserList() {
        $result = $this->repository->GetUserList();

        if($result["Result"] == false){
            return $result;
        }

        $result["Message"] = "get user list access";
        return $result;
    }

    /**
     * 變更使用者密碼
     */
    public function EditUserPassword($param) {
        $result = $this->repository->EditUserPassword($param);

        if($result["Result"] == false){
            return $result;
        }

        $result["Message"] = "change user password access";
        return $result;
    }

    /**
     * 刪除用戶帳號
     */
    public function DeleteUser($param) {
        $result = $this->repository->DeleteUser($param);

        if($result["Result"] == false){
            return $result;
        }

        $result["Message"] = "delete user account access";
        return $result;
    }
}
