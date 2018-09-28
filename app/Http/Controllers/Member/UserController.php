<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\GetParamsTrait;
use App\Http\Service\UserService;

class UserController extends Controller
{
    use GetParamsTrait;
    protected $service;

    /**
     * RegisterMember constructor.
     * @param Member $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    /**
     * 註冊會員
     *
     */
    public function create() {
        // 取參數
        $data = $this->getParams([
            "username","password"
        ]);

        // 密碼加密
        $data["password"] = sha1($data["password"]);

        // 執行 DB 動作
        $serviceResult = $this->service->RegisterMember($data);

        return response()->json($serviceResult);
    }

    /**
     * 取用戶清單
     */
    public function userList() {
        // 執行 DB 動作
        $serviceResult = $this->service->GetUserList();

        return response()->json($serviceResult);
    }

    /**
     * 變更使用者密碼
     */
    public function editUserPassword() {
        // 取參數
        $data = $this->getParams([
            "username", "password"
        ]);

        // 密碼加密
        $data["password"] = sha1($data["password"]);

        // 執行 DB 動作
        $serviceResult = $this->service->EditUserPassword($data);

        return response()->json($serviceResult);
    }

    /**
     * 刪除帳號
     */
    public function deleteUser() {
        // 取參數
        $data = $this->getParams([
            "username"
        ]);

        // 執行 DB 動作
        $serviceResult = $this->service->DeleteUser($data);

        return response()->json($serviceResult);
    }
}
